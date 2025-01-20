<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map {
            height: calc(100vh - 64px);
        }

        #dropdownMenu {
            transition: all 0.3s ease-in-out;
        }

        .hidden {
            opacity: 0;
            visibility: hidden;
        }

        .visible {
            opacity: 1;
            visibility: visible;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
    <title>Peta GIS</title>
</head>
<body>
    <div class="navbar flex items-center justify-between px-4 py-2">
        <div id="selectedValue" class="text-gray-700 ">
            <b>Peta Nama Provinsi</b>
        </div>
        <button id="hamburgerBtn" class="w-12 h-12 bg-blue-500 text-white rounded-full shadow-lg flex justify-center items-center hover:bg-blue-600" onclick="meow()">
            ☰
        </button>
        <div id="dropdownMenu" class="hidden bg-white shadow-md rounded-lg w-48 absolute top-16 right-4">
            <ul class="py-2">
                <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="nama">Peta Nama Provinsi</a></li>
                <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="gdp">Peta GDP Pulau Kalimantan</a></li>
                <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="penduduk_miskin">Persentase Kemiskinan di Pulau Kalimantan</a></li>
                <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="pendidikan_s1">Peta Lulusan S1 Pulau Kalimantan</a></li>
                <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" data-value="population">Peta Populasi</a></li>
            </ul>
        </div>
    </div>
    @yield('content')
    <script>
         document.getElementById('hamburgerBtn').onclick = function() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        if (dropdownMenu.classList.contains('hidden')) {
            dropdownMenu.classList.remove('hidden');
            dropdownMenu.classList.add('visible');
        } else {
            dropdownMenu.classList.remove('visible');
            dropdownMenu.classList.add('hidden');
        }
    };

    document.querySelectorAll('#dropdownMenu a').forEach(function(item) {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            var value = this.getAttribute('data-value');
            var text = this.textContent;
            document.getElementById('selectedValue').innerHTML = '<b>' + text + '</b>';
            updateMap(value);
            // Hide the dropdown menu after selection
            document.getElementById('dropdownMenu').classList.remove('visible');
            document.getElementById('dropdownMenu').classList.add('hidden');
        });
    });
   </script>
</body>
</html>
