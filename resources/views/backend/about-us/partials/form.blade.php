<div x-data="{ tab: localStorage.getItem('selectedTab') || 'about-us' }" x-init="$watch('tab', value => localStorage.setItem('selectedTab', value))" class="w-full mx-auto">
    <!-- Tabs -->
    <div class="flex bg-gray-100 p-1 rounded-xl">
        <button @click="tab = 'about-us'" type="button"
            :class="tab === 'about-us'
                ?
                'bg-gray-400 text-white shadow' :
                'text-gray-600 hover:text-gray-400'"
            class="flex-1 text-center py-2 rounded-lg font-semibold transition-all">
            About Us
        </button>

        <button @click="tab = 'cronology'" type="button"
            :class="tab === 'cronology'
                ?
                'bg-gray-400 text-white shadow' :
                'text-gray-600 hover:text-gray-400'"
            class="flex-1 text-center py-2 rounded-lg font-semibold transition-all">
            Cronology
        </button>

        <button @click="tab = 'card'" type="button"
            :class="tab === 'card'
                ?
                'bg-gray-400 text-white shadow' :
                'text-gray-600 hover:text-gray-400'"
            class="flex-1 text-center py-2 rounded-lg font-semibold transition-all">
            Card
        </button>
    </div>

    <div class="p-4 rounded-b-lg">
        {{-- about us --}}
        <div x-show="tab === 'about-us'">
            @include('backend.about-us.partials.about-us')
        </div>

        {{-- cronology --}}
        <div x-show="tab === 'cronology'">
            @include('backend.about-us.partials.cronology')
        </div>

        {{-- card --}}
        <div x-show="tab === 'card'">
            @include('backend.about-us.partials.card')
        </div>
    </div>
</div>
