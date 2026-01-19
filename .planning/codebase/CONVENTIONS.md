# Coding Conventions

**Analysis Date:** 2026-01-19

## Naming Patterns

**Files:**
- PHP: snake_case (`enqueue_assets.php`, `maker_starter_setup.php`)
- JavaScript: PascalCase for classes (`MakerStarter.js`), camelCase for entry (`index.js`)
- SCSS: underscore prefix for partials (`_variables.scss`, `_mixins.scss`)
- Templates: lowercase (`index.html`)

**Functions (PHP):**
- Prefixed with theme name: `makerstarter_*`
- Examples: `makerstarter_setup()`, `makerstarter_enqueue_assets()`
- Exception: TGMPA callbacks use `my_theme_*` prefix

**Variables (PHP):**
- Global vars: snake_case (`$theme_path`, `$theme_uri`, `$script_version`)

**Classes (JS):**
- PascalCase: `MakerStarter`

**SCSS Variables:**
- Kebab-case (standard): `$primary-color`, `$breakpoint-md`

## Code Style

**Formatting:**
- No dedicated formatter configured
- PHP: 2-space indentation
- JS: 2-space indentation
- SCSS: 2-space indentation

**Linting:**
- No ESLint, Prettier, or PHP_CodeSniffer configured
- Relies on @wordpress/scripts defaults

## Import Organization

**JavaScript:**
1. Relative imports from `./scripts/` directory
2. Instantiate at module level

```javascript
import MakerStarter from "./scripts/MakerStarter";
new MakerStarter();
```

**SCSS:**
1. Abstracts (no underscore in @use)
2. Base
3. Layout
4. Pages
5. Components

```scss
@use "abstracts";
@use "base";
@use "layout";
@use "pages";
@use "components";
```

**PHP:**
- Array-driven includes in `functions.php`
- Order: setup → variables → config → plugins → assets

## Error Handling

**Patterns:**
- Minimal error handling observed
- PHP relies on WordPress hooks (fail silently)
- No try/catch in JavaScript

## Logging

**Framework:** Browser console

**Patterns:**
- Development logging via `console.log()` in JS classes
- No structured logging in PHP

## Comments

**When to Comment:**
- File headers with `@package` docblock
- Section comments (e.g., `// REQUIRED PLUGINS`)

**PHP Docblocks:**
```php
/**
 * Description.
 *
 * @package makerstarter
 */
```

## Function Design

**Size:** Small, single-purpose functions

**Parameters:** Minimal, use globals for shared state

**Return Values:** Void for hooks, implicit returns

## Module Design

**PHP Exports:**
- Functions registered via WordPress hooks
- No class-based architecture

**JS Exports:**
- ES6 default export for classes
- Single class per file

**SCSS Barrel Files:**
- `_index.scss` uses `@forward` to expose partials
- Each layer has its own barrel file

## WordPress-Specific Conventions

**Hook Registration:**
```php
function makerstarter_function_name() {
    // Implementation
}
add_action('hook_name', 'makerstarter_function_name');
```

**Asset Registration:**
```php
wp_register_script('handle', $url, $deps, $version, $in_footer);
wp_enqueue_script('handle');
```

**Global Variables Pattern:**
- Define in `inc/variables.php`
- Access via `global $var_name;`

## Template Conventions

**FSE Templates:**
- Block markup only, no PHP
- Single block reference typical: `<!-- wp:namespace/block /-->`

---

*Convention analysis: 2026-01-19*
