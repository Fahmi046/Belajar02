{{-- <nav class="bg-gray-800" x-data="{ isOpen: false }">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <div class="shrink-0">
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="size-8" />
          </div>
          <div class="hidden md:block">
            <div class="flex items-baseline ml-10 space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <x-nav-link href="/" :active="request()->is('/')" >Home</x-nav-link>
            <x-nav-link href="/posts" :active="request()->is('posts')" >Blog</x-nav-link>
            <x-nav-link href="/about" :active="request()->is('about')" >About</x-nav-link>
            <x-nav-link href="/contact" :active="request()->is('contact')" >Contact</x-nav-link>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="flex items-center ml-4 md:ml-6">

            <!-- Profile dropdown -->
            <div class="relative ml-3">
              <div>
                <button id="user-menu-button" type="button" @click="isOpen = !isOpen" aria-expanded="false" aria-haspopup="true" class="relative flex items-center max-w-xs text-sm bg-gray-800 rounded-full focus:outline-hidden focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-gray-800">
                  <span class="absolute -inset-1.5"></span>
                  <span class="sr-only">Open user menu</span>
                  <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="rounded-full size-8" />
                </button>
              </div>

              <div x-show="isOpen"
    x-transition:enter="transition ease-out duration-100 transform"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-75 transform"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
              role="menu" tabindex="-1" aria-labelledby="user-menu-button" aria-orientation="vertical" class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black/5 focus:outline-hidden">
                <!-- Active: "bg-gray-100 outline-hidden", Not Active: "" -->
                <a id="user-menu-item-0" role="menuitem" href="#" tabindex="-1" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
                <a id="user-menu-item-1" role="menuitem" href="#" tabindex="-1" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                <a id="user-menu-item-2" role="menuitem" href="#" tabindex="-1" class="block px-4 py-2 text-sm text-gray-700">Sign out</a>
              </div>
            </div>
          </div>
        </div>
        <div class="flex -mr-2 md:hidden">
          <!-- Mobile menu button -->
          <button @click="isOpen = !isOpen" type="button" aria-controls="mobile-menu" aria-expanded="false" class="relative inline-flex items-center justify-center p-2 text-gray-400 bg-gray-800 rounded-md hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg :class="{'hidden': isOn, 'block': !isOn }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="block size-6">
              <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg :class="{'block': isOn, 'hidden': !isOn }" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="hidden size-6">
              <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" id="mobile-menu" class="md:hidden">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
       <x-nav-link href="/" :active="request()->is('/')" >Home</x-nav-link>
        <x-nav-link href="/posts" :active="request()->is('posts')" >Blog</x-nav-link>
       <x-nav-link href="/about" :active="request()->is('about')" >About</x-nav-link>
        <x-nav-link href="/contact" :active="request()->is('contact')" >Contact</x-nav-link>
      </div>
      <div class="pt-4 pb-3 border-t border-gray-700">
        <div class="flex items-center px-5">
          <div class="shrink-0">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="rounded-full size-10" />
          </div>
          <div class="ml-3">
            <div class="font-medium text-white text-base/5">Tom Cook</div>
            <div class="text-sm font-medium text-gray-400">tom@example.com</div>
          </div>
        </div>
        <div class="px-2 mt-3 space-y-1">
          <a href="#" class="block px-3 py-2 text-base font-medium text-gray-400 rounded-md hover:bg-gray-700 hover:text-white">Your Profile</a>
          <a href="#" class="block px-3 py-2 text-base font-medium text-gray-400 rounded-md hover:bg-gray-700 hover:text-white">Settings</a>
          <a href="#" class="block px-3 py-2 text-base font-medium text-gray-400 rounded-md hover:bg-gray-700 hover:text-white">Sign out</a>
        </div>
      </div>
    </div>
  </nav> --}}



<nav class="bg-white border-gray-200 dark:bg-gray-900" x-data="{ isOpen: false }">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
        <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Apotek Sahabat</span>
        </a>
        <div class="flex items-center space-x-1 md:order-2 md:space-x-2 rtl:space-x-reverse">
            <a href="#"
                class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Login</a>
            <a href="#"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Sign
                up</a>
            <button data-collapse-toggle="mega-menu-icons" type="button"
                class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="mega-menu-icons" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div id="mega-menu-icons" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
            <ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="/posts" :active="request()->is('posts')">Blog</x-nav-link>
                <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
                <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
                <li>
                    <button id="mega-menu-icons-dropdown-button" data-dropdown-toggle="mega-menu-icons-dropdown"
                        class="flex items-center justify-between w-full px-3 py-2 font-medium text-gray-900 border-b border-gray-100 md:w-auto hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">
                        Company
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="mega-menu-icons-dropdown"
                        class="absolute z-10 grid hidden w-auto grid-cols-1 text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-700">
                        <div class="p-4 pb-0 text-gray-900 md:pb-4 dark:text-white">
                            <ul class="space-y-4" aria-labelledby="mega-menu-icons-dropdown-button">
                                <x-nav-level href="/" :active="request()->is('/')"></x-nav-level>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
