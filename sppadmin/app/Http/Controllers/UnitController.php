<?php

namespace App\Http\Controllers;


use App\Models\MUnit;
use App\Models\MForklifttype;
use App\Models\User;
use App\Models\MSitename;
use App\Models\MMaintenanceaction;
use App\Models\MTroubleaction;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sitename=MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $unit = MUnit::where('idsitename',Session::get('runidsitename'))->get();
        return view('unit.index', compact('unit','cbu','sitename'));
    }
    public function create()
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $forklifttype = MForklifttype::get();
        return view('unit.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $unit = MUnit::find($id);
        $forklifttype = MForklifttype::get();
        return view('unit.edit',compact('cbu','unit','forklifttype'));
    }
    public function store(Request $request){
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required',
            'idsitename'=>'required',
            'kdunit'=>'required|unique:unit,kdunit',
            'hm'=>'required',
        ]);



        $unit = new MUnit;
        $unit->idcbu = $request->idcbu;
        $unit->idregion = $request->idregion;
        $unit->idsitename = $request->idsitename;
        $unit->kdunit = $request->kdunit;
        $unit->idforklifttype = $request->idforklifttype;

        $unit->equipment = $request->equipment;
        $unit->merk = $request->merk;
        $unit->type = $request->type;
        $unit->model = $request->model;
        $unit->capcity = $request->capcity;
        $unit->serialnumber = $request->serialnumber;
        $unit->specification = $request->specification;
        $unit->qty = $request->qty;
        $unit->namaunit = $request->kdunit;
        $unit->hm = $request->hm;
        $unit->statusspp = "CLOSE";
        $unit->statusmekanik = "CLOSE";
        $simpan = $unit->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('unit.index');

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
        ]);



        $unit = MUnit::find($id);
        $unit->idcbu = $request->idcbu;
        $unit->idregion = $request->idregion;
        $unit->idsitename = $request->idsitename;
        $unit->kdunit = $request->kdunit;
        $unit->idforklifttype = $request->idforklifttype;
        $unit->equipment = $request->equipment;
        $unit->merk = $request->merk;
        $unit->type = $request->type;
        $unit->model = $request->model;
        $unit->capcity = $request->capcity;
        $unit->serialnumber = $request->serialnumber;
        $unit->specification = $request->specification;
        $unit->qty = $request->qty;
        $unit->namaunit = $request->kdunit;
        $unit->statusspp = "CLOSE";
        $unit->statusmekanik = "CLOSE";
        $simpan = $unit->save();
        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('unit.index');

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
            MUnit::where('kdunit', '=', $id)->delete();
            Alert::success('sukses dihapus');
            return redirect()->route('unit.index');
        } catch (QueryException $ex) {
            Alert::error('Gagal hapus, ada relasi data dengan yang lain');
            return redirect()->route('unit.index');
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
    public function getunit(Request $request){
        $unit = MUnit::where('idsitename',$request->idsitename)->
        where('kdunit', 'LIKE', '%'.$request->search.'%')->orderBy('kdunit', 'ASC')->get();

        $response = array();
        foreach ($unit as $value) {
            $response[] = array(
                "id" => $value->kdunit,
                "text" => $value->kdunit
            );
        }

        return response()->json($response);
    }

    public function search(Request $request){

        $units = MUnit::where('kdunit', 'LIKE', '%' . $request->keyword . '%')->orderBy('kdunit', 'ASC')->get();
        $listactions= $listactions=MMaintenanceaction::where('kdunit',$request->keyword)->get();
        $listtroubleactions=MTroubleaction::where('kdunit',$request->keyword)->get();
        return view('unit.search', compact('units','listactions','listtroubleactions'));
    }

}
