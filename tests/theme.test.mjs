import assert from 'node:assert/strict';
import { readFileSync, readdirSync } from 'node:fs';
import { spawnSync } from 'node:child_process';
import { fileURLToPath } from 'node:url';
import test from 'node:test';

const root = new URL( '../', import.meta.url );
const read = ( path ) => readFileSync( new URL( path, root ), 'utf8' );
const json = JSON.parse( read( 'theme.json' ) );

const coreBlockNames = new Set( [
    'archives', 'buttons', 'group', 'heading', 'home-link', 'latest-posts',
    'navigation', 'paragraph', 'pattern', 'post-author', 'post-author-name', 'post-comments-form',
    'post-content', 'post-date', 'post-excerpt', 'post-featured-image',
    'post-template', 'post-terms', 'post-title', 'query', 'query-no-results',
    'query-pagination', 'query-pagination-next', 'query-pagination-numbers',
    'query-pagination-previous', 'query-title', 'read-more', 'search', 'site-title',
    'spacer', 'template-part', 'term-description',
] );

test( 'uses theme.json v3 and publishes the MakerBlocks token contract', () => {
    assert.equal( json.version, 3 );
    assert.deepEqual( json.settings.layout, { contentSize: '720px', wideSize: '1200px' } );

    const colors = json.settings.color.palette.map( ( color ) => color.slug );
    assert.deepEqual( colors, [ 'canvas', 'surface', 'ink', 'muted', 'accent', 'highlight', 'border' ] );
    assert.deepEqual( json.settings.spacing.spacingSizes.map( ( size ) => size.slug ), [ '20', '30', '40', '50', '60', '70' ] );
    assert.deepEqual( json.settings.typography.fontFamilies.map( ( family ) => family.slug ), [ 'sans', 'display' ] );
    assert.deepEqual( json.settings.typography.fontSizes.map( ( size ) => size.slug ), [ 'small', 'medium', 'large', 'x-large' ] );
    assert.deepEqual( Object.keys( json.settings.custom.radius ), [ 'small', 'medium', 'large', 'pill' ] );
    assert.deepEqual( Object.keys( json.settings.custom.focus ), [ 'color', 'offset', 'width' ] );
    assert.deepEqual( json.settings.custom.layout, { content: '720px', wide: '1200px' } );
} );

test( 'templates and shell use only core blocks', () => {
    const files = [
        ...readdirSync( new URL( 'templates/', root ) ).map( ( name ) => `templates/${ name }` ),
        ...readdirSync( new URL( 'parts/', root ) ).map( ( name ) => `parts/${ name }` ),
    ];

    for ( const file of files ) {
        for ( const match of read( file ).matchAll( /<!-- wp:([^\s{]+).*?-->/g ) ) {
            const name = match[ 1 ];
            assert.ok( ! name.includes( '/' ) && coreBlockNames.has( name ), `${ file } uses non-core or unexpected block ${ name }` );
        }
    }
} );

test( 'theme setup is broad and runtime-free', () => {
    const functions = read( 'functions.php' );
    for ( const support of [ 'title-tag', 'automatic-feed-links', 'post-thumbnails', 'editor-styles' ] ) {
        assert.match( functions, new RegExp( `add_theme_support\\( '${ support }'` ) );
    }
    assert.match( functions, /load_theme_textdomain\( 'makerstarter'/ );
    assert.doesNotMatch( functions, /wp_enqueue_script|tgmpa|plugin-install/i );
    assert.equal( readdirSync( root ).some( ( name ) => /^(src|assets|scripts|tailwind\.config)/i.test( name ) ), false );
} );

test( 'declares the replaceable parent and child-theme boundary', () => {
    const boundary = read( 'CORE-BOUNDARY.md' );
    const readme = read( 'README.md' );
    const stylesheet = read( 'style.css' );

    assert.match( boundary, /FRAMEWORK CORE — DO NOT EDIT; update from playground releases/ );
    assert.match( boundary, /Every tracked file beneath `wp-content\/themes\/makerstarter\/` is core-owned/ );
    assert.match( boundary, /`themes\/<site>-theme\/`/ );
    assert.match( readme, /Template: makerstarter/ );
    assert.match( read( 'scaffolds/child-theme/README.md' ), /^# PROJECT OWNED — EDIT HERE/ );
    const childStylesheet = read( 'scaffolds/child-theme/style.css' );
    assert.match( childStylesheet, /Template: makerstarter/ );
    assert.match( childStylesheet, /\{\{PROJECT_SLUG\}\}-theme/ );
    assert.match( childStylesheet, /Description:\s+A custom full-site editing theme for \{\{SITE_TITLE\}\}/ );
    assert.match( childStylesheet, /Author URI:\s+https:\/\/github\.com\/prospect-ogujiuba/ );
    assert.match( childStylesheet, /Requires at least:\s+6\.8/ );
    assert.ok( readdirSync( new URL( 'scaffolds/child-theme/', root ) ).includes( 'screenshot.png' ) );
    assert.match( stylesheet, /Requires at least:\s+6\.8/ );
    assert.match( stylesheet, /Requires PHP:\s+8\.2/ );
} );

test( 'boots and registers standard hooks without a child workspace', () => {
    const entry = fileURLToPath( new URL( '../functions.php', import.meta.url ) );
    const script = `
        define( 'ABSPATH', __DIR__ );
        $hooks = [];
        function add_action( $hook, $callback, $priority = 10 ) {
            global $hooks;
            $hooks[$hook] = [$callback, $priority];
        }
        require ${ JSON.stringify( entry ) };
        echo implode( ',', array_keys( $hooks ) );
    `;
    const result = spawnSync( 'php', [ '-r', script ], { encoding: 'utf8' } );

    assert.equal( result.status, 0, result.stderr );
    assert.equal( result.stdout, 'after_setup_theme,init' );
} );

test( 'MakerBlocks patterns include semantic saved fallbacks', () => {
    const patternFiles = readdirSync( new URL( 'patterns/', root ) )
        .filter( ( name ) => name.startsWith( 'makerblocks-' ) );
    assert.ok( patternFiles.length >= 2 );

    for ( const name of patternFiles ) {
        const pattern = read( `patterns/${ name }` );
        assert.match( pattern, /<!-- wp:makerblocks\// );
        assert.match( pattern, /<(?:section|article|div)\b[^>]*class="[^"]*wp-block-makerblocks-/ );
        assert.match( pattern, /<h[1-6]\b/ );
        assert.match( pattern, /<p\b/ );
    }
} );
