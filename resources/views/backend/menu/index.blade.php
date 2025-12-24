@extends('backend.layouts.app')

@section('title')
    Menus
@endsection

@section('headerWithButton')
    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-2 md:gap-3 lg:gap-4">
        <!-- Title -->
        <h2 class="text-lg font-semibold text-gray-900">@yield('title')</h2>

        <!-- Add Button -->
        <x-buttons.form-create-button route="{{ route('menu.create') }}" permission="menu" />
    </div>
@endsection

@php
    $trClass = 'px-3 py-2 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider';
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/treegrid/jquery.treegrid.css') }}">
@endpush

@section('content')
    <table id="menuTable" class="display table-auto" width="100%">
        <thead class="bg-gray-50">
            <tr class="{{ $trClass }}">
                <th class="w-16">S.N</th>
                <th>Parent</th>
                <th>Name</th>
                <th>Display Order</th>
                <th>Is Published?</th>
                <th>Is Featured Navigation?</th>
                <th class="w-20">Actions</th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            @php
                $parentCount = 0;
            @endphp

            @foreach ($menus as $parent)
                @php
                    $parentCount++;
                    $childParent = $parentCount;
                    $checked = $parent->is_published == true ? 'checked' : '';
                @endphp

                <tr class="treegrid-{{ $parentCount }} expanded">
                    <td>{{ $parentCount }}</td>
                    <td>-</td>
                    <td>{!! $parent->name !!}</td>
                    <td>{{ $parent->display_order }}</td>
                    <td>
                        <x-buttons.status-toggle-button dataId="{{ $parent->id }}" status="{{ $checked }}"
                            class="menu-is-published-toggle" />
                    </td>
                    <td>
                        {{ $parent->is_featured_navigation == true ? 'Yes' : 'No' }}
                    </td>
                    <td>
                        <div class="flex space-x-2">
                            <x-buttons.edit-button url="{{ route('menu.edit', $parent->id) }}" />
                            <x-buttons.delete-button url="{{ route('menu.destroy', $parent->id) }}" class="menu-delete" />
                        </div>
                    </td>
                </tr>

                @if ($parent->children)
                    @foreach ($parent->children as $child1)
                        @php
                            $parentCount++;
                            $child1Parent = $parentCount;
                            $checked = $child1->is_published == true ? 'checked' : '';
                        @endphp

                        <tr class="treegrid-{{ $parentCount }} treegrid-parent-{{ $childParent }} expanded">
                            <td>{{ $parentCount }}</td>
                            <td>{!! $child1->parent->name !!}</td>
                            <td>{!! $child1->name !!}</td>
                            <td>{{ $child1->display_order }}</td>
                            <td>
                                <x-buttons.status-toggle-button dataId="{{ $child1->id }}" status="{{ $checked }}"
                                    class="menu-is-published-toggle" />
                            </td>
                            <td>
                                {{ $child1->is_featured_navigation == true ? 'Yes' : 'No' }}
                            </td>
                            <td>
                                <div class="flex space-x-2">
                                    <x-buttons.edit-button url="{{ route('menu.edit', $child1->id) }}" />
                                    <x-buttons.delete-button url="{{ route('menu.destroy', $child1->id) }}"
                                        class="menu-delete" />
                                </div>
                            </td>
                        </tr>

                        @if ($child1->children)
                            @foreach ($child1->children as $child2)
                                @php
                                    $parentCount++;
                                    $checked = $child2->is_published == true ? 'checked' : '';
                                @endphp
                                <tr class="treegrid-{{ $parentCount }} treegrid-parent-{{ $child1Parent }}">
                                    <td>{{ $parentCount }}</td>
                                    <td>{!! $child2->parent->name !!}</td>
                                    <td>{!! $child2->name !!}</td>
                                    <td>{{ $child2->display_order }}</td>
                                    <td>
                                        <x-buttons.status-toggle-button dataId="{{ $child2->id }}"
                                            status="{{ $checked }}" class="menu-is-published-toggle" />
                                    </td>
                                    <td>
                                        {{ $child2->is_featured_navigation == true ? 'Yes' : 'No' }}
                                    </td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <x-buttons.edit-button url="{{ route('menu.edit', $child2->id) }}" />
                                            <x-buttons.delete-button url="{{ route('menu.destroy', $child2->id) }}"
                                                class="menu-delete" />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    @include('backend.menu.partials.scripts')
@endsection
