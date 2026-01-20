<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: true, sidebarCollapsed: false, sidebarHovered: false }" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WPHS | @yield('title')</title>

    @include('layouts.partials.styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-b from-neutral-300 to-neutral-100 h-screen flex flex-col text-sm text-white">
    <div class="flex flex-col lg:flex-row flex-1 min-h-0">
        @include('backend.layouts.partials.sidebar')

        <!-- Main content -->
        <main
            class="flex-1 overflow-y-auto bg-white/90 rounded-t-3xl lg:rounded-l-3xl p-4 sm:p-0 md:p-3 m-4 lg:m-4 text-gray-700 flex flex-col"
            role="main">
            @include('backend.layouts.partials.navbar')

            <!-- Content wrapper with flexible growth -->
            <div class="flex-1 flex flex-col">
                <div class="overflow-x-auto hide-scrollbar flex-1 p-2">
                    @yield('content')
                </div>

                @include('backend.layouts.partials.footer')
            </div>
        </main>
    </div>

    @include('layouts.partials.scripts')
    <script>
        $(document).on('click', '#formResetBtn', function(e) {
            e.preventDefault();
            $("#excelExportForm")[0].reset()
        });
    </script>
</body>

</html>
