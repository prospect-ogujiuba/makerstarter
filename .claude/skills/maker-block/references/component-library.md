<toc>
- #grid-components
- #card-components
- #filter-components
- #pagination-components
- #loading-components
- #error-components
</toc>

<!-- Discovery hints:
     - react-component-dev loads sections based on architecture_handoff.ui_features
     - ui_features contains 'grid' triggers: #grid-components, #card-components
     - ui_features contains 'filters' triggers: #filter-components
     - ui_features contains 'pagination' triggers: #pagination-components
     - ui_features contains 'loading_states' triggers: #loading-components, #error-components
     - all blocks get: #loading-components (base requirement)
-->

<overview>
Shared React components available in MakerBlocks for consistent UI patterns.
</overview>

<section id="import-paths">
## Import Paths

All shared components located in `src/components/`:

```jsx
import { Button } from '../../components/Button';
import { Badge } from '../../components/Badge';
import { Card } from '../../components/Card';
import { IconPicker } from '../../components/IconPicker';
import { SkeletonLoader } from '../../components/SkeletonLoader';
import { Spinner } from '../../components/Spinner';
import { ErrorMessage } from '../../components/ErrorMessage';
import { EmptyState } from '../../components/EmptyState';
```
</section>

<!-- react-component-dev loads this for interactive elements -->
<section id="button-component">
## Button

Interactive button with variants and states.

```jsx
import { Button } from '../../components/Button';

// Variants
<Button variant="primary">Primary</Button>
<Button variant="secondary">Secondary</Button>
<Button variant="outline">Outline</Button>
<Button variant="ghost">Ghost</Button>
<Button variant="danger">Danger</Button>

// Sizes
<Button size="sm">Small</Button>
<Button size="md">Medium (default)</Button>
<Button size="lg">Large</Button>

// States
<Button disabled>Disabled</Button>
<Button loading>Loading...</Button>

// With icon
<Button icon={<PlusIcon />}>Add Item</Button>

// Full width
<Button fullWidth>Full Width</Button>

// As link
<Button as="a" href="/path">Link Button</Button>
```

**Props:**
| Prop | Type | Default | Description |
|------|------|---------|-------------|
| variant | string | 'primary' | Button style variant |
| size | string | 'md' | Button size |
| disabled | boolean | false | Disable interactions |
| loading | boolean | false | Show loading spinner |
| icon | ReactNode | null | Icon element |
| fullWidth | boolean | false | Full container width |
| onClick | function | - | Click handler |
</section>

<!-- react-component-dev loads this for status display -->
<section id="badge-component">
## Badge

Status indicators and labels.

```jsx
import { Badge } from '../../components/Badge';

// Variants
<Badge variant="default">Default</Badge>
<Badge variant="success">Active</Badge>
<Badge variant="warning">Pending</Badge>
<Badge variant="danger">Inactive</Badge>
<Badge variant="info">New</Badge>

// Sizes
<Badge size="sm">Small</Badge>
<Badge size="md">Medium</Badge>

// With dot indicator
<Badge dot variant="success">Online</Badge>

// Pill style
<Badge pill>Rounded</Badge>
```

**Props:**
| Prop | Type | Default | Description |
|------|------|---------|-------------|
| variant | string | 'default' | Color variant |
| size | string | 'md' | Badge size |
| dot | boolean | false | Show status dot |
| pill | boolean | false | Fully rounded |
</section>

<!-- react-component-dev loads this when ui_features contains 'grid' or 'cards' -->
<section id="card-components">
## Card

Container for grouped content.

```jsx
import { Card } from '../../components/Card';

<Card>
    <Card.Header>
        <Card.Title>Card Title</Card.Title>
        <Card.Actions>
            <Button size="sm">Action</Button>
        </Card.Actions>
    </Card.Header>
    <Card.Body>
        Content goes here
    </Card.Body>
    <Card.Footer>
        Footer content
    </Card.Footer>
</Card>

// Variants
<Card variant="elevated">Elevated shadow</Card>
<Card variant="outlined">Border only</Card>
<Card variant="filled">Background fill</Card>

// Interactive
<Card hoverable onClick={handleClick}>
    Clickable card
</Card>
```

**Props:**
| Prop | Type | Default | Description |
|------|------|---------|-------------|
| variant | string | 'elevated' | Card style |
| hoverable | boolean | false | Hover effect |
| padding | string | 'md' | Internal padding |
</section>

