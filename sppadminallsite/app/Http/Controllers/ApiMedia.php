<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\MDokumen;
use App\Models\MDokumenmaintenance;
use App\Models\MDokumentrouble;
use App\Models\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ApiMedia extends Controller
{
    public function store(Request $request)
    {
        // $file =  $request->filegambar;
        $file =  $request->file('image');
        $pathUpload = 'assets/inventory';

        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;

        $resizedImage = Image::make($file)->resize(600, 600, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });




	$resizedImage->save($pathUpload . '/' . $filename);


        if ($request->transaksi == "trouble") {
            MDokumentrouble::create([
                'idaction' => $request->idaction,
                'filename' => $filename,
                'keterangan' => $request->keterangan,

            ]);
        }
        if ($request->transaksi == "maintenance") {
            MDokumenmaintenance::create([
                'idaction' => $request->idaction,
                'filename' => $filename,
                'keterangan' => $request->keterangan,

            ]);
        }
        return $filename;
    }
}
