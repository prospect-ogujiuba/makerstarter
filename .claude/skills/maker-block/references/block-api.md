<toc>
- #block-json
- #index-js
- #render-php
- #edit-js
- #inspector-controls
- #attributes
- #supports
- #registration
- #categories
</toc>

<!-- Discovery hints:
     - block-architect agent needs: #block-json, #index-js, #render-php, #attributes, #supports
     - block-editor-ux agent needs: #edit-js, #inspector-controls
     - architecture_handoff triggers: all sections based on ui_features
-->

<overview>
WordPress Block API v3 patterns for MakerBlocks Gutenberg development.
</overview>

<section id="five-file-pattern">
## 5-File Block Structure

Every block in `src/blocks-dev/{block-name}/`:

```
{block-name}/
├── block.json       # Metadata, attributes, apiVersion 3
├── index.js         # Registration entry point
├── edit.js          # Editor component
├── {BlockName}.jsx  # Frontend React component
└── render.php       # Server-side render template
```

### File Responsibilities

| File | Purpose | When Executed |
|------|---------|---------------|
| block.json | Defines block schema | Build time + runtime |
| index.js | Registers block with WP | Editor load |
| edit.js | Editor UI + controls | Editor (editing) |
| {BlockName}.jsx | Frontend interactivity | Frontend (viewing) |
| render.php | Initial HTML + data encoding | Server (page load) |
</section>

<!-- block-architect loads this section for block.json configuration -->
<section id="block-json">
## block.json Schema

```json
{
    "$schema": "https://schemas.wp.org/trunk/block.json",
    "apiVersion": 3,
    "name": "makerblocks/{block-name}",
    "version": "1.0.0",
    "title": "Block Title",
    "category": "makerblocks",
    "icon": "admin-generic",
    "description": "Block description for inserter.",
    "keywords": ["keyword1", "keyword2"],
    "supports": {
        "html": false,
        "align": ["wide", "full"],
        "spacing": {
            "margin": true,
            "padding": true
        }
    },
    "attributes": {
        "attributeName": {
            "type": "string",
            "default": "defaultValue"
        },
        "count": {
            "type": "number",
            "default": 6
        },
        "showFilters": {
            "type": "boolean",
            "default": true
        }
    },
    "editorScript": "file:./index.js",
    "render": "file:./render.php"
}
```
</section>

<!-- block-architect loads this section for attribute definitions -->
<section id="attributes">
## Attribute Types

- `string` - Text values
- `number` - Integers/floats
- `boolean` - true/false
- `array` - Lists (e.g., selected IDs for multi-select)
- `object` - Complex nested data
</section>

<!-- block-architect loads this section for supports configuration -->
<section id="supports">
## Block Supports

Common supports configuration options:

```json
{
    "supports": {
        "html": false,
        "align": ["wide", "full"],
        "spacing": {
            "margin": true,
            "padding": true
        },
        "color": {
            "background": true,
            "text": true
        },
        "typography": {
            "fontSize": true
        }
    }
}
```
</section>

<!-- block-architect loads this section for index.js patterns -->
<section id="index-js">
## index.js Registration

```javascript
import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import metadata from './block.json';

registerBlockType(metadata.name, {
    edit: Edit,
    save: () => null, // Dynamic block - render.php handles output
});
```

**Key points:**
- `save: () => null` for dynamic blocks (most MakerBlocks)
- Edit component handles editor rendering
- Server render (render.php) handles frontend
</section>

<!-- block-editor-ux loads this section for edit.js patterns -->
<section id="edit-js">
## edit.js Editor Component

```javascript
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, SelectControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
    const { title, showFilters, itemCount } = attributes;
    const blockProps = useBlockProps();

    return (
        <>
            <InspectorControls>
                <PanelBody title="Settings" initialOpen={true}>
                    <TextControl
                        label="Title"
                        value={title}
                        onChange={(value) => setAttributes({ title: value })}
                    />
                    <ToggleControl
                        label="Show Filters"
                        checked={showFilters}
                        onChange={(value) => setAttributes({ showFilters: value })}
                    />
                    <SelectControl
                        label="Items to Show"
                        value={itemCount}
                        options={[
                            { label: '3', value: 3 },
                            { label: '6', value: 6 },
                            { label: '9', value: 9 },
                        ]}
                        onChange={(value) => setAttributes({ itemCount: parseInt(value) })}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...blockProps}>
                <p>Editor Preview: {title}</p>
            </div>
        </>
    );
}
```
</section>

