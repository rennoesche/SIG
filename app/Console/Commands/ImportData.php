<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-data';

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
        $path = storage_path('geojson/data.json');
        if (!File::exists($path)) {
            $this->error("File not found: {$path}");
            return 1;
        }

        $data = json_decode(File::get($path), true);
        if (json_last_error() !== JSON_ERROR_NONE)
        {
            $this->error("Invalid JSON data in file: {$path}");
            return 1;
        }

        foreach ($data as $d)
        {
            $kota = strtoupper($d['kota']);
            $_kota = DB::table('kabkota')->where(DB::raw('UPPER(nama)'), $kota)->first();

            if ($_kota) {
                DB::table('kabkota')->where('id', $_kota->id)->update([
                    'populasi' => $d['populasi'],
                    'kodepos' => $d['pos'],
                    'kecamatan' => $d['kecamatan'],
                    'desa' => $d['desa'],
                    'islam' => $d['islam'],
                    'kristen' => $d['kristen'],
                    'katolik' => $d['katolik'],
                    'hindu' => $d['hindu'],
                    'pk_petani' => $d['tani'],
                    'pk_nelayan' => $d['layan'],
                    'pk_pedagang' => $d['dagang'],
                    'pk_asn' => $d['asn'],
                    'updated_at' => now(),
                ]);
                $this->info("Updated data for kota: {$d['kota']}");
            } else {
                $this->warn("Tidak ada kota yang sama dengan: {$d['kota']}");
            }
        }

        return 0;
    }
}
