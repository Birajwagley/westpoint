<label class="relative inline-flex items-center cursor-pointer">
    <input type="checkbox" data-id="{{ $dataId }}" class="{{ $class }} sr-only peer" {{ $status }} />
    <div
        class="w-12 h-7 bg-gray-300 rounded-full peer-focus:ring-4 peer-focus:ring-blue-300 peer-checked:bg-green-500 transition-colors duration-300">
    </div>
    <div
        class="absolute left-1 top-1 bg-white w-5 h-5 rounded-full shadow transform peer-checked:translate-x-5 transition-transform duration-300">
    </div>
</label>
