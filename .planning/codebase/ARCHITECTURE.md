# Architecture

**Analysis Date:** 2026-01-19

## Pattern Overview

**Overall:** WordPress Full Site Editing (FSE) Theme with Block Delegation

**Key Characteristics:**
- Zero PHP templating - all rendering delegated to Gutenberg block editor
- Single template (`templates/index.html`) uses `makerblocks/app` block for all page rendering
- Theme provides only: asset enqueuing, WP theme support, and SCSS/JS build pipeline
- Presentation logic lives in companion `makerblocks` plugin, not theme

## Layers

**Configuration Layer:**
- Purpose: Theme setup, WP hooks, global variables
- Location: `functions.php` + `inc/*.php`
- Contains: Theme support registration, menu registration, asset enqueuing
- Depends on: WordPress core, TGM Plugin Activation
- Used by: WordPress theme loader

**Asset Layer:**
- Purpose: Frontend styles and scripts
- Location: `src/` (source) → `assets/` (compiled)
- Contains: SCSS modules, JS classes
- Depends on: @wordpress/scripts, Sass compiler
- Used by: Frontend, block editor

**Template Layer:**
- Purpose: Define page structure via block composition
- Location: `templates/*.html`
- Contains: Block markup only (no PHP)
- Depends on: `makerblocks` plugin for `makerblocks/app` block
- Used by: WordPress FSE template resolution

**Build Layer:**
- Purpose: Transform source to production assets
- Location: `package.json` scripts, webpack (via @wordpress/scripts)
- Contains: Build configuration
- Depends on: Node.js, npm
- Used by: Development workflow

## Data Flow

**Page Request:**
1. WordPress resolves template → `templates/index.html`
2. Block parser encounters `<!-- wp:makerblocks/app /-->`
3. `makerblocks` plugin renders entire page via React/PHP
4. Theme assets (`styles.css`, `index.js`) loaded via `wp_enqueue_scripts`

**Asset Compilation:**
1. `src/index.js` → webpack → `assets/js/index.js`
2. `src/styles/styles.scss` → Sass → `assets/css/styles.css`
3. Version busting via `filemtime()` in `inc/variables.php`

**State Management:**
- No client-side state in theme
- All state managed by WordPress block editor or `makerblocks` plugin

## Key Abstractions

**PHP Include System:**
- Purpose: Modular PHP organization
- Examples: `inc/enqueue_assets.php`, `inc/maker_starter_setup.php`
- Pattern: Array-based autoloading in `functions.php`

**SCSS Layer Architecture:**
- Purpose: Organized styling with ITCSS-like structure
- Examples: `src/styles/abstracts/`, `src/styles/components/`
- Pattern: Each layer has `_index.scss` that `@forward`s partials

**JavaScript Class Pattern:**
- Purpose: Encapsulated frontend behavior
- Examples: `src/scripts/MakerStarter.js`
- Pattern: ES6 class with constructor calling `init()`

## Entry Points

**PHP Entry:**
- Location: `functions.php`
- Triggers: WordPress `after_setup_theme`, `wp_enqueue_scripts`, etc.
- Responsibilities: Load includes, register hooks

**JavaScript Entry:**
- Location: `src/index.js`
- Triggers: Page load (script enqueued with `wp-element` dependency)
- Responsibilities: Instantiate script classes

**Style Entry:**
- Location: `src/styles/styles.scss`
- Triggers: Sass compilation
- Responsibilities: Import all SCSS layers in order

**Template Entry:**
- Location: `templates/index.html`
- Triggers: Any page request (FSE catch-all)
- Responsibilities: Invoke `makerblocks/app` block

## Error Handling

**Strategy:** WordPress default (WP_DEBUG, error logging)

**Patterns:**
- No custom error handling in theme
- Silent `index.php` in root prevents directory listing

## Cross-Cutting Concerns

**Logging:** WordPress default (`error_log()`, WP_DEBUG_LOG)
**Validation:** None in theme - delegated to WordPress/makerblocks
**Authentication:** WordPress core handles all auth

---

*Architecture analysis: 2026-01-19*
