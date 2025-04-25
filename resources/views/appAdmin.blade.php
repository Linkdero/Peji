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

        // Bandera para indicar si los scripts ya fueron cargados
        window.adminScriptsLoaded = false;

        // Función para reinicializar los componentes de la interfaz de administrador
        window.reinitAdminUI = function() {
            console.log('Reinicializando componentes de Admin UI...');

            // Reinicializar KTApp (si existe)
            if (typeof KTApp !== 'undefined') {
                if (typeof KTApp.init === 'function') {
                    KTApp.init();
                }

                // Tooltips
                if (typeof KTApp.initBootstrapTooltips === 'function') {
                    KTApp.initBootstrapTooltips();
                }

                // Popovers
                if (typeof KTApp.initBootstrapPopovers === 'function') {
                    KTApp.initBootstrapPopovers();
                }
            }

            // Reinicializar DataTables
            if (typeof $.fn !== 'undefined' && typeof $.fn.dataTable !== 'undefined') {
                $('.datatable').each(function() {
                    if ($.fn.dataTable.isDataTable(this)) {
                        $(this).DataTable().destroy();
                    }
                    $(this).DataTable({
                        responsive: true
                    });
                });
            }

            // Reinicializar cualquier otro componente según sea necesario
            // Por ejemplo, Select2, DatePickers, etc.
            if (typeof $.fn.select2 !== 'undefined') {
                $('.select2').select2();
            }

            // Reinicializar dropdowns, sidebars u otros componentes de la UI
            document.querySelectorAll('[data-kt-menu]').forEach(function(element) {
                if (typeof KTMenu !== 'undefined') {
                    new KTMenu(element);
                }
            });
        };

        document.addEventListener('DOMContentLoaded', function() {
            // Si ya cargamos los scripts, solo reinicializamos los componentes
            if (window.adminScriptsLoaded) {
                window.reinitAdminUI();
                return;
            }

            // Marcamos que ya cargamos los scripts
            window.adminScriptsLoaded = true;

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

                    // Inicializar componentes después de cargar todos los scripts
                    window.reinitAdminUI();
                });
            });
        });

        function loadScript(src, callback) {
            // Evitar cargar el mismo script más de una vez
            if (document.querySelector('script[src="' + src + '"]')) {
                if (callback) callback();
                return;
            }

            var script = document.createElement('script');
            script.src = src;
            script.async = false; // Para mantener el orden de ejecución
            if (callback) {
                script.onload = callback;
            }
            document.body.appendChild(script);
        }

        // Escuchar el evento de navegación de Inertia
        document.addEventListener('inertia:finish', function() {
            // Usar setTimeout para asegurarnos de que se ejecute después de que el DOM se haya actualizado
            setTimeout(function() {
                if (window.reinitAdminUI) {
                    window.reinitAdminUI();
                }
            }, 0);
        });
    </script>
</body>

</html>