# Pattern: Template Structure

Basic FSE template HTML structure patterns.

## Minimal Template

```html
<!-- wp:makerblocks/header /-->

<!-- wp:makerblocks/page-header {"heading":"Page Title"} /-->

<!-- wp:makerblocks/main-content-block /-->

<!-- wp:makerblocks/footer /-->
```

## Standard Page Template

```html
<!-- wp:makerblocks/header /-->

<!-- wp:makerblocks/page-header {"heading":"Title","description":"Subtitle","showStats":false} /-->

<!-- wp:makerblocks/content-block-1 /-->

<!-- wp:makerblocks/cta-section /-->

<!-- wp:makerblocks/footer /-->
```

## Multi-Section Template

```html
<!-- wp:makerblocks/header /-->

<!-- wp:makerblocks/hero-section /-->

<main>
  <!-- wp:makerblocks/section-1 /-->

  <!-- wp:makerblocks/section-2 /-->

  <!-- wp:makerblocks/section-3 /-->
</main>

<!-- wp:makerblocks/cta-section /-->

<!-- wp:makerblocks/footer /-->
```

## Required Elements

Every template MUST have:
1. Header block as first element
2. Footer block as last element
3. At least one content block between

## Template Hierarchy

| File | Purpose |
|------|---------|
| front-page.html | Homepage |
| page.html | Default page |
| page-{slug}.html | Specific page |
| single.html | Single post |
| 404.html | Error page |
| index.html | Fallback |
