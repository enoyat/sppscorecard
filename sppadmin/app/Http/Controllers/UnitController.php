<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MUnit;
use App\Models\MForklifttype;
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

class UnitController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu=MCbu::get();
        $unit = MUnit::get();
        return view('unit.index', compact('unit','cbu'));
    }
    public function create()
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        return view('unit.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        $unit = MUnit::find($id);
        return view('unit.edit',compact('cbu','forklifttype','unit'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'namaunit'=>'required',
            'uom'=>'required',
            
        ]);

      
        
        $unit = new MUnit;
        $unit->namaunit = $request->namaunit;
        $unit->uom = $request->uom;
        
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
            'namaunit'=>'required',
            'uom'=>'required',
          
        ]);

      
        
        $unit = MUnit::find($id);
        $unit->namaunit = $request->namaunit;
        $unit->uom = $request->uom; 
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
            MUnit::where('id', '=', $id)->delete();

            return redirect()->route('unit.index');
        } catch (QueryException $ex) {
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
        $unit = MUnit::where('kdunit', 'LIKE', '%'.$request->search.'%')->orderBy('kdunit', 'ASC')->get();

        $response = array();
        foreach ($unit as $value) {
            $response[] = array(
                "id" => $value->kdunit,
                "text" => $value->kdunit
            );
        }

        return response()->json($response);
    }
}
