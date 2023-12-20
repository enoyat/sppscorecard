<?php

namespace App\Http\Controllers;

use App\Models\MCustomer;
use App\Models\MSitename;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('index');
        // if (view()->exists($request->path())) {
        //     return view($request->path());
        // }
        // return abort(404);
    }
    public function root(Request $request)
    {
        if ($request->get('periode')) {
            $mperiode = $request->get('periode');
        } else {
            $tahun = date('Y');
            $bulan = date('m');
            $mperiode = $tahun . '-' . $bulan;
        }
        if ($request->get('tglawal')) {
            $tglawal = $request->get('tglawal');
        } else {
            $tglawal = date('Y-m-d');
        }
        if ($request->get('tglakhir')) {
            $tglakhir = $request->get('tglakhir');
        } else {
            $tglakhir = date('Y-m-d');
        }




        if ($request->get('filter')) {
            $filter = $request->get('filter');
            if ($filter == 'sitename') {
                $id = $request->get('xidsitename');
                $sitename = MSitename::where('id', $id)->first();
                $region = MSitename::where('id', $sitename->parentid)->first();
                $cbu = MSitename::where('id', $region->parentid)->first();
                Session::put('runidcbu', $cbu->id);
                Session::put('runnamacbu', $cbu->namasitename);
                Session::put('runidregion', $region->id);
                Session::put('runnamaregion', $region->namasitename);
                Session::put('runidsitename', $id);
                Session::put('runnamasitename', $sitename->namasitename);
            }
            if ($filter == 'region') {
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
            }
            if ($filter == 'cbu') {
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
            }
        } else {
            $filter = 'sitename';
        }

        $arraykpi = [];
        if ($filter == 'sitename') {
            $sitename = Session::get('runidsitename');
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idsitename='$sitename'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idsitename='$sitename') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype");
            $delivery = DB::table('delivery')
                ->where('idsitename', $sitename)
                ->count('*');
            $delivered = DB::table('delivery')
                ->where('idsitename', $sitename)
                ->where('statuscustomer', 'close')
                ->count('*');
            $latedelivered = DB::table('delivery')
                ->where('idsitename', $sitename)
                ->where('daysoflapse', '>', '0')
                ->count('*');
            if ($delivery == 0) {
                $kpidelivery = 0;
                $kpiontimedelivery = 0;
            } else {
                $kpidelivery = number_format(($delivered / $delivery) * 100, 2);
                $kpiontimedelivery = number_format(($latedelivered / $delivery) * 100, 2);
            }
            $restkpisparepart = DB::table('sparepartstok')
                ->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
                ->where('idsitename', $sitename)
                ->get();
            if ($restkpisparepart) {
                foreach ($restkpisparepart as $item) {
                    $kpisparepart = $item->kpisparepart;
                }
            } else {
                $kpisparepart = 0;
            }
        } elseif ($request->filter == 'region') {
            $sitename = Session::get('runidregion');
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idregion='$sitename'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idregion='$sitename') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype");
            $delivery = DB::table('delivery')
                ->where('idregion', $sitename)
                ->count('*');
            $delivered = DB::table('delivery')
                ->where('idregion', $sitename)
                ->where('statuscustomer', 'close')
                ->count('*');
            $latedelivered = DB::table('delivery')
                ->where('idregion', $sitename)
                ->where('daysoflapse', '>', '0')
                ->count('*');
            if ($delivery == 0) {
                $kpidelivery = 0;
                $kpiontimedelivery = 0;
            } else {
                $kpidelivery = number_format(($delivered / $delivery) * 100, 2);
                $kpiontimedelivery = number_format(($latedelivered / $delivery) * 100, 2);
            }
            $restkpisparepart = DB::table('sparepartstok')
                ->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
                ->where('idregion', $sitename)
                ->get();
            if ($restkpisparepart) {
                foreach ($restkpisparepart as $item) {
                    $kpisparepart = $item->kpisparepart;
                }
            } else {
                $kpisparepart = 0;
            }
        } elseif ($request->filter == 'cbu') {
            $sitename = Session::get('runidcbu');
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idcbu='$sitename'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idcbu='$sitename') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype");
            $delivery = DB::table('delivery')
                ->where('idcbu', $sitename)
                ->count('*');
            $delivered = DB::table('delivery')
                ->where('idcbu', $sitename)
                ->where('statuscustomer', 'close')
                ->count('*');
            $latedelivered = DB::table('delivery')
                ->where('idcbu', $sitename)
                ->where('daysoflapse', '>', '0')
                ->count('*');
            if ($delivery == 0) {
                $kpidelivery = 0;
                $kpiontimedelivery = 0;
            } else {
                $kpidelivery = number_format(($delivered / $delivery) * 100, 2);
                $kpiontimedelivery = number_format(($latedelivered / $delivery) * 100, 2);
            }
            $restkpisparepart = DB::table('sparepartstok')
                ->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
                ->where('idcbu', $sitename)
                ->get();
            if ($restkpisparepart) {
                foreach ($restkpisparepart as $item) {
                    $kpisparepart = $item->kpisparepart;
                }
            } else {
                $kpisparepart = 0;
            }
        } elseif ($request->filter == 'allsn') {
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idcbu='SN'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idcbu='SN') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype");
            $delivery = DB::table('delivery')
                ->where('idcbu', 'SN')
                ->count('*');
            $delivered = DB::table('delivery')
                ->where('idcbu', 'SN')
                ->where('statuscustomer', 'close')
                ->count('*');
            $latedelivered = DB::table('delivery')
                ->where('idcbu', 'SN')
                ->where('daysoflapse', '>', '0')
                ->count('*');
            if ($delivery == 0) {
                $kpidelivery = 0;
                $kpiontimedelivery = 0;
            } else {
                $kpidelivery = number_format(($delivered / $delivery) * 100, 2);
                $kpiontimedelivery = number_format(($latedelivered / $delivery) * 100, 2);
            }
            $restkpisparepart = DB::table('sparepartstok')
                ->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
                ->where('idcbu', 'SN')
                ->get();
            if ($restkpisparepart) {
                foreach ($restkpisparepart as $item) {
                    $kpisparepart = $item->kpisparepart;
                }
            } else {
                $kpisparepart = 0;
            }
        } elseif ($request->filter == 'allwater') {
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idcbu='Waters'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idcbu='Waters') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype");
            $delivery = DB::table('delivery')
                ->where('idcbu', 'Waters')
                ->count('*');
            $delivered = DB::table('delivery')
                ->where('idcbu', 'Waters')
                ->where('statuscustomer', 'close')
                ->count('*');
            $latedelivered = DB::table('delivery')
                ->where('idcbu', 'Waters')
                ->where('daysoflapse', '>', '0')
                ->count('*');
            if ($delivery == 0) {
                $kpidelivery = 0;
                $kpiontimedelivery = 0;
            } else {
                $kpidelivery = number_format(($delivered / $delivery) * 100, 2);
                $kpiontimedelivery = number_format(($latedelivered / $delivery) * 100, 2);
            }
            $restkpisparepart = DB::table('sparepartstok')
                ->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
                ->where('idcbu', 'Waters')
                ->get();
            if ($restkpisparepart) {
                foreach ($restkpisparepart as $item) {
                    $kpisparepart = $item->kpisparepart;
                }
            } else {
                $kpisparepart = 0;
            }
        } elseif ($request->filter == 'allsnwater') {
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idcbu='SN' or unit.idcbu='Waters'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idcbu='SN' or unit.idcbu='Waters') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype;");
            $delivery = count(DB::select("select * from delivery where (idcbu= 'SN' or idcbu='Waters') and dateestimated between '$tglawal' and '$tglakhir' "));

            $delivered = count(DB::select("select * from delivery where (idcbu='SN' or idcbu='Waters') and statuscustomer='close'"));
            $latedelivered = count(DB::select(" select * from delivery where (idcbu= 'SN' or idcbu='Waters') and dateestimated between '$tglawal' and '$tglakhir' and daysoflapse>0"));

            if ($delivery == 0) {
                $kpidelivery = 0;
                $kpiontimedelivery = 0;
            } else {
                $kpidelivery = number_format(($delivered / $delivery) * 100, 2);
                $kpiontimedelivery = number_format(($latedelivered / $delivery) * 100, 2);
            }
            $restkpisparepart = DB::table('sparepartstok')
                ->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
                ->where('idcbu', 'SN')
                ->orWhere('idcbu', 'Waters')
                ->get();
            if ($restkpisparepart) {
                foreach ($restkpisparepart as $item) {
                    $kpisparepart = $item->kpisparepart;
                }
            } else {
                $kpisparepart = 0;
            }
        }
        $i = 0;
        foreach ($kpi as $k) {
            $dataunit = DB::table('troubleaction')
                ->join('unit', 'troubleaction.kdunit', '=', 'unit.kdunit')
                ->join('forklifttype', 'unit.idforklifttype', '=', 'forklifttype.id')
                ->where('troubleaction.periode', $mperiode)
                ->where('unit.idforklifttype', $k->idforklifttype)
                ->where('unit.idsitename', Session::get('runidsitename'))

                ->get();

            $arraykpi[$i] = [
                'idforklifttype' => $k->idforklifttype,
                'namaforklifttype' => $k->namaforklifttype,
                'jmlunit' => $k->jmlunit,
                'sumplanunitkerja' => $k->sumplanunitkerja,
                'sumtotaljamkerja' => $k->sumtotaljamkerja,
                'totalbreakdown' => $k->sumplanunitkerja - $k->sumtotaljamkerja,
                'avgpaforklift' => number_format(($k->sumtotaljamkerja / $k->sumplanunitkerja) * 100, 2),
                'dataunit' => $dataunit,
            ];
            $i++;
        }
        $restkpisparepart = DB::table('sparepartstok')
            ->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
            ->where('idsitename', Session::get('runidsitename'))
            ->get();
        if ($restkpisparepart) {
            foreach ($restkpisparepart as $item) {
                $kpisparepart = $item->kpisparepart;
            }
        } else {
            $kpisparepart = 0;
        }

        $cbu = MSitename::member(Session::get('kdcustomer'))
            ->kategori('cbu')
            ->where('f_aktif', '1')
            ->get();

        $sitename = MSitename::member(Session::get('kdcustomer'))
            ->kategori('sitename')
            ->get();

        $customer = MCustomer::get();
        // dd($sitename);
        $unit = '[';
        $achievement = '[';
        $max = '[';
        $base = '[';
        $kategori = '';
        $jmlunit = 0;
        $totalavgkpi = 0;
        $counter = 0;
        foreach ($kpi as $k) {
            $achievement = $achievement . number_format($k->avgpaforklift, 2) . ',';
            $max = $max . '100,';
            $base = $base . '98,';
            $unit = $unit . $k->jmlunit . ',';
            $kategori = $kategori . ",'" . $k->namaforklifttype . "'";
            $jmlunit = $jmlunit + $k->jmlunit;
            $totalavgkpi = $totalavgkpi + $k->avgpaforklift;
            $counter++;
        }
        // dd($totalavgkpi."-".$counter);
        $achievement = $achievement . ']';
        $unit = $unit . ']';
        $max = $max . ']';
        $base = $base . ']';
        $kategori = '[' . substr($kategori, 1) . ']';
        if ($counter == 0) {
            $avgkpi = 0;
        } else {
            $avgkpi = number_format($totalavgkpi / $counter, 2);
        }

        return view('index', compact('kpi', 'cbu', 'achievement', 'max', 'base', 'kategori', 'sitename', 'customer', 'unit', 'mperiode', 'jmlunit', 'avgkpi', 'arraykpi', 'kpidelivery', 'delivery',  'kpisparepart', 'kpiontimedelivery', 'tglawal', 'tglakhir'));
    }

    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()
                ->back()
                ->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }
    public function kpidelivery(Request $request)
    {
        $mperiode = $request->get('periode');
        $tglawal = $request->get('tglawal');
        $tglakhir = $request->get('tglakhir');
        $filter = $request->get('filter');
        $delivery = count(DB::select("select * from delivery where (idcbu= 'SN' or idcbu='Waters') and dateestimated between '$tglawal' and '$tglakhir' "));
        $delivered = count(DB::select("select * from delivery where (idcbu= 'SN' or idcbu='Waters') and dateestimated between '$tglawal' and '$tglakhir' and statuscustomer='close' "));

        $latedelivered = count(DB::select(" select * from delivery where (idcbu= 'SN' or idcbu='Waters') and dateestimated between '$tglawal' and '$tglakhir' and daysoflapse>0"));

          if ($delivery == 0) {
              $kpidelivery = 0;
              $kpiontimedelivery = 0;
          } else {
              $kpidelivery = number_format(($delivered / $delivery) * 100, 2);
              $kpiontimedelivery = number_format(($latedelivered / $delivery) * 100, 2);
              return response()->json(
                  [
                      'isSuccess' => true,
                      'Message' => 'Data Found',
                      'kpidelivery' => $kpidelivery,
                      'kpiontimedelivery' => $kpiontimedelivery,
                  ],
                  200,
              ); // Status code here
          }

    }
    public function updateProfile(Request $request, $id)
    {
        // return $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar = '/images/' . $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            return response()->json(
                [
                    'isSuccess' => true,
                    'Message' => 'User Details Updated successfully!',
                ],
                200,
            ); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json(
                [
                    'isSuccess' => true,
                    'Message' => 'Something went wrong!',
                ],
                200,
            ); // Status code here
        }
    }
    public function gantipassword()
    {
        return view('password');
    }
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!Hash::check($request->get('current_password'), Auth::user()->password)) {
            return response()->json(
                [
                    'isSuccess' => false,
                    'Message' => 'Your Current password does not matches with the password you provided. Please try again.',
                ],
                200,
            ); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json(
                    [
                        'isSuccess' => true,
                        'Message' => 'Password updated successfully!',
                    ],
                    200,
                ); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json(
                    [
                        'isSuccess' => true,
                        'Message' => 'Something went wrong!',
                    ],
                    200,
                ); // Status code here
            }
        }
    }
    public function registrasi()
    {
        return view('auth-register');
    }
    public function restrictpage()
    {
        return view('restrict-page');
    }
}
