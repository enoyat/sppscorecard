<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\MDokumentrouble;
use App\Models\MTrouble;
use App\Models\MTroubleaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class ApiTrouble extends Controller
{
    public function listoftrouble($idsitename)
    {
        $trouble = MTrouble::where('idsitename',$idsitename)
        ->join('sitename','sitename.id','=','listoftrouble.idsitename')
        ->join('region','region.id','=','sitename.idregion')    
        ->join('cbu','cbu.id','=','region.idcbu')
        ->where('statusspp','!=','CLOSE')
        ->select('listoftrouble.*','sitename.namasitename','region.namaregion','cbu.namacbu')
        ->orderby('id','desc')        
        ->get();
        return Response::json($trouble);
    }
    public function gettrouble($id)
    {
        $trouble = MTrouble::where('listoftrouble.id',$id)
        ->join('sitename','sitename.id','=','listoftrouble.idsitename')
        ->join('region','region.id','=','sitename.idregion')    
        ->join('cbu','cbu.id','=','region.idcbu')
        ->where('statuscustomer','!=','close')
        ->select('listoftrouble.*','sitename.namasitename','region.namaregion','cbu.namacbu')
        ->orderby('id','desc')        
        ->get();
        return Response::json($trouble);
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
        $Mtroubleaction = New MTroubleaction();
        $Mtroubleaction->idtrouble = $request->idtrouble;
        $Mtroubleaction->iduser = $request->iduser;
         $Mtroubleaction->tanggalmulai = date("y-m-d", strtotime($request->tanggalmulai));
        $Mtroubleaction->tanggalakhir = date("y-m-d", strtotime($request->waktuselesaipengerjaan));
        $Mtroubleaction->shift = $request->shift;
        $Mtroubleaction->actionplan = $request->deskripsi;
        $Mtroubleaction->sparepart = $request->sparepart;
        $Mtroubleaction->save();
        
        $MTrouble = MTrouble::where('id',$request->idtrouble)->first();
        $MTrouble->statusmekanik = $request->statusmekanik;
        $MTrouble->actionplanspp = $request->deskripsi;
        $MTrouble->documentation = $request->documentation;
        $MTrouble->actualcompletedate = date("y-m-d", strtotime($request->waktuselesaipengerjaan));
        $MTrouble->save();
        $id = $MTrouble->id;


        return  Response::json($MTrouble);
    }
    public function listdokumen($id)
    {
        $trouble = MDokumentrouble::where('idtrouble',$id)
        ->get();
        return Response::json($trouble);
    }
}
