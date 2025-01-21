@extends('welcome')

@section('content')
<div id='map'></div>

<script>
        var map = L.map('map',{ zoomControl: false }).setView([4.195, 96.798], 8);
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> | <a href="https://sulsel.bps.go.id/id/statistics-table/2/ODMjMg==/jumlah-penduduk-menurut-kabupaten-kota" target="_blank">BPS Sulawesi Selatan</a>'
        }).addTo(map);

        var meow = @json($desa);

        function getColor(d) {
            return d > 700 ? '#800026' :
                d > 600  ? '#BD0026' :
                d > 500  ? '#E31A1C' :
                d > 400  ? '#FC4E2A' :
                d > 300   ? '#FD8D3C' :
                d > 200   ? '#FEB24C' :
                d > 100   ? '#FED976' :
                                        '#FFEDA0';
        }

        function style(f) {
            return {
                fillColor: getColor(f.d),
                weight: 1,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 0.7
            };
        }
        meow.forEach(function (data) {
            var geo = JSON.parse(data.geometry);
            var desa = JSON.parse(data.desa);
            if (geo.type == 'MultiPolygon' || geo.type == 'Polygon') {
                var popup = `<b>` + data.nama + `</b><br>` + data.desa + ` desa`;
                L.geoJSON(geo, {
                    style: function(f) {
                        f = { ...f, d: desa };
                        return style(f);
                    }
                }).addTo(map).bindPopup(popup);
            } 
        });

        var legend = L.control({ position: 'bottomleft' });

        legend.onAdd = function (map) {
            var div = L.DomUtil.create('div', 'info legend p-4 bg-white rounded shadow');
            var grades = [0, 100, 200, 300, 400, 500, 600];
            var labels = [];
            let from, to;

            labels.push('<b>Jumlah Desa/kelurahan</b>');

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