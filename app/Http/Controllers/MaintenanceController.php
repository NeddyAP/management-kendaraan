<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $maintenances = Maintenance::all();

        $belanjas = Belanja::all();
        
        $maintenances->each(function ($maintenance) use ($belanjas) {
            $belanja = $belanjas->where('nomor_registrasi', $maintenance->nomor_registrasi)->first();
            
            if ($belanja) {
            $maintenance->update([
                'belanja_bahan_bakar_minyak' => $maintenance->belanja_bahan_bakar_minyak + ($belanja->belanja_bahan_bakar_minyak ?? 0),
                'belanja_pelumas_mesin' => $maintenance->belanja_pelumas_mesin + ($belanja->belanja_pelumas_mesin ?? 0),
                'belanja_suku_cadang' => $maintenance->belanja_suku_cadang + ($belanja->belanja_suku_cadang ?? 0),
                'keterangan' => $maintenance->keterangan . ' ' . $belanja->keterangan,
            ]);
            }
        });

        $maintenances = Maintenance::with(['unitKerja', 'kendaraan'])
            ->select('tbl_maintenance.*', 'tbl_kendaraan.berlaku_sampai', 'tbl_unit_kerja.nama_unit_kerja')
            ->join('tbl_unit_kerja', 'tbl_maintenance.unit_kerja', '=', 'tbl_unit_kerja.id')
            ->join('tbl_kendaraan', 'tbl_maintenance.nomor_registrasi', '=', 'tbl_kendaraan.nomor_registrasi')
            ->get()
            ->map(function ($maintenance) {
                $maintenance->berlaku_sampai = Carbon::createFromFormat('d/m/Y', $maintenance->berlaku_sampai)->format('Y-m-d');
                return $maintenance;
            });
        

        $expireDate = $maintenances->filter(function ($maintenance) {
            return Carbon::parse($maintenance->berlaku_sampai)->lt(Carbon::today());
        });

        return view('maintenance.index', compact('maintenances', 'expireDate'));
    }

    public function getBelanjaDetails($nomor_registrasi)
    {
        $belanjas = Belanja::where('nomor_registrasi', $nomor_registrasi)->get()->map(function ($belanja) {
            if (!is_null($belanja->tanggal_belanja)) {
                $belanja->tanggal_belanja = Carbon::parse($belanja->tanggal_belanja)->format('d/m/Y');
            }
            return $belanja;
        });
        return response()->json($belanjas);
    }
}
