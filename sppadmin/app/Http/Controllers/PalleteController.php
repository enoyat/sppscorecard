<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MForklifttype;
use App\Models\MPallete;
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

class PalleteController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu=MCbu::get();
        $pallete = MPallete::where('idsitename',Session::get('runidsitename'))->get();
        return view('pallete.index', compact('pallete','cbu'));
    }
    public function create()
    {
        if(Session::get('roles_id')==2) {
            $cbu=MCbu::where('id',Session::get('runidcbu'))->get();
        } else {
            $cbu=MCbu::get();
        }
        $forklifttype = MForklifttype::get();
        return view('pallete.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        $pallete = MPallete::find($id);
        return view('pallete.edit',compact('cbu','forklifttype','pallete'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required', 
            'idsitename'=>'required',
            'jenisrequest'=>'required',
            'qty'=>'required',
            'daterequest'=>'required',
            'targetdate'=>'required',
            'statusspp'=>'required',

        ]);

      
        
        $pallete = new MPallete;
        $pallete->idcbu = $request->idcbu;
        $pallete->idregion = $request->idregion;
        $pallete->idsitename = $request->idsitename;
        $pallete->jenisrequest = $request->jenisrequest;
        $pallete->qty = $request->qty;
        $pallete->daterequest = $request->daterequest;
        $pallete->targetdate = $request->targetdate;
        $pallete->actualdate = $request->actualdate;
        $pallete->lapsetime = $request->lapsetime;
        $pallete->gap = $request->gap;
        $pallete->remark = $request->remark;
        $pallete->statusspp = $request->statusspp;
        $pallete->statuscustomer = "OPEN";
        $simpan = $pallete->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('pallete.index');

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
            'jenisrequest'=>'required',
            'qty'=>'required',
            'daterequest'=>'required',
            'targetdate'=>'required',
            'statusspp'=>'required',
          
        ]);

      
        
        $pallete = MPallete::find($id);
        $pallete->idcbu = $request->idcbu;
        $pallete->idregion = $request->idregion;
        $pallete->idsitename = $request->idsitename;
        $pallete->jenisrequest = $request->jenisrequest;
        $pallete->qty = $request->qty;
        $pallete->daterequest = $request->daterequest;
        $pallete->targetdate = $request->targetdate;
        $pallete->actualdate = $request->actualdate;
        $pallete->lapsetime = $request->lapsetime;
        $pallete->gap = $request->gap;
        $pallete->remark = $request->remark;
        $pallete->statusspp = $request->statusspp;
        $simpan = $pallete->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('pallete.index');

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
            MPallete::where('id', '=', $id)->delete();

            return redirect()->route('pallete.index');
        } catch (QueryException $ex) {
            return redirect()->route('pallete.index');
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
        $pallete = MPallete::find($id);
        return view('pallete.formstatus', compact('pallete','aid'));
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
            $pallete = MPallete::find($id);
            $pallete->statusspp = $statusspp;
            $pallete->save();
        }
        else {
            $request->validate([
                'statuscustomer'=>'required',
            ]);
            $statuscustomer = $request->statuscustomer;
            $pallete = MPallete::find($id);
            $pallete->statuscustomer = $statuscustomer;
            $pallete->save();
        }
       
        return redirect()->route('pallete.index');
    }

}
