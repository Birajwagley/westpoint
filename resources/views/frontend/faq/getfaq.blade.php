<div class="flex flex-wrap gap-2" id="faq-container">
    @forelse ($faqs as $faq)
        <details class="group w-full p-4 bg-white border border-gray-200 rounded-lg shadow">
            <summary
                class="flex items-center justify-between cursor-pointer font-medium text-brandBlue-700 focus:outline-none group-hover:text-brandBlue-800">
                <div class="flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 stroke-brandBlue group-hover:stroke-[#12919F]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                    {{ app()->getLocale() == 'en' ? $faq->question_en : ($faq->question_np ?? $faq->question_en) }}
                </div>

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 stroke-brandBlue-700 transition-transform duration-300 group-open:rotate-45"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </summary>
            <p class="mt-4 text-brandBlue-500">
                {{ app()->getLocale() == 'en' ? $faq->answer_en : ($faq->answer_np ?? $faq->answer_en) }}
            </p>
        </details>
    @empty
        <h3 class="text-center text-gray-600">
            {{ app()->getLocale() == 'en' ? 'No FAQs available for this category.' : 'यस श्रेणीमा कुनै प्रश्न उपलब्ध छैन।' }}
        </h3>
    @endforelse
</div>
