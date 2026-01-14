# Phase 2: Plan Changes

Determine JSON paths and prepare modifications for theme.json.

## Read Current State

```
Theme.json location:
/home/priz/projects/devarch/apps/b2bcnc/wp-content/themes/makerstarter/theme.json
```

1. Read current theme.json
2. Parse existing structure
3. Identify target sections for modifications

## JSON Path Planning

### Color Palette Additions
```
Path: settings.color.palette
Action: Append to existing array
Preserve: All existing color entries
```

### Typography Additions
```
Path: settings.typography.fontFamilies
Action: Append to existing array
Preserve: All existing font entries

Path: settings.typography.fontSizes (if needed)
Action: Append to existing array
```

### Custom Template Registration
```
Path: customTemplates (or settings.custom.templates)
Action: Add template entry
```

## Conflict Detection

Check for existing entries with same slugs:
- Duplicate color slug → skip or warn
- Duplicate typography slug → skip or warn
- Existing template registration → skip

## Change Manifest

Prepare structured list of all modifications:

```yaml
modifications:
  - path: "settings.color.palette"
    action: "append"
    entries:
      - {name: "Service Accent", slug: "service-accent", color: "#3B82F6"}

  - path: "settings.typography.fontFamilies"
    action: "append"
    entries:
      - {name: "Display", slug: "display", fontFamily: "'Playfair Display', serif"}
```

## Section Loading

Based on change types, load relevant section files:
- Colors needed → @sections/color-palette.md
- Typography needed → @sections/typography.md
- Spacing needed → @sections/spacing.md
- Custom templates → @sections/custom-templates.md
- Block styles → @sections/block-styles.md

## Traceability

Map each change to handoff decision:
```
Change: Add 'service-accent' color
Decision: "Services page needs distinct accent color"
Rationale: "Design requires visual distinction from main brand"
```
