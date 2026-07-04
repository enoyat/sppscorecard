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

        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->take(10)
            ->get();

        return view('index', compact('notifications'));
    }
    public function root(Request $request)
    {

        $periode = '2026-07';

        $dashboard = [

            'totalUnit'    => 126,
            'pa'           => 97,
            'padelivery'   => 60.25,
            'pasparepart'  => 85,
            'working'      => 5620120,
            'breakdown'    => 18540,
            'backup'       => 2140,
            'mttr'         => 1.52,
            'mtbf'         => 312,

            'bestSite'     => 'Jakarta',
            'bestSitePA'   => 99.92,

            'worstSite'    => 'Balikpapan',
            'worstSitePA'  => 96.84,

            'criticalUnit' => 6,

        ];

        $kpi = [

            [
                'namaforklifttype' => 'Counter Balance',
                'jmlunit'          => 28,
                'sumplanunitkerja' => 1249920,
                'sumtotaljamkerja' => 1247300,
                'totalbreakdown'   => 2380,
                'totalbackup'      => 240,
                'avgpaforklift'    => 99.79,
            ],

            [
                'namaforklifttype' => 'Reach Truck',
                'jmlunit'          => 20,
                'sumplanunitkerja' => 892800,
                'sumtotaljamkerja' => 887200,
                'totalbreakdown'   => 5300,
                'totalbackup'      => 180,
                'avgpaforklift'    => 99.37,
            ],

            [
                'namaforklifttype' => 'Reach Stacker',
                'jmlunit'          => 15,
                'sumplanunitkerja' => 669600,
                'sumtotaljamkerja' => 664900,
                'totalbreakdown'   => 4500,
                'totalbackup'      => 120,
                'avgpaforklift'    => 99.30,
            ],

            [
                'namaforklifttype' => 'Electric Pallet',
                'jmlunit'          => 32,
                'sumplanunitkerja' => 1428480,
                'sumtotaljamkerja' => 1426000,
                'totalbreakdown'   => 2180,
                'totalbackup'      => 150,
                'avgpaforklift'    => 99.83,
            ],

            [
                'namaforklifttype' => 'Hand Pallet',
                'jmlunit'          => 18,
                'sumplanunitkerja' => 803520,
                'sumtotaljamkerja' => 802900,
                'totalbreakdown'   => 580,
                'totalbackup'      => 80,
                'avgpaforklift'    => 99.92,
            ],

            [
                'namaforklifttype' => 'Order Picker',
                'jmlunit'          => 13,
                'sumplanunitkerja' => 580320,
                'sumtotaljamkerja' => 576800,
                'totalbreakdown'   => 3320,
                'totalbackup'      => 70,
                'avgpaforklift'    => 99.39,
            ],

        ];

        $topBreakdown = [

            [
                'unit'     => 'FD25-001',
                'kategori' => 'Counter Balance',
                'site'     => 'Jakarta',
                'menit'    => 420,
            ],

            [
                'unit'     => 'RT20-015',
                'kategori' => 'Reach Truck',
                'site'     => 'Bekasi',
                'menit'    => 385,
            ],

            [
                'unit'     => 'ES10-002',
                'kategori' => 'Electric Stacker',
                'site'     => 'Surabaya',
                'menit'    => 310,
            ],

            [
                'unit'     => 'CB30-009',
                'kategori' => 'Counter Balance',
                'site'     => 'Semarang',
                'menit'    => 280,
            ],

            [
                'unit'     => 'OP15-011',
                'kategori' => 'Order Picker',
                'site'     => 'Bandung',
                'menit'    => 250,
            ],

        ];
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
