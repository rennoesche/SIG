<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportGeoJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-geo-json';

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
        $dir = storage_path('geojson');
        $file = File::allFiles($dir);

        foreach ($file as $f){
            $data = json_decode(file_get_contents($f), true);

            foreach ($data['features'] as $feature){
                DB::table('provinsis')
                    ->updateOrInsert([
                        'name' => $feature['properties']['name'],
                        'boundary' => DB::raw("ST_GeomFromGeoJSON('".json_encode($feature['geometry'])."')"),
                        'latitude' => $feature['properties']['latitude'],
                        'longitude' => $feature['properties']['longitude'],
                    ]);
            }
        }

        $dirx = storage_path('data');
        $files = File::allFiles($dirx);

        foreach ($files as $file) {
            $datas = json_decode(file_get_contents($file), true);
        
            foreach ($datas['features'] as $features) {
                $name = strtolower($features['properties']['provinsi']);
                $existingRecord = DB::table('provinsis')
                    ->whereRaw('LOWER(name) = ?', [$name])
                    ->first();
        
                if ($existingRecord) {
                    DB::table('provinsis')
                        ->where('id', $existingRecord->id)
                        ->update([
                            'pendidikan_s1' => $features['properties']['lulusan_s1'],
                            'gdp' => $features['properties']['PDRB_2023'],
                            'penduduk_miskin' => $features['properties']['persentase_penduduk_miskin'],
                            'population' => $features['properties']['populasi'],
                            'luas' => $features['properties']['luas_km2']
                        ]);
                } else {
                    DB::table('provinsis')
                        ->insert([
                            'name' => $features['properties']['provinsi'],
                            'pendidikan_s1' => $features['properties']['lulusan_s1'],
                            'gdp' => $features['properties']['PDRB_2023'],
                            'penduduk_miskin' => $features['properties']['persentase_penduduk_miskin'],
                            'population' => $features['properties']['populasi'],
                            'luas' => $features['properties']['luas_km2']
                        ]);
                }
            }
        }
    }
}
