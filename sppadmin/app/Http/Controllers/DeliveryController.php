<?php

namespace App\Http\Controllers;

use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;



use App\Models\MDelivery;
use App\Models\MForklifttype;
use App\Models\User;
use App\Models\MSitename;
class DeliveryController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $delivery = MDelivery::where('idsitename',Session::get('runidsitename'))->get();
        $sitename=MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $forklifttype = MForklifttype::get();
        return view('delivery.index', compact('delivery','forklifttype','cbu','sitename'));
    }
    public function create()
    {
        if(Session::get('roles_id')==2) {
            $cbu=MCbu::where('id',Session::get('runidcbu'))->get();
        } else {
            $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        }
        $forklifttype = MForklifttype::get();
        return view('delivery.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $forklifttype = MForklifttype::get();
        $delivery = MDelivery::find($id);
        return view('delivery.edit',compact('cbu','forklifttype','delivery'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required',
            'idsitename'=>'required',
            'serialnumber'=>'required',
            'idforklifttype'=>'required',
            'capacity'=>'required',
            'masheight'=>'required',
            'dateestimated'=>'required',
            'statusspp'=>'required',

        ]);



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
        $delivery->daterequest = $request->daterequest;
        $delivery->ponumber  = $request->ponumber;
        $delivery->daysoflapse  = $request->daysoflapse;

        $delivery->dateactual  = $request->dateactual;

        $delivery->statusspp  = $request->statusspp;
        $delivery->statuscustomer   = "OPEN";
        $simpan = $delivery->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('delivery.index');

        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!"
            ], 200); // Status code here
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required',
            'idsitename'=>'required',
            'serialnumber'=>'required',
            'idforklifttype'=>'required',
            'capacity'=>'required',
            'masheight'=>'required',
            'dateestimated'=>'required',
            'statusspp'=>'required',
        ]);



        $delivery = MDelivery::find($id);
        $delivery->idcbu = $request->idcbu;
        $delivery->idregion = $request->idregion;
        $delivery->idsitename = $request->idsitename;
        $delivery->serialnumber = $request->serialnumber;
        $delivery->idforklifttype = $request->idforklifttype;
        $delivery->capacity = $request->capacity;
        $delivery->masheight  = $request->masheight;
        $delivery->dateestimated = $request->dateestimated;
        $delivery->reason = $request->reason;
        $delivery->daterequest = $request->daterequest;
        $delivery->ponumber  = $request->ponumber;
        $delivery->daysoflapse  = $request->daysoflapse;

        $delivery->dateactual  = $request->dateactual;

        $delivery->statusspp  = $request->statusspp;
        $simpan = $delivery->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('delivery.index');

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

            return redirect()->route('delivery.index');
        } catch (QueryException $ex) {
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

    public function formstatus(Request $request)
    {
        $id = $request->id;
        $aid = $request->aid;
        if($request->aid == 'spp'){
            $delivery = MDelivery::find($id);
            return view('delivery.formstatus', compact('delivery','aid'));
        }
        else {
            $delivery = MDelivery::find($id);
            return view('delivery.formstatuscustomer', compact('delivery','aid'));
        }

    }
    public function updatestatus(Request $request)
    {

        $id = $request->id;
        $aid = $request->aid;
        if($request->aid == 'spp'){
            $request->validate([
                'statusspp'=>'required',
            ]);
            $statusspp = $request->statusspp;
            $delivery = MDelivery::find($id);
            $delivery->statusspp = $statusspp;
            $delivery->save();
        }
        else {
            $request->validate([
                'statuscustomer'=>'required',
            ]);
            $statuscustomer = $request->statuscustomer;

            $delivery = MDelivery::find($id);
            $delivery->statuscustomer = $statuscustomer;
            $delivery->remarkplan = $request->remarkplan;
            $delivery->save();
        }

        return redirect()->route('delivery.index');
    }

}
