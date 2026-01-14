# Coding Conventions

**Analysis Date:** 2026-01-06

## Naming Patterns

**Files:**
- PHP includes: snake_case (`maker_starter_setup.php`, `enqueue_assets.php`)
- JavaScript classes: PascalCase (`MakerStarter.js`)
- JavaScript entry: lowercase (`index.js`)
- SCSS partials: underscore prefix + kebab-case (`_variables.scss`, `_index.scss`)
- Templates: kebab-case (`front-page.html`, `page-services.html`)

**Functions:**
- PHP: snake_case with theme prefix `makerstarter_*`
  - Examples: `makerstarter_setup()`, `makerstarter_enqueue_assets()`
- JavaScript: camelCase for methods (`constructor()`, `init()`)

**Variables:**
- PHP: snake_case (`$theme_uri`, `$script_version`, `$style_version`)
- JavaScript: camelCase (standard ES6 conventions)

**Types:**
- PHP: No type hinting used (PHP 7.4 compatible)
- JavaScript: No TypeScript (vanilla ES6)

## Code Style

**Formatting:**
- Indentation: 2 spaces (soft spaces, not tabs) across PHP, JS, SCSS
- Line length: No enforced limit
- Quotes:
  - PHP: Single quotes preferred (`'makerstarter'`), double only when needed
  - JavaScript: Double quotes (`"MakerStarter Theme Script initialized"`)
- Semicolons: Required in PHP and JavaScript

**Linting:**
- No ESLint configuration
- No Prettier configuration
- No Stylelint for SCSS
- Implicit WordPress coding standards via @wordpress/scripts

## Import Organization

**PHP:**
- Include pattern: Array-based loader in `functions.php`
- Order: Defined by array order in `$includes`
- Files loaded from `/inc` directory only

**JavaScript:**
- ES6 modules: `import`/`export` syntax
- Pattern: `src/index.js` imports from `src/scripts/MakerStarter.js`
- No path aliases configured

**SCSS:**
- Modern `@use` and `@forward` syntax (not `@import`)
- Pattern: Main file uses `@use` → subdirectories use `@forward` in `_index.scss`
- Barrel exports: Each subdirectory has `_index.scss` that forwards all partials

## Error Handling

**Patterns:**
- No try/catch blocks in theme code
- No custom error handling
- Relies on WordPress default error handling

**Error Types:**
- WordPress hooks handle missing functions gracefully
- Missing asset files fail silently (WordPress behavior)

**Logging:**
- PHP: No error_log calls
- JavaScript: console.log for initialization (`src/scripts/MakerStarter.js`)

## Logging

**Framework:**
- console.log - JavaScript only
- No PHP logging framework

**Patterns:**
- Single console.log in MakerStarter init: `console.log("MakerStarter Theme Script initialized");`
- No structured logging
- No log levels

## Comments

**When to Comment:**
- Per CLAUDE.md: "Do not add comments to code"
- File-level docblocks with @package tag in PHP
- No inline comments

**JSDoc/TSDoc:**
- Not used

**TODO Comments:**
- No TODO comments in theme code (some in vendor/carbon-fields)

## Function Design

**Size:**
- Small functions (most under 20 lines)
- `makerstarter_setup()` is largest at ~30 lines

**Parameters:**
- PHP: Follows WordPress hook signature patterns (no params or ($arg) patterns)
- JavaScript: Single class with no-arg methods

**Return Values:**
- PHP: Void functions (WordPress hook handlers)
- JavaScript: MakerStarter class returns undefined from init()

## Module Design

**Exports:**
- PHP: No explicit exports (functions available globally after include)
- JavaScript: ES6 default export (`export default MakerStarter;`)
- SCSS: `@forward` for barrel exports, no default exports

**Barrel Files:**
- SCSS only: `_index.scss` in each subdirectory
- Pattern: `@forward '../path/to/partial';`

**PHP Include System:**
- Array-based: `$includes` array in `functions.php`
- Pattern: `foreach` → `include(get_theme_file_path('/inc/' . $include . '.php'));`

---

*Convention analysis: 2026-01-06*
*Update when patterns change*
