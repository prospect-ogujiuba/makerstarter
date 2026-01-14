# Technology Stack

**Analysis Date:** 2026-01-06

## Languages

**Primary:**
- PHP 7.4+ - `style.css` (all theme logic and setup)
- JavaScript ES6+ - `src/index.js`, `src/scripts/MakerStarter.js` (frontend interactivity)

**Secondary:**
- SCSS (Sass) - `src/styles/styles.scss` (styling system)
- HTML - `templates/*.html` (FSE block templates)

## Runtime

**Environment:**
- WordPress 6.2+ (tested up to 6.5.4) - `style.css`
- PHP 7.4+ - `style.css`
- Node.js (via npm) - `package.json`

**Package Manager:**
- npm 10.x - `package.json`, `package-lock.json` (v3 lockfile)
- Composer - `composer.json` (PHP dependencies)

## Frameworks

**Core:**
- WordPress Full Site Editing (FSE) - `theme.json` (v3 schema)
- WordPress Block Editor - `templates/*.html`

**Testing:**
- None currently configured - `package.json` (test script placeholder)

**Build/Dev:**
- @wordpress/scripts 30.19.0 - `package.json` (webpack bundling for WordPress)
- Sass 1.89.2 - `package.json` (SCSS compilation)
- npm-run-all 4.1.5 - `package.json` (parallel script execution)
- BrowserSync - `package.json` (live preview on local.test)

## Key Dependencies

**Critical:**
- wp-element - `assets/js/index.asset.php` (React compatibility for blocks)
- Carbon Fields 3.6+ - `composer.json` (custom fields framework, currently disabled)

**Infrastructure:**
- WordPress native hooks and filters - `inc/*.php`
- TGM Plugin Activation 2.6+ - `class-tgm-plugin-activation.php`

## Configuration

**Environment:**
- No .env files detected
- Configuration via theme.json for FSE settings - `theme.json`
- Hardcoded domain for BrowserSync: local.test - `package.json`

**Build:**
- Build scripts in package.json: dev (watch), prod (minified)
- Sass compilation: `src/styles/` → `assets/css/styles.css`
- JS bundling: `src/` → `assets/js/index.js`
- Asset versioning via filemtime() - `inc/variables.php`

## Platform Requirements

**Development:**
- Any platform with Node.js and PHP 7.4+
- WordPress 6.2+ local installation
- No Docker or additional tooling required

**Production:**
- WordPress 6.2+ hosting
- PHP 7.4+ runtime
- Standard WordPress theme structure

---

*Stack analysis: 2026-01-06*
*Update after major dependency changes*
