<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MForklifttype;
use App\Models\MPenalty;
use App\Models\MSitename;
use App\Models\MUnit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PenaltyController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (!empty($request->get('periode'))) {
            $mperiode = $request->get('periode');
        } else {
            $tahun = date('Y');
            $bulan = date('m');
            $mperiode = $tahun . '-' . $bulan;
        }
        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $penalty = MPenalty::with('getunit')->where('idsitename', Session::get('runidsitename'))->where('periode', $mperiode)->get();
        $forklifttype = MForklifttype::get();
        return view('penalty.index', compact('penalty', 'forklifttype', 'cbu', 'sitename'));
    }
    public function create()
    {
        if (Session::get('roles_id') == 2) {
            $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        } else {
            $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        }
        $forklifttype = MForklifttype::get();
        return view('penalty.create', compact('cbu', 'forklifttype'));
    }
    public function edit($id)
    {
        $cbu = MCbu::get();
        $forklifttype = MForklifttype::get();
        $penalty = MPenalty::find($id);
        return view('penalty.edit', compact('cbu', 'forklifttype', 'penalty'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcbu' => 'required',
            'idregion' => 'required',
            'idsitename' => 'required',
            'periode' => 'required',

        ]);

        if ($request->pilihunit == "allunit") {

            $unit = MUnit::where('idsitename', $request->idsitename)->get();

            foreach ($unit as $item) {
                $cek = MPenalty::where('kdunit', $item->kdunit)->where('periode', $request->periode)->count();

                if ($cek < 1) {

                    $penalty = new Mpenalty;
                    $penalty->idcbu = $request->idcbu;
                    $penalty->idregion = $request->idregion;
                    $penalty->idsitename = $request->idsitename;
                    $penalty->periode = $request->periode;
                    $penalty->kdunit = $item->kdunit;
                    $penalty->price = $item->price;
                    $penalty->prosentase = $item->prosentase;
                    $penalty->tanggal = $item->tanggal;
                    $penalty->showcustomer = $item->showcustomer;
                    $penalty->dateactual = $item->dateactual;
                    $penalty->daterequest = $item->daterequest;
                    $penalty->dateestimated = $item->dateestimated;
                    $penalty->reason = $item->reason;
                    $penalty->flag_aktif = $item->flag_aktif;
                    $penalty->flag_baru = $item->flag_baru;
                    $penalty->flag_target = $item->flag_target;
                    $penalty->flag_actual = $item->flag_actual;
                    $penalty->flag_otif = $item->flag_otif;
                    $penalty->prosentase = $item->prosentase;
                    $simpan = $penalty->save();
                }
            }
            Alert::success('Success', 'Data berhasil disimpan!');
            return redirect()->route('penalty.index');
        } else {

            $cek = MPenalty::where('kdunit', $request->kdunit)->where('periode', $request->periode)->count();
            if ($cek > 0) {
                Alert::error('Error', 'Data sudah ada!');
                Session::flash('message', 'Data sudah ada!');
                return redirect()->back();
            }
            $unit = MUnit::where('kdunit', $request->kdunit)->first();
            $price = $unit->price;
            $prosentase = $unit->prosentase;

            $penalty = new Mpenalty;
            $penalty->idcbu = $request->idcbu;
            $penalty->idregion = $request->idregion;
            $penalty->idsitename = $request->idsitename;
            $penalty->periode = $request->periode;
            $penalty->kdunit = $request->kdunit;
            $penalty->price = $price;
            $penalty->prosentase = $unit->prosentase;
            $penalty->tanggal = $unit->tanggal;
            $penalty->showcustomer = $unit->showcustomer;
            $penalty->dateactual = $unit->dateactual;
            $penalty->daterequest = $unit->daterequest;
            $penalty->dateestimated = $unit->dateestimated;
            $penalty->reason = $unit->reason;
            $penalty->flag_aktif = $unit->flag_aktif;
            $penalty->flag_baru = $unit->flag_baru;
            $penalty->flag_target = $unit->flag_target;
            $penalty->flag_actual = $unit->flag_actual;
            $penalty->flag_otif = $unit->flag_otif;
            $penalty->prosentase = $unit->prosentase;

            $simpan = $penalty->save();

            if ($simpan) {
                Alert::success('Success', 'Data berhasil disimpan!');
                Session::flash('message', 'Data berhasil disimpan!');
                return redirect()->route('penalty.index');
            } else {
                Alert::error('Error', 'Something went wrong!');
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'idcbu' => 'required',
            'idregion' => 'required',
            'idsitename' => 'required',
            'periode' => 'required',
            'kdunit' => 'required',
            'price' => 'required',

        ]);

        $penalty = MPenalty::find($id);
        $penalty->idcbu = $request->idcbu;
        $penalty->idregion = $request->idregion;
        $penalty->idsitename = $request->idsitename;
        $penalty->periode = $request->periode;
        $penalty->kdunit = $request->kdunit;
        $penalty->price = $request->price;

        $penalty->penalty = $request->penalty;
        $simpan = $penalty->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('penalty.index');
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
            MPenalty::where('idpenalty', '=', $id)->delete();

            return redirect()->route('penalty.index');
        } catch (QueryException $ex) {
            return redirect()->route('penalty.index');
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
        $penalty = MPenalty::find($id);
        return view('penalty.formstatus', compact('penalty', 'aid'));
    }
    public function updatestatus(Request $request)
    {

        $id = $request->id;
        $aid = $request->aid;
        if ($request->aid == 'spp') {
            $request->validate([
                'statusspp' => 'required',
            ]);
            $statusspp = $request->statusspp;
            $penalty = MPenalty::find($id);
            $penalty->statusspp = $statusspp;
            $penalty->save();
        } else {
            $request->validate([
                'statuscustomer' => 'required',
            ]);
            $statuscustomer = $request->statuscustomer;
            $penalty = MPenalty::find($id);
            $penalty->statuscustomer = $statuscustomer;
            $penalty->save();
        }

        return redirect()->route('penalty.index');
    }
}
