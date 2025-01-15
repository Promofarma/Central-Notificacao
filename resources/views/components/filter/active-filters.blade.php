 @if (count($activeFilters))
     <div class="flex flex-wrap items-center gap-3 mt-4">
         <span class="text-xs font-semibold text-slate-600">Filtros ativos:</span>
         @foreach ($activeFilters as $activeFilter)
             <x-ui.badge
                 color="white"
                 icon="filter"
             >
                 {{ $activeFilter['label'] }}: {{ $activeFilter['state'] }}
             </x-ui.badge>
         @endforeach
     </div>
 @endif
