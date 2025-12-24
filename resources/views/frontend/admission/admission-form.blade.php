@extends('frontend.layouts.app')

@section('title', 'Admission Form: School Level')

@php
    use Carbon\Carbon;
    use App\Helpers\Helper;
    use App\Enum\TimingTypeEnum;
    use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
@endphp

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => $typeOfAdmission ? __('pages.school_admission_title') : __('pages.plus2_admission_title'),
        'subHeading' => $typeOfAdmission
            ? __('pages.school_admission_subtitle')
            : __('pages.plus2_admission_subtitle'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => $typeOfAdmission ? __('pages.school_admission_title') : __('pages.plus2_admission_title'),
            'route' => $typeOfAdmission
                ? route('online-admission.school-level')
                : route('online-admission.college-level'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])


    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 space-y-4">

            <form
                action="{{ $typeOfAdmission ? route('online-admission.school-level-store') : route('online-admission.college-level-store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Grid Wrapper -->
                @include('frontend.admission.form', ['applyFor' => 'hidden'])

                <div class="flex mt-6 gap-2">
                    <x-buttons.form-save-button type="Save" />
                    <x-buttons.form-cancel-button href="{{ route('admission.index') }}" />
                </div>
            </form>

            <!-- Hidden Template -->
            <div id="parent-field-template" class="hidden">
                <div class="parent-fields border p-3 mb-3 rounded-lg relative guardian-field">
                    <button type="button"
                        class="remove-parent-btn absolute top-2 right-2 text-red-500 font-bold">&times;</button>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Guardian Name <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="parents[__INDEX__][name]"
                                value="{{ old('parents.__INDEX__.name') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error('parents.__INDEX__.name') border-red-500 @enderror">
                            @error('parents.__INDEX__.name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Relation <span
                                    class="text-red-600">*</span></label>
                            <input type="text" name="parents[__INDEX__][relation]"
                                placeholder="Relation (e.g. Uncle, Aunt, Sponsor)"
                                value="{{ old('parents.__INDEX__.relation') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error('parents.__INDEX__.relation') border-red-500 @enderror">
                            @error('parents.__INDEX__.relation')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Occupation</label>
                            <input type="text" name="parents[__INDEX__][occupation]"
                                value="{{ old('parents.__INDEX__.occupation') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error('parents.__INDEX__.occupation') border-red-500 @enderror">
                            @error('parents.__INDEX__.occupation')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Contact No</label>
                            <input type="text" name="parents[__INDEX__][contact_no]"
                                value="{{ old('parents.__INDEX__.contact_no') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error('parents.__INDEX__.contact_no') border-red-500 @enderror">
                            @error('parents.__INDEX__.contact_no')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
