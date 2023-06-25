<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\MDokumenmaintenance;
use App\Models\MMaintenance;
use App\Models\MMaintenanceaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class ApiMaintenance extends Controller
{
    public function listof($idsitename)
    {
        $maintenance = MMaintenance::where('idsitename',$idsitename)
        ->join('sitename','sitename.id','=','listofmaintenance.idsitename')
        ->join('region','region.id','=','sitename.idregion')    
        ->join('cbu','cbu.id','=','region.idcbu')
        ->where('statusspp','!=','CLOSE')
        ->select('listofmaintenance.*','sitename.namasitename','region.namaregion','cbu.namacbu')
        ->orderby('id','desc')        
        ->get();
        return Response::json($maintenance);
    }
    public function getmaintenance($id)
    {
        $maintenance = MMaintenance::where('listofmaintenance.id',$id)
        ->join('sitename','sitename.id','=','listofmaintenance.idsitename')
        ->join('region','region.id','=','sitename.idregion')    
        ->join('cbu','cbu.id','=','region.idcbu')
        ->where('statuscustomer','!=','close')
        ->select('listofmaintenance.*','sitename.namasitename','region.namaregion','cbu.namacbu')
        ->orderby('id','desc')        
        ->get();
        return Response::json($maintenance);
    }
    public function uploadgallery(Request $request)
    {
        $file = $request->filefoto;
        $pathUpload = 'assets/inventory';

        $extension = $file->getClientOriginalExtension();
        $filename = time() . "." . $extension;
        $file->move($pathUpload, $filename);
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $MMaintenanceaction = New MMaintenanceaction();
        $MMaintenanceaction->idmaintenance = $request->idmaintenance;
        $MMaintenanceaction->iduser = $request->iduser;
        $MMaintenanceaction->tanggalmulai = date("y-m-d", strtotime($request->tanggalmulai));
        $MMaintenanceaction->tanggalakhir = date("y-m-d", strtotime($request->waktuselesaipengerjaan));
        $MMaintenanceaction->shift = $request->shift;
        $MMaintenanceaction->actionplan = $request->deskripsi;
        $MMaintenanceaction->sparepart = $request->sparepart;
        $MMaintenanceaction->hm = $request->hm;

        $MMaintenanceaction->save();
        
        $MMaintenance = MMaintenance::where('id',$request->idmaintenance)->first();
        $MMaintenance->statusmekanik = $request->statusmekanik;
        $MMaintenance->tanggal = date("y-m-d", strtotime($request->waktuselesaipengerjaan));
        $MMaintenance->hm = $request->hm;
        $MMaintenance->save();
        $id = $MMaintenance->id;


        return  Response::json($MMaintenance);
    }
    public function listdokumen($id)
    {
        $maintenance = MDokumenmaintenance::where('idmaintenance',$id)
        ->get();
        return Response::json($maintenance);
    }
}
