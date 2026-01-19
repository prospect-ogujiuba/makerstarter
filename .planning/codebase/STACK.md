# Technology Stack

**Analysis Date:** 2026-01-19

## Languages

**Primary:**
- PHP 7.4+ - Theme logic, WordPress hooks (`functions.php`, `inc/*.php`)
- JavaScript ES6+ - Frontend scripts (`src/scripts/*.js`)
- Sass/SCSS - Stylesheets (`src/styles/**/*.scss`)

**Secondary:**
- HTML - Block templates (`templates/*.html`)
- JSON - Configuration (`theme.json`, `package.json`)

## Runtime

**Environment:**
- WordPress 6.2+ (Full Site Editing required)
- PHP 7.4+ (per `style.css` declaration)
- Node.js (for build tools, version not pinned)

**Package Manager:**
- npm (lockfile: `package-lock.json` present)
- Composer (autoload present in `vendor/`, no `composer.json` committed)

## Frameworks

**Core:**
- WordPress FSE - Block-based theme architecture
- WordPress Block API - Template composition via block markup

**Testing:**
- None configured (`npm test` echoes error)

**Build/Dev:**
- @wordpress/scripts ^30.19.0 - JS bundling (`wp-scripts build/start`)
- sass ^1.89.2 - SCSS compilation
- npm-run-all ^4.1.5 - Parallel/sequential script runner
- browser-sync - Live reload (via `npm run preview`)

## Key Dependencies

**Critical:**
- @wordpress/scripts - Provides webpack config, React dependencies, build tooling
- htmlburger/carbon-fields v3.6.3 - Custom fields library (Composer, currently commented out in `functions.php`)

**Infrastructure:**
- wp-element - React wrapper (dependency of compiled JS per `inc/enqueue_assets.php`)
- TGM Plugin Activation - Required plugins management (`class-tgm-plugin-activation.php`)

## Configuration

**Environment:**
- No `.env` files - WordPress handles configuration via `wp-config.php`
- No runtime-specific configs

**Build:**
- `package.json` - npm scripts for dev/prod builds
- `theme.json` - WordPress FSE settings (layout, colors, typography, blocks)

**WordPress FSE Settings (`theme.json`):**
- Schema version 3
- Content width: 800px, Wide: 1100px
- Core block patterns disabled
- Image lightbox enabled

## Platform Requirements

**Development:**
- Node.js + npm
- Local WordPress installation (proxy expects `local.test`)
- PHP 7.4+

**Production:**
- WordPress 6.2+ with FSE support
- PHP 7.4+
- No special server requirements

## Build Commands

```bash
npm run dev      # Watch: JS (wp-scripts start) + Sass (watch mode)
npm run prod     # Production: Sass compressed + JS build
npm run preview  # BrowserSync proxy on local.test
```

## Asset Output

- JS: `src/index.js` → `assets/js/index.js`
- CSS: `src/styles/styles.scss` → `assets/css/styles.css`
- Admin assets expected at `assets/admin/` (referenced but may not exist)

---

*Stack analysis: 2026-01-19*
