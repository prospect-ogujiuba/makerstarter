# Spacing Section

Managing settings.spacing in theme.json.

## Structure

```json
"spacing": {
  "spacingSizes": [
    {
      "name": "Small",
      "slug": "small",
      "size": "1rem"
    }
  ]
}
```

## Properties

| Property | Type | Format | Example |
|----------|------|--------|---------|
| name | string | Human-readable | "Medium" |
| slug | string | kebab-case | "medium" |
| size | string | CSS unit | "2rem" |

## Recommended Scale

```json
"spacingSizes": [
  {"name": "Extra Small", "slug": "xs", "size": "0.5rem"},
  {"name": "Small", "slug": "small", "size": "1rem"},
  {"name": "Medium", "slug": "medium", "size": "2rem"},
  {"name": "Large", "slug": "large", "size": "4rem"},
  {"name": "Extra Large", "slug": "xl", "size": "6rem"}
]
```

## Unit Guidelines

- Prefer: `rem` for scalability
- Alternative: `px` for fixed values
- Avoid: `em` (context-dependent)

## CSS Variable Output

WordPress generates:
```css
--wp--preset--spacing--{slug}: {size};
```

Usage:
```
var(--wp--preset--spacing--medium)
```

## Related Settings

```json
"spacing": {
  "blockGap": true,
  "margin": true,
  "padding": true,
  "units": ["px", "rem", "%"]
}
```
