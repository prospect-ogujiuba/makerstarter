# Essential Principles for Gutenberg Blocks

This context is loaded by Stage 1 (Requirements Gathering) to inform proper block creation.

## 5-File Block Pattern

Every MakerBlocks block consists of 5 files in `src/blocks-dev/{block-name}/`:

```
{block-name}/
├── block.json       # Block metadata, attributes, apiVersion 3
├── index.js         # Block registration, edit/save imports
├── edit.js          # Editor component with InspectorControls
├── {BlockName}.jsx  # Frontend React component
└── render.php       # Server-side render with component-data encoding
```

## Component-Data Encoding Pattern

Server passes data to React via encoded JSON in data attribute:

**render.php:**
```php
$component_data = [
    'endpoint' => rest_url('tr-api/rest/services/'),
    'nonce' => wp_create_nonce('wp_rest'),
    'attributes' => $attributes,
];
$encoded = htmlspecialchars(json_encode($component_data), ENT_QUOTES, 'UTF-8');
?>
<div <?php echo get_block_wrapper_attributes(['id' => 'makerblocks-{block-name}']); ?>
     data-component-data="<?php echo $encoded; ?>">
    <!-- Loading placeholder -->
</div>
```

**{BlockName}.jsx:**
```jsx
const mountPoint = document.getElementById('makerblocks-{block-name}');
const componentData = JSON.parse(mountPoint.dataset.componentData);
```

## Hydration Flow

1. Server renders `render.php` -> HTML with encoded data
2. MakerBlocks.js finds mount point by ID
3. Parses component-data attribute
4. Renders React component with parsed props

## Registration Points

Two registration locations required:

### PHP Registration (`inc/blocks.php`)
```php
register_block_type(MAKERBLOCKS_DIR . 'build/blocks/{block-name}');
```

### Frontend Registry (`src/scripts/MakerBlocks.js`)
```js
import { BlockName } from '../blocks-dev/{block-name}/{BlockName}.jsx';

const components = {
    '{block-name}': BlockName,
};
```

## Block Attributes

Define in `block.json` with types:

```json
{
    "attributes": {
        "title": { "type": "string", "default": "" },
        "count": { "type": "number", "default": 6 },
        "showFilters": { "type": "boolean", "default": true },
        "items": { "type": "array", "default": [] }
    }
}
```

## InspectorControls Pattern

Editor sidebar controls in `edit.js`:

```jsx
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, RangeControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
    return (
        <>
            <InspectorControls>
                <PanelBody title="Settings">
                    <TextControl
                        label="Title"
                        value={attributes.title}
                        onChange={(title) => setAttributes({ title })}
                    />
                    <ToggleControl
                        label="Show Filters"
                        checked={attributes.showFilters}
                        onChange={(showFilters) => setAttributes({ showFilters })}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...useBlockProps()}>
                {/* Editor preview */}
            </div>
        </>
    );
}
```

## Success Criteria

A complete block includes:
- `block.json` with apiVersion 3, attributes, category
- `index.js` with registerBlockType call
- `edit.js` with InspectorControls (if needed)
- `{BlockName}.jsx` frontend component
- `render.php` with component-data encoding
- Registration in `inc/blocks.php`
- Registration in `src/scripts/MakerBlocks.js`
- Block appears in editor inserter
- Block renders correctly on frontend
- Data hydration works (if dynamic)
