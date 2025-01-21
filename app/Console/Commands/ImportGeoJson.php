<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ImportGeoJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-kabkota';

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
        $dir = storage_path('geojson/kabkota');
        $files = File::allFiles($dir);
    
        $province = DB::table('provinsi')->where('nama', 'Aceh')->first();
    
        if (!$province) {
            $this->error("Provinsi 'Aceh' tidak ditemukan di database.");
            return;
        }
    
        foreach ($files as $file) {
            $data = json_decode(file_get_contents($file), true);
    
            if (!isset($data['features'])) {
                $this->error("File {$file->getFilename()} tidak valid atau tidak memiliki fitur GeoJSON.");
                continue;
            }
    
            foreach ($data['features'] as $feature) {
                if (isset($feature['properties']['name']) && isset($feature['geometry'])) {
                    $kabkotaName = $feature['properties']['name'];
    
                    DB::table('kabkota')->updateOrInsert(
                        [
                            'nama' => $kabkotaName, 
                            'provinsi_id' => $province->id,
                        ],
                        [
                            'geometry' => DB::raw("ST_GeomFromGeoJSON('" . json_encode($feature['geometry']) . "')"),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
    
                    $this->info("Data kabupaten/kota '{$kabkotaName}' berhasil diproses.");
                }
            }
        }
    }
    
}