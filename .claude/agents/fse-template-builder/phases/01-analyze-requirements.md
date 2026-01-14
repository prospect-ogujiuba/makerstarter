# Phase 1: Analyze Requirements

Parse the incoming requirements handoff and determine template structure.

## Input Processing

Extract from requirements_handoff.yaml:
- **template_name**: Determines filename and template type
- **purpose**: Guides block selection and layout structure
- **sections**: Required page sections to compose
- **makerblocks**: Specific blocks to include
- **custom_attributes**: Override default block attributes

## Template Type Determination

Map template_name to WordPress FSE hierarchy:
| Pattern | Template Type | Use Case |
|---------|---------------|----------|
| front-page.html | Home | Site homepage |
| page.html | Default | Standard pages |
| page-{slug}.html | Custom | Specific page (e.g., page-services.html) |
| single.html | Single post | Blog posts |
| search.html | Search | Search results page |
| 404.html | Error | Not found page |
| index.html | Fallback | Last resort |

## Section Mapping

Map sections to block categories:
- **header** → makerblocks/header (required)
- **hero** → makerblocks/hero, page-header, contact-hero, company-hero
- **content** → services, team-showcase, pricing-tiers, resources-page
- **cta** → cta-section, benefits-section
- **footer** → makerblocks/footer (required)

## Block Verification

Before proceeding, verify all requested blocks exist:
1. Check against block catalog (33 available blocks)
2. Flag any unknown blocks as errors
3. Note blocks requiring special attributes

## Output

Structured analysis for Phase 2:
- Template type and filename
- Ordered list of blocks to include
- Attribute requirements per block
- Layout structure needed (simple vs grid)
