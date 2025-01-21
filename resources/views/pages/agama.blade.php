@extends('welcome')

@section('content')
<div id='map'>
</div>

<script>
        var map = L.map('map', { zoomControl: false }).setView([4.195, 96.798], 8);
        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright" target="_blank">OpenStreetMap</a> | <a href="https://sulsel.bps.go.id/id/statistics-table/2/ODMjMg==/jumlah-penduduk-menurut-kabupaten-kota" target="_blank">BPS Sulawesi Selatan</a>'
        }).addTo(map);

        var meow = @json($agama);

        meow.forEach(function (data) {
            var geo = JSON.parse(data.geometry);
            if (geo.type == 'MultiPolygon' || geo.type == 'Polygon') {
                var popup = `
                    <div style="font-size: 14px;">
                        <b>${data.nama}</b><br>
                        <table style="mt-2">
                            <tr><td>Islam</td><td>: ${data.islam} jiwa</td></tr>
                            <tr><td>Kristen</td><td>: ${data.kristen} jiwa</td></tr>
                            <tr><td>Katolik</td><td>: ${data.katolik} jiwa</td></tr>
                            <tr><td>Hindu</td><td>: ${data.hindu} jiwa</td></tr>
                        </table>
                    </div>`;
                const total = data.islam + data.kristen + data.katolik + data.hindu;

                if (!total || data.islam == null) {
                    L.geoJSON(geo, {
                    style: {
                        fillColor: 'blue', 
                        weight: 0.2,
                        opacity: 1,
                        color: '#000',
                        fillOpacity: 0.7,
                    }
                }).addTo(map).bindPopup(popup);
                    return;
                }
                const islam = (data.islam / total) * 100;

                function getColor(percentage) {
                    if (percentage <= 20) {
                        const red = 255;
                        const green = Math.floor((percentage / 20) * 165);
                        return `rgb(${red}, ${green}, 0)`;
                    } else if (percentage <= 40) {
                        const red = Math.floor(255 - ((percentage - 20) / 20) * 90); 
                        const green = 165 + Math.floor(((percentage - 20) / 20) * 90);
                        return `rgb(${red}, ${green}, 0)`;
                    } else if (percentage <= 60) {
                        const red = Math.floor(165 - ((percentage - 40) / 20) * 165);
                        const green = 255;
                        return `rgb(${red}, ${green}, 0)`;
                    } else if (percentage <= 80) {
                        const red = Math.floor(((percentage - 60) / 20) * 255);
                        const green = 255;
                        const blue = Math.floor(((percentage - 60) / 20) * 255);
                        return `rgb(${red}, ${green}, ${blue})`;
                    } else {
                        return 'rgb(199, 199, 199)';
                    }
                }

                L.geoJSON(geo, {
                    style: {
                        fillColor: getColor(islam), 
                        weight: 1,
                        opacity: 1,
                        color: '#000',
                        fillOpacity: 0.7,
                    }
                }).addTo(map).bindPopup(popup);
            } 
        });
        const legend = L.control({ position: 'bottomleft' });

        legend.onAdd = function (map) {
            const div = L.DomUtil.create('div', 'info legend p-4 bg-white rounded-lg');
            const grades = [0, 20, 40, 60, 80]; 
            const labels = [];
            let from, to;
            function getColor(percentage) {
                    if (percentage <= 20) {
                        const red = 255;
                        const green = Math.floor((percentage / 20) * 165);
                        return `rgb(${red}, ${green}, 0)`;
                    } else if (percentage <= 40) {
                        const red = Math.floor(255 - ((percentage - 20) / 20) * 90); 
                        const green = 165 + Math.floor(((percentage - 20) / 20) * 90);
                        return `rgb(${red}, ${green}, 0)`;
                    } else if (percentage <= 60) {
                        const red = Math.floor(165 - ((percentage - 40) / 20) * 165);
                        const green = 255;
                        return `rgb(${red}, ${green}, 0)`;
                    } else if (percentage <= 80) {
                        const red = Math.floor(((percentage - 60) / 20) * 255);
                        const green = 255;
                        const blue = Math.floor(((percentage - 60) / 20) * 255);
                        return `rgb(${red}, ${green}, ${blue})`;
                    } else {
                        return 'rgb(199, 199, 199)';
                    }
                }

            labels.push(`<b>Persentase agama islam</b><br>`);
            for (let i = 0; i < grades.length; i++) {
                from = grades[i];
                to = grades[i + 1];

                labels.push(
                    `<i style="background:${getColor(from + 1)}; width: 20px; height: 20px; display: inline-block; margin-right: 8px;"></i> 
                    ${from}${to && to !== 100 ? `&ndash;${to}` : '+'}`
                );
            }

            labels.push(
                `<i style="background:#0000FF; width: 20px; height: 20px; display: inline-block; margin-right: 8px;"></i> Tidak Ada Data`
            );

            div.innerHTML = labels.join('<br>'); 
            return div;
        };

        legend.addTo(map);

</script>
@endsection