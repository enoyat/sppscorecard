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
use Illuminate\Support\Facades\DB;
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
            $kdbulan = $request->get('periode');
            $tglakhir = date('Y-m-t', strtotime($mperiode));
        } else {
            $tahun = date('Y');
            $bulan = date('m');
            $mperiode = $tahun . '-' . $bulan;
            $kdbulan = $tahun . '-' . $bulan;
            $tglakhir = date('Y-m-t', strtotime($mperiode));
        }
        $penalty = MPenalty::with('getunit')->where('idcbu', Session::get('runidcbu'))->where('periode', $mperiode)->get();
        $cbu = MSitename::member(Session::get('kdcustomer'))
            ->kategori('cbu')
            ->where('f_aktif', '1')
            ->get();

        $sitename = MSitename::member(Session::get('kdcustomer'))
            ->kategori('sitename')
            ->get();

        $forklifttype = MForklifttype::get();
        return view('penalty.index', compact('penalty', 'forklifttype', 'cbu', 'sitename'));
    }

    public function getpenalty(Request $request)
    {
        if (!empty($request->get('periode'))) {
            $mperiode = $request->get('periode');
            $kdbulan = $request->get('periode');
            $tglakhir = date('Y-m-t', strtotime($mperiode));
        } else {
            $tahun = date('Y');
            $bulan = date('m');
            $mperiode = $tahun . '-' . $bulan;
            $kdbulan = $tahun . '-' . $bulan;
            $tglakhir = date('Y-m-t', strtotime($mperiode));
        }
        $idsitename = Session::get('runidsitename');
        $idcbu = Session::get('runidcbu');

        if ($kdbulan == "2023-10") {

            $penalty = DB::select("SELECT penalty.*, price*0.05 as price5, sitename.namasitename,
            CASE
                    WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')
                    WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')
                    WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, dateactual)

            END AS JMBULAN,
            CASE
                    WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir'))*(price*0.05)
                    WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir'))*(price*0.05)
                    WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, dateactual)) *(price*0.05)

            END AS jmlpenalty  FROM penalty  join sitename on penalty.idsitename=sitename.id WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idcbu='$idcbu' and periode='$kdbulan'
            ");

        } else {
            $tglawal = date('Y-m-01', strtotime($tglakhir));

            $penalty = DB::select("SELECT penalty.*, price*0.05 as price5,  sitename.namasitename,
                CASE
                        -- WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')
                        WHEN dateactual is NOT null and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')
                        WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)
                        WHEN dateactual is null and TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')=0 THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1 ELSE TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')

                END AS JMBULAN,
                CASE
                        -- WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir'))*(price*0.05)

                        WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir'))*(price*0.05)
                        WHEN dateactual is NOT null  and dateactual>='$tglawal' THEN (TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)) *(price*0.05)
                        WHEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')=0 THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is null and TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')=0 THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05) ELSE TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')*(price*0.05)
                END AS jmlpenalty  FROM penalty  join sitename on penalty.idsitename=sitename.id WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idcbu='$idcbu' and periode='$kdbulan'
              ");

        }

        // dd($sitename, $cbu, $penalty, $tglawal, $tglakhir, $mperiode, $kdbulan);
        $cbu = MSitename::member(Session::get('kdcustomer'))
            ->kategori('cbu')
            ->where('f_aktif', '1')
            ->get();

        $sitename = MSitename::member(Session::get('kdcustomer'))
            ->kategori('sitename')
            ->get();

        // $penalty = MPenalty::with('getunit')->where('idsitename', Session::get('runidsitename'))->where('periode', $mperiode)->get();
        $forklifttype = MForklifttype::get();
        return view('penalty.listpenalty', compact('penalty', 'forklifttype', 'cbu', 'sitename'));
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

            if ($request->pilihsite == "allsite") {
                $unit = MUnit::where('idcbu', $request->idcbu)->where('showcustomer','Y')->get();
            } else {
                $unit = MUnit::where('idsitename', $request->idsitename)->where('showcustomer','Y')->get();
            }

            foreach ($unit as $item) {
                $cek = MPenalty::where('kdunit', $item->kdunit)->where('periode', $request->periode)->count();

                if ($cek < 1) {

                    $penalty = new Mpenalty;
                    $penalty->periode = $request->periode;
                    $penalty->idcbu = $item->idcbu;
                    $penalty->idregion = $item->idregion;
                    $penalty->idsitename = $item->idsitename;
                    $penalty->kdunit = $item->kdunit;
                    $penalty->serialnumber = $item->serialnumber;
                    $penalty->price = $item->price;
                    $diff = abs(strtotime($item->daterequest) - strtotime($item->dateactual));
                    $years = floor($diff / (365 * 60 * 60 * 24));
                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                    if ($months == 0 && $days == 0) {
                        $penalty->late = 0;
                    } elseif ($months == 0 && $days > 0) {
                        $penalty->late = 1;
                    } elseif ($months > 0) {
                        $penalty->late = $months;
                    } else {
                        $penalty->late = 0;
                    }
                    $penalty->pricelate = $item->price * 0.05;
                    $penalty->penalty = $item->late * $item->price * 0.05;
                    $penalty->datetarget = $item->daterequest;
                    $penalty->dateactual = $item->dateactual;
                    $penalty->reason = $item->reason;
                    if ($item->dateactual != null) {
                        $penalty->flag_delivered = 'Delivered';
                    } else {
                        $penalty->flag_delivered = 'Undelivered';
                    }

                    $penalty->flag_otif = $item->flag_otif;
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
            $penalty->periode = $request->periode;
            $penalty->idcbu = $unit->idcbu;
            $penalty->idregion = $unit->idregion;
            $penalty->idsitename = $unit->idsitename;
            $penalty->kdunit = $unit->kdunit;
            $penalty->serialnumber = $unit->serialnumber;
            $penalty->price = $unit->price;
            $diff = abs(strtotime($unit->daterequest) - strtotime($unit->dateactual));
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            if ($months == 0 && $days == 0) {
                $penalty->late = 0;
            } elseif ($months == 0 && $days > 0) {
                $penalty->late = 1;
            } elseif ($months > 0) {
                $penalty->late = $months;
            } else {
                $penalty->late = 0;
            }

            $penalty->pricelate = $unit->price * 0.05;
            $penalty->penalty = $unit->late * $unit->price * 0.05;
            $penalty->datetarget = $unit->daterequest;
            $penalty->dateactual = $unit->dateactual;
            $penalty->reason = $unit->reason;
            if ($unit->dateactual != null) {
                $penalty->flag_delivered = 'Delivered';
            } else {
                $penalty->flag_delivered = 'Undelivered';
            }
            $penalty->flag_otif = $unit->flag_otif;
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
            'price' => 'required',

        ]);

        $penalty = MPenalty::find($id);
        $penalty->idcbu = $request->idcbu;
        $penalty->idregion = $request->idregion;
        $penalty->idsitename = $request->idsitename;
        $penalty->periode = $request->periode;
        $penalty->kdunit = $request->kdunit;
        $penalty->serialnumber = $request->serialnumber;
        $penalty->price = $request->price;
        $penalty->late = $request->late;
        $penalty->pricelate = $request->pricelate;
        $penalty->penalty = $request->penalty;
        $penalty->datetarget = $request->datetarget;
        $penalty->dateactual = $request->dateactual;
        $penalty->reason = $request->reason;
        $penalty->flag_delivered = $request->flag_delivered;
        $penalty->flag_otif = $request->flag_otif;

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
