# Phase 3: Apply Changes

Execute theme.json modifications and validate results.

## Edit Workflow

1. **Apply modifications using Edit tool**
   - One section at a time
   - Maintain JSON validity throughout
   - Preserve 2-space indentation

2. **Ordering**
   - Alphabetical where applicable
   - New entries at end of arrays

## Edit Pattern

For array additions (colors, typography):
```
old_string: Existing array end
new_string: Existing entries + new entries
```

Ensure proper JSON comma placement:
- Add comma after last existing entry
- No trailing comma on new last entry

## Validation Steps

After each modification:

1. **JSON Validity**
   - No syntax errors
   - Proper bracket/brace matching
   - No trailing commas

2. **Schema Compliance**
   - version: 3 maintained
   - $schema field preserved
   - Required root properties present

3. **Structure Integrity**
   - settings object intact
   - All arrays properly formatted
   - String values quoted
   - Number/boolean values unquoted

## Documentation

Summarize changes made:

```
SECTION: settings.color.palette
ACTION: Added 1 color definition
VALUES: service-accent (#3B82F6)
RATIONALE: Services page needs distinct accent color

SECTION: settings.typography.fontFamilies
ACTION: Added 1 font family
VALUES: display ('Playfair Display', serif)
RATIONALE: Hero sections need decorative heading font
```

## Final Output

- Updated theme.json with all changes applied
- Change summary for audit trail
- No handoff produced (terminal agent)
