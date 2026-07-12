<?php
namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MForklifttype;
use App\Models\MSitename;
use App\Models\MUnit;
use App\Models\MUnitout;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class MutationController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->filled('periode')) {
            $periode = $request->periode;
            $unitout = MUnitout::with('getunit')->where('periode', $periode)->get();
        } else {
            $unitout = MUnitout::with('getunit')->get();
        }
        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $cbu      = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();

        $forklifttype = MForklifttype::get();
        return view('mutation.index', compact('unitout', 'forklifttype', 'cbu', 'sitename'));
    }
    public function create()
    {
        $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        // $cbutarget = MSitename::kategori("cbu")->get();
        return view('mutation.create', compact('cbu'));
    }
    public function edit($id)
    {
        $cbu          = MCbu::get();
        $forklifttype = MForklifttype::get();
        $unitout      = MUnitout::find($id);
        return view('mutation.edit', compact('cbu', 'forklifttype', 'unitout'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcbu'      => 'required',
            'idregion'   => 'required',
            'idsitename' => 'required',
            'kdunit'     => 'required',

        ]);

        $kdbulan                 = date('Y', strtotime($request->dateout)) . '-' . date('m', strtotime($request->dateout));
        $unitout                 = new MUnitout;
        $unitout->periode        = date('Y-m', strtotime($request->dateout));
        $unitout->idcbu          = $request->idcbu;
        $unitout->idregion       = $request->idregion;
        $unitout->idsitename     = $request->idsitename;
        $unitout->kdunit         = $request->kdunit;
        $unitout->kdunitasal     = $request->kdunitasal;
        $unitout->idcbuasal      = $request->idcbuasal;
        $unitout->idregionasal   = $request->idregionasal;
        $unitout->idsitenameasal = $request->idsitenameasal;
        $unitout->typemutation   = $request->typemutation;
        $unitout->dateout        = $request->dateout;
        $unitout->eksekutor      = Auth::user()->email;

        $simpan = $unitout->save();
        if ($request->typemutation == "mutation") {
            $unit             = MUnit::where('kdunit', $request->kdunitasal)->first();
            $unit->idcbu      = $request->idcbu;
            $unit->idregion   = $request->idregion;
            $unit->idsitename = $request->idsitename;
            $unit->save();
        } else {
            $unit             = MUnit::where('kdunit', $request->kdunit)->first();
            $unit->idcbu      = $request->idcbu;
            $unit->idregion   = $request->idregion;
            $unit->idsitename = $request->idsitename;
            $unit->kdunit     = $request->kdunit;
            $unit->save();
        }

        if ($simpan) {
            Alert::success('Success', 'Data berhasil disimpan!');
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('mutation.index');
        } else {
            Alert::error('Error', 'Something went wrong!');
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->back();
        }

    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            MUnitout::where('idmutation', '=', $id)->delete();

            return redirect()->route('mutation.index');
        } catch (QueryException $ex) {
            return redirect()->route('mutation.index');
        }
    }

}
