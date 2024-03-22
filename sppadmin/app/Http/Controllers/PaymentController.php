<?php

namespace App\Http\Controllers;


use App\Models\MUnit;

use App\Models\MForklifttype;
use App\Models\Mpayment;
use App\Models\User;
use App\Models\MSitename;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
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
        $payment = Mpayment::with('getunit')->where('idsitename', Session::get('runidsitename'))->get();
        $forklifttype = MForklifttype::get();
        return view('payment.index', compact('payment', 'forklifttype', 'cbu','sitename'));
    }
    public function create()
    {
        if (Session::get('roles_id') == 2) {
            $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        } else {
            $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        }
        $forklifttype = MForklifttype::get();
        return view('payment.create', compact('cbu', 'forklifttype'));
    }
    public function edit($id)
    {
        $cbu = MCbu::get();
        $forklifttype = MForklifttype::get();
        $payment = Mpayment::find($id);
        return view('payment.edit', compact('cbu', 'forklifttype', 'payment'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcbu' => 'required',
            'idregion' => 'required',
            'idsitename' => 'required',
            'periode' => 'required',
            'pilihunit' => 'required',
            'harikerja' => 'required',
            'planunitkerja' => 'required',
        ]);


        if ($request->pilihunit == "allunit") {

            $unit = MUnit::where('idsitename', $request->idsitename)->get();

            foreach ($unit as $item) {
                $cek = Mpayment::where('kdunit', $item->kdunit)->where('periode', $request->periode)->count();
                if ($cek < 1) {

                    $payment = new Mpayment;
                    $payment->idcbu = $request->idcbu;
                    $payment->idregion = $request->idregion;
                    $payment->idsitename = $request->idsitename;
                    $payment->periode = $request->periode;
                    $payment->kdunit = $item->kdunit;
                    $payment->harikerja = $request->harikerja;
                    $payment->planunitkerja = $request->planunitkerja;
                    $payment->totaljamkerja = $request->planunitkerja;
                    $payment->paforklift = 100;

                    $simpan = $payment->save();
                }
            }
            Alert::success('Success', 'Data berhasil disimpan!');
            return redirect()->route('payment.index');
        } else {

            $cek = Mpayment::where('kdunit', $request->kdunit)->where('periode', $request->periode)->count();
            if ($cek > 0) {
                Alert::error('Error', 'Data sudah ada!');
                Session::flash('message', 'Data sudah ada!');
                return redirect()->back();
            }
            $payment = new Mpayment;
            $payment->idcbu = $request->idcbu;
            $payment->idregion = $request->idregion;
            $payment->idsitename = $request->idsitename;
            $payment->periode = $request->periode;
            $payment->kdunit = $request->kdunit;
            $payment->harikerja = $request->harikerja;
            $payment->planunitkerja = $request->planunitkerja;
            $payment->totaljamkerja = $request->planunitkerja;
            $payment->paforklift = 100;

            $simpan = $payment->save();

            if ($simpan) {
                Alert::success('Success', 'Data berhasil disimpan!');
                Session::flash('message', 'Data berhasil disimpan!');
                return redirect()->route('payment.index');
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
            'harikerja' => 'required',
            'planunitkerja' => 'required',
        ]);



        $payment = Mpayment::find($id);
        $payment->idcbu = $request->idcbu;
        $payment->idregion = $request->idregion;
        $payment->idsitename = $request->idsitename;
        $payment->periode = $request->periode;
        $payment->kdunit = $request->kdunit;
        $payment->harikerja = $request->harikerja;
        $payment->planunitkerja = $request->planunitkerja;
        $payment->totalbreakdown = $request->totalbreakdown;
        $payment->totaljamkerja = $request->planunitkerja;
        $simpan = $payment->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('payment.index');
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
            Mpayment::where('id', '=', $id)->delete();

            return redirect()->route('payment.index');
        } catch (QueryException $ex) {
            return redirect()->route('payment.index');
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
        $payment = Mpayment::find($id);
        return view('payment.formstatus', compact('payment', 'aid'));
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
            $payment = Mpayment::find($id);
            $payment->statusspp = $statusspp;
            $payment->save();
        } else {
            $request->validate([
                'statuscustomer' => 'required',
            ]);
            $statuscustomer = $request->statuscustomer;
            $payment = Mpayment::find($id);
            $payment->statuscustomer = $statuscustomer;
            $payment->save();
        }

        return redirect()->route('payment.index');
    }
}
