# Block Styles Section

Managing styles.blocks in theme.json.

## Structure

```json
"styles": {
  "blocks": {
    "core/heading": {
      "color": {
        "text": "var(--wp--preset--color--primary)"
      },
      "typography": {
        "fontFamily": "var(--wp--preset--font-family--display)"
      }
    }
  }
}
```

## Common Block Targets

| Block | Use Case |
|-------|----------|
| core/heading | Heading styles |
| core/paragraph | Body text |
| core/button | Button styles |
| core/image | Image defaults |
| core/group | Container styles |

## Style Properties

```json
"core/button": {
  "color": {
    "background": "var(--wp--preset--color--primary)",
    "text": "#ffffff"
  },
  "border": {
    "radius": "4px"
  },
  "spacing": {
    "padding": {
      "top": "0.75rem",
      "bottom": "0.75rem",
      "left": "1.5rem",
      "right": "1.5rem"
    }
  }
}
```

## Block Settings vs Styles

Settings (what's available):
```json
"settings": {
  "blocks": {
    "core/button": {
      "color": {"custom": false}
    }
  }
}
```

Styles (default appearance):
```json
"styles": {
  "blocks": {
    "core/button": {
      "color": {"background": "#000"}
    }
  }
}
```

## Using Preset Variables

Reference palette/typography presets:
```
var(--wp--preset--color--{slug})
var(--wp--preset--font-family--{slug})
var(--wp--preset--font-size--{slug})
var(--wp--preset--spacing--{slug})
```
