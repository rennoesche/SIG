@extends('index')
@section('content')
<div id="map"></div>
<script>
    var map = L.map('map', {zoomControl: false}).setView([0.419, 113.59], 5);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19, attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    var geoData = @json($provinsi_data);

    function updateMap(value) {
        map.eachLayer(function (layer) {
        if (layer instanceof L.GeoJSON) {
            map.removeLayer(layer);
        }
    });

    geoData.forEach(function (item) {
        var geometry = JSON.parse(item.geometry);
            if (geometry.type === "MultiPolygon") {
                var popupContent = `<b>` + item.name + `</b>`;
                if (value === 'gdp') {
                    popupContent += `<br>GDP: ` + item.gdp;
                } else if (value === 'population') {
                    popupContent += `<br>Population: ` + item.population;
                } else if (value === 'pendidikan_s1') {
                    popupContent += `<br>Pendidikan S1: ` + item.pendidikan_s1;
                } else if (value === 'penduduk_miskin') {
                    popupContent += `<br>Penduduk Miskin %: ` + item.penduduk_miskin;
                } else if (value === 'nama') {
                    popupContent += `<br>Luas: ` + item.luas + `km<sup>2</sup>`;
                }

                L.geoJSON(geometry, {
                    style: {
                        fillColor: 'blue',
                        weight: 2,
                        opacity: 0.4
                    }
                }).addTo(map).bindPopup(popupContent);
            }
        
    });

    }
    updateMap('nama');

 </script>
@endsection
