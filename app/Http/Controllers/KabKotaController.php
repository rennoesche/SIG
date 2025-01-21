<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KabKotaController extends Controller
{
    public function provinsi()
    {
        $provinsi = DB::table('provinsi')->select( 'nama',DB::raw('ST_AsGeoJSON(geometry) as geometry'), 'populasi')->get();
        $kabkota = DB::table('kabkota')->select('populasi')->get();
        return view('pages.home', compact(['provinsi','kabkota']));
    }
    
    public function populasi()
    {
        $kabkota = DB::table('kabkota')->select( 'nama',DB::raw('ST_AsGeoJSON(geometry) as geometry'), 'populasi')->get();
        return view('pages.kabkota', compact('kabkota'));
    }
    
    public function agama()
    {
        $agama = DB::table('kabkota')->select( 'nama',DB::raw('ST_AsGeoJSON(geometry) as geometry'), 'islam', 'kristen', 'katolik', 'hindu')->get();
        return view('pages.agama', compact('agama'));
    }
    public function pekerjaan()
    {
        $pekerjaan = DB::table('kabkota')->select( 'nama',DB::raw('ST_AsGeoJSON(geometry) as geometry'), 'pk_petani', 'pk_nelayan', 'pk_pedagang', 'pk_asn')->get();
        return view('pages.pekerjaan', compact('pekerjaan'));
    }
    public function kecamatan() 
    {
        $kecamatan = DB::table('kabkota')->select( 'nama',DB::raw('ST_AsGeoJSON(geometry) as geometry'), 'kecamatan')->get();
        return view('pages.kecamatan', compact('kecamatan'));
    }
    public function desa() 
    {
        $desa = DB::table('kabkota')->select( 'nama',DB::raw('ST_AsGeoJSON(geometry) as geometry'), 'desa')->get();
        return view('pages.desa', compact('desa'));
    }
}
