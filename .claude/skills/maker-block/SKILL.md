---
name: maker-block
description: Orchestrated Gutenberg block creation with staged context loading.
---

<core_concept>
5-file block pattern: block.json -> index.js -> render.php -> edit.js -> {Component}.jsx

Architecture decisions flow to parallel agents (React component + Editor UX) via handoffs.
</core_concept>

<intake>
What would you like to do?

1. Create new block
2. Modify existing block
3. Add controls to block

**Provide block name and requirements.**
</intake>

<routing>
| Response | Workflow |
|----------|----------|
| 1, "create", "new" | workflows/create-block.md |
| 2, "modify", "update" | workflows/modify-block.md |
| 3, "controls", "add" | workflows/add-controls.md |
</routing>

<workflows_index>
| File | Purpose |
|------|---------|
| workflows/create-block.md | Full 5-file block creation |
| workflows/modify-block.md | Modify existing block |
| workflows/add-controls.md | Add InspectorControls |
</workflows_index>

<handoffs_index>
| Template | Transition |
|----------|------------|
| handoffs/requirements_handoff.yaml.template | intake -> architecture |
| handoffs/architecture_handoff.yaml.template | architecture -> react/editor |
</handoffs_index>
