@props(['category'])
<button
    title="{{ $category->name }}"
    {!! $attributes->merge([
        'class' =>
            'relative flex items-center gap-x-1.5 p-2 rounded-lg cursor-pointer transition duration-150 cursor-pointer text-gray-500 hover:bg-primary-400/20 hover:text-primary-700 data-[loading]:pointer-events-none data-[loading]:opacity-75',
    ]) !!}
>
    <x-heroicon-m-folder class="w-5 h-5 shrink-0" />
    <span class="text-sm font-medium text-left line-clamp-1">
        {{ $category->name }}
    </span>
    <span class="absolute inset-y-0 flex items-center text-xs font-medium right-2">
        {{ $category->notifications_count > 99 ? '99+' : $category->notifications_count ?? '' }}
    </span>
</button>
