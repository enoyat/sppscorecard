<?php

namespace App\Http\Controllers;


use App\Models\MSparepart;
use App\Models\MForklifttype;
use App\Models\MSparepartstok;
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

class SparepartstokController extends Controller
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
        $sparepartstok = MSparepartstok::where('idsitename',Session::get('runidsitename'))->get();
        return view('sparepartstok.index', compact('sparepartstok','cbu','sitename'));
    }
    public function create()
    {
        if(Session::get('roles_id')==2) {
            $cbu=MCbu::where('id',Session::get('runidcbu'))->get();
        } else {
            $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        }
        $forklifttype = MForklifttype::get();
        return view('sparepartstok.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $sparepart = MSparepartstok::find($id);

        return view('sparepartstok.edit',compact('cbu','sparepart'));
    }
    public function store(Request $request)
    {
        $cek=MSparepartstok::where('idsitename',$request->idsitename)->where('idsparepart',$request->idsparepart)->count();
        if ($cek>0) {
            Session::flash('success', 'Data sudah ada!');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required',
            'idsitename'=>'required',
            'idsparepart'=>'required',
            'qty'=>'required',
        ]);



        $sparepart = new MSparepartstok;
        $sparepart->idcbu = $request->idcbu;
        $sparepart->idregion = $request->idregion;
        $sparepart->idsitename = $request->idsitename;
        $sparepart->idsparepart = $request->idsparepart;
        $sparepart->qty = $request->qty;
        $simpan = $sparepart->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('sparepartstok.index');

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
            'idsparepart'=>'required',
            'qty'=>'required',

        ]);



        $sparepart = MSparepartstok::find($id);
        $sparepart->idcbu = $request->idcbu;
        $sparepart->idregion = $request->idregion;
        $sparepart->idsitename = $request->idsitename;
        $sparepart->idsparepart = $request->idsparepart;
        $sparepart->qty = $request->qty;

        $simpan = $sparepart->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('sparepartstok.index');

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
            MSparepartstok::where('id', '=', $id)->delete();

            return redirect()->route('sparepartstok.index');
        } catch (QueryException $ex) {
            return redirect()->route('sparepartstok.index');
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
