@props(['links'])

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <div class="hidden space-x-8 sm:-my-px sm:flex">
               <x-nav.side-nav-link :href="route('index')" :active="request()->routeIs('index')" wire:navigate>
                  {{ __('Home') }}
               </x-nav.side-nav-link>
            </div>
         </li>
         <li>
            <div class="hidden space-x-8 sm:-my-px sm:flex">
               <x-nav.side-nav-link :href="route('search')" :active="request()->routeIs('search')" wire:navigate>
                  {{ __('Search') }}
               </x-nav.side-nav-link>
            </div>
         </li>
         <li>
            <div class="hidden space-x-8 sm:-my-px sm:flex">
               <x-nav.side-nav-link :href="route('likes')" :active="request()->routeIs('likes')" wire:navigate>
                  {{ __('Likes') }}
               </x-nav.side-nav-link>
            </div>
         </li>
         <li>
            <div class="hidden space-x-8 sm:-my-px sm:flex">
               <x-nav.side-nav-link :href="route('ratings')" :active="request()->routeIs('ratings')" wire:navigate>
                  {{ __('Ratings') }}
               </x-nav.side-nav-link>
            </div>
         </li>
         <li>
            <div class="hidden space-x-8 sm:-my-px sm:flex">
               <x-nav.side-nav-link :href="route('playlist')" :active="request()->routeIs('playlist')" wire:navigate>
                  {{ __('Playlist') }}
               </x-nav.side-nav-link>
            </div>
         </li>
      </ul>
   </div>
</aside>
