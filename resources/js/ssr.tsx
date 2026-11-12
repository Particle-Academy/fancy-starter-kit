import { createFancyServer } from '@particle-academy/fancy-inertia/server';
import { Toast } from '@particle-academy/react-fancy';
import type { ComponentType, ReactNode } from 'react';

/**
 * Server-side rendering entry. It renders each page inside the SAME Fancy
 * provider tree as the client entry (resources/js/app.tsx) so the markup
 * hydrates cleanly — keep this `providers` tree identical to app.tsx's.
 *
 * Build it with `npm run build` (which runs `vite build --ssr`), then run the
 * SSR daemon with `php artisan inertia:start-ssr`. SSR is OFF by default — set
 * `INERTIA_SSR_ENABLED=true` in `.env` to use it.
 */
const providers = (outlet: ReactNode): ReactNode => (
    <Toast.Provider position="bottom-right">{outlet}</Toast.Provider>
);

/**
 * The port to listen on, read from INERTIA_SSR_URL: the same URL Laravel sends
 * its render requests to (config/inertia.php), so the two cannot disagree.
 * `php artisan inertia:start-ssr` passes the app's environment, .env included,
 * to this process. Change the port in INERTIA_SSR_URL to run two apps' SSR on
 * one machine.
 */
const DEFAULT_SSR_URL = 'http://127.0.0.1:13714';

// This file runs in Node. Declared here, rather than adding Node's types to
// tsconfig, so `process` does not type-check in browser code.
declare const process: { env: Record<string, string | undefined> };

function ssrPort(): number {
    const raw = process.env.INERTIA_SSR_URL || DEFAULT_SSR_URL;
    let url: URL;
    try {
        url = new URL(raw);
    } catch {
        throw new Error(`INERTIA_SSR_URL is not a valid URL: "${raw}"`);
    }
    if (url.port !== '') {
        return Number(url.port);
    }
    return url.protocol === 'https:' ? 443 : 80;
}

createFancyServer({
    resolve: (name) => {
        const pages = import.meta.glob<{ default: ComponentType }>('./Pages/**/*.tsx', {
            eager: true,
        });
        return pages[`./Pages/${name}.tsx`];
    },
    providers,
    appRoot: false,
    port: ssrPort(),
});
