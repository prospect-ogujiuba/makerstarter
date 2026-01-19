# Codebase Concerns

**Analysis Date:** 2026-01-19

## Tech Debt

**Empty SCSS Files:**
- Issue: All base and abstract SCSS files are empty placeholders
- Files: `src/styles/base/_base.scss`, `src/styles/base/_fonts.scss`, `src/styles/base/_helpers.scss`, `src/styles/base/_typography.scss`, `src/styles/abstracts/_variables.scss`, `src/styles/abstracts/_colors.scss`, `src/styles/abstracts/_breakpoints.scss`, `src/styles/abstracts/_mixins.scss`, `src/styles/abstracts/_functions.scss`, `src/styles/abstracts/_utility.scss`
- Impact: No actual styles compiled; build runs but produces empty output
- Fix approach: Implement base styles or remove unused forwards

**Empty Layout/Pages/Components SCSS:**
- Issue: Layer index files have only commented-out forwards
- Files: `src/styles/layout/_index.scss`, `src/styles/pages/_index.scss`, `src/styles/components/_index.scss`
- Impact: SCSS architecture exists but no implementation
- Fix approach: Uncomment and create referenced partials as needed

**Stub JavaScript:**
- Issue: MakerStarter class only logs initialization message
- Files: `src/scripts/MakerStarter.js`
- Impact: No frontend functionality; script loaded but does nothing useful
- Fix approach: Remove or implement actual functionality

**Empty Admin Assets:**
- Issue: Admin JS/CSS files are empty/whitespace only
- Files: `assets/admin/index-wp-admin.js` (empty), `assets/admin/styles-wp-admin.css` (0 bytes)
- Impact: Admin scripts enqueued but serve no purpose
- Fix approach: Remove enqueueing in `inc/enqueue_assets.php` or implement

**Unused TGMPA:**
- Issue: 3962-line TGMPA library included but no plugins defined
- Files: `class-tgm-plugin-activation.php`, `inc/required_plugins.php`
- Impact: Large unused dependency; empty plugins array
- Fix approach: Remove TGMPA entirely or define required plugins

**Dead Code in menu_config.php:**
- Issue: Function with all lines commented out
- Files: `inc/menu_config.php`
- Impact: Empty function hooked to admin_menu; no actual effect
- Fix approach: Remove file or implement functionality

**Commented Carbon Fields Include:**
- Issue: Carbon Fields reference in functions.php commented out, no composer.json for it
- Files: `functions.php` line 10
- Impact: Documentation references Carbon Fields but it's not actually set up
- Fix approach: Remove reference or properly set up Carbon Fields

## Known Bugs

**Variable Package Name Mismatch:**
- Symptoms: PHPDoc says `@package makerblocks` but theme is `makerstarter`
- Files: `inc/variables.php` line 6
- Trigger: Package name inconsistency
- Workaround: Cosmetic only; no functional impact

**Domain Path Mismatch:**
- Symptoms: style.css declares `/assets/lang`, code uses `/languages`
- Files: `style.css` line 10, `inc/maker_starter_setup.php` line 11
- Trigger: i18n loading may fail if translations exist
- Workaround: None needed if no translations

## Security Considerations

**No Input Sanitization Patterns:**
- Risk: No esc_*, sanitize_*, or nonce functions found in inc/ files
- Files: All files in `inc/`
- Current mitigation: No user input currently handled
- Recommendations: Establish sanitization patterns before accepting any input

**Global Variables:**
- Risk: Theme uses globals ($theme_uri, $script_version, etc.) which can be overwritten
- Files: `inc/variables.php`, `inc/enqueue_assets.php`
- Current mitigation: WordPress environment provides some isolation
- Recommendations: Use a theme class or namespaced functions instead of globals

## Performance Bottlenecks

**Unnecessary Script Loading:**
- Problem: Empty/stub scripts loaded on every page
- Files: `inc/enqueue_assets.php`
- Cause: `makerstarter-admin-scripts`, `makerstarter-scripts` enqueued regardless of content
- Improvement path: Conditional loading or remove empty assets

**wp-element Dependency:**
- Problem: Theme JS depends on `wp-element` but doesn't use React
- Files: `inc/enqueue_assets.php` line 15
- Cause: Possibly leftover from template
- Improvement path: Remove dependency if React unused

## Fragile Areas

**Hard-coded Asset Paths:**
- Files: `inc/enqueue_assets.php`
- Why fragile: filemtime() will error if asset files don't exist
- Safe modification: Add file_exists() checks
- Test coverage: None

**Template Dependency on makerblocks:**
- Files: `templates/index.html`
- Why fragile: Single template uses `wp:makerblocks/app` block from external plugin
- Safe modification: Ensure makerblocks plugin installed; add fallback
- Test coverage: None

## Scaling Limits

**Single Template:**
- Current capacity: Only index.html template exists
- Limit: Cannot create distinct page layouts without makerblocks
- Scaling path: Add templates (page.html, single.html, archive.html, etc.)

**No Template Parts:**
- Current capacity: No reusable header/footer/sidebar parts
- Limit: Duplication if multiple templates created
- Scaling path: Create `parts/` directory with common elements

## Dependencies at Risk

**TGMPA Library:**
- Risk: Bundled version (v2.6.1) may become outdated; known hacks documented in file
- Impact: Plugin management functionality if used
- Migration plan: Update periodically or switch to Composer-managed dependency

**makerblocks Plugin:**
- Risk: Theme completely dependent on external plugin for rendering
- Impact: Theme renders nothing useful without it
- Migration plan: Add fallback templates that work without plugin

## Missing Critical Features

**No Block Templates:**
- Problem: Missing standard FSE templates
- Blocks: page.html, single.html, archive.html, 404.html, search.html, header.html, footer.html

**No Block Patterns:**
- Problem: Core patterns disabled but no custom patterns registered
- Blocks: Pattern registration in `inc/`

**No Theme Styles:**
- Problem: theme.json has empty palette/gradients/typography settings
- Blocks: Users cannot customize via Site Editor

**No Languages Directory:**
- Problem: i18n configured but /languages/ doesn't exist
- Blocks: Translations cannot be loaded

## Test Coverage Gaps

**No Test Infrastructure:**
- What's not tested: Everything
- Files: All PHP and JS
- Risk: Regressions undetected
- Priority: Low for starter theme; establish before adding complexity

---

*Concerns audit: 2026-01-19*
