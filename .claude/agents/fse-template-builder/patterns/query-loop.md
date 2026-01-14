# Pattern: Query Loop

Patterns for dynamic content templates.

## Note on Data Flow

makerblocks architecture:
- Templates do NOT query data directly
- Blocks fetch data client-side via REST API
- Templates compose blocks that handle their own data

## Dynamic Content Blocks

These blocks handle their own data fetching:

### Services Grid
```html
<!-- wp:makerblocks/services /-->
```
Fetches services from TypeRocket REST API.

### Team Display
```html
<!-- wp:makerblocks/team-showcase /-->
```
Fetches team members dynamically.

### Resources
```html
<!-- wp:makerblocks/resources-page /-->
```
Fetches resources with filtering.

### Search Results
```html
<!-- wp:makerblocks/search-results /-->
```
Displays search results dynamically.

## Configuring Dynamic Blocks

Use attributes to configure behavior:

### Filtered Content
```html
<!-- wp:makerblocks/services {"category":"consulting"} /-->
```

### Limited Results
```html
<!-- wp:makerblocks/team-showcase {"limit":6} /-->
```

### Custom Display
```html
<!-- wp:makerblocks/pricing-tiers {"featuredTierCode":"premium"} /-->
```

## Archive Templates

For post type archives:

### Single Post
```html
<!-- wp:makerblocks/header /-->
<!-- wp:makerblocks/page-header /-->
<!-- wp:makerblocks/post-content /-->
<!-- wp:makerblocks/footer /-->
```

### Archive List
```html
<!-- wp:makerblocks/header /-->
<!-- wp:makerblocks/archive-header /-->
<!-- wp:makerblocks/post-grid /-->
<!-- wp:makerblocks/footer /-->
```

## Key Principle

Templates compose, blocks fetch. No PHP queries in templates.
