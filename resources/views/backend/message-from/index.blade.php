@extends('backend.layouts.app')

@section('title')
    Founder and Principal
@endsection

@section('headerWithButton')
    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2 md:gap-3 lg:gap-4">
        <!-- Title -->
        <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>
    </div>
@endsection

@section('content')
    <div class="grid grid-col-1 md:grid-cols-3 gap-4">
        @foreach ($messages as $message)
            @php
                $informationEn = json_decode($message->information_en);
                $informationNp = json_decode($message->information_np);
            @endphp

            <div class="rounded overflow-hidden shadow-2xl text-center p-4">
                <img class="mx-auto  w-full w-[200px] h-[200px]" src="{{ $message->image ? asset($message->image) : asset('images/avatar.jpg') }}"
                    alt="{{ $informationEn->name }}">

                <div class="font-bold text-xl mb-2 pt-2">{{ $informationEn->name }}</div>

                <div>
                    <a href="{{ route('message-from.edit', $message->slug) }}"
                        class="p-2 rounded-md shadow-sm font-semibold text-green-600
                                border border-green-600
                                hover:bg-green-600 hover:text-white
                                focus:outline-none focus:ring-2 focus:ring-green-500"
                        title="Edit"><i class="fa fa-edit"></i>&nbsp;Edit</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
