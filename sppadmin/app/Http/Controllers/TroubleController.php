<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MDokumentrouble;
use App\Models\MForklifttype;
use App\Models\MTrouble;
use App\Models\MTroubleaction;
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

class TroubleController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu=MCbu::get();
        $trouble = MTrouble::where('idsitename',Session::get('runidsitename'))->get();
        $forklifttype = MForklifttype::get();
        return view('trouble.index', compact('trouble','forklifttype','cbu'));
    }
    public function create()
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        return view('trouble.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        $trouble = MTrouble::find($id);
        return view('trouble.edit',compact('cbu','forklifttype','trouble'));
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

      
        
        $trouble = new MTrouble;
        $trouble->idcbu = $request->idcbu;
        $trouble->idregion = $request->idregion;
        $trouble->idsitename = $request->idsitename;
        $trouble->kdunit = $request->kdunit;
        $trouble->tanggal = $request->tanggal;
        $trouble->issue = $request->issue;
        $trouble->documentation = $request->documentation;
        $trouble->targetcompletedate= $request->targetcompletedate;
        $trouble->actionplanspp= $request->actionplanspp;
        $trouble->actualcompletedate = $request->actualcompletedate;
        $trouble->lapsetime = $request->lapsetime;
        $trouble->confirmationplan= $request->confirmationplan;
        $trouble->statusspp = $request->statusspp;
        $trouble->statuscustomer = $request->statuscustomer;
   
        $simpan = $trouble->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('trouble.index');

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
            'kdunit'=>'required',        
            'statusspp'=>'required',
            'statuscustomer'=>'required',
        ]);

      
        
        $trouble = MTrouble::find($id);
        $trouble->idcbu = $request->idcbu;
        $trouble->idregion = $request->idregion;
        $trouble->idsitename = $request->idsitename;
        $trouble->kdunit = $request->kdunit;
        $trouble->tanggal = $request->tanggal;
        $trouble->issue = $request->issue;
        $trouble->documentation = $request->documentation;
        $trouble->targetcompletedate= $request->targetcompletedate;
        $trouble->actionplanspp= $request->actionplanspp;
        $trouble->actualcompletedate = $request->actualcompletedate;
        $trouble->lapsetime = $request->lapsetime;
        $trouble->confirmationplan= $request->confirmationplan;
        $trouble->statusspp = $request->statusspp;
        $trouble->statuscustomer = $request->statuscustomer;       
        $simpan = $trouble->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('trouble.index');

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
            MTrouble::where('id', '=', $id)->delete();

            return redirect()->route('trouble.index');
        } catch (QueryException $ex) {
            return redirect()->route('trouble.index');
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
        $dokumentrouble=MDokumentrouble::where('idtrouble',$id)->get();
        return view('trouble.listdokumen', compact('dokumentrouble','id'));
    }

    public function dokumendestroy(Request $request)
    {
        try {
            $id = $request->id;
            $data=MDokumentrouble::where('id', '=', $id)->first();
            $file=$data->filename;
            $path = public_path().'/assets/inventory/'.$file;
            unlink($path);
            MDokumentrouble::where('id', '=', $id)->delete();
            return redirect()->back();
        } catch (QueryException $ex) {
            return redirect()->back();
        }
    }
    public function listaction($id)
    {
        $listactions=MTroubleaction::where('idtrouble',$id)->get();
        return view('trouble.listaction', compact('listactions','id'));
    }
    public function actiondestroy(Request $request)
    {
        try {
            $id = $request->id;
            MTroubleaction::where('id', '=', $id)->delete();
            return redirect()->back();
        } catch (QueryException $ex) {
            return redirect()->back();
        }
    }
}
