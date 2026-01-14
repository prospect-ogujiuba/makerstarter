# Custom Templates Section

Registering custom templates in theme.json.

## Structure

```json
"customTemplates": [
  {
    "name": "page-services",
    "title": "Services Page",
    "postTypes": ["page"]
  }
]
```

## Properties

| Property | Type | Description |
|----------|------|-------------|
| name | string | Template filename (without .html) |
| title | string | Display name in editor |
| postTypes | array | Applicable post types |

## Post Types

Common values:
- `"page"` - Pages only
- `"post"` - Posts only
- `["page", "post"]` - Both
- Custom post types by slug

## File Location

Templates must exist at:
```
wp-content/themes/makerstarter/templates/{name}.html
```

## Registration Pattern

When fse-template-builder creates a custom template:

1. Template file created: `templates/page-services.html`
2. Handoff sets `custom_template_registration: true`
3. theme-integrator adds to customTemplates array

## Edit Pattern

```json
// BEFORE
"customTemplates": []

// AFTER
"customTemplates": [
  {
    "name": "page-services",
    "title": "Services Page",
    "postTypes": ["page"]
  }
]
```

## Validation

- name must match existing template file
- title should be descriptive
- postTypes must be valid post type slugs
