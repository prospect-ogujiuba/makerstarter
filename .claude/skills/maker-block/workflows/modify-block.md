<objective>
Modify an existing Gutenberg block by updating specific components.
</objective>

<staged_context>

## Stage 0: Modification Routing

Identify what the user wants to modify and route to appropriate context loading.

**Modification Types:**
| Type | Files Affected | Context Needed |
|------|----------------|----------------|
| Attributes | block.json, edit.js, {Component}.jsx, render.php | block-api.md#attributes |
| Editor controls | edit.js | block-api.md#inspector-controls |
| Component logic | {Component}.jsx | react-patterns sections based on change |
| Data source | render.php, {Component}.jsx | block-api.md#render-php, react-patterns.md#fetch-patterns |
| Render template | render.php | block-api.md#render-php |

</staged_context>

<process>

## Stage 1: Identify Modification Scope

Ask user what they want to modify:
- **Attributes**: Add/change/remove block attributes
- **Editor UI**: InspectorControls, toolbar, placeholder
- **Frontend component**: React component logic or rendering
- **Server render**: PHP render template
- **Data fetching**: Endpoint, filters, caching

<modification_routing>
Based on user response, determine:
1. Which files need modification
2. Which reference sections to load (if any)
3. Which agent(s) to invoke
</modification_routing>

## Stage 2: Context Loading Based on Scope

<context_rules>
**Load ONLY what's needed for the specific modification:**

**If modifying ATTRIBUTES:**
- Load: block-api.md#attributes
- Agent: block-architect
- Ensure 4-file consistency check

**If modifying EDITOR CONTROLS:**
- Load: block-api.md#inspector-controls
- Agent: block-editor-ux
- No other references needed

**If modifying COMPONENT LOGIC:**
<discovery_trigger_evaluation>
Evaluate against requested changes:
```
Adding data fetching → Load react-patterns.md#fetch-patterns
Adding loading states → Load react-patterns.md#loading-states
Adding filters → Load component-library.md#filter-components
Adding pagination → Load component-library.md#pagination-components
Adding state management → Load react-patterns.md#state-management
Modifying hooks → Load react-patterns.md#hooks
```
</discovery_trigger_evaluation>
- Agent: react-component-dev

**If modifying DATA SOURCE:**
- Load: block-api.md#render-php
- Load: react-patterns.md#fetch-patterns
- Agents: block-architect + react-component-dev

**If modifying RENDER TEMPLATE only:**
- Load: block-api.md#render-php
- Agent: block-architect
</context_rules>

## Stage 3: Execute Modifications

For each change:
1. Read current file state
2. Apply modification using loaded context
3. Ensure attribute consistency across files (if applicable)

## Stage 4: Attribute Consistency Check

<consistency_check>
When modifying attributes, ensure all 4 files agree:
```
block.json     → Defines attribute schema (source of truth)
edit.js        → Reads/writes attribute values
{Component}.jsx → Receives attributes via componentData
render.php     → Encodes attributes in component-data
```

**Verification:**
1. Attribute name matches across all files
2. Attribute type consistent
3. Default values propagate correctly
</consistency_check>

## Stage 5: Rebuild and Test

```bash
npm run dev
```

**Editor tests:**
- Changes appear without errors
- Existing blocks still work
- New functionality works

**Frontend tests:**
- Component receives updated data
- No hydration errors

</process>

<common_modifications>
## Common Modification Patterns

### Add New Attribute
**Context:** block-api.md#attributes
**Files:** block.json → edit.js → render.php → {Component}.jsx

1. Add to block.json `attributes` object
2. Add control in edit.js InspectorControls
3. Include in render.php component_data
4. Use in {Component}.jsx

### Change Data Endpoint
**Context:** block-api.md#render-php, react-patterns.md#fetch-patterns
**Files:** render.php, {Component}.jsx

1. Update render.php endpoint URL
2. Update {Component}.jsx fetch logic
3. Handle new data shape in rendering

### Add Loading State
**Context:** react-patterns.md#loading-states
**Files:** {Component}.jsx only

1. Add useState for loading/error
2. Add SkeletonLoader during fetch
3. Handle error states

### Add Inspector Control
**Context:** block-api.md#inspector-controls
**Files:** edit.js only (plus block.json if new attribute)

1. Import control component
2. Add to InspectorControls PanelBody
3. Connect to attribute via setAttributes
</common_modifications>

<handoff_format>
**Reference architecture handoff format for modifications:**
```yaml
modification_handoff:
  scope: [attributes | editor | component | data_source | render]
  files_affected:
    - path: src/blocks-dev/{block-name}/block.json
      changes: [add attribute, remove attribute, modify type]
    - path: src/blocks-dev/{block-name}/edit.js
      changes: [add control, update binding]
  context_loaded:
    - reference: block-api.md
      sections: [#attributes, #inspector-controls]
  decisions:
    - decision: "Description of change"
      rationale: "Why this approach"
```
</handoff_format>

<success_criteria>
- [ ] Modifications applied to correct files
- [ ] Attribute consistency maintained
- [ ] No console errors in editor
- [ ] No hydration errors on frontend
- [ ] Existing functionality preserved
</success_criteria>
