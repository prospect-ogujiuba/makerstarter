<staged_context>

## Stage 0: Skill Router (~400 tokens)

Essential knowledge only - route to this workflow when user wants to create a new block.

**5-File Pattern Overview:**
- block.json - Block metadata and attribute schema
- index.js - Editor registration
- edit.js - Editor UI and controls
- render.php - Server-side render + component-data encoding
- {BlockName}.jsx - React component for frontend hydration

**Component-Data Encoding:**
PHP encodes configuration into data-component-data attribute. React hydrates from this.

**Hydration Flow:**
```
Server (PHP) → HTML with data-component-data → Client (React) hydrates → Interactive
```

</staged_context>

<objective>
Create a complete Gutenberg block with all 5 files plus registration.
</objective>

<process>

## Stage 1: Requirements Gathering (~1.5k tokens)

Collect from user:
- **Block name** (kebab-case): e.g., "services-grid", "equipment-card"
- **Block title** (human readable): e.g., "Services Grid", "Equipment Card"
- **Category**: makerblocks | makerblocks-layout | makerblocks-templates
- **Attributes**: Name, type (string, number, boolean, array, object), defaults
- **Data source**: REST endpoint (if dynamic) or static
- **UI requirements**: Filters, pagination, loading states, layout options

<handoff_output>
**OUTPUT: requirements_handoff.yaml**
```yaml
handoff:
  metadata:
    from_stage: "requirements-gathering"
    to_stage: "architecture-phase"
  schema:
    block_name: services-grid
    title: Services Grid
    category: makerblocks
    attributes:
      - name: showFilters
        type: boolean
        default: true
      - name: itemsPerPage
        type: number
        default: 12
    data_source:
      endpoint: /tr-api/rest/services/
      dynamic: true
    ui_features:
      - filters
      - pagination
      - loading_states
  decisions: []
  constraints: []
```
</handoff_output>

## Stage 2: Block Architecture Phase

<context_loading>
**CONTEXT LOADED:**
- references/block-api.md (sections: #block-json, #index-js, #render-php)
- requirements_handoff.yaml

**DISCOVERY TRIGGERS:**
| Trigger Condition | Reference | Section |
|-------------------|-----------|---------|
| (always) | block-api.md | #block-json |
| (always) | block-api.md | #index-js |
| (always) | block-api.md | #render-php |
| attributes.length > 0 | block-api.md | #attributes |
</context_loading>

**AGENT: block-architect**

Invoke with requirements_handoff.yaml contents.

<handoff_validation>
**Wait for handoff containing:**
- block_name
- mount_id
- attributes_schema (validated block.json attributes)
- component_data_shape
- decisions (attribute type choices, mount ID reasoning)
</handoff_validation>

<handoff_output>
**OUTPUT: architecture_handoff.yaml**
```yaml
handoff:
  metadata:
    from_stage: "architecture-phase"
    to_stage: "component-phase"
  schema:
    block_name: services-grid
    mount_id: makerblocks-services-grid
    attributes_schema:
      showFilters:
        type: boolean
        default: true
      itemsPerPage:
        type: number
        default: 12
    component_data_shape:
      endpoint: string
      nonce: string
      attributes: object
  decisions:
    - decision: "Array attributes for selectedIds (multi-select capability)"
      rationale: "Allow filtering by multiple service IDs"
      impact: ["Component needs array state management"]
    - decision: "Boolean for showFilters (simple toggle)"
      rationale: "On/off control in InspectorControls"
      impact: ["ToggleControl in edit.js"]
```
</handoff_output>

**Files created:**
- block.json
- index.js
- render.php (skeleton)

## Stage 3A/3B: React Component + Editor UX (PARALLEL)

<parallel_stages>

### Stage 3A: React Component (react-component-dev)

<context_loading>
**CONTEXT LOADED:**
- architecture_handoff.yaml

<discovery_trigger_evaluation>
**Evaluate triggers against architecture_handoff:**
```
(always) → Load react-patterns.md#hooks
data_source.dynamic == true → Load react-patterns.md#fetch-patterns
ui_features contains "loading_states" → Load react-patterns.md#loading-states
ui_features contains "filters" → Load component-library.md#filter-components
ui_features contains "pagination" → Load component-library.md#pagination-components
attributes contains type="array" → Load react-patterns.md#state-management
```
</discovery_trigger_evaluation>

**Sections loaded based on evaluation:**
- references/react-patterns.md (sections: #hooks, conditional sections from triggers)
- references/component-library.md (sections: conditional based on ui_features)
</context_loading>

**AGENT: react-component-dev**

Invoke with:
```yaml
architecture_handoff: [from Stage 2]
component_requirements:
  data_fetching: true/false
  loading_states: true/false
  filters: [any filters]
  interactions: [click handlers, etc.]
```

**OUTPUT: {BlockName}.jsx + component_decisions**
- loading_strategy
- error_handling
- state_management_approach

### Stage 3B: Editor UX (block-editor-ux)

<context_loading>
**CONTEXT LOADED:**
- architecture_handoff.yaml

<discovery_trigger_evaluation>
**Evaluate triggers against architecture_handoff:**
```
(always) → Load block-api.md#edit-js
attributes.length > 0 → Load block-api.md#inspector-controls
supports.align == true → Load block-api.md#supports
```
</discovery_trigger_evaluation>

**Sections loaded:**
- references/block-api.md (sections: #edit-js, #inspector-controls)
</context_loading>

**AGENT: block-editor-ux**

Invoke with:
```yaml
architecture_handoff: [from Stage 2]
editor_controls:
  inspector: [controls for sidebar based on attributes]
  toolbar: [controls for toolbar if needed]
```

**OUTPUT: edit.js**

</parallel_stages>

**Wait for both agents to complete.**

**Files created:**
- {BlockName}.jsx
- edit.js

## Stage 4: Registration + Verification

No reference loading required - use file paths only.

**inc/blocks.php:**
```php
register_block_type(
    MAKERBLOCKS_PLUGIN_DIR . 'src/blocks-dev/{block-name}/block.json'
);
```

**src/scripts/MakerBlocks.js:**
```javascript
import {BlockName} from '../blocks-dev/{block-name}/{BlockName}';

// Add to registry
'{block-name}': {
    mountId: 'makerblocks-{block-name}',
    component: {BlockName}
}
```

**Build:**
```bash
cd /path/to/makerblocks
npm run dev
```

**Editor tests:**
1. Block appears in inserter under correct category
2. Block can be added to page
3. InspectorControls show in sidebar
4. Attributes persist on save

**Frontend tests:**
1. Block renders HTML
2. React component hydrates
3. Data fetches correctly (if dynamic)
4. Loading states work
5. Error states handled

</process>

<agent_sequence>
```
Stage 0: Skill Router
       ↓
Stage 1: Requirements Gathering
       ↓ requirements_handoff.yaml
Stage 2: block-architect
       ↓ architecture_handoff.yaml
       ├──→ Stage 3A: react-component-dev
       │
       └──→ Stage 3B: block-editor-ux
              ↓
Stage 4: Registration + Verification
```
</agent_sequence>

<success_criteria>
- [ ] 5 files created in src/blocks-dev/{block-name}/
- [ ] block.json has apiVersion 3 and valid attributes
- [ ] index.js registers block correctly
- [ ] edit.js has functional InspectorControls
- [ ] {BlockName}.jsx fetches data and renders
- [ ] render.php encodes component-data correctly
- [ ] Block registered in inc/blocks.php
- [ ] Component registered in MakerBlocks.js
- [ ] Block appears in editor inserter
- [ ] Frontend hydration works
</success_criteria>
