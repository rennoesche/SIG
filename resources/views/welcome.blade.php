<!DOCTYPE html>
<html lang="en" h-full>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS Map</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        #map {
            width: 1000px;
            height: 400px;
        }

        .slide-left {
            animation: slide-left 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        @keyframes slide-left {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100px);
            }
        }

        #map {
            width: 1000px;
            height: 400px;
        }

        /* Styling for dropdown */
        #dropdownMenu {
            display: none; /* Initially hide the menu */
            position: absolute;
            top: 50px;
            right: 0;
            width: 150px;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        #dropdownMenu ul {
            padding: 0;
            list-style-type: none;
        }

        #dropdownMenu li {
            padding: 8px 10px;
            cursor: pointer;
        }

        #dropdownMenu li:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body class="h-full bg-gray-100 ">

<div class="min-h-full">
  <nav class="bg-gray-800" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0">
            <img class="size-8" src="https://www.vhv.rs/dpng/d/324-3247699_gis-logo-square-circle-hd-png-download.png" alt="Your Company">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-700" aria-current="page">Beranda</a>
            </div>
        </div>
    </div>
    <div class="hidden md:block">
        <div class="ml-4 flex items-center md:ml-6">
            
            
            <!-- Profile dropdown -->
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-700 ">Peta Tematik</a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-700 ">Provinsi</a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-700 ">Kabupaten</a>
            <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-gray-700 ">Tentang</a>
            <div class="relative ml-3">
              <div >
                <button type="button"  @click="isOpen = !isOpen"
                class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="absolute -inset-1.5"></span>
                  <span class="sr-only">Open user menu</span>
                  <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                </button>
              </div>

              <!--
                Dropdown menu, show/hide based on menu state.

                Entering: "transition ease-out duration-100"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
              <div  x-show="isOpen"
                    x-transition:enter="transition ease-out duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75 transform"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <!-- Active: "bg-gray-100 outline-none", Not Active: "" -->
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
              </div>
            </div>
          </div>
        </div>
        <div class="-mr-2 flex md:hidden">
          <!-- Mobile menu button -->
          <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg :class="{'hidden': isOpen, 'block': !isOpen }"  class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg  :class="{'block': isOpen, 'hiden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Beranda</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Peta TEmatik</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Provinsi</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Kabupaten</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Tentang</a>
      </div>
      <div class="border-t border-gray-700 pb-3 pt-4">
        <div class="flex items-center px-5">
          <div class="shrink-0">
            <img class="size-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
          </div>
          <div class="ml-3">
            <div class="text-base/5 font-medium text-white">Akmal</div>
            <div class="text-sm font-medium text-gray-400">Akmal@uiaiu.cat</div>
          </div>
          <button type="button" class="relative ml-auto shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
          </button>
        </div>
        <div class="mt-3 space-y-1 px-2">
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
        </div>
      </div>
    </div>
  </nav>

  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
    </div>
  </main>
</div>

<div id="map" class="relative">
    <div class="absolute top-4 right-4 z-[1000] flex items-center space-x-2">
        <div id="selectedValue" class="pl-4 pr-1 py-1 bg-white text-gray-700 rounded-full shadow-md flex gap-x-4 items-center justify-center self-center">
            Select Option
            <button id="hamburgerBtn" class="w-12 h-12 bg-blue-500 text-white rounded-full shadow-lg flex justify-center items-center hover:bg-blue-600">
                ☰
            </button>
        </div>

        <div id="dropdownMenu" class="hidden bg-white shadow-md rounded-lg w-48 right-0 absolute top-0 mt-16">
            <ul class="py-2">
                <li>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="Option 1">Option 1</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="Option 2">Option 2</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="Option 3">Option 3</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="Option 4">Option 4</a>
                </li>
                <li>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="Option 5">Option 5</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
   const toggleButton = document.getElementById('toggleDropdown');
    const dropdownMenu = document.getElementById('dropdownMenu');

    toggleButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden'); // Toggle the visibility
    });

    // Hide dropdown when clicking outside of it
    document.addEventListener('click', function(event) {
        if (!dropdownMenu.contains(event.target) && !toggleButton.contains(event.target)) {
            dropdownMenu.classList.add('hidden'); // Hide the dropdown
        }
    });

    // Initialize Leaflet Map
    var map = L.map('map').setView([0.419, 116.59], 6);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    fetch('/provinsi')
    .then(response => response.json())
    .then(data => {
        data.forEach(province => {
            L.geoJSON(province.boundary, {
                style: { color: 'blue' },
                onEachFeature: (feature, layer) => {
                    layer.bindPopup(`<b>${province.name}</b>`);
                }
            }).addTo(map);
        });
    })
    .catch(error => console.log('Error fetching data:', error));
</script>

</body>
</html>
