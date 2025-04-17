 @props([
     'notification' => null,
     'isViewed' => false,
     'isRead' => false,
     'isLocked' => false,
     'isArchived' => false,
 ])
 <a
     href="javascript:void(0)"
     {!! $attributes->merge([
         'class' => 'block p-3 border-b border-gray-200 transition-colors duration-150 hover:bg-white n-item',
     ]) !!}
     title="{{ $notification->title }}"
     x-bind:class="{
         'bg-white': selected === '{{ $notification->uuid }}' && 'bg-white',
         'animate-pulse': isOpening
     }"
     x-on:click.prevent="selected === '{{ $notification->uuid }}' || handleOnNotificationSelection('{{ $notification->uuid }}')"
 >
     <div class="flex items-start justify-between gap-3 mb-3">
         <div class="grid gap-y-1 max-w-56">

             <x-ui.heading
                 level="3"
                 size="sm"
                 class="mr-3 truncate"
             >
                 @unless ($isRead)
                     <span class="relative left-0 inline-block w-2 h-2 rounded-full bg-primary-600 -top-px"></span>
                 @endunless
                 {{ $notification->title }}
             </x-ui.heading>



             <x-ui.text size="sm">{{ $notification->user->name }}</x-ui.text>
         </div>
         <div class="pt-px shrink-0">
             <x-ui.text
                 size="xs"
                 variant="subtle"
             >
                 {{ $notification->formatted_created_at }}
             </x-ui.text>
         </div>
     </div>

     <div class="flex items-center justify-between gap-x-3">
         <x-ui.text
             size="xs"
             class="flex-1 line-clamp-1 max-w-64"
         >
             {!! Str::of(html_entity_decode($notification->content))->stripTags()->lower()->trim()->ucfirst() !!}
         </x-ui.text>

         <div
             x-data=""
             class="shrink-0 flex items-center gap-x-3 [&>svg]:size-4"
         >
             @if ($notification->attachments_count)
                 <x-heroicon-m-paper-clip
                     class="text-gray-500"
                     x-tooltip="'Anexos: {{ $notification->attachments_count }}'"
                 />
             @endif

             @if ($isViewed && !$isRead)
                 <x-heroicon-m-check
                     class="text-gray-500"
                     x-tooltip="'Vista'"
                 />
             @endif

             @if ($isRead)
                 <x-heroicon-m-check
                     class="text-primary-600"
                     x-tooltip="'Lida'"
                 />
             @endif

             @if ($isArchived)
                 <x-heroicon-m-archive-box
                     class="text-gray-500"
                     x-tooltip="'Arquivada'"
                 />
             @endif
         </div>
     </div>
 </a>
