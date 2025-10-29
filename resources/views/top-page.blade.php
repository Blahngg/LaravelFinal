<x-user-layout>
  <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __($title) }}
        </h2>
    </x-slot>
  
  <div id="detailed-pricing" class="w-full overflow-x-auto">
      <div class="overflow-hidden min-w-max mb-5 mt-4">
          <x-tables.user-table-header-row class="grid-cols-4">
              <div class="flex items-center cursor-pointer">
                  Title
              </div>
              <div class="cursor-pointer">
                  Artist
              </div>
              <div class="cursor-pointer">
                  Rating
              </div>
              <div class="cursor-pointer">
              </div>
          </x-tables.user-table-header-row>
          @foreach ($musics as $music)
              <x-tables.user-table-row-link class="grid-cols-4">
                  <x-tables.user-table-title-cell 
                      :image="$music->image" 
                      :title="$music->title">
                          {{ $music->title }}
                  </x-tables.user-table-title-cell>

                  <x-tables.user-table-cell>
                      {{ $music->artist }}
                  </x-tables.user-table-cell>

                  <x-tables.user-table-cell class="ml-2">
                      {{ number_format($music->ratings_avg_rating, 2) }}
                  </x-tables.user-table-cell>

                  <x-tables.user-table-cell class="space-x-2">
                      <a href="{{ route('music.view', $music) }}">
                          <x-buttons.show-button>
                              View
                          </x-buttons.show-button>
                      </a>
                      <a href="{{ route('similar', $music) }}">
                          <x-buttons.add-button>
                              Find Similar Songs
                          </x-buttons.add-button>
                      </a>
                  </x-tables.user-table-cell>
              </x-tables.user-table-row-link>
          @endforeach
      </div>
  </div>
</x-user-layout>