@extends('welcome')

@section('content')
<div id='map'></div>

<script src="
https://cdn.jsdelivr.net/npm/@turf/turf@7.2.0/turf.min.js
"></script>
<script>
        var map = L.map('map',{ zoomControl: false }).setView([4.195, 96.798], 8);
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> | <a href="https://sulsel.bps.go.id/id/statistics-table/2/ODMjMg==/jumlah-penduduk-menurut-kabupaten-kota" target="_blank">BPS Sulawesi Selatan</a>'
        }).addTo(map);

        var meow = @json($pekerjaan);

        console.log(meow);

        function genPoint(polygon, count) {
            const points = [];
            for (let i = 0; i < count; i++) {
                const point = turf.randomPoint(1, { bbox: turf.bbox(polygon) }).features[0];
                if (turf.booleanPointInPolygon(point, polygon)) {
                    points.push(point);
                }
            }
            return points;
        }
        
        meow.forEach(function (data) {
        const geo = JSON.parse(data.geometry); 
        const pekerjaan = {
            petani: { count: Math.floor(JSON.parse(data.pk_petani) / 100), color: '#4CAF50' }, 
            nelayan: { count: Math.floor(JSON.parse(data.pk_nelayan) / 100), color: '#2196F3' },
            pedagang: { count: Math.floor(JSON.parse(data.pk_pedagang) / 100), color: '#FFEB3B' },
            asn: { count: Math.floor(JSON.parse(data.pk_asn) / 100), color: '#F44336' }
        };

        L.geoJSON(geo, {
            style: {
                color: 'white',
                weight: 2,
                fillOpacity: 0.5
            }
        }).addTo(map);

        Object.keys(pekerjaan).forEach(type => {
            const { count, color } = pekerjaan[type];
            const points = genPoint(geo, count); 

            points.forEach(point => {
                L.circleMarker([point.geometry.coordinates[1], point.geometry.coordinates[0]], {
                    radius: 4,
                    fillColor: color,
                    color: color,
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                }).addTo(map).bindPopup(`
                    <b>${data.nama}</b><br>
                    Jenis: ${type.charAt(0).toUpperCase() + type.slice(1)}<br>
                    Jumlah: ${data[type]}
                `);
            });
        });
    });

    const legend = L.control({ position: 'bottomleft' });
    const epic = L.control({ position: 'bottomright' });

    epic.onAdd = function (map) {
        const div = L.DomUtil.create('div', 'info p-4 bg-white/30 rounded-lg ');
        div.innerHTML = `
            <span class="opacity-100">Setiap titik mewakili 100 pekerja dari jenis pekerjaan.</span>
        `;
        return div;
    }

    epic.addTo(map);

    legend.onAdd = function (map) {
        const div = L.DomUtil.create('div', 'info legend p-4 bg-white rounded-lg shadow');
        div.innerHTML = `
            <b>Legenda</b><br><br>
            <i style="background:#4CAF50; width: 20px; height: 20px; display: inline-block;"></i> Petani<br>
            <i style="background:#2196F3; width: 20px; height: 20px; display: inline-block;"></i> Nelayan<br>
            <i style="background:#FFEB3B; width: 20px; height: 20px; display: inline-block;"></i> Pedagang<br>
            <i style="background:#F44336; width: 20px; height: 20px; display: inline-block;"></i> ASN<br>
        `;
        return div;
    };

    legend.addTo(map);


</script>
@endsection