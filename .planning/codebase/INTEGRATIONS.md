# External Integrations

**Analysis Date:** 2026-01-19

## APIs & External Services

**WordPress Core:**
- WordPress Block Editor API - Template rendering
- WordPress REST API - Implicit via FSE
- WordPress Hooks API - Theme setup, asset enqueueing

**No external third-party APIs detected.**

## Data Storage

**Databases:**
- WordPress/MySQL - Managed by WordPress core
  - Connection: via `wp-config.php` (outside theme)
  - Client: WordPress `$wpdb`

**File Storage:**
- WordPress Media Library (core)
- Theme assets in `assets/` directory

**Caching:**
- None theme-specific (relies on WordPress/server caching)

## Authentication & Identity

**Auth Provider:**
- WordPress native authentication
  - Implementation: Core WordPress user system
  - No custom auth integrations

## Monitoring & Observability

**Error Tracking:**
- None (relies on WordPress debug mode)

**Logs:**
- None theme-specific

## CI/CD & Deployment

**Hosting:**
- Not specified (standard WordPress hosting)

**CI Pipeline:**
- None detected

## Environment Configuration

**Required env vars:**
- None theme-specific
- WordPress handles all DB/site config via `wp-config.php`

**Secrets location:**
- Not applicable (no API keys required)

## Webhooks & Callbacks

**Incoming:**
- None

**Outgoing:**
- None

## Plugin Dependencies

**Required (via TGM Plugin Activation):**
- Currently empty (`$plugins = []` in `inc/required_plugins.php`)
- Infrastructure ready for requiring plugins

**Expected Companion Plugin:**
- `makerblocks` - Block library plugin (referenced in `templates/index.html` as `wp:makerblocks/app`)
  - Provides custom blocks for FSE templates
  - Required for templates to render correctly

## PHP Library Dependencies

**Composer (installed in `vendor/`):**
- htmlburger/carbon-fields v3.6.3 - Custom fields framework
  - Status: Installed but NOT loaded (commented out in `functions.php`)
  - Purpose: Post meta, options pages, term meta
  - Docs: http://carbonfields.net/docs/

## WordPress Theme Support

**Registered Features (`inc/maker_starter_setup.php`):**
- `automatic-feed-links`
- `title-tag`
- `post-thumbnails`
- `custom-logo`
- `html5` (search-form, comment-form, comment-list, gallery, caption, style, script)
- `post-formats` (aside, image, video, quote, link, gallery, status, audio, chat)

**Disabled:**
- `core-block-patterns` (removed)

**Nav Menus:**
- `primary` - Primary Menu
- `secondary` - Secondary Menu
- `mobile` - Mobile Menu

## Block Editor Integration

**theme.json Configuration:**
- Appearance tools enabled
- Full border controls
- Full color controls (custom, duotone, gradients, palette)
- Layout editing (content/wide sizes)
- Core image block lightbox enabled

---

*Integration audit: 2026-01-19*
