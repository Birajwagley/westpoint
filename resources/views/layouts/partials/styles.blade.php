{{-- tailwind --}}
<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />

{{-- data tables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.10/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">

<!-- Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

{{-- select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link
    href="https://cdn.jsdelivr.net/gh/erimicel/select2-tailwindcss-theme@1.2.4/dist/select2-tailwindcss-theme-plain.min.css"
    rel="stylesheet">

{{-- fontawesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- icon picker --}}
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/fontawesome/iconpicker-1.5.0.css') }}">

{{-- Leapfrog date picker --}}
<link rel="stylesheet" href="https://unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.css"
    crossorigin="anonymous" />

{{-- poppins font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

{{-- Noto Sans Devanagari font --}}
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari&display=swap" rel="stylesheet">

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

{{-- treegrid --}}
<link rel="stylesheet" href="{{ asset('assets/backend/plugins/treegrid/jquery.treegrid.css') }}">

<style>
    body {
        font-family: 'Noto Sans Devanagari', 'Poppins', sans-serif;
    }

    .note-editable {
        font-family: 'Poppins', sans-serif !important;
        font-size: 16px;
        /* optional */
    }
</style>

@yield('styles')
@stack('styles')
