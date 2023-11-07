<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\MDetailorder;
use App\Models\MDokumentrouble;
use App\Models\MOrder;
use App\Models\MTrouble;
use App\Models\MTroubleaction;
use App\Models\MSparepart;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class ApiSparepart extends Controller
{
    public function index()
    {
        $trouble = MSparepart::all();
        return Response::json($trouble);
    }

    public function store(Request $request)
    {
        
         
        $order = new MOrder();
        $order->iduser = $request->iduser;
        $order->kdunit = $request->kdunit;   
        $order->idsitename = $request->idsitename;
        $order->dateorder = Carbon::now();
        $order->save();
        $noorder = $order->noorder;
        foreach($request->itemorder as $cart){
            $detailorder = MDetailorder::create([
                'noorder' => $noorder,
                'description' => $cart['partname'],
                'qty' => $cart['partqty'],
            ]);
        }
       

        return $data = [
            'noorder' => $noorder,
        ];


    }

    public function listsparepart($id)
    {
        $trouble = MSparepart::where('codepart',$id)
        ->get();
        return Response::json($trouble);
    }
    public function searchsparepart($id)
    {
        $sparepart = MSparepart::where('simplename','like','%'.$id.'%')
        ->get();
        return Response::json($sparepart);
    }
}