<!-- react-component-dev loads this when ui_features contains 'grid' -->
<section id="grid-components">
## Grid Layout

Grid container for card layouts.

```jsx
// CSS Grid wrapper
<div className="makerblocks-grid" data-columns={columns}>
    {items.map(item => (
        <Card key={item.id}>...</Card>
    ))}
</div>

// Responsive grid classes
// .makerblocks-grid[data-columns="2"] - 2 column grid
// .makerblocks-grid[data-columns="3"] - 3 column grid
// .makerblocks-grid[data-columns="4"] - 4 column grid

// Grid with gap control
<div
    className="makerblocks-grid"
    style={{ gap: '1.5rem' }}
    data-columns={3}
>
    {items.map(item => <ItemCard key={item.id} {...item} />)}
</div>
```
</section>

<!-- react-component-dev loads this when ui_features contains 'loading_states' -->
<section id="loading-components">
## SkeletonLoader

Loading placeholder that mimics content shape.

```jsx
import { SkeletonLoader } from '../../components/SkeletonLoader';

// Basic shapes
<SkeletonLoader type="text" />
<SkeletonLoader type="title" />
<SkeletonLoader type="avatar" />
<SkeletonLoader type="thumbnail" />
<SkeletonLoader type="button" />

// Multiple lines
<SkeletonLoader type="text" lines={3} />

// Custom dimensions
<SkeletonLoader width={200} height={100} />

// Card skeleton
<SkeletonLoader type="card" />

// Grid of skeletons
<SkeletonLoader type="grid" count={6} columns={3} />
```

**Props:**
| Prop | Type | Default | Description |
|------|------|---------|-------------|
| type | string | 'text' | Skeleton shape type |
| lines | number | 1 | Number of text lines |
| width | number/string | '100%' | Custom width |
| height | number/string | 'auto' | Custom height |
| count | number | 1 | Number of items |
| columns | number | 1 | Grid columns |

## Spinner

Loading indicator.

```jsx
import { Spinner } from '../../components/Spinner';

// Sizes
<Spinner size="sm" />
<Spinner size="md" />
<Spinner size="lg" />

// Colors
<Spinner color="primary" />
<Spinner color="white" />

// With label
<Spinner label="Loading..." />

// Centered
<Spinner centered />
```

**Props:**
| Prop | Type | Default | Description |
|------|------|---------|-------------|
| size | string | 'md' | Spinner size |
| color | string | 'primary' | Spinner color |
| label | string | null | Accessible label |
| centered | boolean | false | Center in container |
</section>

<!-- react-component-dev loads this when ui_features contains 'loading_states' -->
<section id="error-components">
## ErrorMessage

Error display with optional retry.

```jsx
import { ErrorMessage } from '../../components/ErrorMessage';

// Basic error
<ErrorMessage message="Something went wrong" />

// With retry
<ErrorMessage
    message="Failed to load data"
    onRetry={handleRetry}
/>

// With details
<ErrorMessage
    message="Request failed"
    details="Server returned 500 error"
/>

// Variants
<ErrorMessage variant="inline" message="Error" />
<ErrorMessage variant="banner" message="Error" />
<ErrorMessage variant="toast" message="Error" />
```

**Props:**
| Prop | Type | Default | Description |
|------|------|---------|-------------|
| message | string | required | Error message |
| details | string | null | Additional details |
| onRetry | function | null | Retry callback |
| variant | string | 'inline' | Display style |

## EmptyState

Placeholder for empty data states.

```jsx
import { EmptyState } from '../../components/EmptyState';

// Basic empty
<EmptyState
    title="No items found"
    description="Try adjusting your filters"
/>

// With action
<EmptyState
    title="No services yet"
    description="Create your first service"
    action={<Button>Create Service</Button>}
/>

// With icon
<EmptyState
    icon={<SearchIcon />}
    title="No results"
/>
```

**Props:**
| Prop | Type | Default | Description |
|------|------|---------|-------------|
| title | string | required | Main heading |
| description | string | null | Supporting text |
| icon | ReactNode | null | Optional icon |
| action | ReactNode | null | Action button |
</section>

<!-- react-component-dev loads this when ui_features contains 'filters' -->
<section id="filter-components">
## Filter UI Components

Filter bar and controls for data filtering.

