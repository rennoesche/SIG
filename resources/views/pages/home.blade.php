@extends('welcome')

@section('content')
<div id='map'></div>

<script>
        var map = L.map('map',{ zoomControl: false }).setView([4.195, 96.798], 8);
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> | <a href="https://sulsel.bps.go.id/id/statistics-table/2/ODMjMg==/jumlah-penduduk-menurut-kabupaten-kota" target="_blank">BPS Sulawesi Selatan</a>'
        }).addTo(map);

        var meow = @json($provinsi);
        var meng = @json($kabkota);

        var totalPopulation = 0;
        meng.forEach(function(data) {
            totalPopulation += data.populasi;
        });
        console.log('Total Population:', totalPopulation);

        meow.forEach(function (data) {
            var geo = JSON.parse(data.geometry);
            if (geo.type == 'MultiPolygon') {
                var popup = `<b>` + data.nama + `</b><br>Populasi: ` + totalPopulation + ` jiwa`;
                L.geoJSON(geo, {
                    style: {
                        fillColor: 'blue',
                        weight: 1,
                        opacity: 1,
                    }
                }).addTo(map).bindPopup(popup);
            } else {
                L.geoJSON(geo).addTo(map);
            }
        });
        
</script>
@endsection