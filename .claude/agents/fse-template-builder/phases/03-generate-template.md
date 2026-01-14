# Phase 3: Generate Template

Generate the FSE template HTML file.

## File Location

Output path: `/wp-content/themes/makerstarter/templates/{template_name}`

Follow naming convention from Phase 1:
- front-page.html, page.html, page-{slug}.html, etc.

## Template Structure

### Minimal Template (No Layout)
```html
<!-- wp:makerblocks/header /-->

<!-- wp:makerblocks/page-header {"heading":"Title","description":"Subtitle"} /-->

<!-- wp:makerblocks/content-block /-->

<!-- wp:makerblocks/footer /-->
```

### Template with Layout Wrapper
```html
<!-- wp:makerblocks/header /-->

<!-- wp:makerblocks/hero {...} /-->

<main class="container-class">
  <!-- Blocks with HTML structure -->
</main>

<!-- wp:makerblocks/footer /-->
```

## Block Comment Syntax

### Self-closing (no inner content)
```html
<!-- wp:makerblocks/block-name /-->
```

### With attributes
```html
<!-- wp:makerblocks/block-name {"key":"value","number":123} /-->
```

### With inner content
```html
<!-- wp:makerblocks/block-name -->
<p>Inner content</p>
<!-- /wp:makerblocks/block-name -->
```

## Attribute Serialization

JSON in HTML comment:
- Double quotes for keys and strings
- No trailing commas
- Proper escaping for special characters
- Complex types: arrays `["a","b"]`, objects `{"nested":"value"}`

## Validation Checklist

Before writing file:
- [ ] Header block at start
- [ ] Footer block at end
- [ ] All JSON valid
- [ ] Namespace is makerblocks
- [ ] Block names are kebab-case
- [ ] File extension is .html

## Conditional Theme Handoff

If template requires theme.json updates:
- New colors not in palette
- Custom typography needs
- Template registration required

Produce theme_needs_handoff.yaml for theme-integrator.
Otherwise, skip handoff (empty arrays signal no updates).
