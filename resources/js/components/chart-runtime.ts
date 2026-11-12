import { EChart, registerAll, registerBuiltinThemes } from '@particle-academy/fancy-echarts';

/*
 * The chart runtime: fancy-echarts plus its registration. Only <Chart>
 * (./Chart.tsx) imports this, and only through a dynamic import(), so echarts is
 * a chunk of its own that the browser downloads the first time a page mounts a
 * chart. Pages without one never pay for it, and the server never loads it.
 *
 * fancy-echarts registers chart types explicitly; an <EChart> whose type was
 * never registered cannot render. The kit mounts with `appRoot: false`, which
 * skips the registration FancyAppRoot would do, so it happens here, once, when
 * this module is first evaluated.
 *
 * registerAll() puts every chart type in this chunk. If your app uses only a
 * few types, replace it with registerCharts(...) and registerComponents(...);
 * see the fancy-echarts README for what else a chart needs registered.
 */
registerAll();
registerBuiltinThemes();

export default EChart;
