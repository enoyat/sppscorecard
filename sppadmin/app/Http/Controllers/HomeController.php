<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Models\MSitename;
use App\Models\MCustomer;

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
            $mperiode=$request->get('periode');
        }
        else {
            $tahun=date('Y');
            $bulan=date('m');
            $mperiode=$tahun.'-'.$bulan;
        }
        $kpi=DB::table('physicalavailable')->
        join('unit','unit.kdunit','=','physicalavailable.kdunit')->
        join('forklifttype','unit.idforklifttype','=','forklifttype.id')->
        select(DB::raw('namaforklifttype, count(unit.kdunit) as jmlunit, sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift  '))
        ->where('periode',$mperiode)
        ->where('unit.idsitename',Session::get('runidsitename'))
        ->where('forklifttype.f_dashboard',"Y")
        ->groupBy('namaforklifttype')
        ->get();
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();

        $sitename=MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();

        $customer=MCustomer::get();
        // dd($sitename);
        $unit="[";
        $achievement="[";
        $max="[";
        $base="[";
        $kategori="";
        $jmlunit=0;
        $totalavgkpi=0;
        $counter=0;
        foreach($kpi as $k){
            $achievement=$achievement.number_format($k->avgpaforklift,2).',';
            $max=$max.'100,';
            $base=$base.'98,';
            $unit=$unit.$k->jmlunit.',';
            $kategori=$kategori.",'".$k->namaforklifttype."'";
            $jmlunit=$jmlunit+$k->jmlunit;
            $totalavgkpi=$totalavgkpi+$k->avgpaforklift;
            $counter++;

        }
       // dd($totalavgkpi."-".$counter);
        $achievement=$achievement."]";
        $unit=$unit."]";
        $max=$max."]";
        $base=$base."]";
        $kategori="[".substr($kategori,1)."]";
        if ($counter==0) {
            $avgkpi=0;
        }
        else {
            $avgkpi=number_format($totalavgkpi/$counter,2);

        }

        return view('index',compact('kpi','cbu','achievement','max','base','kategori','sitename','customer','unit','mperiode','jmlunit','avgkpi'));
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
                'Message' => "User Details Updated successfully!"
            ], 200); // Status code here
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message' => "Something went wrong!"
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
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
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
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }
    public function registrasi(){
        return view('auth-register');
    }
    public function restrictpage(){
        return view('restrict-page');
    }
}
