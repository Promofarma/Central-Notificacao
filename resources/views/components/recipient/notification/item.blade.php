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
         'class' =>
             'flex items-center gap-3 p-3 border-b border-slate-200 transition-colors duration-150 hover:bg-slate-100 n-item',
     ]) !!}
     x-bind:class="selected === '{{ $notification->uuid }}' ? 'bg-slate-100' : 'opacity-80'"
     x-on:click.prevent="selected === '{{ $notification->uuid }}' || handleOnNotificationSelection('{{ $notification->uuid }}')"
 >
     <div class="inline-flex items-center justify-center text-sm font-bold text-white rounded-lg size-9 bg-slate-600">
         <template x-if="!isOpening">
             <span>{{ $notification->user->name[0] }}</span>
         </template>
         <template x-if="isOpening">
             <x-lucide-loader class="animate-spin size-5" />
         </template>
     </div>
     <div class="flex-1 space-y-1">
         <div class="flex items-center justify-between gap-3">
             <h3 class="flex-1 w-32 text-sm font-bold truncate text-ellipsis">
                 @unless ($isRead)
                     <span
                         class="relative inline-flex animate-pulse items-center justify-center bg-blue-300 rounded-full -top-0.5 left-0 size-3"
                     >
                         <span class="size-1.5 rounded-full bg-blue-600 block"></span>
                     </span>
                 @endunless
                 {{ $notification->title }}
             </h3>
             <span class="text-xs font-medium text-slate-400 shrink-0">
                 {{ $notification->formatted_created_at }}
             </span>
         </div>
         <div
             class="flex items-center justify-between"
             x-data=""
         >
             <p class="w-32 text-sm truncate text-slate-400">
                 {{ strip_tags($notification->content) }}
             </p>
             <div class="flex items-center gap-3 [&>svg]:size-4">
                 @if ($notification->attachments_count)
                     <x-lucide-paperclip />
                 @endif
                 @if ($isViewed && !$isRead)
                     <x-lucide-check-check
                         class="stroke-slate-300"
                         x-tooltip="'Vista'"
                     />
                 @endif
                 @if ($isRead)
                     <x-lucide-check-check
                         class="stroke-blue-600"
                         x-tooltip="'Vista e lida'"
                     />
                 @endif
                 @if ($isArchived)
                     <x-lucide-archive
                         class="stroke-slate-300"
                         x-tooltip="'Arquivada'"
                     />
                 @endif
                 @if ($isLocked)
                     <x-lucide-lock class="stroke-slate-300" />
                 @endif
             </div>
         </div>
     </div>
 </a>
