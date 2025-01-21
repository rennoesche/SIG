@extends('index')
@section('content')
<div id="map"></div>
<script>
    var map = L.map('map', {
        zoomControl: false
    }).setView([0.419, 113.59], 5);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    var geoData = @json($provinsi_data);

    function getColor(value, type) {
        if (type === 'gdp') {
            return value > 350000 ? '#00FF00' :
                value > 300000 ? '#66FF00' :
                value > 250000 ? '#CCFF00' :
                value > 200000 ? '#FFFF00' :
                value > 150000 ? '#FFCC00' :
                value > 100000 ? '#FF9900' :
                value > 50000 ? '#FF6600' :
                '#000000';
        } else if (type === 'population') {
            return value > 4000000 ? '#FF0000' :
                value > 3000000 ? '#FF3300' :
                value > 2000000 ? '#FF6600' :
                value > 1000000 ? '#FF9900' :
                value > 500000 ? '#FFCC00' :
                value > 250000 ? '#FFFF00' :
                value > 100000 ? '#CCFF00' :
                value > 50000 ? '#66FF00' :
                '#000000';
        } else if (type === 'pendidikan_s1') {
            return value > 500000 ? '#00FF00' :
                value > 400000 ? '#66FF00' :
                value > 300000 ? '#CCFF00' :
                value > 200000 ? '#FFFF00' :
                value > 100000 ? '#FFCC00' :
                value > 50000 ? '#FF9900' :
                value > 25000 ? '#FF6600' :
                '#000000';
        } else if (type === 'penduduk_miskin') {
            return value > 10 ? '#FF0000' :
                value > 8 ? '#FF9900' :
                value > 6 ? '#FFFF00' :
                value > 4 ? '#66FF00' :
                value > 2 ? '#00FF00' :
                '#000000';
        } else if (type === 'nama') {
            return value > 100 ? '#FF0000' : 
           value > 50  ? '#FFA500' :  
           value > 25  ? '#FFFF00' :  
           value > 10   ? '#32CD32' :  
                           '#006400';
        }
    }

    function style(feature, type) {
        const value = feature.properties.value; 
        return {
            fillColor: getColor(value, type),
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7
        };
    }

    function highlightFeature(e) {
        const layer = e.target;

        layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });

        layer.bringToFront();
    }

    function resetHighlight(e) {
        geojson.resetStyle(e.target);
    }

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }

    function updateMap(value) {
        map.eachLayer(function(layer) {
            if (layer instanceof L.GeoJSON) {
                map.removeLayer(layer);
            }
        });

        geoData.forEach(function(item) {
            const geometry = JSON.parse(item.geometry);

            if (geometry.type === "MultiPolygon") {
                let popupContent = `<b>${item.name}</b>`;
                let featureValue;

                switch (value) {
                    case 'gdp':
                        featureValue = item.gdp;
                        popupContent += `<br>GDP: ${item.gdp}`;
                        break;
                    case 'population':
                        featureValue = item.population;
                        popupContent += `<br>Population: ${item.population}`;
                        break;
                    case 'pendidikan_s1':
                        featureValue = item.pendidikan_s1;
                        popupContent += `<br>Pendidikan S1: ${item.pendidikan_s1}`;
                        break;
                    case 'penduduk_miskin':
                        featureValue = item.penduduk_miskin;
                        popupContent += `<br>Penduduk Miskin: ${item.penduduk_miskin}%`;
                        break;
                    case 'nama':
                        featureValue = item.population / item.luas;
                        popupContent += `<br>Luas: ${item.luas} km<sup>2</sup>`;
                        popupContent += `<br>Kepadatan: ${item.population/item.luas}`;
                        break;
                    default:
                        featureValue = item.population / item.luas;
                        popupContent += `<br>Kepadatan: ${item.population/item.luas}`;
                }

                const feature = {
                    type: "Feature",
                    geometry: geometry,
                    properties: {
                        value: featureValue,
                        name: item.name
                    }
                };

                geojson = L.geoJSON(feature, {
                    style: function(feature) {
                        return style(feature, value); 
                    },
                    onEachFeature: onEachFeature
                }).addTo(map);

                geojson.bindPopup(popupContent);
            }
        });
    }

    updateMap('nama');

    var legend = L.control({ position: 'bottomright' });

    legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend p-4 bg-white/50 rounded-lg shadow');
    var labels = [];
    let grades, title;

    const type = document.getElementById('selectedValue').getAttribute('data-value') || 'nama';

    if (type === 'gdp') {
        grades = [50000, 100000, 150000, 200000, 250000, 300000, 350000];
        title = 'GDP';
    } else if (type === 'population') {
        grades = [50000, 100000, 250000, 500000, 1000000, 2000000, 3000000, 4000000];
        title = 'Populasi';
    } else if (type === 'pendidikan_s1') {
        grades = [25000, 50000, 100000, 200000, 300000, 400000, 500000];
        title = 'Pendidikan S1';
    } else if (type === 'penduduk_miskin') {
        grades = [2, 4, 6, 8, 10];
        title = 'Penduduk Miskin (%)';
    } else if (type === 'nama') {
        grades = [10, 25, 50, 100];
        title = 'Kepadatan penduduk';
    }
    if (!grades || grades.length === 0) {
        div.innerHTML = `<b>${title}</b><br>No data available`;
        return div;
    }
    labels.push(`<b>${title}</b>`);

    for (var i = 0; i < grades.length; i++) {
        let from = grades[i];
        let to = grades[i + 1];

        labels.push(
            `<i style="background:${getColor(from + 1, type)}; width: 20px; height: 20px; display: inline-block; margin-right: 8px;"></i>
            ${from}${to ? '&ndash;' + to : '+'}`
        );
    }

    labels.push(
        `<i style="background:#3388ff33; width: 20px; height: 20px; display: inline-block; margin-right: 8px;"></i> Tidak Ada Data`
    );

    div.innerHTML = labels.join('<br>');
    return div;
};

legend.addTo(map);

</script>
@endsection