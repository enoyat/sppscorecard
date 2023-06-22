<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MSparepart;
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

class SparepartController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu=MCbu::get();
        $sparepart = MSparepart::get();
        return view('sparepart.index', compact('sparepart','cbu'));
    }
    public function create()
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        return view('sparepart.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        $sparepart = MSparepart::find($id);
        return view('sparepart.edit',compact('cbu','forklifttype','sparepart'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'namasparepart'=>'required',
            'uom'=>'required',
            
        ]);

      
        
        $sparepart = new MSparepart;
        $sparepart->namasparepart = $request->namasparepart;
        $sparepart->uom = $request->uom;
        
        $simpan = $sparepart->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('sparepart.index');

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
            'namasparepart'=>'required',
            'uom'=>'required',
          
        ]);

      
        
        $sparepart = MSparepart::find($id);
        $sparepart->namasparepart = $request->namasparepart;
        $sparepart->uom = $request->uom; 
        $simpan = $sparepart->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('sparepart.index');

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
            MSparepart::where('id', '=', $id)->delete();

            return redirect()->route('sparepart.index');
        } catch (QueryException $ex) {
            return redirect()->route('sparepart.index');
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
