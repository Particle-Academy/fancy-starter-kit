<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Apply the saved/system theme before first paint to avoid a flash. --}}
    <script>
        (function () {
            try {
                var t = localStorage.getItem('fancy.theme');
                // Only 'light'/'dark' count as a choice; anything else means
                // follow the system, which is what initTheme() decides a moment
                // later. If the two disagree the page paints twice.
                var dark = (t === 'light' || t === 'dark')
                    ? t === 'dark'
                    : window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (dark) document.documentElement.classList.add('dark');
            } catch (e) { /* noop */ }
        })();
    </script>

    {{-- Self-hosted Instrument Sans (vite.config.js `fonts`): preloads + @font-face. --}}
    @fonts
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
    {{--
        The server-rendered head when SSR answers, which carries the page's own
        <title>; the app name as the title when it does not. Never both: two
        <title> elements is an invalid document, and a crawler reads the first.
    --}}
    <x-inertia::head>
        <title>{{ config('app.name', 'Fancy') }}</title>
    </x-inertia::head>
</head>
<body class="min-h-screen bg-white text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">
    @inertia
</body>
</html>
