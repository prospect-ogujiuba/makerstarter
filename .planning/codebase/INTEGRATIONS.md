# External Integrations

**Analysis Date:** 2026-01-06

## APIs & External Services

**No External Services Detected**
- No payment processing (Stripe, PayPal, etc.)
- No email services (SendGrid, Mailgun, etc.)
- No analytics (Google Analytics, Mixpanel, etc.)
- No third-party APIs

## Data Storage

**Databases:**
- WordPress native database - via wp_* functions
  - Connection: WordPress wp-config.php
  - Client: WordPress core wpdb class
  - Migrations: None (theme-level, no migrations)

**File Storage:**
- WordPress media library - native upload handling
  - Location: wp-content/uploads/
  - Access: WordPress media functions

**Caching:**
- WordPress transients - WordPress native
  - No external caching services (Redis, Memcached)

## Authentication & Identity

**Auth Provider:**
- WordPress core authentication - native user system
  - Implementation: WordPress login, sessions, cookies
  - Token storage: WordPress native (cookies, nonces)

**OAuth Integrations:**
- None detected

## Monitoring & Observability

**Error Tracking:**
- None (relies on WordPress debug mode)

**Analytics:**
- None

**Logs:**
- PHP error_log - standard PHP error logging
  - No structured logging framework

## CI/CD & Deployment

**Hosting:**
- Standard WordPress hosting - any provider
  - Deployment: Manual FTP/SFTP or git-based
  - Environment vars: None (theme has no env configuration)

**CI Pipeline:**
- None configured
  - No GitHub Actions, Jenkins, or similar
  - Build step must be run locally before deployment

## Environment Configuration

**Development:**
- Required: WordPress 6.2+, PHP 7.4+, Node.js for builds
- No .env files - theme has no environment-specific configuration
- BrowserSync preview: hardcoded to local.test domain - `package.json`

**Staging:**
- Not applicable (no environment-specific behavior)

**Production:**
- No secrets management (theme doesn't use external services)
- Configuration: WordPress settings and theme.json only

## Webhooks & Callbacks

**Incoming:**
- WordPress hooks only (after_setup_theme, wp_enqueue_scripts, etc.) - `inc/*.php`
  - No REST API endpoints registered
  - No custom webhooks

**Outgoing:**
- None

## WordPress-Specific Integration

**WordPress REST API:**
- Carbon Fields uses WordPress REST API when enabled - `vendor/htmlburger/carbon-fields/`
  - Endpoint: fetch_association_options via wp_ajax

**Plugin Dependencies:**
- TGM Plugin Activation framework integrated - `class-tgm-plugin-activation.php`
  - Currently no required plugins configured - `inc/required_plugins.php` (empty array)
  - Designed to require makerblocks plugin

**Carbon Fields (Optional, Disabled):**
- Carbon Fields 3.6+ - `composer.json`
  - Currently not loaded - `functions.php` (line 10 commented)
  - Would provide theme options and custom fields
  - Integration hook: carbon_fields_register_fields

---

*Integration audit: 2026-01-06*
*Update when adding/removing external services*
