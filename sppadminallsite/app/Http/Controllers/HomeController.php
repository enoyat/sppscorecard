<?php
namespace App\Http\Controllers;

use App\Models\MCustomer;
use App\Models\MPhysical;
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
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->take(10)
            ->get();
        return view('index', compact('notifications'));
    }
    public function root(Request $request)
    {
        if ($request->filled('periode')) {
            $mperiode = $request->periode;
            $periode  = $request->periode;
        } else {
            $mperiode = now()->format('Y-m');
            $periode  = now()->format('Y-m');
        }
        if ($request->get('filterby')) {
            $filter = $request->get('filterby');
        } else {
            $filter = "sitename";
        }
        // hitung KPI
        $query = MPhysical::query()
            ->join('unit', 'physicalavailable.kdunit', '=', 'unit.kdunit')
            ->join('forklifttype', 'unit.idforklifttype', '=', 'forklifttype.id')
            ->where('physicalavailable.periode', $mperiode);

        $subTrouble = DB::table('troubleaction')
            ->selectRaw("
        periode,
        kdunit,
        SUM(lapsetime) total_breakdown,
        SUM(backup_minutes) total_backup
    ")
            ->where('periode', $mperiode)
            ->groupBy('periode', 'kdunit');
        $query->leftJoinSub($subTrouble, 'tb', function ($join) {
            $join->on('physicalavailable.kdunit', '=', 'tb.kdunit')
                ->on('physicalavailable.periode', '=', 'tb.periode');
        });
        $query->selectRaw("
forklifttype.id idforklifttype,
forklifttype.namaforklifttype,
count(*) jumlah_unit,
sum(planunitkerja) total_plan,
sum(COALESCE(tb.total_breakdown,0)) breakdown_total,
sum(COALESCE(tb.total_backup,0)) backup_total,
sum(planunitkerja-COALESCE(tb.total_breakdown,0)) total_work,
ROUND(
(sum(planunitkerja-COALESCE(tb.total_breakdown,0)+COALESCE(tb.total_backup,0))
/
sum(planunitkerja))
*100
,2) pa
");

        $query->groupBy(
            'forklifttype.id',
            'forklifttype.namaforklifttype'
        );

        switch ($filter) {
            case 'Site':
                $query->where(
                    'physicalavailable.idsitename',
                    Session::get('runidsitename')
                );
                break;
            case 'Region':
                $query->where(
                    'physicalavailable.idregion',
                    Session::get('runidregion')
                );
                break;
            case 'CBU':
                $query->where(
                    'physicalavailable.idcbu',
                    Session::get('runidcbu')
                );
                break;
            default:
                $query->where(
                    'physicalavailable.idsitename',
                    Session::get('runidsitename')
                );
                break;
        }

        $querykpi = $query->get();

        $dashboard = [
            'totalUnit'   => $querykpi->sum('jumlah_unit'),
            'pa'          => $querykpi->avg('pa'),
            'working'     => $querykpi->sum('total_plan'),
            'breakdown'   => $querykpi->sum('breakdown_total'),
            'totalWork'   => $querykpi->sum('total_work'),
            'backup'      => $querykpi->sum('backup_total'),
            'mttr'        => 1.52,

        ];

        $kpi = [];
        foreach ($querykpi as $row) {
            $kpi[] = [
                'namaforklifttype' => $row->namaforklifttype,
                'jmlunit'          => $row->jumlah_unit,
                'sumplanunitkerja' => $row->total_plan,
                'sumtotaljamkerja' => $row->total_work,
                'totalbreakdown'   => $row->breakdown_total,
                'totalbackup'      => $row->backup_total,
                'avgpaforklift'    => $row->pa,
            ];
        }
        $labels       = collect($kpi)->pluck('namaforklifttype');
        $dataUnit     = collect($kpi)->pluck('jmlunit');
        $topBreakdown = $query->orderBy('total_breakdown', 'desc')->take(5)->get();
        // dd($topBreakdown);
        // KPI Delivery
        $querydelivery = DB::table('delivery')
            ->where('idsitename', Session::get('runidsitename'));

        $totaldelivery = (clone $querydelivery)->count();

        $totalclosed = (clone $querydelivery)
            ->where('statuscustomer', 'close')
            ->count();

        $kpiontime = $totaldelivery ? round($totalclosed / $totaldelivery * 100, 2) : 0;
        if ($totaldelivery > 0) {
            $kpilate = 100 - $kpiontime;
        } else {
            $kpilate = 0;
        }

        $kpidelivery = [
            'on_time'        => $kpiontime,
            'total_delivery' => $totaldelivery,
            'late_delivery'  => $kpilate,
            'total_closed'   => $totalclosed,
        ];
        // kpi sparepart
        $kpisparepartresult = DB::table('sparepartstok')
            ->where('idsitename', Session::get('runidsitename'))
            ->selectRaw('COALESCE(AVG((stok / NULLIF(qty, 0)) * 100), 0) AS kpisparepart')
            ->value('kpisparepart');
        if ($kpisparepartresult > 0) {
            $kpisparepart = [
                'stokavailable' => $kpisparepartresult,
                'notavailable'  => 100 - $kpisparepartresult,
            ];

        } else {
            $kpisparepart = [
                'stokavailable' => 0,
                'notavailable'  => 0,
            ];
        }

        $cbu      = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->where('f_aktif', '1')->get();
        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $customer = MCustomer::where('kdcustomer', Session::get('kdcustomer'))->first();
        Session::put('logo', $customer->logo);
        $customer     = MCustomer::get();
        $forklifttype = DB::table('forklifttype')->where('f_dashboard', 'Y')->get();
        return view('dashboard.index', compact(
            'periode',
            'dashboard',
            'kpi',
            'labels',
            'dataUnit',
            'kpidelivery',
            'kpisparepart',
            'topBreakdown',
            'cbu',
            'sitename',
            'customer',
            'forklifttype'
        ));
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
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);
        $user        = User::find($id);
        $user->name  = $request->get('name');
        $user->email = $request->get('email');
        if ($request->file('avatar')) {
            $avatar     = $request->file('avatar');
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
                'Message'   => "User Details Updated successfully!",
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message'   => "Something went wrong!",
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
            'password'         => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        if (! (Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message'   => "Your Current password does not matches with the password you provided. Please try again.",
            ], 200); // Status code
        } else {
            $user           = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message'   => "Password updated successfully!",
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message'   => "Something went wrong!",
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
