# Typography Section

Managing settings.typography in theme.json.

## Font Families Structure

```json
"typography": {
  "fontFamilies": [
    {
      "name": "System",
      "slug": "system",
      "fontFamily": "-apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif"
    }
  ]
}
```

## Font Sizes Structure

```json
"typography": {
  "fontSizes": [
    {
      "name": "Small",
      "slug": "small",
      "size": "14px"
    }
  ]
}
```

## Font Family Properties

| Property | Type | Format | Example |
|----------|------|--------|---------|
| name | string | Human-readable | "Display" |
| slug | string | kebab-case | "display" |
| fontFamily | string | CSS font stack | "'Playfair Display', serif" |

## Font Size Properties

| Property | Type | Format | Example |
|----------|------|--------|---------|
| name | string | Human-readable | "Large" |
| slug | string | kebab-case | "large" |
| size | string | CSS unit | "24px" |

## Font Stack Guidelines

```
serif: "'Font Name', Georgia, serif"
sans-serif: "'Font Name', -apple-system, sans-serif"
monospace: "'Font Name', 'Courier New', monospace"
```

Quote font names with spaces.

## CSS Variable Output

WordPress generates:
```css
--wp--preset--font-family--{slug}: {fontFamily};
--wp--preset--font-size--{slug}: {size};
```

## Edit Pattern

```json
// Adding font family
"fontFamilies": [
  {"name": "System", "slug": "system", "fontFamily": "..."},
  {"name": "Display", "slug": "display", "fontFamily": "'Playfair Display', serif"}
]
```
