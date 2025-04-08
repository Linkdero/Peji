<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark'=> ($appearance ?? 'system') == 'dark'])>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('appAdmin.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- 1️⃣ Vendor CSS (plugins externos) -->
    <link href="{{ asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!-- 2️⃣ Global CSS Bundle (Obligatorio para todas las páginas) -->
    <link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!-- Define la URL base para los assets -->

    @routes
    @vite([
    'resources/js/app.ts',
    ])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
    <script>
        var hostUrl = "{{ asset('admin/assets/') }}/";

        document.addEventListener('DOMContentLoaded', function() {
            // 1️⃣ Global JS Bundle
            loadScript("{{ asset('admin/assets/plugins/global/plugins.bundle.js') }}");
            loadScript("{{ asset('admin/assets/js/scripts.bundle.js') }}", function() {
                // 2️⃣ Vendors JS (dependientes de los globales)
                loadScript("{{ asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}");
                loadScript("https://cdn.amcharts.com/lib/5/index.js", function() {
                    loadScript("https://cdn.amcharts.com/lib/5/xy.js");
                    loadScript("https://cdn.amcharts.com/lib/5/percent.js");
                    loadScript("https://cdn.amcharts.com/lib/5/radar.js");
                    loadScript("https://cdn.amcharts.com/lib/5/themes/Animated.js");
                    loadScript("https://cdn.amcharts.com/lib/5/map.js");
                    loadScript("https://cdn.amcharts.com/lib/5/geodata/worldLow.js");
                    loadScript("https://cdn.amcharts.com/lib/5/geodata/continentsLow.js");
                    loadScript("https://cdn.amcharts.com/lib/5/geodata/usaLow.js");
                    loadScript("https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js");
                    loadScript("https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js");
                });
                loadScript("{{ asset('admin/assets/plugins/custom/datatables/datatables.bundle.js') }}");

                // 3️⃣ Custom JS (dependientes de los anteriores)
                loadScript("{{ asset('admin/assets/js/widgets.bundle.js') }}", function() {
                    loadScript("{{ asset('admin/assets/js/custom/widgets.js') }}");
                    loadScript("{{ asset('admin/assets/js/custom/apps/chat/chat.js') }}");
                    loadScript("{{ asset('admin/assets/js/custom/utilities/modals/upgrade-plan.js') }}");
                    loadScript("{{ asset('admin/assets/js/custom/utilities/modals/create-app.js') }}");
                    loadScript("{{ asset('admin/assets/js/custom/utilities/modals/new-target.js') }}");
                    loadScript("{{ asset('admin/assets/js/custom/utilities/modals/users-search.js') }}");
                });
            });
        });

        function loadScript(src, callback) {
            var script = document.createElement('script');
            script.src = src;
            script.async = false; // Para mantener el orden de ejecución
            if (callback) {
                script.onload = callback;
            }
            document.body.appendChild(script);
        }
    </script>
</body>

</html>