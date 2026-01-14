# Color Palette Section

Managing settings.color.palette in theme.json.

## Structure

```json
"color": {
  "palette": [
    {
      "name": "Primary",
      "slug": "primary",
      "color": "#1a1a1a"
    }
  ]
}
```

## Required Properties

| Property | Type | Format | Example |
|----------|------|--------|---------|
| name | string | Human-readable | "Primary" |
| slug | string | kebab-case | "primary" |
| color | string | CSS color | "#1a1a1a" |

## Color Value Formats

Valid formats:
- Hex: `#1a1a1a`, `#fff`
- RGB: `rgb(26, 26, 26)`
- RGBA: `rgba(26, 26, 26, 0.5)`
- HSL: `hsl(0, 0%, 10%)`
- Named: `black`, `white`

Prefer: 6-digit hex for consistency

## Edit Pattern

Adding to existing palette:

```json
// BEFORE
"palette": [
  {"name": "Primary", "slug": "primary", "color": "#1a1a1a"}
]

// AFTER
"palette": [
  {"name": "Primary", "slug": "primary", "color": "#1a1a1a"},
  {"name": "Service Accent", "slug": "service-accent", "color": "#3B82F6"}
]
```

## CSS Variable Output

WordPress generates:
```css
--wp--preset--color--{slug}: {color};
```

Usage in templates:
```
var(--wp--preset--color--service-accent)
```
