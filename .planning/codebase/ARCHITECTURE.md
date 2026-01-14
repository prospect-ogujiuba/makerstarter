# Architecture

**Analysis Date:** 2026-01-06

## Pattern Overview

**Overall:** Full Site Editing (FSE) WordPress Theme with Block Composition

**Key Characteristics:**
- Pure presentation layer (no business logic)
- Block-driven templates (data structures not PHP code)
- Modular include system with array-based loading
- Asset compilation pipeline (SCSS → CSS, ES6 → bundled JS)

## Layers

**Configuration Layer (`/inc`):**
- Purpose: Theme setup, feature registration, asset management
- Contains: Theme support hooks, menu config, asset enqueueing, variables
- Location: `inc/*.php` files
- Depends on: WordPress core hooks
- Used by: WordPress theme loading sequence

**Template Layer (`/templates`):**
- Purpose: FSE block templates (HTML with block markup)
- Contains: 13 template files (front-page, page, single, custom page templates)
- Location: `templates/*.html`
- Depends on: makerblocks plugin for block rendering
- Used by: WordPress FSE template hierarchy

**Asset Source Layer (`/src`):**
- Purpose: Uncompiled JavaScript and SCSS source code
- Contains: JS classes, SCSS modules (7-1 pattern)
- Location: `src/index.js`, `src/scripts/`, `src/styles/`
- Depends on: Build tools (@wordpress/scripts, Sass)
- Used by: Build pipeline to generate `/assets`

**Asset Output Layer (`/assets`):**
- Purpose: Compiled, browser-ready JS and CSS
- Contains: Bundled JavaScript, compiled CSS, dependency manifests
- Location: `assets/js/`, `assets/css/`, `assets/admin/`
- Depends on: Build step completion
- Used by: Frontend and WordPress block editor

## Data Flow

**Theme Initialization:**

1. WordPress loads `functions.php`
2. Include loader iterates array: `['maker_starter_setup', 'variables', 'menu_config', 'required_plugins', 'enqueue_assets']`
3. Each include file registers WordPress hooks
4. Hooks fire during WordPress request lifecycle:
   - `after_setup_theme` → register theme features
   - `wp_enqueue_scripts` → register frontend assets
   - `enqueue_block_assets` → register editor assets
   - `admin_enqueue_scripts` → register admin assets

**Page Render Lifecycle:**

1. User requests page (e.g., `/services`)
2. WordPress loads appropriate template (`templates/page-services.html`)
3. Template contains block markup: `<!-- wp:makerblocks/header /-->`, etc.
4. WordPress block editor parses comments as block definitions
5. makerblocks plugin renders each block to HTML
6. Enqueued assets (`assets/js/index.js`, `assets/css/styles.css`) load in browser
7. JavaScript initializes `MakerStarter` class
8. CSS applies from compiled styles

**Asset Build Flow:**

```
Development:
  src/index.js → @wordpress/scripts (webpack) → assets/js/index.js
  src/styles/styles.scss → Sass compiler → assets/css/styles.css

Production:
  Same flow with minification enabled
```

**State Management:**
- Stateless theme (no session or user state managed in theme)
- Block state managed by makerblocks plugin
- WordPress core manages auth, session, database

## Key Abstractions

**Include Array Pattern:**
- Purpose: Centralized module loading
- Location: `functions.php`
- Pattern: Array of filenames → foreach → include from `/inc`
- Example: `$includes = ['maker_starter_setup', ...]` → `include('/inc/' . $include . '.php')`

**Global Variable Context:**
- Purpose: Share theme metadata across includes
- Location: `inc/variables.php`
- Pattern: Global variables for theme URI, asset versions
- Example: `global $theme_uri, $script_version, $style_version`

**SCSS Module System:**
- Purpose: Modular styling with barrel exports
- Location: `src/styles/` with subdirectories
- Pattern: 7-1 architecture (abstracts, base, layout, pages, components)
- Example: `@use "abstracts"` → loads `abstracts/_index.scss` → forwards all partials

**FSE Block Composition:**
- Purpose: Template rendering via block markup
- Location: `templates/*.html`
- Pattern: HTML comments with JSON attributes
- Example: `<!-- wp:makerblocks/hero {"ctaPrimary": {"text": "..."}} /-->`

## Entry Points

**PHP Entry:**
- Location: `functions.php`
- Triggers: WordPress theme activation/loading
- Responsibilities: Load includes, bootstrap theme

**JavaScript Entry:**
- Location: `src/index.js` → compiled to `assets/js/index.js`
- Triggers: Frontend page load, block editor load
- Responsibilities: Instantiate MakerStarter class, initialize theme JS

**SCSS Entry:**
- Location: `src/styles/styles.scss`
- Triggers: Build step (npm run dev/prod)
- Responsibilities: Import all SCSS modules, compile to CSS

## Error Handling

**Strategy:** Minimal error handling (relies on WordPress defaults)

**Patterns:**
- No try/catch blocks in theme code
- No custom error logging
- Asset loading failures handled by WordPress (missing files fail silently)

**Gap:** No error handling for `filemtime()` calls in `inc/variables.php` - will break if assets don't exist

## Cross-Cutting Concerns

**Logging:**
- console.log in JavaScript (`src/scripts/MakerStarter.js`)
- No structured logging framework

**Validation:**
- No input validation in theme (theme doesn't accept user input)
- Block validation handled by makerblocks plugin

**Asset Versioning:**
- Cache busting via `filemtime()` on compiled assets - `inc/variables.php`
- Version strings appended to asset URLs automatically

---

*Architecture analysis: 2026-01-06*
*Update when major patterns change*
