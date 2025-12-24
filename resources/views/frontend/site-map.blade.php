@extends('frontend.layouts.app')

@section('title', 'Site Map')

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.site_map'),
        'subHeading' => __('pages.site_map_description'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.site_map'),
            'route' => route('site-map'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Site Map Section --}}
    <section class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 py-16  space-y-20">
        <div>
            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($menus->where('parent_id', null) as $parent)
                    @php
                        $hasChildren = $menus->where('parent_id', $parent->id)->count() > 0;
                    @endphp

                    @if (!$hasChildren)
                        <div
                            class="group bg-white rounded-xl shadow-sm hover:bg-primary hover:shadow-md transition duration-300 flex items-center justify-center p-8">
                            <a href="{{ url($parent->slug) }}"
                                class="text-lg font-semibold text-primary group-hover:text-white text-center transition-colors duration-300">
                                {{ app()->getLocale() == 'en' ? $parent->name_en ?? '' : $parent->name_np ?? ($parent->name_en ?? '') }}
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($menus->where('parent_id', null) as $parent)
                    @php
                        $hasChildren = $menus->where('parent_id', $parent->id)->count() > 0;
                    @endphp

                    @if ($hasChildren)
                        <div
                            class="group bg-white rounded-2xl shadow-md hover:shadow-xl border border-gray-100 transition duration-300 p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-semibold text-green-700">
                                    <a href="{{ url($parent->slug) }}" class="hover:text-green-800 transition">
                                        {{ app()->getLocale() == 'en' ? $parent->name_en ?? '' : $parent->name_np ?? ($parent->name_en ?? '') }}
                                    </a>
                                </h3>
                                <span class="text-green-600 group-hover:rotate-90 transition duration-300">
                                    ➤
                                </span>
                            </div>

                            {{-- CHILDREN --}}
                            <ul class="space-y-2 ml-2 border-l-2 border-green-100 pl-4">
                                @foreach ($menus->where('parent_id', $parent->id) as $child)
                                    <li>
                                        <a href="{{ url($child->slug) }}"
                                            class="text-gray-700 hover:text-green-700 transition font-medium">
                                            •
                                            {{ app()->getLocale() == 'en' ? $child->name_en ?? '' : $child->name_np ?? ($child->name_en ?? '') }}
                                        </a>

                                        {{-- GRANDCHILDREN --}}
                                        @if ($menus->where('parent_id', $child->id)->count() > 0)
                                            <ul class="ml-4 mt-1 space-y-1 border-l border-gray-200 pl-3">
                                                @foreach ($menus->where('parent_id', $child->id) as $grandchild)
                                                    <li>
                                                        <a href="{{ url($grandchild->slug) }}"
                                                            class="text-sm text-gray-600 hover:text-green-600 transition">
                                                            →
                                                            {{ app()->getLocale() == 'en' ? $grandchild->name_en ?? '' : $grandchild->name_np ?? ($grandchild->name_en ?? '') }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>


    </section>
@endsection
