@extends('welcome')

@section('content')
<div id='map'></div>

<script>
        var map = L.map('map',{ zoomControl: false }).setView([4.195, 96.798], 8);
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> | <a href="https://sulsel.bps.go.id/id/statistics-table/2/ODMjMg==/jumlah-penduduk-menurut-kabupaten-kota" target="_blank">BPS Sulawesi Selatan</a>'
        }).addTo(map);

        var meow = @json($kabkota);

        function getColor(population) {
            return population > 1000000 ? '#800026' :
                population > 500000  ? '#BD0026' :
                population > 200000  ? '#E31A1C' :
                population > 100000  ? '#FC4E2A' :
                population > 50000   ? '#FD8D3C' :
                population > 20000   ? '#FEB24C' :
                population > 10000   ? '#FED976' :
                                        '#FFEDA0';
        }

        function style(feature) {
            return {
                fillColor: getColor(feature.populasi),
                weight: 1,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 0.7
            };
        }

        meow.forEach(function (data) {
            var geo = JSON.parse(data.geometry);
            var populasi = JSON.parse(data.populasi);
            if (geo.type == 'MultiPolygon' || geo.type == 'Polygon') {
                var popup = `<b class="mb-2">${data.nama}</b><br>${data.populasi} jiwa`;
                L.geoJSON(geo, {
                    style: function(feature) {
                        feature = { ...feature, populasi: populasi };
                        return style(feature);
                    }
                }).addTo(map).bindPopup(popup);
            } else {
                L.geoJSON(geo).addTo(map);
            }
        });

        var legend = L.control({ position: 'bottomleft' });

        legend.onAdd = function (map) {
            var div = L.DomUtil.create('div', 'info legend p-4 bg-white rounded shadow');
            var grades = [0, 10000, 20000, 50000, 100000, 200000, 500000, 1000000];
            var labels = [];
            let from, to;

            labels.push('<b>Populasi (Jiwa)</b>');

            for (var i = 0; i < grades.length; i++) {
                from = grades[i];
                to = grades[i + 1];

                labels.push(
                    `<i style="background:${getColor(from + 1)}; width: 20px; height: 20px; display: inline-block; margin-right: 8px;"></i>
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