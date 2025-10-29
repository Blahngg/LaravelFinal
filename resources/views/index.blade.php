<x-user-layout>
  <div>
    <div class="mb-2">
      <h4 class="text-2xl font-bold dark:text-white">Top Songs</h4>
    </div>
    <div class="flex mb-2">
      @foreach ($musics as $music)
        <a href="{{ route('music.view', $music) }}" class="mr-5">
          <div class="w-64 h-75 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden">
              <div>
                  <img class="h-40 w-full object-cover" src="{{ asset('storage/' . $music->image) }}" alt="{{ $music->title }}" />
              </div>
              <div class="p-4 flex-1 flex flex-col">
                  <div>
                      <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white truncate">{{ $music->title }}</h5>
                  </div>
                  <p class="text-sm text-gray-700 dark:text-gray-400 flex-1 overflow-auto">
                      {{ $music->artist }}
                  </p>
              </div>
          </div>
        </a>
      @endforeach
      <a href="" class="mr-7">
        <div class="w-27 h-75 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden">
            <div>
                <img class="h-40 w-full object-cover" src="{{ asset('storage/' . $music->image) }}" alt="{{ $music->title }}" />
            </div>
            <div class="p-4 flex-1 flex flex-col">
                <div>
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white truncate">
                      View More
                    </h5>
                </div>
                <p class="text-sm text-center text-gray-700 dark:text-gray-400 flex-1 overflow-auto">
                    Top Songs
                </p>
            </div>
        </div>
      </a>
    </div>
  </div>
  <div>
    <div class="mb-2">
      <h4 class="text-2xl font-bold dark:text-white">Trending Songs</h4>
    </div>
    <div class="flex mb-2">
      @foreach ($musics as $music)
        <a href="{{ route('music.view', $music) }}" class="mr-5">
          <div class="w-64 h-75 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden">
              <div>
                  <img class="h-40 w-full object-cover" src="{{ asset('storage/' . $music->image) }}" alt="{{ $music->title }}" />
              </div>
              <div class="p-4 flex-1 flex flex-col">
                  <div>
                      <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white truncate">{{ $music->title }}</h5>
                  </div>
                  <p class="text-sm text-gray-700 dark:text-gray-400 flex-1 overflow-auto">
                      {{ $music->artist }}
                  </p>
              </div>
          </div>
        </a>
      @endforeach
      <a href="" class="mr-7">
        <div class="w-27 h-75 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden">
            <div>
                <img class="h-40 w-full object-cover" src="{{ asset('storage/' . $music->image) }}" alt="{{ $music->title }}" />
            </div>
            <div class="p-4 flex-1 flex flex-col">
                <div>
                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white truncate">
                      View More
                    </h5>
                </div>
                <p class="text-sm text-center text-gray-700 dark:text-gray-400 flex-1 overflow-auto">
                    Trending
                </p>
            </div>
        </div>
      </a>
    </div>
  </div>
</x-user-layout>