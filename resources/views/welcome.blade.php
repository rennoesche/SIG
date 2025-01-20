<!DOCTYPE html>
<html lang="en" h-full>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS Map</title>

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
</head>
<body class="h-full bg-gray-100 ">

<div id="map"></div>

<script>

    // Initialize Leaflet Map
    var map = L.map('map', {zoomControl: false}).setView([0.419, 113.59], 5);
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
