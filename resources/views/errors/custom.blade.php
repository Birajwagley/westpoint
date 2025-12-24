<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GBBS :: @yield('title')</title>

    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .footer-image img {
            transform: translateZ(0);
            /* helps fix clipping in some browsers */
        }
    </style>

    @yield('styles')
</head>

<body>
    @yield('code')

    <!-- Footer Image -->
    <div class="fixed bottom-0 left-0 right-0 w-full z-0 footer-image h-[20vh] md:h-fit">
        <img src="{{ asset('assets/frontend/images/homepage/area.png') }}" alt="School Building"
            class="w-full h-full object-cover object-bottom">
    </div>

</body>

</html>
