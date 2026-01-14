# Phase 2: Compose Blocks

Determine block composition and layout structure.

## Block Catalog Reference

Load appropriate blocks from available categories:

### Header/Footer (Required)
- makerblocks/header
- makerblocks/footer

### Heroes (Choose one)
- makerblocks/page-header - Standard page header with optional stats
- makerblocks/hero - Full hero section
- makerblocks/hero-section - Alternate hero
- makerblocks/contact-hero - Contact page hero with image
- makerblocks/company-hero - About page hero

### Content Blocks
- makerblocks/services, service-bundles, core-services
- makerblocks/team-showcase
- makerblocks/pricing-tiers, pricing-models
- makerblocks/resources-page
- makerblocks/search-results

### Section Blocks
- makerblocks/stats-section, stats-counter
- makerblocks/features-section
- makerblocks/benefits-section
- makerblocks/social-proof-section
- makerblocks/faq-section
- makerblocks/cta-section

### Company Blocks
- makerblocks/mission-vision
- makerblocks/values-grid

### Contact Blocks
- makerblocks/contact-form, contact-info, contact-submissions
- makerblocks/location-map
- makerblocks/social-links

## Layout Decisions

### Simple Layout (No HTML wrapper)
Use when blocks stack vertically with no grid:
```
<!-- wp:makerblocks/header /-->
<!-- wp:makerblocks/page-header {...} /-->
<!-- wp:makerblocks/services /-->
<!-- wp:makerblocks/footer /-->
```

### Grid Layout (HTML wrapper needed)
Use for multi-column layouts:
```html
<main class="py-12 bg-gray-50">
  <div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3">
      <div class="lg:col-span-2">
        <!-- wp:makerblocks/contact-form /-->
      </div>
      <div class="lg:col-span-1">
        <!-- wp:makerblocks/contact-info /-->
      </div>
    </div>
  </div>
</main>
```

## Attribute Configuration

Configure attributes based on custom_attributes from handoff:
1. Use defaults for unspecified attributes
2. Override with provided values
3. Validate types against block.json

## Output

Block composition plan for Phase 3:
- Ordered block list with attributes
- Layout structure (simple/grid)
- HTML wrapper markup if needed
