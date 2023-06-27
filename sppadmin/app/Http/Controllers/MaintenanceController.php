<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MMaintenance;
use App\Models\MForklifttype;
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
        $forklifttype = MForklifttype::get();
        return view('maintenance.index', compact('maintenance','forklifttype','cbu'));
    }
    public function create()
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        return view('maintenance.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        $maintenance = MMaintenance::find($id);
        return view('maintenance.edit',compact('cbu','forklifttype','maintenance'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required',
            'idsitename'=>'required',
            'kdunit'=>'required',
            'tanggal'=>'required',
            'statusspp'=>'required',
            'statuscustomer'=>'required',
        ]);

      
        
        $maintenance = new Mmaintenance;
        $maintenance->idcbu = $request->idcbu;
        $maintenance->idregion = $request->idregion;
        $maintenance->idsitename = $request->idsitename;
        $maintenance->kdunit = $request->kdunit;
        $maintenance->tanggal = $request->tanggal;        
        $maintenance->statusspp = $request->statusspp;        
        $maintenance->statuscustomer = $request->statuscustomer;   
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required',
            'idsitename'=>'required',
            'kdunit'=>'required',
            'tanggal'=>'required',
            'statusspp'=>'required',
            'statuscustomer'=>'required',
          
        ]);

      
        
        $maintenance = MMaintenance::find($id);
        $maintenance->idcbu = $request->idcbu;
        $maintenance->idregion = $request->idregion;
        $maintenance->idsitename = $request->idsitename;
        $maintenance->kdunit = $request->kdunit;
        $maintenance->tanggal = $request->tanggal;     
        $maintenance->statusspp = $request->statusspp;
        $maintenance->statuscustomer = $request->statuscustomer;       
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
}
