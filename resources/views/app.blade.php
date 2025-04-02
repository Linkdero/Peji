<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark'=> ($appearance ?? 'system') == 'dark'])>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Inline script to detect system dark mode preference and apply it immediately --}}
    <script>
        (function() {
            const appearance = '{{ $appearance ?? "system" }}';

            if (appearance === 'system') {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (prefersDark) {
                    document.documentElement.classList.add('dark');
                }
            }
        })();
    </script>

    {{-- Inline style to set the HTML background color based on our theme in app.css --}}
    <style>
        html {
            background-color: oklch(1 0 0);
        }

        html.dark {
            background-color: oklch(0.145 0 0);
        }
    </style>

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @routes
    @vite([ 'resources/css/bootstrap.min.css',
    'resources/css/bootstrap-icons.css',
    'resources/css/swiper-bundle.min.css',
    'resources/css/glightbox.min.css',
    'resources/css/main.css',
    'resources/js/app.ts',
    'resources/js/assets/bootstrap.bundle.min.js',
    'resources/js/assets/validate.js',
    'resources/js/assets/swiper-bundle.min.js',
    'resources/js/assets/purecounter_vanilla.js',
    'resources/js/assets/glightbox.min.js',
    'resources/js/assets/main.js',
    ])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>