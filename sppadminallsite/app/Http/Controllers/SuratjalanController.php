<?php

namespace App\Http\Controllers;

use App\Models\MSuratjalan;

use App\Models\MOffice;
use App\Models\MSitename;
use App\Models\MCbu;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class suratjalanController extends Controller
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
        if (Auth::user()->roles_id == "1" || Auth::user()->roles_id == "2") {
            $suratjalan = MSuratjalan::where('pengirim', Session::get('runidsitename'))->get();
        } else {
            $suratjalan = MSuratjalan::where('penerima', Session::get('runidsitename'))->get();
        }
        if (Auth::user()->roles_id == "5" || Auth::user()->roles_id == "6") {
            $suratjalan = MSuratjalan::get();
        }
       
        return view('suratjalan.index', compact('suratjalan', 'cbu', 'sitename'));
    }
    public function create()
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $sitename = MSitename::get();
        return view('suratjalan.create', compact('sitename', 'cbu'));
    }
    public function edit($id)
    {
        $office = MOffice::get();
        $suratjalan = MSuratjalan::find($id);
        return view('suratjalan.edit', compact('office', 'suratjalan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'pengirim' => 'required',
            'idsitename' => 'required',
            'filefoto' => 'required',
        ]);

        if (!empty($request->filefoto)) {
            $file = $request->filefoto;
            $pathUpload = 'assets/inventory';

            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move($pathUpload, $filename);
        } else {
            $filename = 'default.png';
        }

        $suratjalan = new MSuratjalan;
        $suratjalan->pengirim = $request->pengirim;
        $suratjalan->penerima = $request->idsitename;
        $suratjalan->tanggal = date('Y-m-d');
        $suratjalan->filename = $filename;
        $suratjalan->statuspengirim  = "OPEN";
        $simpan = $suratjalan->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('suratjalan.index');
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

        $suratjalan = MSuratjalan::find($id);
        $suratjalan->tanggalterima = $request->tanggalterima;
        $suratjalan->namapenerima = $request->namapenerima;
        $suratjalan->tanggalkembali = $request->tanggalkembali;
        $suratjalan->statuspengirim = $request->statuspengirim;


        $simpan = $suratjalan->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('suratjalan.index');
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!"
            ], 200); // Status code here
        }
    }
    public function show($id)
    {
        $suratjalan = MSuratjalan::find($id);
        return view('suratjalan.reply', compact('suratjalan'));
    }
    public function reply(Request $request, $id)
    {
        $request->validate([
            'filefoto' => 'required',
        ]);
        if (!empty($request->filefoto)) {
            $file = $request->filefoto;
            $pathUpload = 'assets/inventory';

            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move($pathUpload, $filename);
        } else {
            $filename = 'default.png';
        }

        $suratjalan = MSuratjalan::find($id);
        $suratjalan->tanggalterima = Carbon::now();    
        $suratjalan->filereply = $filename;   
        $simpan = $suratjalan->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('suratjalan.index');
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
            $data = MSuratjalan::where('id', '=', $id)->first();
            $file = $data->filename;
            $path = public_path() . '/assets/inventory/' . $file;
            unlink($path);
            MSuratjalan::where('id', '=', $id)->delete();

            return redirect()->route('suratjalan.index');
        } catch (QueryException $ex) {
            return redirect()->route('suratjalan.index');
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
    public function formterima(Request $request)
    {
        $id = $request->id;
        $suratjalan = MSuratjalan::find($id);
        return view('suratjalan.formterima', compact('suratjalan'));
    }
}
