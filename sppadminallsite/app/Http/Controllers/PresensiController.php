<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\User;
use App\Models\MMekanik;
use App\Models\MDokumenpresensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PresensiController extends Controller
{
    public function index()
    {
        if (request()->get('tanggal') != null) {
            $presensis = Presensi::where('tanggal',request()->get('tanggal'))->get();
            return view('presensi.index', ['presensis' => $presensis]);
        }
        else {
            $presensis = Presensi::where('tanggal', date('Y-m-d'))->get();
            return view('presensi.index', ['presensis' => $presensis]);
        }
    }

    public function add()
    {
        $mekanik=MMekanik::orderBy('namamekanik')->get();
        return view('presensi.add',compact('mekanik'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'idmekanik' => 'required',
            'statuspresensi' => 'required',
        ]);

        //cek presensi
        $cekpresensi = Presensi::where('idmekanik', $request->idmekanik)
            ->where('tanggal', date('Y-m-d'))
            ->first();
        if ($cekpresensi) {
            $presensi=Presensi::where('idmekanik', $request->idmekanik)
                ->where('tanggal', date('Y-m-d'))
                ->update([
                    'jampulang' => date('H:i'),
                ]);
                return redirect()->route('presensi.index')
                ->with(['success' => 'presensi sukses disimpan']);
        }
        else {
            $presensi = new presensi();
            $presensi->idmekanik = $request->idmekanik;
            $presensi->statuspresensi = $request->statuspresensi;
            $presensi->tanggal = date('Y-m-d');
            $presensi->jamdatang = date('H:i');
            $presensi->jampulang = "-";

            $simpan=$presensi->save();

            if ($simpan) {
                return redirect()->route('presensi.index')
                    ->with(['success' => 'presensi sukses disimpan']);
            } else {
                return redirect()->route('presensi.index')
                    ->with(['success', 'ada kesalahan simpan, coba beberapa saat lagi']);
            }
        }


    }

    public function edit($id)
    {
        $presensi = Presensi::where('id', $id)->first();
        return view('presensi.edit', ['presensi' => $presensi]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'statuspresensi' => 'required',
        ]);

        $simpan = Presensi::where('idpresensi', $request->idpresensi)->update([
            'statuspresensi' => $request->statuspresensi,
        ]);

        if ($simpan) {
            return redirect()->route('presensi.index')
                ->with(['success' => 'presensi sukses diubah']);
        } else {
            return redirect()->route('presensi.index')
                ->with(['success', 'ada kesalahan simpan, coba beberapa saat lagi']);
        } //
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $data=MDokumenpresensi::where('idaction', '=', $id)->first();
        $file=$data->filename;
        $path = public_path().'/assets/inventory/'.$file;
        unlink($path);
        Presensi::where('id', '=', $id)->delete();
        return redirect()->back(); //
    }

}
