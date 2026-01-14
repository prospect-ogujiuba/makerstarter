# CLAUDE.md

FSE WordPress theme (6.2+) using block composition with makerblocks plugin.

**Theme:** `makerstarter` | **PHP:** 7.4+ | **WP:** 6.2+

## Commands

```bash
npm run dev      # Watch mode (JS + Sass)
npm run prod     # Production build
npm run preview  # BrowserSync on local.test
npm install      # Install npm deps
composer install # Install PHP deps (Carbon Fields)
```

## Quick Reference

| Entry Point | Location                                           |
| ----------- | -------------------------------------------------- |
| PHP         | `functions.php` → loads `inc/*.php` via array      |
| JavaScript  | `src/index.js` → `assets/js/index.js`              |
| Styles      | `src/styles/styles.scss` → `assets/css/styles.css` |
| FSE Config  | `theme.json`                                       |
| Templates   | `templates/*.html` (block markup)                  |

**Add new code:**

- PHP feature → `inc/{name}.php` + add to `$includes` array in functions.php
- JavaScript → `src/scripts/{Name}.js` + import in `src/index.js`
- Styles → `src/styles/{layer}/_{name}.scss` + `@forward` in `_index.scss`
- Template → `templates/{name}.html`

## Detailed Documentation

See `.planning/codebase/` for comprehensive docs:

| File              | Contents                                            |
| ----------------- | --------------------------------------------------- |
| `ARCHITECTURE.md` | Layers, data flow, entry points, patterns           |
| `STRUCTURE.md`    | Directory layout, file purposes, naming conventions |
| `STACK.md`        | Languages, runtime, frameworks, dependencies        |
| `CONVENTIONS.md`  | Naming patterns, code style, imports                |
| `INTEGRATIONS.md` | External dependencies (makerblocks, makermaker)     |
| `CONCERNS.md`     | Known issues, gaps, technical debt                  |
| `TESTING.md`      | Test infrastructure (none currently)                |

---

## Communication Rules

- Extreme concision. Sacrifice grammar for the sake of concision.
- No verbose READMEs, summaries, trees, diagrams unless explicitly requested
- End plans with concise unresolved questions

## Version Control - Git

1. Commits must be surgical but not overly granular
2. Commit messages must be one liners
3. No self insertion
4. DO not commit docs (.md) files
