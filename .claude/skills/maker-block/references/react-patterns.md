<toc>
- #hooks
- #fetch-patterns
- #state-management
- #loading-states
- #event-handlers
- #memoization
</toc>

<!-- Discovery hints:
     - react-component-dev agent loads sections based on architecture_handoff
     - architecture_handoff.data_source.dynamic=true triggers: #fetch-patterns, #loading-states
     - architecture_handoff.ui_features contains 'filters' triggers: #state-management, #event-handlers
     - all components need: #hooks (base patterns)
-->

<overview>
React 18 patterns for MakerBlocks frontend components.
</overview>

<section id="component-structure">
## Standard Component Structure

```jsx
import React, { useState, useEffect, useMemo, useCallback } from 'react';

export function BlockName({ endpoint, nonce, siteUrl, attributes }) {
    // State
    const [items, setItems] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);
    const [filters, setFilters] = useState({});

    // Destructure attributes
    const { showFilters, itemCount, title } = attributes;

    // Fetch data on mount
    useEffect(() => {
        fetchData();
    }, [filters]); // Re-fetch when filters change

    // Fetch function
    const fetchData = async () => {
        setLoading(true);
        setError(null);

        try {
            const params = new URLSearchParams({
                per_page: itemCount,
                ...filters
            });

            const response = await fetch(`${endpoint}?${params}`, {
                headers: {
                    'X-WP-Nonce': nonce,
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) throw new Error('Failed to fetch');

            const data = await response.json();
            setItems(data.data || data);
        } catch (err) {
            setError(err.message);
        } finally {
            setLoading(false);
        }
    };

    // Memoized computed values
    const filteredItems = useMemo(() => {
        return items.filter(/* filter logic */);
    }, [items, filters]);

    // Event handlers
    const handleFilterChange = useCallback((key, value) => {
        setFilters(prev => ({ ...prev, [key]: value }));
    }, []);

    // Render states
    if (loading) return <LoadingState />;
    if (error) return <ErrorState message={error} onRetry={fetchData} />;
    if (!items.length) return <EmptyState />;

    return (
        <div className="makerblocks-{block-name}">
            {showFilters && <FilterBar onChange={handleFilterChange} />}
            <div className="items-grid">
                {filteredItems.map(item => (
                    <ItemCard key={item.id} item={item} />
                ))}
            </div>
        </div>
    );
}
```
</section>

<!-- react-component-dev loads this when architecture_handoff.data_source.dynamic=true -->
<section id="fetch-patterns">
## Data Fetching Patterns

### Basic Fetch
```jsx
const fetchData = async () => {
    const response = await fetch(endpoint, {
        headers: {
            'X-WP-Nonce': nonce,
            'Accept': 'application/json'
        }
    });
    const data = await response.json();
    return data;
};
```

### With Query Parameters
```jsx
const fetchWithParams = async (params = {}) => {
    const queryString = new URLSearchParams({
        per_page: 20,
        page: 1,
        orderby: 'name',
        order: 'asc',
        ...params
    }).toString();

    const response = await fetch(`${endpoint}?${queryString}`, {
        headers: {
            'X-WP-Nonce': nonce,
            'Accept': 'application/json'
        }
    });

    return response.json();
};
```

### POST Request (Create/Update)
```jsx
const submitData = async (formData) => {
    const response = await fetch(endpoint, {
        method: 'POST',
        headers: {
            'X-WP-Nonce': nonce,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify(formData)
    });

    if (!response.ok) {
        const error = await response.json();
        throw new Error(error.message || 'Submit failed');
    }

    return response.json();
};
```

### With Error Handling
```jsx
const safeFetch = async () => {
    try {
        setLoading(true);
        setError(null);

        const response = await fetch(endpoint, {
            headers: { 'X-WP-Nonce': nonce }
        });

        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.message || `HTTP ${response.status}`);
        }

        const data = await response.json();
        setItems(data.data || []);

    } catch (err) {
        setError(err.message);
        console.error('Fetch error:', err);
    } finally {
        setLoading(false);
    }
};
```
</section>

<!-- react-component-dev loads this for filter/pagination components -->
<section id="state-management">
## State Management Patterns

### Loading/Error/Data Pattern
```jsx
const [data, setData] = useState(null);
const [loading, setLoading] = useState(true);
const [error, setError] = useState(null);

// Render based on state
if (loading) return <Spinner />;
if (error) return <Error message={error} />;
if (!data) return <Empty />;
return <DataDisplay data={data} />;
```

