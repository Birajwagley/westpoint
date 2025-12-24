@extends('backend.layouts.app')

@php
    $informationEn = json_decode($messageFrom->information_en);
    $informationNp = json_decode($messageFrom->information_np);
@endphp

@section('title')
    Update {{ $informationEn->name }} Information
@endsection

@section('headerWithButton')
    <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
@endsection

@section('content')
    @include('backend.message-from.partials.form')
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select-multi-1, .select-multi-2').select2({
                theme: 'tailwindcss-3',
            });
        });

        $('.image').on('change', function() {
            fieldId = $(this).attr('id');
            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden'); // Hide the primary logo preview
                $('#current_' + fieldId + '_value').val(null); // Clear the current primary logo value
            }
        });
    </script>
@endsection
