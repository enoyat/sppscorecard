<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MDelivery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;

class DeliveryController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $delivery = MDelivery::get();
        return view('delivery.index', compact('delivery'));
    }
    public function create()
    {
        $cbu=MCbu::get();
        return view('delivery.create',compact('cbu'));
    }
    public function store(Request $request)
    {


        $request->validate(
            [
                'serialnumber'    => 'required|min:5',
            ],
            [
                'serialnumber.required'   => 'serialnumber tidak boleh kosong',

            ]
        );
        $cekdelivery = MDelivery::where('kddelivery', $request->kddelivery)->count();
        if ($cekdelivery > 0) {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "ada kesalahan data!"
            ], 200);

            return redirect()->back()->withInput();
        }

        $delivery = new MDelivery;
        $delivery->idcbu = $request->idcbu;
        $delivery->idregion = $request->idregion;
        $delivery->idsitename = $request->idsitename;
        $delivery->serialnumber = $request->serialnumber;
        $delivery->idforklifttype = $request->idforklifttype;
        $delivery->capacity = $request->capacity;
        $delivery->masheight  = $request->masheight;
        $delivery->dateestimated = $request->dateestimated;
        $delivery->reason = $request->reason;
        $delivery->mitigationplan  = $request->mitigationplan;
        $delivery->dateactual  = $request->dateactual;
        $delivery->confirmationplan  = $request->confirmationplan;
        $delivery->statusspp  = $request->statusspp;
        $delivery->statuscustomer   = $request->statuscustomer;        
        $simpan = $delivery->save();

        if ($simpan) {
            Session::flash('message', 'Delivery save successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Password updated successfully!"
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!"
            ], 200); // Status code here
        }
    }
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            MDelivery::where('id', '=', $id)->delete();
            return response()->json([
                'isSuccess' => true,
                'Message' => "Delete success!"
            ], 200);
            return redirect()->route('delivery.index');
        } catch (QueryException $ex) {
            return response()->json([
                'isSuccess' => true,
                'Message' => "Delete fail!"
            ], 200);
            return redirect()->route('delivery.index');
        }
    }
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }
}
