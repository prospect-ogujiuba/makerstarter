# MakerStarter core boundary

MakerStarter is a replaceable framework package. Every tracked file beneath `wp-content/themes/makerstarter/` is core-owned, including `theme.json`, `style.css`, `functions.php`, templates, template parts, patterns, style variations, package metadata, and tests.

## Ownership

| Location | Owner | Policy |
| --- | --- | --- |
| `themes/makerstarter/` | MakerStarter | Replace the whole directory during install, update, or rollback. |
| `themes/<site>-theme/` | Consumer project | Store branding, composition, templates, parts, patterns, assets, and PHP here. DevArch must not synchronize this directory from MakerStarter. |

A project theme is a standard WordPress child theme. Its `style.css` must declare `Template: makerstarter`; overrides use normal WordPress child-theme and Site Editor resolution. Do not add a `custom/` directory or site-specific files to MakerStarter.

## Compatibility contract

The public contract is:

- the parent theme directory slug `makerstarter`;
- standard WordPress child-theme resolution;
- the design-token slugs documented in [README.md](README.md);
- the normal WordPress lifecycle hooks used to register theme support and pattern categories.

MakerStarter has no required companion plugin or custom child-theme discovery API. Removing or renaming a documented token, the parent slug, or a documented hook contract requires a major release. Token values, core templates, and visual defaults may change compatibly.

WordPress enforces the `Requires at least` and `Requires PHP` headers in `style.css`. MakerStarter must boot with no child theme, MakerBlocks plugin, or project workspace installed.

## Prohibited edits

Do not put branding, project templates, project patterns, project assets, project PHP, copied plugin code, secrets, uploads, or database-managed Site Editor content in this checkout. Core contributors may change these files only as framework work covered by MakerStarter tests and release review.
