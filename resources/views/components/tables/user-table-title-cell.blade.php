@props(['image', 'title'])

<div class="flex items-center space-x-3 text-gray-800 dark:text-gray-100">
    <img src="{{ asset('storage/' . $image) }}"
        alt="$title"
        class="w-10 h-10 object-cover rounded-md shadow-sm border border-gray-200 dark:border-gray-700">
    <span class="text-sm font-medium truncate max-w-[150px]">
        {{ $slot }}
    </span>
</div>