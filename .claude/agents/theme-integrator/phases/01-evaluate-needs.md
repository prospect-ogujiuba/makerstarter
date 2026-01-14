# Phase 1: Evaluate Needs

Parse theme_needs_handoff.yaml and determine what theme.json updates are required.

## Input Processing

Receive handoff from fse-template-builder:

```yaml
handoff:
  metadata:
    from_stage: "template-building"
    to_stage: "theme-integration"
  schema:
    template_file: "templates/page-services.html"
    new_colors_needed: [...]
    new_typography_needed: [...]
    custom_template_registration: boolean
  decisions: [...]
```

## Extraction Steps

1. **Parse new_colors_needed**
   - Extract: name, slug, value, rationale
   - Each entry becomes a palette addition
   - Validate hex/rgb color format

2. **Parse new_typography_needed**
   - Extract: name, slug, fontFamily, rationale
   - May include fontSizes if specified
   - Validate font stack format

3. **Check custom_template_registration**
   - Boolean flag for customTemplates array
   - If true, extract template_file path

## Validation Checks

- At least one change type must be present
- Color slugs must be kebab-case
- Typography slugs must be kebab-case
- Color values must be valid CSS colors

## Output: Change Requirements

```
changes_needed:
  colors: [{name, slug, value}]
  typography: [{name, slug, fontFamily}]
  custom_templates: boolean
  rationales: [{change, reason}]
```

## Skip Condition

If ALL conditions met, this agent should NOT have been invoked:
- new_colors_needed is empty
- new_typography_needed is empty
- custom_template_registration is false
