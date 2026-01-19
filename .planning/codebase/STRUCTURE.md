# Codebase Structure

**Analysis Date:** 2026-01-19

## Directory Layout

```
makerstarter/
├── assets/                 # Compiled/production assets
│   ├── admin/             # WP admin-specific assets
│   ├── css/               # Compiled CSS
│   └── js/                # Compiled JavaScript
├── inc/                    # PHP includes (modular functions)
├── src/                    # Source files for compilation
│   ├── scripts/           # JavaScript source classes
│   └── styles/            # SCSS source
│       ├── abstracts/     # Variables, mixins, functions
│       ├── base/          # Reset, typography, fonts
│       ├── components/    # UI components
│       ├── layout/        # Major layout sections
│       └── pages/         # Page-specific styles
├── templates/              # FSE block templates
├── vendor/                 # Composer dependencies
├── .claude/                # Claude agent configuration
├── .planning/              # Project documentation
├── functions.php           # Main PHP entry point
├── theme.json              # FSE configuration
├── package.json            # npm configuration
└── style.css               # WP theme metadata (required)
```

## Directory Purposes

**`assets/`:**
- Purpose: Production-ready compiled assets
- Contains: CSS, JS bundles, source maps
- Key files: `css/styles.css`, `js/index.js`

**`assets/admin/`:**
- Purpose: WordPress admin dashboard assets
- Contains: Admin-only JS/CSS
- Key files: `index-wp-admin.js`, `styles-wp-admin.css`

**`inc/`:**
- Purpose: Modular PHP functionality
- Contains: Individual feature files loaded by `functions.php`
- Key files: `enqueue_assets.php`, `maker_starter_setup.php`, `variables.php`

**`src/`:**
- Purpose: Development source files
- Contains: Uncompiled JS and SCSS
- Key files: `index.js`, `styles/styles.scss`

**`src/styles/abstracts/`:**
- Purpose: SCSS design tokens and utilities
- Contains: Variables, mixins, functions, breakpoints
- Key files: `_variables.scss`, `_mixins.scss`, `_breakpoints.scss`

**`src/styles/base/`:**
- Purpose: Foundation styles
- Contains: Resets, typography, fonts
- Key files: `_base.scss`, `_typography.scss`, `_fonts.scss`

**`src/styles/components/`:**
- Purpose: Reusable UI component styles
- Contains: Individual component partials
- Key files: Add `_componentname.scss` here

**`src/styles/layout/`:**
- Purpose: Major layout section styles
- Contains: Header, footer, grid styles
- Key files: Add `_header.scss`, `_footer.scss` here

**`src/styles/pages/`:**
- Purpose: Page-specific style overrides
- Contains: Single page/template styles
- Key files: Add `_front-page.scss`, `_archive.scss` here

**`templates/`:**
- Purpose: FSE block templates
- Contains: HTML files with block markup
- Key files: `index.html` (catch-all template)

## Key File Locations

**Entry Points:**
- `functions.php`: PHP bootstrap, loads all includes
- `src/index.js`: JavaScript entry, instantiates classes
- `src/styles/styles.scss`: SCSS entry, imports all layers
- `templates/index.html`: FSE catch-all template

**Configuration:**
- `theme.json`: FSE settings, layout, block configuration
- `package.json`: npm scripts, dependencies
- `composer.json`: PHP dependencies (if present)

**Core Logic:**
- `inc/enqueue_assets.php`: Asset registration and enqueuing
- `inc/maker_starter_setup.php`: Theme support and menus
- `inc/variables.php`: Global PHP variables (paths, versions)

**Compiled Output:**
- `assets/js/index.js`: Bundled JavaScript
- `assets/css/styles.css`: Compiled CSS

## Naming Conventions

**Files:**
- PHP includes: `snake_case.php` (e.g., `enqueue_assets.php`)
- SCSS partials: `_kebab-case.scss` with leading underscore
- JS classes: `PascalCase.js` (e.g., `MakerStarter.js`)
- Templates: `kebab-case.html`

**Directories:**
- All lowercase, no underscores
- SCSS layers: singular nouns (`components/`, not `component/`)

**Functions:**
- PHP: `makerstarter_` prefix with snake_case (e.g., `makerstarter_enqueue_assets`)
- JS: camelCase methods within PascalCase classes

## Where to Add New Code

**New PHP Feature:**
1. Create `inc/{feature_name}.php`
2. Add to `$includes` array in `functions.php`
3. Use `makerstarter_` function prefix

**New JavaScript Class:**
1. Create `src/scripts/{ClassName}.js`
2. Import and instantiate in `src/index.js`
3. Run `npm run dev` to compile

**New SCSS Component:**
1. Create `src/styles/components/_{name}.scss`
2. Add `@forward '../components/{name}';` to `src/styles/components/_index.scss`
3. Run `npm run dev` to compile

**New Page Style:**
1. Create `src/styles/pages/_{page-name}.scss`
2. Add `@forward '../pages/{page-name}';` to `src/styles/pages/_index.scss`

**New FSE Template:**
1. Create `templates/{template-name}.html`
2. Use block markup (typically `<!-- wp:makerblocks/app /-->`)
3. Register in `theme.json` if needed

**New Admin Asset:**
1. Add to `assets/admin/`
2. Enqueue via `makerstarter_enqueue_admin_assets()` in `inc/enqueue_assets.php`

## Special Directories

**`vendor/`:**
- Purpose: Composer autoloaded dependencies
- Generated: Yes (via `composer install`)
- Committed: Typically yes for themes

**`node_modules/`:**
- Purpose: npm dependencies for build tools
- Generated: Yes (via `npm install`)
- Committed: No

**`.claude/`:**
- Purpose: Claude Code agent configuration
- Generated: No (manual)
- Committed: Yes

**`.planning/`:**
- Purpose: Project planning and documentation
- Generated: By GSD commands
- Committed: Optional

---

*Structure analysis: 2026-01-19*
