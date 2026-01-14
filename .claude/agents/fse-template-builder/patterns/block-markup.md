# Pattern: Block Markup

WordPress block comment syntax reference.

## Self-Closing Block

No inner content, no attributes:
```html
<!-- wp:makerblocks/block-name /-->
```

## Block with Attributes

JSON object in comment:
```html
<!-- wp:makerblocks/block-name {"key":"value"} /-->
```

## Block with Inner Content

Opening and closing comments:
```html
<!-- wp:makerblocks/block-name -->
<p>Inner HTML content</p>
<!-- /wp:makerblocks/block-name -->
```

## Block with Attributes and Content

```html
<!-- wp:makerblocks/block-name {"className":"custom-class"} -->
<div>Inner content</div>
<!-- /wp:makerblocks/block-name -->
```

## Attribute Types

### String
```json
{"heading":"Page Title"}
```

### Number
```json
{"columns":3}
```

### Boolean
```json
{"showStats":true}
```

### Array
```json
{"items":["one","two","three"]}
```

### Object
```json
{"image":{"id":123,"url":"https://example.com/img.jpg","alt":"Description"}}
```

### Complex Object
```json
{"stats":[{"label":"Services","value":"50+","id":"services-count"}]}
```

## Namespace Rules

- Custom blocks: `makerblocks/block-name`
- Core blocks: `wp:core/block-name` or `wp:block-name`
- Always use makerblocks namespace for custom blocks
