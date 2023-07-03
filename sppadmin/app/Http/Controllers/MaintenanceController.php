<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MDokumenmaintenance;
use App\Models\MMaintenance;
use App\Models\MForklifttype;
use App\Models\MMaintenanceaction;
use App\Models\MUnit;
use App\Models\User;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class MaintenanceController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu=MCbu::get();
        $maintenance = MUnit::where('idsitename',Session::get('runidsitename'))->get();
        return view('maintenance.index', compact('maintenance','cbu'));
    }
    public function create(){
        $cbu=MCbu::get();
        return view('maintenance.create', compact('cbu'));
    }
    public function store(Request $request){
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required', 
            'idsitename'=>'required',
            'kdunit'=>'required|unique:unit,kdunit',
            'hm'=>'required',
        ]);

      
        
        $maintenance = new MUnit;
        $maintenance->idcbu = $request->idcbu;
        $maintenance->idregion = $request->idregion;
        $maintenance->idsitename = $request->idsitename;
        $maintenance->kdunit = $request->kdunit;
        $maintenance->serialnumber = $request->serialnumber;
        $maintenance->namaunit = $request->kdunit;
        $maintenance->hm = $request->hm;
        $maintenance->statusspp = "CLOSE";
        $maintenance->statusmekanik = "CLOSE";
        $simpan = $maintenance->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('maintenance.index');

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
            MMaintenance::where('id', '=', $id)->delete();

            return redirect()->route('maintenance.index');
        } catch (QueryException $ex) {
            return redirect()->route('maintenance.index');
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
    public function listdokumen($id)
    {
        $dokumenmaintenance=MDokumenmaintenance::where('idaction',$id)->get();
        return view('maintenance.listdokumen', compact('dokumenmaintenance','id'));
    }

    public function dokumendestroy(Request $request)
    {
        try {
            $id = $request->id;
            $data=MDokumenmaintenance::where('id', '=', $id)->first();
            $file=$data->filename;
            $path = public_path().'/assets/inventory/'.$file;
            unlink($path);
            MDokumenmaintenance::where('id', '=', $id)->delete();
            return redirect()->back();
        } catch (QueryException $ex) {
            return redirect()->back();
        }
    }
    public function listaction($id)
    {
        $listactions=MMaintenanceaction::where('kdunit',$id)->get();
        return view('maintenance.listaction', compact('listactions','id'));
    }
    public function actiondestroy(Request $request)
    {
        try {
            $id = $request->id;
            MMaintenanceaction::where('id', '=', $id)->delete();
            return redirect()->back();
        } catch (QueryException $ex) {
            return redirect()->back();
        }
    }
    public function formstatus(Request $request)
    {
        $kdunit = $request->kdunit;
        $aid = $request->aid;
        $maintenance = MUnit::find($kdunit);
        return view('maintenance.formstatus', compact('maintenance','aid'));
    }
    public function updatestatus(Request $request)
    {
       
        $kdunit = $request->kdunit;
        $aid = $request->aid;
        if($request->aid == 'spp'){
            $request->validate([
                'statusspp'=>'required',
            ]);
            $statusspp = $request->statusspp;
            $maintenance = MUnit::find($kdunit);
            $maintenance->statusspp = $statusspp;
            $maintenance->save();
        }
        else {
            $request->validate([
                'statuscustomer'=>'required',
            ]);
            $statuscustomer = $request->statuscustomer;
            $maintenance = MUnit::find($kdunit);
            $maintenance->statuscustomer = $statuscustomer;
            $maintenance->save();
        }
       
        return redirect()->route('maintenance.index');
    }

}
