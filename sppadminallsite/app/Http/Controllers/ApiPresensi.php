<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Models\Lokasi;
use App\Models\MMekanik;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
class ApiPresensi extends Controller
{

    public function store(Request $request)
    {
        //cek presensi
        $mekanik=MMekanik::where('userid',$request->idmekanik)->first();
        $idmekanik=$mekanik->id;

        $cekpresensi = Presensi::where('idmekanik', $idmekanik)
            ->where('tanggal', date('Y-m-d'))
            ->first();
        if ($cekpresensi) {
            $presensi = Presensi::where('idmekanik', $idmekanik)
                ->where('tanggal', date('Y-m-d'))
                ->update([
                    'jampulang' => date('H:i'),
                ]);
                $idaction=$presensi->id;
                return $data = [

                        'status' => true,
                        'message' => 'Presensi Sukses ',
                        'idaction' => $idaction

                ];
        } else {
            $presensi = new Presensi();
            $presensi->idmekanik = $idmekanik;
            $presensi->statuspresensi = 'Hadir';
            $presensi->tanggal = date('Y-m-d');
            $presensi->jamdatang = date('H:i');
            $presensi->jampulang = "-";
            $presensi->save();
            $idaction = $presensi->id;
            return $data = [
                'status' => true,
                'message' => 'Presensi Sukses xxx',
                'idaction' => $idaction
            ];
        }

    }

    public function listpresensi($id)
    {
        $bulan= date('m');
        $tahun= date('Y');

        $presensi = Presensi::join('mekanik', 'mekanik.idmekanik', '=', 'presensi.idmekanik')
        ->where('presensi.idmekanik', $id)
        ->whereMonth('tanggal', '=', $bulan)
        ->whereYear('tanggal', '=', $tahun)
        ->orderBy('tanggal', 'desc')
        ->get();
       return Response::json($presensi);
    }

    public function show($id)
    {
        $motor = Presensi::where('idpresensi', $id)->get();
        return Response::json($motor);
    }
    public function delete($id)
    {
        $motor = Presensi::where('idpresensi', $id)->delete();
        return Response::json($motor);
    }

    public function lokasi()
    {
        $lokasi = Lokasi::first();
        $datanya= [
            'lat1' => $lokasi->lat1,
            'lat2' => $lokasi->lat2,
            'long1' => $lokasi->long1,
            'long2' => $lokasi->long2,
        ];
        return $data = [
            'status' => 'success',
            'data' => [$datanya],

        ];



    }

}