```jsx
// Filter bar wrapper
<div className="makerblocks-filter-bar">
    <SearchInput
        value={search}
        onChange={setSearch}
        placeholder="Search..."
    />
    <SelectFilter
        value={category}
        onChange={setCategory}
        options={categoryOptions}
        placeholder="All Categories"
    />
    <ToggleFilter
        checked={activeOnly}
        onChange={setActiveOnly}
        label="Active Only"
    />
</div>

// Search input component
const SearchInput = ({ value, onChange, placeholder }) => (
    <input
        type="search"
        className="makerblocks-search"
        value={value}
        onChange={(e) => onChange(e.target.value)}
        placeholder={placeholder}
    />
);

// Select filter component
const SelectFilter = ({ value, onChange, options, placeholder }) => (
    <select
        className="makerblocks-select"
        value={value || ''}
        onChange={(e) => onChange(e.target.value || null)}
    >
        <option value="">{placeholder}</option>
        {options.map(opt => (
            <option key={opt.value} value={opt.value}>
                {opt.label}
            </option>
        ))}
    </select>
);
```
</section>

<!-- react-component-dev loads this when ui_features contains 'pagination' -->
<section id="pagination-components">
## Pagination

Pagination controls for paged data.

```jsx
// Simple pagination
const Pagination = ({ page, totalPages, onPageChange }) => (
    <div className="makerblocks-pagination">
        <Button
            variant="outline"
            size="sm"
            disabled={page <= 1}
            onClick={() => onPageChange(page - 1)}
        >
            Previous
        </Button>
        <span className="page-info">
            Page {page} of {totalPages}
        </span>
        <Button
            variant="outline"
            size="sm"
            disabled={page >= totalPages}
            onClick={() => onPageChange(page + 1)}
        >
            Next
        </Button>
    </div>
);

// Usage
<Pagination
    page={currentPage}
    totalPages={totalPages}
    onPageChange={handlePageChange}
/>
```

### Load More Pattern
```jsx
const LoadMore = ({ hasMore, loading, onLoadMore }) => {
    if (!hasMore) return null;

    return (
        <div className="makerblocks-load-more">
            <Button
                variant="outline"
                loading={loading}
                onClick={onLoadMore}
            >
                Load More
            </Button>
        </div>
    );
};
```
</section>

<section id="icon-picker">
## IconPicker

Icon selection component for editor controls.

```jsx
import { IconPicker } from '../../components/IconPicker';

<IconPicker
    value={selectedIcon}
    onChange={(icon) => setAttributes({ icon })}
    icons={['star', 'heart', 'check', 'arrow-right']}
/>
```

**Props:**
| Prop | Type | Default | Description |
|------|------|---------|-------------|
| value | string | null | Selected icon name |
| onChange | function | required | Selection callback |
| icons | array | allIcons | Available icons |
</section>

<section id="usage-example">
## Complete Usage Example

```jsx
import React, { useState, useEffect } from 'react';
import { Card } from '../../components/Card';
import { Button } from '../../components/Button';
import { Badge } from '../../components/Badge';
import { SkeletonLoader } from '../../components/SkeletonLoader';
import { ErrorMessage } from '../../components/ErrorMessage';
import { EmptyState } from '../../components/EmptyState';

export function ServiceGrid({ endpoint, nonce, attributes }) {
    const [services, setServices] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        fetchServices();
    }, []);

    const fetchServices = async () => {
        try {
            setLoading(true);
            const res = await fetch(endpoint, {
                headers: { 'X-WP-Nonce': nonce }
            });
            const data = await res.json();
            setServices(data.data || []);
        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };

    if (loading) {
        return <SkeletonLoader type="grid" count={6} columns={3} />;
    }

    if (error) {
        return <ErrorMessage message={error} onRetry={fetchServices} />;
    }

    if (!services.length) {
        return (
            <EmptyState
                title="No services available"
                description="Check back later for new services"
            />
        );
    }

    return (
        <div className="service-grid">
            {services.map(service => (
                <Card key={service.id} hoverable>
                    <Card.Body>
                        <h3>{service.name}</h3>
                        <Badge variant={service.is_active ? 'success' : 'default'}>
                            {service.is_active ? 'Active' : 'Inactive'}
                        </Badge>
                        <p>{service.description}</p>
                    </Card.Body>
                    <Card.Footer>
                        <Button variant="outline" size="sm">
                            Learn More
                        </Button>
                    </Card.Footer>
                </Card>
            ))}
        </div>
    );
}
```
</section>
