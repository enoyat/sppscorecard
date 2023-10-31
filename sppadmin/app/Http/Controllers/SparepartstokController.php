<?php

namespace App\Http\Controllers;

use App\Models\MForklifttype;
use App\Models\MSitename;
use App\Models\MSparepartstok;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SparepartstokController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if ($request->get('filter')) {
            $filter = $request->get('filter');
        } else {
            $filter = "sitename";
        }

        if ($filter == "sitename") {
            $sparepartstok = MSparepartstok::where('idsitename', Session::get('runidsitename'))->get();
            if ($request->get('xidsitename') == null) {
                $id = Session::get('runidsitename');
            } else {
                $id = $request->get('xidsitename');
            }
            $sitename = MSitename::where('id', $id)->first();
            $region = MSitename::where('id', $sitename->parentid)->first();
            $cbu = MSitename::where('id', $region->parentid)->first();
            Session::put('runidcbu', $cbu->id);
            Session::put('runnamacbu', $cbu->namasitename);
            Session::put('runidregion', $region->id);
            Session::put('runnamaregion', $region->namasitename);
            Session::put('runidsitename', $id);
            Session::put('runnamasitename', $sitename->namasitename);
        } else if ($request->filter == "region") {
            $sparepartstok = MSparepartstok::where('idregion', Session::get('runidregion'))->get();
            $id = $request->get('xidregion');
            $region = MSitename::where('id', $id)->first();
            $cbu = MSitename::where('id', $region->parentid)->first();
            $sitename = MSitename::where('parentid', $id)->first();
            Session::put('runidcbu', $cbu->id);
            Session::put('runnamacbu', $cbu->namasitename);
            Session::put('runidregion', $region->id);
            Session::put('runnamaregion', $region->namasitename);
            Session::put('runidsitename', $sitename->id);
            Session::put('runnamasitename', $sitename->namasitename);
        } else if ($request->filter == "cbu") {
            $sparepartstok = MSparepartstok::where('idcbu', Session::get('runidcbu'))->get();
            $id = $request->get('xidcbu');
            $cbu = MSitename::where('id', $id)->first();
            $region = MSitename::where('parentid', $cbu->id)->first();
            $sitename = MSitename::where('parentid', $region->id)->first();
            Session::put('runidcbu', $cbu->id);
            Session::put('runnamacbu', $cbu->namasitename);
            Session::put('runidregion', $region->id);
            Session::put('runnamaregion', $region->namasitename);
            Session::put('runidsitename', $sitename->id);
            Session::put('runnamasitename', $sitename->namasitename);
        } else if ($request->filter == "allsn") {
            $sparepartstok = MSparepartstok::where('idcbu', 'SN')->get();
        } else if ($request->filter == "allwater") {
            $sparepartstok = MSparepartstok::where('idcbu', 'Waters')->get();
        } else if ($request->filter == "allsnwater") {
            $sparepartstok = MSparepartstok::where('idcbu', 'SN')->orwhere('idcbu', 'Waters')->get();
        }
        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();

        return view('sparepartstok.index', compact('sparepartstok', 'cbu', 'sitename'));
    }
    public function create()
    {
        if (Session::get('roles_id') == 2) {
            $cbu = MCbu::where('id', Session::get('runidcbu'))->get();
        } else {
            $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        }
        $forklifttype = MForklifttype::get();
        return view('sparepartstok.create', compact('cbu', 'forklifttype'));
    }
    public function edit($id)
    {
        $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $sparepart = MSparepartstok::find($id);

        return view('sparepartstok.edit', compact('cbu', 'sparepart'));
    }
    public function store(Request $request)
    {
        $cek = MSparepartstok::where('idsitename', $request->idsitename)->where('codepart', $request->codepart)->count();
        if ($cek > 0) {
            Session::flash('success', 'Data sudah ada!');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

        $request->validate([
            'idcbu' => 'required',
            'idregion' => 'required',
            'idsitename' => 'required',
            'codepart' => 'required',
            'qty' => 'required',
        ]);

        $sparepart = new MSparepartstok;
        $sparepart->idcbu = $request->idcbu;
        $sparepart->idregion = $request->idregion;
        $sparepart->idsitename = $request->idsitename;
        $sparepart->codepart = $request->codepart;
        $sparepart->qty = $request->qty;
        $sparepart->stok = $request->qty;
        $simpan = $sparepart->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('sparepartstok.index');

        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!",
            ], 200); // Status code here
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'idcbu' => 'required',
            'idregion' => 'required',
            'idsitename' => 'required',
            'codepart' => 'required',
            'qty' => 'required',

        ]);

        $sparepart = MSparepartstok::find($id);
        $sparepart->idcbu = $request->idcbu;
        $sparepart->idregion = $request->idregion;
        $sparepart->idsitename = $request->idsitename;
        $sparepart->codepart = $request->codepart;
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
                'Message' => "Something went wrong!",
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
