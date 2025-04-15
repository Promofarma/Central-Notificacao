  @props([
      'href' => '#',
      'icon' => null,
      'resource' => null,
  ])

  <a
      href="{{ $href }}"
      resource-name="{{ $resource }}"
      class="flex items-center text-sm px-3 py-2 md:gap-3 justify-center tracking-wide md:justify-start rounded-lg  text-gray-500 transition-colors duration-150 hover:bg-white hover:shadow-sm hover:shadow-gray-300/10 hover:ring-1 hover:ring-gray-950/10 hover:text-gray-950 focus:outline-none [&>svg]:size-5 [&>svg]:shrink-0"
  >
      @if ($icon)
          <x-dynamic-component
              component="icon"
              :name="$icon"
          />
      @endif
      <span class="hidden md:block">{{ $slot }}</span>
  </a>
