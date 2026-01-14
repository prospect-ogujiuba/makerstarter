# Makerstarter Quickstart

## Create an FSE Template

**Prompt:**
```
Create a template for {page type} using {blocks}
```

**Execution flow:**
```
fse-template-builder → templates/{template-name}.html
    ↓ (if theme.json changes needed)
theme-integrator → theme.json updates
```

## Prompt Tips

### Specify template type:
```
✓ "Archive template for equipment listing"
✓ "Single template for service detail page"
✓ "Custom template for contact page"

✗ "A page template"
```

### Describe block composition:
```
✓ "Header part, hero with service title, makerblocks/service-detail block,
   related services grid, footer part"

✗ "Show the service"
```

### Request theme.json changes:
```
✓ "Add 'services' color palette with brand blue (#1a5fb4)"
✓ "Register template in theme.json with title 'Service Detail'"
```

## Single-Agent Tasks

| Task | Prompt |
|------|--------|
| Create template | "Create {type} template for {entity}" |
| Update theme.json | "Add {setting} to theme.json" |
| Create pattern | "Create pattern for {reusable section}" |

## File Locations

```
templates/           → {template-name}.html
parts/               → header.html, footer.html, etc.
patterns/            → {pattern-name}.php
theme.json           → Global settings + styles
```

## Template Hierarchy

| Type | Filename |
|------|----------|
| Front page | front-page.html |
| Single post type | single-{post-type}.html |
| Archive | archive-{post-type}.html |
| Page template | page-{slug}.html |
| Custom template | {custom-name}.html (registered in theme.json) |

## Block Markup Syntax

```html
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
  <!-- wp:makerblocks/service-list {"itemsPerPage":6} /-->
</div>
<!-- /wp:group -->
```

## Common Compositions

### Archive with query loop:
```html
<!-- wp:template-part {"slug":"header"} /-->
<!-- wp:query {"queryId":1,"query":{"postType":"service"}} -->
  <!-- wp:post-template -->
    <!-- wp:post-title {"isLink":true} /-->
    <!-- wp:post-excerpt /-->
  <!-- /wp:post-template -->
  <!-- wp:query-pagination /-->
<!-- /wp:query -->
<!-- wp:template-part {"slug":"footer"} /-->
```

### Single with custom block:
```html
<!-- wp:template-part {"slug":"header"} /-->
<!-- wp:group {"layout":{"type":"constrained"}} -->
  <!-- wp:post-title /-->
  <!-- wp:makerblocks/service-detail /-->
<!-- /wp:group -->
<!-- wp:template-part {"slug":"footer"} /-->
```
