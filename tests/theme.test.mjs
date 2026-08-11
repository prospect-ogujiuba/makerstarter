import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';

const json = JSON.parse( readFileSync( new URL( '../theme.json', import.meta.url ) ) );
test( 'uses theme.json v3 with content widths', () => {
    assert.equal( json.version, 3 );
    assert.ok( json.settings.layout.contentSize );
    assert.ok( json.settings.layout.wideSize );
} );