<!-- block-editor-ux loads this section for InspectorControls patterns -->
<section id="inspector-controls">
## InspectorControls Reference

Common controls for sidebar UI:

```javascript
import {
    PanelBody,
    TextControl,
    ToggleControl,
    SelectControl,
    RangeControl,
    ColorPicker
} from '@wordpress/components';

<InspectorControls>
    <PanelBody title="Display Settings">
        <RangeControl
            label="Columns"
            value={columns}
            onChange={(value) => setAttributes({ columns: value })}
            min={1}
            max={6}
        />
    </PanelBody>
</InspectorControls>
```
</section>

<!-- block-architect loads this section for render.php patterns -->
<section id="render-php">
## render.php Server Template

```php
<?php
/**
 * Block: {Block Name}
 * Renders the {block-name} block on the frontend.
 *
 * @var array $attributes Block attributes.
 * @var string $content Block inner content.
 * @var WP_Block $block Block instance.
 */

// Prepare data for React component
$component_data = [
    'endpoint' => rest_url('tr-api/rest/services/'),
    'nonce' => wp_create_nonce('wp_rest'),
    'siteUrl' => get_site_url(),
    'attributes' => $attributes,
];

// Encode for safe HTML attribute
$encoded_data = htmlspecialchars(
    json_encode($component_data),
    ENT_QUOTES,
    'UTF-8'
);

// Get wrapper attributes with mount ID
$wrapper_attributes = get_block_wrapper_attributes([
    'id' => 'makerblocks-{block-name}',
    'class' => 'makerblocks-{block-name}-wrapper',
]);
?>

<div <?php echo $wrapper_attributes; ?>
     data-component-data="<?php echo $encoded_data; ?>">
    <!-- Loading placeholder shown until React hydrates -->
    <div class="makerblocks-loading">
        <div class="makerblocks-skeleton"></div>
    </div>
</div>
```

**Critical:**
- `id` must match MakerBlocks.js mountId
- `data-component-data` is parsed by React component
- Loading placeholder prevents layout shift
</section>

<!-- block-architect loads this section for registration patterns -->
<section id="registration">
## Registration Points

### inc/blocks.php
```php
function makerblocks_register_blocks() {
    // Register each block
    register_block_type(
        MAKERBLOCKS_PLUGIN_DIR . 'src/blocks-dev/{block-name}/block.json'
    );
}
add_action('init', 'makerblocks_register_blocks');
```

### src/scripts/MakerBlocks.js
```javascript
import { ServiceGrid } from '../blocks-dev/service-grid/ServiceGrid';
import { EquipmentCard } from '../blocks-dev/equipment-card/EquipmentCard';

const componentRegistry = {
    'service-grid': {
        mountId: 'makerblocks-service-grid',
        component: ServiceGrid
    },
    'equipment-card': {
        mountId: 'makerblocks-equipment-card',
        component: EquipmentCard
    }
};

// Hydration logic
document.addEventListener('DOMContentLoaded', () => {
    Object.entries(componentRegistry).forEach(([name, config]) => {
        const mountPoint = document.getElementById(config.mountId);
        if (mountPoint) {
            const data = JSON.parse(mountPoint.dataset.componentData);
            ReactDOM.createRoot(mountPoint).render(
                <config.component {...data} />
            );
        }
    });
});
```
</section>

<!-- block-architect loads this section for category configuration -->
<section id="categories">
## Block Categories

| Category | Use For |
|----------|---------|
| makerblocks | General data display blocks |
| makerblocks-layout | Layout/container blocks |
| makerblocks-templates | Full-page template blocks |

Register categories in `inc/blocks.php`:
```php
function makerblocks_register_categories($categories) {
    return array_merge($categories, [
        ['slug' => 'makerblocks', 'title' => 'MakerBlocks'],
        ['slug' => 'makerblocks-layout', 'title' => 'MakerBlocks Layout'],
        ['slug' => 'makerblocks-templates', 'title' => 'MakerBlocks Templates'],
    ]);
}
add_filter('block_categories_all', 'makerblocks_register_categories');
```
</section>
