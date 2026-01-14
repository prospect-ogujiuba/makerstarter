<objective>
Add InspectorControls to an existing block for sidebar settings.
</objective>

<staged_context>

## Stage 0: Minimal Workflow

This is a focused, single-agent workflow for adding sidebar controls to an existing block.

**Context Loading:** block-api.md#inspector-controls ONLY

**Agent:** block-editor-ux

</staged_context>

<process>

## Stage 1: Gather Control Requirements

Collect from user:
- **Control type**: TextControl, SelectControl, ToggleControl, RangeControl, ColorPicker
- **Attribute name**: camelCase identifier
- **Attribute type**: string, number, boolean
- **Default value**: Initial value
- **Label/help text**: UI labels

<control_requirements>
```yaml
new_control:
  type: TextControl | SelectControl | ToggleControl | RangeControl | ColorPicker
  attribute: attributeName
  attribute_type: string | number | boolean
  default: defaultValue
  label: "Display Label"
  help: "Optional help text"
  options: [] # For SelectControl only
```
</control_requirements>

## Stage 2: Load Focused Context

<context_loading>
**CONTEXT LOADED:**
- references/block-api.md#inspector-controls ONLY

No other references needed for this workflow.
</context_loading>

**AGENT:** block-editor-ux

## Stage 3: Update block.json Attributes

Add new attribute to block.json:
```json
{
  "attributes": {
    "existingAttr": { "type": "string" },
    "newAttribute": {
      "type": "string",
      "default": "defaultValue"
    }
  }
}
```

## Stage 4: Add InspectorControls

**edit.js pattern:**
```jsx
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ToggleControl, SelectControl, RangeControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
    const { newAttribute } = attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title="Settings">
                    <TextControl
                        label="New Attribute"
                        value={newAttribute}
                        onChange={(value) => setAttributes({ newAttribute: value })}
                    />
                </PanelBody>
            </InspectorControls>
            {/* Block content */}
        </>
    );
}
```

## Stage 5: Update render.php (if frontend needs attribute)

If attribute should reach frontend component:
```php
$component_data = [
    'endpoint' => rest_url('tr-api/rest/resource/'),
    'nonce' => wp_create_nonce('wp_rest'),
    'attributes' => $attributes, // All attributes passed
];
```

## Stage 6: Update Component (if frontend needs attribute)

If component needs the new attribute:
```jsx
const { newAttribute } = componentData.attributes;
// Use in component logic or rendering
```

## Stage 7: Test Attribute Flow

1. Open block in editor
2. Change control value in sidebar
3. Save page
4. Reload - value persists
5. View frontend - attribute affects rendering (if applicable)

</process>

<control_types>
## Available Control Types

| Control | Use For | Attribute Type |
|---------|---------|----------------|
| TextControl | Short text, URLs | string |
| TextareaControl | Long text | string |
| SelectControl | Dropdown selection | string |
| ToggleControl | Boolean on/off | boolean |
| RangeControl | Numeric slider | number |
| ColorPicker | Color selection | string |
| MediaUpload | Image/file selection | number (attachment ID) |

**Usage pattern:**
```jsx
<{Control}
    label="Label"
    help="Help text"
    value={attributes.attrName}
    onChange={(value) => setAttributes({ attrName: value })}
    // Type-specific props
/>
```

**SelectControl options:**
```jsx
<SelectControl
    label="Layout"
    value={attributes.layout}
    options={[
        { label: 'Grid', value: 'grid' },
        { label: 'List', value: 'list' },
    ]}
    onChange={(value) => setAttributes({ layout: value })}
/>
```

**RangeControl range:**
```jsx
<RangeControl
    label="Items per page"
    value={attributes.itemsPerPage}
    onChange={(value) => setAttributes({ itemsPerPage: value })}
    min={1}
    max={50}
/>
```
</control_types>

<handoff_format>
**Reference architecture handoff format:**
```yaml
control_handoff:
  block_name: services-grid
  new_controls:
    - type: ToggleControl
      attribute: showFilters
      attribute_type: boolean
      default: true
      label: "Show Filters"
  files_modified:
    - block.json (attribute added)
    - edit.js (control added)
    - render.php (if frontend needed)
    - {Component}.jsx (if frontend needed)
  context_loaded:
    - block-api.md#inspector-controls
```
</handoff_format>

<success_criteria>
- [ ] Attribute added to block.json
- [ ] Control appears in InspectorControls
- [ ] Value changes persist on save
- [ ] Attribute reaches component (if needed)
- [ ] No editor console errors
</success_criteria>
