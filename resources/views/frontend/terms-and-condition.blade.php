@extends('frontend.layouts.app')

@section('title', 'Terms and Conditions')

@php
    use App\Helpers\Helper;
@endphp

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.terms_and_conditions'),
        'subHeading' => __('pages.terms_and_conditions_description'),
        'breadcrumb1' => [
            'name' => __('route.terms_and_conditions'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.privacy_statement'),
            'route' => route('terms-and-condition'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Terms Section --}}
    <section class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 py-16">
        <div class="p-8 bg-white shadow-md rounded-lg space-y-8 text-gray-700 text-justify">

            @php
                $terms = [
                    [
                        'title' => 'Introduction',
                        'content' =>
                            'These Terms and Conditions govern your use of the Gyanodaya Bal Batika School website and services. By accessing the site, you agree to comply with these terms.',
                    ],
                    [
                        'title' => 'Use of the Website',
                        'content' =>
                            'The website is intended for students, parents, and staff for informational purposes. Users agree to use the website responsibly and not engage in any activity that may harm or interfere with its operation.',
                    ],
                    [
                        'title' => 'Intellectual Property',
                        'content' =>
                            'All content on the website, including text, images, logos, and other materials, is the property of Gyanodaya Bal Batika School and is protected by intellectual property laws. Unauthorized use is prohibited.',
                    ],
                    [
                        'title' => 'Limitation of Liability',
                        'content' =>
                            'Gyanodaya Bal Batika School is not liable for any direct, indirect, or incidental damages arising from the use of the website or reliance on its content.',
                    ],
                    [
                        'title' => 'Changes to Terms',
                        'content' =>
                            'The school reserves the right to modify these Terms and Conditions at any time. Users are encouraged to review this page periodically for updates.',
                    ],
                    [
                        'title' => 'Contact Us',
                        'content' =>
                            'For any questions or clarifications regarding these Terms and Conditions, please contact us at <a href="mailto:info@gyanodaya.edu.np" class="text-blue-600 underline">info@gyanodaya.edu.np</a>.',
                    ],
                ];
            @endphp

            @foreach ($terms as $term)
                <div>
                    <h2 class="text-xl sm:text-2xl font-semibold text-primary mb-2 flex items-center">
                        <span class="text-primary text-xl mr-2">➜</span> {{ $term['title'] }}
                    </h2>
                    <p class="leading-relaxed">{!! Helper::stripInlineStyle($term['content']) !!}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
