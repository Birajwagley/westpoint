<div x-data="{ tab: localStorage.getItem('selectedTab') ?? 'faculty' }" x-init="$watch('tab', value => localStorage.setItem('selectedTab', value))" class="w-full mx-auto">
    <!-- Tabs -->
    <div class="flex bg-gray-100 p-1 rounded-xl">
        <button @click="tab = 'faculty'" type="button"
            :class="tab === 'faculty'
                ?
                'bg-gray-400 text-white shadow' :
                'text-gray-600 hover:text-gray-400'"
            class="flex-1 text-center py-2 rounded-lg font-semibold transition-all">
            Faculty
        </button>
        <button @click="tab = 'subject'" type="button"
            :class="tab === 'subject'
                ?
                'bg-gray-400 text-white shadow' :
                'text-gray-600 hover:text-gray-400'"
            class="flex-1 text-center py-2 rounded-lg font-semibold transition-all">
            Subject
        </button>
    </div>

    <div class="p-4 rounded-b-lg">
        <div x-show="tab === 'faculty'">
            @include('backend.faculty.partials.faculty', ['method' => 'put'])
        </div>

        <div x-show="tab === 'subject'">
            @include('backend.faculty.partials.subject')
        </div>
    </div>
</div>
