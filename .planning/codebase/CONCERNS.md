# Codebase Concerns

**Analysis Date:** 2026-01-06

## Tech Debt

**Empty/Uncompiled Asset Files:**
- Issue: Build step never completed - CSS file is 2 bytes (empty), admin assets missing
- Files: `assets/css/styles.css`, `assets/admin/styles-wp-admin.css`, `assets/admin/index-wp-admin.js`
- Why: Build scripts exist but were not run during development
- Impact: Theme completely unstyled, admin features broken
- Fix approach: Run `npm run prod` to rebuild all assets

**Carbon Fields Integration Disabled:**
- Issue: Carbon Fields framework installed via Composer but not loaded
- Files: `inc/carbon_fields.php` (entire file unused), `functions.php` (line 10 commented)
- Why: Feature was disabled during development
- Impact: Dead code adds 13MB to vendor/, potential confusion about theme capabilities
- Fix approach: Either remove Carbon Fields from composer.json or enable in functions.php

**Duplicate Asset Enqueuing:**
- Issue: Same assets registered twice with identical handles in frontend and editor functions
- Files: `inc/enqueue_assets.php` (lines 15-19 duplicate lines 29-33)
- Why: Copy-paste pattern without refactoring
- Impact: WordPress may only load one registration, leaving editor without assets
- Fix approach: Use unique handles or refactor to single registration function

**Empty Function Implementations:**
- Issue: `remove_admin_menu_items()` defined but entire function body commented out
- Files: `inc/menu_config.php` (lines 11-20 commented, hook still registered line 22)
- Why: Feature disabled but hook registration left in place
- Impact: Dead code, wasted hook execution on every admin page load
- Fix approach: Either implement menu removal or delete file and remove from includes array

**Empty Required Plugins Array:**
- Issue: TGM Plugin Activation integrated but `$plugins` array is empty
- Files: `inc/required_plugins.php` (lines 16-21 empty array), `class-tgm-plugin-activation.php` (139KB)
- Why: Infrastructure added for future use but not configured
- Impact: 139KB library loaded for no purpose
- Fix approach: Add makerblocks to required plugins or remove TGM integration

## Known Bugs

**Missing Error Handling for filemtime():**
- Symptoms: If asset files don't exist, filemtime() returns false, breaks cache busting
- Trigger: Delete `assets/js/index.js` or `assets/css/styles.css`, load theme
- Files: `inc/variables.php` (lines 12-13)
- Workaround: None - will cause undefined behavior in asset versioning
- Root cause: No file_exists() check before calling filemtime()
- Fix: Wrap with `file_exists()` check and fallback to '1.0.0'

**Hardcoded Environment URL in Templates:**
- Symptoms: Templates contain hardcoded `http://b2bcnc.test/` URLs
- Trigger: Deploy to different domain (staging, production)
- Files: `templates/front-page.html` (lines 3, 7, 11 - media URLs)
- Workaround: Find/replace domain before deployment
- Root cause: Absolute URLs saved from block editor instead of relative
- Fix: Use relative URLs or WordPress media functions

**Undefined Constant in Commented Code:**
- Symptoms: If Carbon Fields re-enabled, fatal error on `MAKERSTARTER_PLUGIN_DIR`
- Trigger: Uncomment line 10 in `functions.php`
- Files: `inc/carbon_fields.php` (line 32)
- Root cause: Constant never defined (likely copy-paste from plugin code)
- Fix: Define constant or use `get_theme_file_path()` instead

## Security Considerations

**No Security Concerns Detected:**
- No eval, extract, or unserialize calls
- No direct $_GET, $_POST, $_REQUEST usage
- No hardcoded secrets or API keys
- Theme follows WordPress security best practices (uses native functions)

## Performance Bottlenecks

**Large Vendor Directory (13MB):**
- Problem: Carbon Fields installed but not used
- Measurement: `du -sh vendor/` = 13MB
- Files: `vendor/htmlburger/carbon-fields/`
- Cause: Composer dependency included but feature disabled
- Improvement path: Remove from composer.json if not needed, run `composer install --no-dev` for production

**No Asset Minification Verification:**
- Problem: Build process exists but output not verified for minification
- Files: `assets/css/styles.css` (currently empty)
- Cause: Build step not run during development
- Improvement path: Add pre-deployment checks to verify assets built with production flags

## Fragile Areas

**Global Variable Dependency:**
- Files: `inc/variables.php` (defines globals), `inc/enqueue_assets.php` (uses globals)
- Why fragile: Load order matters - if variables.php not loaded first, undefined variables
- Common failures: If include order changes in functions.php, enqueueing breaks
- Safe modification: Always keep 'variables' before 'enqueue_assets' in $includes array
- Test coverage: None

**Asset Compilation Pipeline:**
- Files: `package.json` (build scripts), `src/` directory
- Why fragile: Multi-step build (Sass + wp-scripts) must both succeed
- Common failures: Sass compilation errors fail silently, leaving empty CSS
- Safe modification: Run `npm run dev` in watch mode during development
- Test coverage: None

**Include Array Loading System:**
- Files: `functions.php` (lines 6-11)
- Why fragile: Order-dependent, no error handling for missing files
- Common failures: Typo in filename causes silent failure (include() vs require())
- Safe modification: Use require() instead of include() for critical files
- Test coverage: None

## Scaling Limits

**Not Applicable:**
- Theme is presentation layer only
- No database queries or API calls
- Scaling handled by WordPress core and makerblocks plugin

## Dependencies at Risk

**No package.json semver ranges:**
- Risk: Dependencies locked to exact versions (^30.19.0 uses caret, acceptable)
- Impact: Minor - npm will install compatible versions
- Migration plan: Use `npm update` periodically to stay current

## Missing Critical Features

**No Template Parts:**
- Problem: No reusable template fragments (header, footer duplicated across templates)
- Current workaround: Blocks handle header/footer (`<!-- wp:makerblocks/header /-->`)
- Blocks: Can't easily update global header/footer without editing all templates
- Implementation complexity: Low (create `parts/` directory, extract header/footer blocks)

**No Build Verification:**
- Problem: No automated check that assets compiled successfully
- Current workaround: Visual inspection in browser
- Blocks: Can't catch build failures before deployment
- Implementation complexity: Low (add `test` script that checks asset file sizes)

**No .gitignore for Build Artifacts:**
- Problem: Compiled assets committed to repo instead of built during deployment
- Current workaround: Manual builds before commit
- Blocks: Larger repo size, merge conflicts on compiled files
- Implementation complexity: Low (add assets/ to .gitignore, add build step to deploy)

## Test Coverage Gaps

**No Testing Infrastructure:**
- What's not tested: Everything (PHP setup, asset enqueueing, JavaScript, SCSS compilation)
- Risk: Any change could break theme without detection
- Priority: Medium (small theme, manual testing sufficient for now)
- Difficulty to test: Low (WordPress provides test utilities, Jest already bundled)

**Build Pipeline Not Verified:**
- What's not tested: Sass compilation success, JavaScript bundling, asset file existence
- Risk: Silent build failures deploy broken theme
- Priority: High (currently CSS is empty - this exact issue exists)
- Difficulty to test: Low (simple file existence and size checks)

---

*Concerns audit: 2026-01-06*
*Update as issues are fixed or new ones discovered*
