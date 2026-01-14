# Codebase Structure

**Analysis Date:** 2026-01-06

## Directory Layout

```
makerstarter/
├── functions.php              # Theme entry point
├── index.php                  # Silent fallback
├── style.css                  # Theme metadata header
├── theme.json                 # FSE global settings
├── composer.json              # PHP dependencies
├── package.json               # npm configuration
├── package-lock.json          # npm lockfile
│
├── inc/                       # PHP includes
├── templates/                 # FSE block templates
├── src/                       # Source code (build inputs)
├── assets/                    # Compiled output (build artifacts)
├── vendor/                    # Composer packages
├── .planning/                 # Project planning docs
├── .git/                      # Version control
└── class-tgm-plugin-activation.php  # TGM plugin library
```

## Directory Purposes

**inc/**
- Purpose: PHP functional modules
- Contains: Setup, variables, enqueue, menu config, plugin requirements
- Key files:
  - `maker_starter_setup.php` - Theme features, menus, post formats
  - `variables.php` - Global vars (theme URI, asset versions)
  - `enqueue_assets.php` - Asset registration/enqueueing
  - `menu_config.php` - Admin menu customization
  - `required_plugins.php` - TGM plugin activation config
  - `carbon_fields.php` - Custom fields (currently disabled)
- Subdirectories: None (flat structure)

**templates/**
- Purpose: FSE block templates
- Contains: HTML files with block markup
- Key files:
  - Core: `front-page.html`, `page.html`, `single.html`, `index.html`, `search.html`, `404.html`
  - Custom pages: `page-services.html`, `page-pricing.html`, `page-resources.html`, `page-contact.html`, `page-company.html`, `page-support.html`, `page-service-bundles.html`
- Subdirectories: None (no template parts directory)

**src/**
- Purpose: Source code for build pipeline
- Contains: JavaScript and SCSS source files
- Key files:
  - `index.js` - JS entry point
  - `scripts/MakerStarter.js` - Main theme class
  - `styles/styles.scss` - Main SCSS entry
- Subdirectories:
  - `scripts/` - JavaScript classes
  - `styles/` - SCSS modules (abstracts, base, layout, pages, components)

**src/styles/**
- Purpose: Modular SCSS architecture (7-1 pattern)
- Contains: SCSS partials organized by function
- Subdirectories:
  - `abstracts/` - Variables, mixins, functions, colors, breakpoints, utility
  - `base/` - Base styles, typography, fonts, helpers
  - `layout/` - Layout components
  - `pages/` - Page-specific styles (mostly empty)
  - `components/` - Component styles (mostly empty)
- Each subdirectory has `_index.scss` for barrel exports

**assets/**
- Purpose: Compiled, browser-ready assets
- Contains: Built JavaScript and CSS
- Key files:
  - `js/index.js` - Compiled from `src/index.js`
  - `js/index.asset.php` - Dependency manifest (auto-generated)
  - `css/styles.css` - Compiled from `src/styles/styles.scss`
- Subdirectories:
  - `admin/` - Admin-specific assets (`index-wp-admin.js`, `styles-wp-admin.css`)

**vendor/**
- Purpose: Composer PHP dependencies
- Contains: Carbon Fields framework, Composer autoloader
- Key files:
  - `htmlburger/carbon-fields/` - Custom fields framework (3.6+)
  - `autoload.php` - PSR-4 autoloader
- Subdirectories: Composer package structure

**.planning/**
- Purpose: Project planning and documentation
- Contains: Codebase analysis documents
- Subdirectories:
  - `codebase/` - Stack, architecture, conventions, testing, integrations, concerns

## Key File Locations

**Entry Points:**
- `functions.php` - PHP theme entry
- `src/index.js` - JavaScript entry
- `src/styles/styles.scss` - SCSS entry
- `theme.json` - FSE configuration entry

**Configuration:**
- `theme.json` - FSE settings (colors, typography, spacing, layouts)
- `composer.json` - PHP dependencies
- `package.json` - Build scripts, npm dependencies
- `style.css` - Theme metadata header

**Core Logic:**
- `inc/*.php` - All theme functionality (6 files)
- `src/scripts/MakerStarter.js` - JavaScript initialization
- `templates/*.html` - Block composition templates (13 files)

**Testing:**
- None (no test files)

**Documentation:**
- `CLAUDE.md` - Project instructions for Claude Code
- `.planning/codebase/*.md` - Codebase analysis documents

## Naming Conventions

**Files:**
- PHP includes: snake_case.php (`maker_starter_setup.php`, `enqueue_assets.php`)
- JavaScript: PascalCase for classes (`MakerStarter.js`), lowercase for entry (`index.js`)
- SCSS partials: underscore prefix + kebab-case (`_variables.scss`, `_index.scss`)
- Templates: kebab-case (`front-page.html`, `page-services.html`)
- Config: lowercase (`functions.php`, `theme.json`, `composer.json`, `package.json`)

**Directories:**
- Lowercase: `inc/`, `templates/`, `src/`, `assets/`, `vendor/`
- SCSS subdirectories: lowercase (`abstracts/`, `base/`, `layout/`, `pages/`, `components/`)

**Special Patterns:**
- `_index.scss` - Barrel export files in SCSS
- `index.js` - Entry point convention
- `*.asset.php` - wp-scripts dependency manifest (auto-generated)

## Where to Add New Code

**New Theme Feature:**
- Primary code: `inc/{feature-name}.php`
- Add to includes: `functions.php` (add to $includes array)
- Tests: N/A (no test infrastructure)

**New JavaScript Functionality:**
- Implementation: `src/scripts/{FeatureName}.js`
- Import: `src/index.js`
- Output: `assets/js/index.js` (auto-compiled)

**New Styles:**
- Global styles: `src/styles/base/` or `src/styles/abstracts/`
- Page-specific: `src/styles/pages/_{page-name}.scss`
- Component: `src/styles/components/_{component-name}.scss`
- Update barrel: Add `@forward` to appropriate `_index.scss`

**New FSE Template:**
- Implementation: `templates/{template-name}.html`
- Follow block markup pattern: `<!-- wp:makerblocks/{block} /-->`

**Utilities:**
- SCSS utilities: `src/styles/abstracts/_utility.scss`
- JavaScript utilities: `src/scripts/` (new file, import in `src/index.js`)
- PHP utilities: `inc/` (new file, add to `functions.php` includes array)

## Special Directories

**vendor/**
- Purpose: Composer PHP dependencies
- Source: Auto-generated by `composer install`
- Committed: Yes (typically not committed, but present in this repo)
- Size: ~13MB

**assets/**
- Purpose: Build output
- Source: Compiled from `src/` via npm scripts
- Committed: Yes (should be built before deployment)
- Note: Current CSS file is empty (build not run)

**.planning/**
- Purpose: Project planning and codebase documentation
- Source: Manual documentation and analysis
- Committed: Yes
- Pattern: Follows GSD (Get Shit Done) workflow system

---

*Structure analysis: 2026-01-06*
*Update when directory structure changes*
