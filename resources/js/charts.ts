import { registerAll, registerBuiltinThemes } from '@particle-academy/fancy-echarts';

/*
 * Chart registration, imported for its side effect by BOTH entries (app.tsx and
 * ssr.tsx) so a chart renders the same on the server and in the browser.
 *
 * fancy-echarts registers chart types explicitly, and an <EChart> whose type was
 * never registered cannot render. FancyAppRoot would do this for you, but the
 * kit mounts with `appRoot: false`, so it happens here instead, before the first
 * page module is evaluated.
 *
 * This puts every chart type in the client bundle. If your app has no charts,
 * delete this file and its two imports. If it uses only a few types, replace
 * registerAll() with registerCharts(...) and registerComponents(...); see the
 * fancy-echarts README for what else a chart needs registered.
 */
registerAll();
registerBuiltinThemes();
