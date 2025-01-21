@extends('welcome')

@section('content')
<div id='map'></div>

<script>
        var map = L.map('map',{ zoomControl: false }).setView([4.195, 96.798], 8);
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> | <a href="https://sulsel.bps.go.id/id/statistics-table/2/ODMjMg==/jumlah-penduduk-menurut-kabupaten-kota" target="_blank">BPS Sulawesi Selatan</a>'
        }).addTo(map);

        var meow = @json($kecamatan);

        function getColor(d) {
            return d > 28 ? '#800026' :
                d > 24  ? '#BD0026' :
                d > 20  ? '#E31A1C' :
                d > 16  ? '#FC4E2A' :
                d > 12   ? '#FD8D3C' :
                d > 8   ? '#FEB24C' :
                d > 4   ? '#FED976' :
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
            var kecamatan = JSON.parse(data.kecamatan);
            if (geo.type == 'MultiPolygon' || geo.type == 'Polygon') {
                var popup = `<b>` + data.nama + `</b><br>` + data.kecamatan + ` kecamatan`;
                L.geoJSON(geo, {
                    style: function(f) {
                        f = { ...f, d: kecamatan };
                        return style(f);
                    }
                }).addTo(map).bindPopup(popup);
            } 
        });

        var legend = L.control({ position: 'bottomleft' });

        legend.onAdd = function (map) {
            var div = L.DomUtil.create('div', 'info legend p-4 bg-white rounded shadow');
            var grades = [0, 4, 8, 12, 16, 20, 24];
            var labels = [];
            let from, to;

            labels.push('<b>Jumlah Kecamatan/distrik</b>');

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