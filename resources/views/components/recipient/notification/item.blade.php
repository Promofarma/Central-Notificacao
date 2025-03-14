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
         'class' => 'block p-3 border-b border-slate-200 transition-colors duration-150 hover:bg-white n-item',
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
             <h3 class="mr-3 text-sm font-bold truncate text-slate-700">
                 @unless ($isRead)
                     <span class="relative left-0 inline-block w-2 h-2 bg-blue-600 rounded-full -top-px"></span>
                 @endunless
                 {{ $notification->title }}
             </h3>
             <span class="text-xs font-medium text-slate-500">{{ $notification->user->name }}</span>
         </div>
         <span class="pt-px text-xs font-medium shrink-0 text-slate-500">{{ $notification->formatted_created_at }}</span>
     </div>

     <div class="flex items-center justify-between gap-x-3">
         <p class="flex-1 text-xs font-semibold line-clamp-2 text-slate-400">
             {!! Str::of(html_entity_decode($notification->content))->stripTags()->lower()->trim()->ucfirst() !!}</p>
         <div
             x-data=""
             class="shrink-0 flex items-center gap-x-3 [&>svg]:size-4"
         >
             @if ($notification->attachments_count)
                 <x-lucide-paperclip
                     class="stroke-slate-400"
                     x-tooltip="'Anexos: {{ $notification->attachments_count }}'"
                 />
             @endif

             @if ($isViewed && !$isRead)
                 <x-lucide-check
                     class="stroke-slate-400"
                     x-tooltip="'Vista'"
                 />
             @endif

             @if ($isRead)
                 <x-lucide-check-check
                     class="stroke-blue-600"
                     x-tooltip="'Lida'"
                 />
             @endif

             @if ($isArchived)
                 <x-lucide-archive
                     class="stroke-slate-400"
                     x-tooltip="'Arquivada'"
                 />
             @endif
         </div>
     </div>
 </a>
