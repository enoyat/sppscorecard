<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\MOrder;
use App\Models\MSitename;
use App\Models\MCbu;
use App\Models\MSparepart;
use App\Models\MDetailorder;
use App\Models\MUser;
use Carbon\Carbon;

class OrderController extends Controller
{
    //
    public function index()
    {
        $sitename=MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $orders= MOrder::where('f_status',"!=","close")->get();
        return view('orders.index', compact('orders','cbu','sitename'));
    }
    public function history()
    {
        $sitename=MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $orders= MOrder::status("close")->get();
        return view('orders.index', compact('orders','cbu','sitename'));
    }
    public function accsite(Request $request)
    {
        if ($request->f_status== "order") {
            $orders = MOrder::find($request->id);
            $orders->f_accsite = '1';
            $orders->dateaccsite = Carbon::now();
            $orders->f_status = "accsite";
            $orders->save();
        }
        elseif ($request->f_status== "accsite") {
            $orders = MOrder::find($request->id);
            $orders->f_accho = '1';
            $orders->dateaccho = Carbon::now();
            $orders->f_status = "accho";
            $orders->save();
        }
        elseif ($request->f_status== "accho") {
            $orders = MOrder::find($request->id);
            $orders->f_accgudang = '1';
            $orders->dateaccgudang = Carbon::now();
            $orders->f_status = "close";
            $orders->save();
        }

        return redirect()->back();
    }
    public function docorder($id)
    {
        $orders = MOrder::with('getdetailorder')
        ->where('noorder',$id)
        ->get();
        return view('orders.docorder', compact('orders'));
    }
}
