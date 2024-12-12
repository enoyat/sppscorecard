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
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

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
        if ($request->get('filter')) {
            $filter = $request->get('filter');
        } else {
            $filter = "sitename";
        }

        $arraykpi = array();
        if ($filter == "sitename") {
            $kpi = DB::table('physicalavailable')->join('unit', 'unit.kdunit', '=', 'physicalavailable.kdunit')->join('forklifttype', 'unit.idforklifttype', '=', 'forklifttype.id')->select(DB::raw('idforklifttype, namaforklifttype, count(unit.kdunit) as jmlunit, sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift  '))
                ->where('periode', 'like', '%' . $mperiode . '%')
                ->where('unit.idsitename', request()->get('xidsitename'))
                ->where('forklifttype.f_dashboard', "Y")
                ->groupBy('namaforklifttype', 'idforklifttype')
                ->get();
        } else if ($request->filter == "region") {
            $kpi = DB::table('physicalavailable')->join('unit', 'unit.kdunit', '=', 'physicalavailable.kdunit')->join('sitename', 'unit.idsitename', '=', 'sitename.id')->join('forklifttype', 'unit.idforklifttype', '=', 'forklifttype.id')->select(DB::raw('idforklifttype, namaforklifttype, count(unit.kdunit) as jmlunit, sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift  '))
                ->where('periode', 'like', '%' . $mperiode . '%')
                ->where('unit.idregion', request()->get('xidregion'))
                ->where('forklifttype.f_dashboard', "Y")
                ->groupBy('namaforklifttype', 'idforklifttype')
                ->get();
        } else if ($request->filter == "cbu") {

            $kpi = DB::table('physicalavailable')->join('unit', 'unit.kdunit', '=', 'physicalavailable.kdunit')->join('sitename', 'unit.idsitename', '=', 'sitename.id')->join('forklifttype', 'unit.idforklifttype', '=', 'forklifttype.id')->select(DB::raw('idforklifttype, namaforklifttype, count(unit.kdunit) as jmlunit, sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift  '))
                ->where('periode', 'like', '%' . $mperiode . '%')
                ->where('unit.idcbu', request()->get('xidcbu'))
                ->where('forklifttype.f_dashboard', "Y")
                ->groupBy('namaforklifttype', 'idforklifttype')
                ->get();
        }
        $i = 0;
        foreach ($kpi as $k) {
            if ($request->filter == "sitename") {
                $dataunit = DB::table('troubleaction')
                    ->join('unit', 'troubleaction.kdunit', '=', 'unit.kdunit')
                    ->join('forklifttype', 'unit.idforklifttype', '=', 'forklifttype.id')
                    ->where('troubleaction.periode', $mperiode)
                    ->where('unit.idforklifttype', $k->idforklifttype)
                    ->where('unit.idsitename', request()->get('xidsitename'))
                    ->get();
            } else if ($request->filter == "region") {
                $dataunit = DB::table('troubleaction')
                    ->join('unit', 'troubleaction.kdunit', '=', 'unit.kdunit')
                    ->join('forklifttype', 'unit.idforklifttype', '=', 'forklifttype.id')
                    ->where('troubleaction.periode', $mperiode)
                    ->where('unit.idforklifttype', $k->idforklifttype)
                    ->where('unit.idregion', request()->get('xidregion'))
                    ->get();
            } else if ($request->filter == "cbu") {
                $dataunit = DB::table('troubleaction')
                    ->join('unit', 'troubleaction.kdunit', '=', 'unit.kdunit')
                    ->join('forklifttype', 'unit.idforklifttype', '=', 'forklifttype.id')
                    ->where('troubleaction.periode', $mperiode)
                    ->where('unit.idforklifttype', $k->idforklifttype)
                    ->where('unit.idsitename', request()->get('xidcbu'))
                    ->get();
            }

            $arraykpi[$i] = array(
                'idforklifttype' => $k->idforklifttype,
                'namaforklifttype' => $k->namaforklifttype,
                'jmlunit' => $k->jmlunit,
                'sumplanunitkerja' => $k->sumplanunitkerja,
                'sumtotaljamkerja' => $k->sumtotaljamkerja,
                'totalbreakdown' => $k->sumplanunitkerja - $k->sumtotaljamkerja,
                'avgpaforklift' => number_format($k->sumtotaljamkerja / $k->sumplanunitkerja * 100, 2),
                'dataunit' => $dataunit,
            );
            $i++;
        }

        if ($request->filter == "sitename") {
            $restkpisparepart = DB::table('sparepartstok')->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
                ->where('idsitename', request()->get('xidsitename'))
                ->get();
        } else if ($request->filter == "region") {
            $restkpisparepart = DB::table('sparepartstok')->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
                ->where('idregion', request()->get('xidregion'))
                ->get();
        } else if ($request->filter == "cbu") {
            $restkpisparepart = DB::table('sparepartstok')->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
                ->where('idcbu', request()->get('xidcbu'))
                ->get();
        } else {
            $restkpisparepart = DB::table('sparepartstok')->select(DB::raw('avg((stok/qty)*100) as kpisparepart'))
                ->get();
        }
        if ($restkpisparepart) {
            foreach ($restkpisparepart as $item) {
                $kpisparepart = $item->kpisparepart;
            }
        } else {
            $kpisparepart = 0;
        }

        $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->where('f_aktif', '1')->get();
        if ($request->filter == "sitename") {
            $delivery = DB::table('delivery')->where('idsitename', request()->get('xidsitename'))->count('*');
            $delivered = DB::table('delivery')->where('idsitename', request()->get('xidsitename'))->where('statuscustomer', 'close')->count('*');
        } else if ($request->filter == "region") {
            $delivery = DB::table('delivery')->where('idregion', request()->get('xidregion'))->count('*');
            $delivered = DB::table('delivery')->where('idregion', request()->get('xidregion'))->where('statuscustomer', 'close')->count('*');
        } else if ($request->filter == "cbu") {
            $delivery = DB::table('delivery')->where('idcbu', request()->get('xidcbu'))->count('*');
            $delivered = DB::table('delivery')->where('idcbu', request()->get('xidcbu'))->where('statuscustomer', 'close')->count('*');
        } else {
            $delivery = 0;
            $delivered = 0;
        }
        if ($delivery == 0) {
            $kpidelivery = 0;
        } else {
            $kpidelivery = number_format($delivered / $delivery * 100, 2);
        }

        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $customer = MCustomer::where('kdcustomer', Session::get('kdcustomer'))->first();

        Session::put('logo', $customer->logo);

        $customer = MCustomer::get();
        // dd($sitename);
        $unit = "[";
        $achievement = "[";
        $max = "[";
        $base = "[";
        $kategori = "";
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
        $achievement = $achievement . "]";
        $unit = $unit . "]";
        $max = $max . "]";
        $base = $base . "]";
        $kategori = "[" . substr($kategori, 1) . "]";
        if ($counter == 0) {
            $avgkpi = 0;
        } else {
            $avgkpi = number_format($totalavgkpi / $counter, 2);
        }

        return view('index', compact('kpi', 'cbu', 'achievement', 'max', 'base', 'kategori', 'sitename', 'customer', 'unit', 'mperiode', 'jmlunit', 'avgkpi', 'arraykpi', 'kpidelivery', 'delivery', 'delivered', 'kpisparepart'));
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
            return response()->json([
                'isSuccess' => true,
                'Message' => "User Details Updated successfully!",
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!",
            ], 200); // Status code here
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

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again.",
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!",
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!",
                ], 200); // Status code here
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
