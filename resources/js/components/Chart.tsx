import type { EChartComponentProps } from '@particle-academy/fancy-echarts';
import { lazy, Suspense, useEffect, useState, type CSSProperties } from 'react';

/*
 * A fancy-echarts chart, loaded on demand. Use it instead of importing <EChart>
 * directly: a value import of '@particle-academy/fancy-echarts' anywhere in a
 * page puts all of echarts back into the bundle that page loads.
 *
 * - The server, and the browser's first (hydrating) render, show a placeholder
 *   of the same size, so the markup matches and the layout does not jump.
 * - After mount, the chart runtime (echarts + its registration) is fetched as a
 *   separate chunk, once, and the chart replaces the placeholder.
 *
 * The `import type` above is erased at build time and costs nothing.
 */
const LazyEChart = lazy(() => import('./chart-runtime'));

export type ChartProps = EChartComponentProps & {
    /** Height in px. A chart needs one: its canvas has no intrinsic size. */
    height?: number;
};

export function Chart({ height = 300, style, className, ...props }: ChartProps) {
    const [mounted, setMounted] = useState(false);
    useEffect(() => setMounted(true), []);

    const sized: CSSProperties = { height, ...style };
    const placeholder = (
        <div
            data-chart-placeholder=""
            aria-hidden="true"
            className={['animate-pulse rounded-lg bg-zinc-100 dark:bg-zinc-800', className].filter(Boolean).join(' ')}
            style={sized}
        />
    );

    if (!mounted) {
        return placeholder;
    }

    return (
        <Suspense fallback={placeholder}>
            <LazyEChart {...props} className={className} style={sized} />
        </Suspense>
    );
}
