# Pattern: Layout Patterns

HTML layout structures for FSE templates.

## Simple Stack (No Wrapper)

Blocks stack vertically without HTML:
```html
<!-- wp:makerblocks/block-1 /-->
<!-- wp:makerblocks/block-2 /-->
<!-- wp:makerblocks/block-3 /-->
```

## Main Wrapper

Single container for content:
```html
<main class="py-12 bg-gray-50">
  <!-- wp:makerblocks/content-block /-->
</main>
```

## Two-Column Grid

Sidebar layout:
```html
<main class="py-12">
  <div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <div class="lg:col-span-2">
        <!-- wp:makerblocks/main-content /-->
      </div>
      <div class="lg:col-span-1">
        <!-- wp:makerblocks/sidebar-content /-->
      </div>
    </div>
  </div>
</main>
```

## Sticky Sidebar

Sidebar that follows scroll:
```html
<div class="lg:col-span-1">
  <div class="sticky top-4 space-y-8">
    <!-- wp:makerblocks/sidebar-block-1 /-->
    <!-- wp:makerblocks/sidebar-block-2 /-->
  </div>
</div>
```

## Section Container

Centered content section:
```html
<section class="py-16">
  <div class="max-w-7xl mx-auto px-4">
    <!-- wp:makerblocks/section-content /-->
  </div>
</section>
```

## Use Guidelines

- Use simple stack when blocks handle their own layout
- Add wrapper only for multi-column or complex layouts
- Prefer Tailwind utility classes
- Keep HTML minimal, let blocks do heavy lifting
