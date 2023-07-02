<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MPalleterenew;
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

class palleterenewController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu=MCbu::get();
        $palleterenew = MPalleterenew::where('idsitename',Session::get('runidsitename'))->get();
        $forklifttype = MForklifttype::get();
        return view('palleterenew.index', compact('palleterenew','forklifttype','cbu'));
    }
    public function create()
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        return view('palleterenew.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        $palleterenew = MPalleterenew::find($id);
        return view('palleterenew.edit',compact('cbu','forklifttype','palleterenew'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required',
            'idsitename'=>'required',
            'tanggal'=>'required',
            'totalrent'=>'required',
            'qty'=>'required',
            'statusspp'=>'required',
            'statuscustomer'=>'required',
        ]);

      
        
        $palleterenew = new MPalleterenew;
        $palleterenew->idcbu = $request->idcbu;
        $palleterenew->idregion = $request->idregion;
        $palleterenew->idsitename = $request->idsitename;
        $palleterenew->totalrent = $request->totalrent;
        $palleterenew->qty = $request->qty;
        $palleterenew->tanggal = $request->tanggal;        
        $palleterenew->statusspp = $request->statusspp;        
        $palleterenew->statuscustomer = $request->statuscustomer;   
        $simpan = $palleterenew->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('palleterenew.index');

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
            'tanggal'=>'required',
            'totalrent'=>'required',
            'qty'=>'required',
            'statusspp'=>'required',
            'statuscustomer'=>'required',
          
        ]);

      
        
        $palleterenew = MPalleterenew::find($id);
        $palleterenew->idcbu = $request->idcbu;
        $palleterenew->idregion = $request->idregion;
        $palleterenew->idsitename = $request->idsitename;
        $palleterenew->totalrent = $request->totalrent;
        $palleterenew->qty = $request->qty;
        $palleterenew->tanggal = $request->tanggal;        
        $palleterenew->statusspp = $request->statusspp;        
        $palleterenew->statuscustomer = $request->statuscustomer;   
        $simpan = $palleterenew->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('palleterenew.index');

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
            MPalleterenew::where('id', '=', $id)->delete();

            return redirect()->route('palleterenew.index');
        } catch (QueryException $ex) {
            return redirect()->route('palleterenew.index');
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
