<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MSparepart;
use App\Models\MForklifttype;
use App\Models\MSparepartstok;
use App\Models\MSparepartstoktrans;
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

class SparepartstoktransController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu=MCbu::get();
        $sparepartstoktrans = MSparepartstoktrans::where('idsitename',Session::get('runidsitename'))->get();
        return view('sparepartstoktrans.index', compact('sparepartstoktrans','cbu'));
    }
    public function create()
    {
        if(Session::get('roles_id')==2) {
            $cbu=MCbu::where('id',Session::get('runidcbu'))->get();
        } else {
            $cbu=MCbu::get();
        }
        return view('sparepartstoktrans.create',compact('cbu'));
    }
    public function edit($id)
    {
        $cbu=MCbu::get();
        $sparepart = MSparepartstoktrans::find($id);
        
        return view('sparepartstoktrans.edit',compact('cbu','sparepart'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required', 
            'idsitename'=>'required',
            'idsparepart'=>'required',
            'qtytrans'=>'required',

        ]);

      
        
        $sparepart = new MSparepartstoktrans;
        $sparepart->idcbu = $request->idcbu;
        $sparepart->idregion = $request->idregion;
        $sparepart->idsitename = $request->idsitename;
        $sparepart->idsparepart = $request->idsparepart;
        $sparepart->tanggal =date('Y-m',strtotime($request->tanggal));
        $sparepart->qtytrans = $request->qtytrans;
        $sparepart->qty = $request->qty;
        $sparepart->stockpros = ($request->qtytrans/$request->qty)*100;
        $sparepart->confirmation = $request->confirmation;
        $sparepart->avgpros = ($request->qtytrans/$request->qty)*100;

        $simpan = $sparepart->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('sparepartstoktrans.index');

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

      
        
        $sparepart = MSparepartstoktrans::find($id);
        $sparepart->idcbu = $request->idcbu;
        $sparepart->idregion = $request->idregion;
        $sparepart->idsitename = $request->idsitename;
        $sparepart->idsparepart = $request->idsparepart;
        $sparepart->qty = $request->qty;

        $simpan = $sparepart->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('sparepartstoktrans.index');

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
            MSparepartstoktrans::where('id', '=', $id)->delete();

            return redirect()->route('sparepartstoktrans.index');
        } catch (QueryException $ex) {
            return redirect()->route('sparepartstoktrans.index');
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
    public function getsparepart(Request $request){
        $sparepart = 
        MSparepartstok::join('sparepart','sparepartstok.idsparepart','=','sparepart.id')
        ->select('sparepartstok.*','sparepart.namasparepart')
        ->where('idsitename',Session::get('runidsitename'))->where('namasparepart', 'LIKE', '%'.$request->search.'%')->orderBy('namasparepart', 'ASC')->get();

        $response = array();
        foreach ($sparepart as $value) {
            $response[] = array(
                "id" => $value->idsparepart,
                "text" => $value->namasparepart
            );
        }

        return response()->json($response);
    }
    public function getstok(Request $request){
        $sparepart = MSparepartstok::join('sparepart','sparepartstok.idsparepart','=','sparepart.id')
        ->select('sparepartstok.*','sparepart.namasparepart', 'sparepartstok.qty')
        ->where('idsitename',Session::get('runidsitename'))->where('idsparepart', '=', $request->id)->get();
        return response()->json($sparepart);
    }
}
