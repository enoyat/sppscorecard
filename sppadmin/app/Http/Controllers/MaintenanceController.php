<?php

namespace App\Http\Controllers;


use App\Models\MDokumenmaintenance;
use App\Models\MMaintenance;
use App\Models\MForklifttype;
use App\Models\MMaintenanceaction;
use App\Models\MUnit;
use App\Models\User;
use App\Models\MSitename;
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
        $sitename=MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $maintenance = MUnit::where('idsitename',Session::get('runidsitename'))->get();
        return view('maintenance.index', compact('maintenance','cbu','sitename'));
    }
    public function create(){
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        return view('maintenance.create', compact('cbu'));
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
        return view('maintenance.listaction', compact('listactions'));
    }
    public function listactionall()
    {
        $listactions = MMaintenanceaction::join('unit','unit.kdunit','=','maintenanceaction.kdunit')
        ->where('unit.idsitename',Session::get('runidsitename'))
        ->get();

        return view('maintenance.listaction', compact('listactions'));
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
        $id = $request->id;
        $aid = $request->aid;
        if($request->aid == 'spp'){
            $maintenance = MMaintenanceaction::find($id);
            return view('maintenance.formstatus', compact('maintenance','aid'));
        }
        else {
            $maintenance = MMaintenanceaction::find($id);
            return view('maintenance.formstatuscustomer', compact('maintenance','aid'));
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
            $maintenance = MMaintenanceaction::find($id);
            $maintenance->statusspp = $statusspp;
            $maintenance->save();
        }
        else {
            $request->validate([
                'statuscustomer'=>'required',
            ]);
            $statuscustomer = $request->statuscustomer;
            $maintenance = MMaintenanceaction::find($id);
            $maintenance->statuscustomer = $statuscustomer;
            $maintenance->save();
        }

        return redirect()->back();
    }

}
