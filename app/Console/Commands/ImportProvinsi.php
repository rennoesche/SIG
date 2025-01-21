<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportProvinsi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-provinsi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dir = storage_path('geojson/provinsi');
        $files = File::allFiles($dir);

        foreach ($files as $file) {
            $data = json_decode(file_get_contents($file), true);
            
            if (!isset($data['features'])) {
                $this->error("File {$file->getFilename()} tidak valid atau tidak memiliki fitur GeoJSON.");
                continue;
            }

            foreach ($data['features'] as $feature) {
                if (isset($feature['properties']['name']) && isset($feature['geometry'])) {
                    $provinsiName = $feature['properties']['name'];

                    DB::table('provinsi')->updateOrInsert(
                        [
                            'nama' => $provinsiName,
                        ],
                        [
                            'geometry' => DB::raw("ST_GeomFromGeoJSON('" . json_encode($feature['geometry']) . "')"),
                            'latitude' => $feature['properties']['latitude'],
                            'longitude' => $feature['properties']['longitude'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                    );
                    $this->info("Data kabupaten/kota '{$provinsiName}' berhasil diproses.");
                }
            }
        }

    }
}
