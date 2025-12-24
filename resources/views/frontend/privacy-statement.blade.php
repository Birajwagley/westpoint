@extends('frontend.layouts.app')

@section('title', 'Privacy Statement')

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.privacy_statement'),
        'subHeading' => __('pages.privacy_statement_description'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.privacy_statement'),
            'route' => route('privacy-statement'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Privacy Statement Section --}}
    <section class="px-4 sm:px-6 md:px-10 lg:px-20 xl:px-40 py-16">
        <div class="p-8 bg-white shadow-md rounded-lg space-y-8 text-gray-700 text-justify">
            @php
                $sections = [
                    [
                        'title' => 'Introduction',
                        'content' =>
                            'Gyanodaya Bal Batika School values the privacy of our students, parents, and visitors. This Privacy Statement explains how we collect, use, and protect personal information to ensure a safe and secure learning environment.',
                    ],
                    [
                        'title' => 'Information We Collect',
                        'content' =>
                            'We collect personal information such as student and parent names, contact details, academic records, and other relevant data to provide educational services and communicate effectively with parents and guardians.',
                    ],
                    [
                        'title' => 'How We Use Information',
                        'content' =>
                            'Collected information is used to manage student records, communicate school updates, organize events, provide academic support, and comply with regulatory obligations.',
                    ],
                    [
                        'title' => 'Information Protection',
                        'content' =>
                            'Gyanodaya Bal Batika School implements secure data storage and strict access controls to protect personal information from unauthorized access, misuse, or disclosure.',
                    ],
                    [
                        'title' => 'Sharing Information',
                        'content' =>
                            'We do not sell or rent personal information. Information may be shared with authorized staff, educational authorities, or service providers as necessary to facilitate school operations and educational programs.',
                    ],
                    [
                        'title' => 'Use of Cookies',
                        'content' =>
                            'Our website may use cookies to improve user experience, track website performance, and enhance online services. Visitors can manage cookies through their browser settings.',
                    ],
                    [
                        'title' => 'Third-Party Links',
                        'content' =>
                            'Our website may include links to third-party educational or service websites. Gyanodaya Bal Batika School is not responsible for the privacy practices of these external sites.',
                    ],
                    [
                        'title' => 'Changes to This Policy',
                        'content' =>
                            'The school may update this Privacy Statement from time to time. Users are encouraged to review this page periodically for any updates.',
                    ],
                    [
                        'title' => 'Contact Us',
                        'content' =>
                            'For any questions regarding this Privacy Statement or data handling practices, please contact the school administration using the contact information provided on our website.',
                    ],
                ];
            @endphp

            @foreach ($sections as $section)
                <div>
                    <h2 class="text-xl sm:text-2xl font-semibold text-primary mb-2 flex items-center">
                        <span class="text-primary text-xl mr-2">➜</span> {{ $section['title'] }}
                    </h2>
                    <p class="leading-relaxed">{{ $section['content'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection
