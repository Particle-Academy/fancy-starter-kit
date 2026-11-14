/**
 * The document title, shared by the client entry (app.tsx) and the SSR entry
 * (ssr.tsx) so the first byte's `<title>` is the one the browser shows. A page
 * that sets no title gets the app name.
 */
const appName = import.meta.env.VITE_APP_NAME ?? 'Fancy';

export const pageTitle = (title: string): string => (title ? `${title} — ${appName}` : appName);