### Filter State
```jsx
const [filters, setFilters] = useState({
    search: '',
    category: null,
    status: 'active'
});

const updateFilter = (key, value) => {
    setFilters(prev => ({
        ...prev,
        [key]: value
    }));
};

// Effect re-fetches when filters change
useEffect(() => {
    fetchData(filters);
}, [filters]);
```

### Pagination State
```jsx
const [page, setPage] = useState(1);
const [totalPages, setTotalPages] = useState(1);
const [perPage] = useState(10);

const fetchPage = async (pageNum) => {
    const response = await fetch(`${endpoint}?page=${pageNum}&per_page=${perPage}`);
    const data = await response.json();

    setItems(data.data);
    setTotalPages(Math.ceil(data.total / perPage));
    setPage(pageNum);
};
```
</section>

<!-- react-component-dev loads this as base reference -->
<section id="hooks">
## React Hooks Quick Reference

### useState
```jsx
const [value, setValue] = useState(initialValue);
setValue(newValue);
setValue(prev => prev + 1); // Functional update
```

### useEffect
```jsx
// Run on mount
useEffect(() => { /* ... */ }, []);

// Run when deps change
useEffect(() => { /* ... */ }, [dep1, dep2]);

// Cleanup
useEffect(() => {
    const timer = setInterval(/* ... */);
    return () => clearInterval(timer);
}, []);
```

### useMemo
```jsx
// Expensive computation cached
const computed = useMemo(() => {
    return items.filter(/* ... */).map(/* ... */);
}, [items]);
```

### useCallback
```jsx
// Stable function reference
const handleClick = useCallback((id) => {
    setSelected(id);
}, []);
```

### useRef
```jsx
const inputRef = useRef(null);
// Access: inputRef.current
```
</section>

<!-- react-component-dev loads this when architecture_handoff.data_source.dynamic=true -->
<section id="loading-states">
## Loading State Patterns

### Basic Loading State
```jsx
if (loading) return <LoadingState />;
```

### Skeleton Loading
```jsx
if (loading) {
    return (
        <div className="skeleton-grid">
            {[...Array(6)].map((_, i) => (
                <SkeletonCard key={i} />
            ))}
        </div>
    );
}
```

### Loading with Data Refresh
```jsx
const [isRefreshing, setIsRefreshing] = useState(false);

const handleRefresh = async () => {
    setIsRefreshing(true);
    await fetchData();
    setIsRefreshing(false);
};

// Show overlay spinner during refresh, keep existing data visible
return (
    <div className={isRefreshing ? 'refreshing' : ''}>
        {items.map(item => <Card key={item.id} {...item} />)}
        {isRefreshing && <RefreshSpinner />}
    </div>
);
```
</section>

<!-- react-component-dev loads this for interactive components -->
<section id="event-handlers">
## Event Handler Patterns

### Conditional Rendering
```jsx
{showHeader && <Header />}
{items.length > 0 ? <List items={items} /> : <Empty />}
{error ? <Error /> : <Content />}
```

### List Rendering
```jsx
{items.map(item => (
    <Card key={item.id} {...item} />
))}
```

### Event Handling
```jsx
<button onClick={() => handleAction(item.id)}>
    Action
</button>

<input
    value={search}
    onChange={(e) => setSearch(e.target.value)}
/>
```

### Form Submission
```jsx
const handleSubmit = async (e) => {
    e.preventDefault();
    setSubmitting(true);

    try {
        await submitData(formData);
        onSuccess();
    } catch (err) {
        setError(err.message);
    } finally {
        setSubmitting(false);
    }
};
```
</section>

<!-- react-component-dev loads this for performance optimization -->
<section id="memoization">
## Memoization Patterns

### useMemo for Computed Values
```jsx
const filteredItems = useMemo(() => {
    return items
        .filter(item => item.status === 'active')
        .sort((a, b) => a.name.localeCompare(b.name));
}, [items]);
```

### useCallback for Stable Handlers
```jsx
const handleItemClick = useCallback((itemId) => {
    setSelectedId(itemId);
    onSelect?.(itemId);
}, [onSelect]);

const handleFilterChange = useCallback((filterKey, value) => {
    setFilters(prev => ({
        ...prev,
        [filterKey]: value
    }));
}, []);
```

### React.memo for Component Optimization
```jsx
const ItemCard = React.memo(function ItemCard({ item, onClick }) {
    return (
        <div onClick={() => onClick(item.id)}>
            {item.name}
        </div>
    );
});
```

### When to Memoize
- Expensive calculations that don't need to run on every render
- Callbacks passed to child components that use React.memo
- Values used as dependencies in other hooks
</section>
