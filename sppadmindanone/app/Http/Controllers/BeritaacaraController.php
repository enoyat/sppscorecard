<?php

namespace App\Http\Controllers;

use App\Models\MBeritaacara;

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

class BeritaacaraController extends Controller
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
            $beritaacara = MBeritaacara::where('pengirim', Session::get('runidsitename'))->get();
        } else {
            $beritaacara = MBeritaacara::where('penerima', Session::get('runidsitename'))->get();
        }
        if (Auth::user()->roles_id == "5" || Auth::user()->roles_id == "6") {
            $beritaacara = MBeritaacara::get();
        }
       
        return view('beritaacara.index', compact('beritaacara', 'cbu', 'sitename'));
    }
    public function create()
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $sitename = MSitename::get();
        return view('beritaacara.create', compact('sitename', 'cbu'));
    }
    public function edit($id)
    {
        $office = MOffice::get();
        $beritaacara = MBeritaacara::find($id);
        return view('beritaacara.edit', compact('office', 'beritaacara'));
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

        $Beritaacara = new MBeritaacara;
        $Beritaacara->pengirim = $request->pengirim;
        $Beritaacara->penerima = $request->idsitename;
        $Beritaacara->tanggal = date('Y-m-d');
        $Beritaacara->filename = $filename;
        $Beritaacara->statuspengirim  = "OPEN";
        $simpan = $Beritaacara->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('beritaacara.index');
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

        $Beritaacara = MBeritaacara::find($id);
        $Beritaacara->tanggalterima = $request->tanggalterima;
        $Beritaacara->namapenerima = $request->namapenerima;
        $Beritaacara->tanggalkembali = $request->tanggalkembali;
        $Beritaacara->statuspengirim = $request->statuspengirim;


        $simpan = $Beritaacara->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('beritaacara.index');
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
        $beritaacara = MBeritaacara::find($id);
        return view('beritaacara.reply', compact('beritaacara'));
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

        $Beritaacara = MBeritaacara::find($id);
        $Beritaacara->tanggalterima = Carbon::now();    
        $Beritaacara->filereply = $filename;   
        $simpan = $Beritaacara->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('beritaacara.index');
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
            $data = MBeritaacara::where('id', '=', $id)->first();
            $file = $data->filename;
            $path = public_path() . '/assets/inventory/' . $file;
            unlink($path);
            MBeritaacara::where('id', '=', $id)->delete();

            return redirect()->route('beritaacara.index');
        } catch (QueryException $ex) {
            return redirect()->route('beritaacara.index');
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
        $beritaacara = MBeritaacara::find($id);
        return view('beritaacara.formterima', compact('beritaacara'));
    }
}
