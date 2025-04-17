  @props([
      'notification' => null,
  ])
  <div {!! $attributes->merge(['class' => 'space-y-4']) !!}>
      @foreach ($notification->recipients as $recipient)
          <div
              class="overflow-hidden bg-white divide-y rounded-lg shadow-sm divide-gray-950/5 ring-1 ring-gray-950/10"
              wire:key="{{ $recipient->id }}"
          >
              <div class="flex items-center p-4 gap-x-2">
                  <img
                      src="{{ $recipient->recipient->avatarUrl() }}"
                      alt="{{ $recipient->recipient->name }}"
                      class="rounded-full w-9 h-9"
                  />
                  <x-ui.heading level="3">{{ $recipient->recipient->name }}</x-ui.heading>
              </div>
              <div class="flex items-center px-4 py-2 gap-x-4 bg-gray-50">
                  @if (!$recipient->isViewed())
                      <span class="flex items-center gap-x-1.5 text-gray-500">
                          <x-heroicon-s-eye-slash class="w-4 h-4 shrink-0" />
                          <x-ui.text
                              size="xs"
                              variant="subtle"
                          >Não vista</x-ui.text>
                      </span>
                  @endif

                  @if ($recipient->isViewed())
                      <span class="flex items-center gap-x-1.5 text-green-600">
                          <x-heroicon-s-eye class="w-4 h-4 shrink-0" />
                          <x-ui.text
                              size="xs"
                              variant="subtle"
                          >Vista</x-ui.text>
                      </span>
                  @endif

                  @if ($recipient->isRead())
                      <span class="flex items-center gap-x-1.5 text-green-600">
                          <x-heroicon-s-check class="w-4 h-4 shrink-0" />
                          <x-ui.text
                              size="xs"
                              variant="subtle"
                          >Lida</x-ui.text>
                      </span>
                  @endif
              </div>
          </div>
      @endforeach
  </div>
