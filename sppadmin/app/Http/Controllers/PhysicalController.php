<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MUnit;

use App\Models\MForklifttype;
use App\Models\MPhysical;
use App\Models\User;
use Illuminate\Console\View\Components\Alert as ComponentsAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class PhysicalController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu = MCbu::get();
        $physical = MPhysical::with('getunit')->where('idsitename', Session::get('runidsitename'))->get();
        $forklifttype = MForklifttype::get();
        return view('physical.index', compact('physical', 'forklifttype', 'cbu'));
    }
    public function create()
    {
        if (Session::get('roles_id') == 2) {
            $cbu = MCbu::where('id', Session::get('runidcbu'))->get();
        } else {
            $cbu = MCbu::get();
        }
        $forklifttype = MForklifttype::get();
        return view('physical.create', compact('cbu', 'forklifttype'));
    }
    public function edit($id)
    {
        $cbu = MCbu::get();
        $forklifttype = MForklifttype::get();
        $physical = MPhysical::find($id);
        return view('physical.edit', compact('cbu', 'forklifttype', 'physical'));
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
                $cek = MPhysical::where('kdunit', $item->kdunit)->where('periode', $request->periode)->count();
                if ($cek < 1) {

                    $physical = new MPhysical;
                    $physical->idcbu = $request->idcbu;
                    $physical->idregion = $request->idregion;
                    $physical->idsitename = $request->idsitename;
                    $physical->periode = $request->periode;
                    $physical->kdunit = $item->kdunit;
                    $physical->harikerja = $request->harikerja;
                    $physical->planunitkerja = $request->planunitkerja;
                    $physical->totaljamkerja = $request->planunitkerja;
                    $physical->paforklift = 100;

                    $simpan = $physical->save();
                }
            }
            Alert::success('Success', 'Data berhasil disimpan!');
            return redirect()->route('physical.index');
        } else {

            $cek = MPhysical::where('kdunit', $request->kdunit)->where('periode', $request->periode)->count();
            if ($cek > 0) {
                Alert::error('Error', 'Data sudah ada!');
                Session::flash('message', 'Data sudah ada!');
                return redirect()->back();
            }
            $physical = new MPhysical;
            $physical->idcbu = $request->idcbu;
            $physical->idregion = $request->idregion;
            $physical->idsitename = $request->idsitename;
            $physical->periode = $request->periode;
            $physical->kdunit = $request->kdunit;
            $physical->harikerja = $request->harikerja;
            $physical->planunitkerja = $request->planunitkerja;
            $physical->totaljamkerja = $request->planunitkerja;
            $physical->paforklift = 100;

            $simpan = $physical->save();

            if ($simpan) {
                Alert::success('Success', 'Data berhasil disimpan!');
                Session::flash('message', 'Data berhasil disimpan!');
                return redirect()->route('physical.index');
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



        $physical = MPhysical::find($id);
        $physical->idcbu = $request->idcbu;
        $physical->idregion = $request->idregion;
        $physical->idsitename = $request->idsitename;
        $physical->periode = $request->periode;
        $physical->kdunit = $request->kdunit;
        $physical->harikerja = $request->harikerja;
        $physical->planunitkerja = $request->planunitkerja;
        $physical->totalbreakdown = $request->totalbreakdown;
        $physical->totaljamkerja = $request->planunitkerja;
        $simpan = $physical->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('physical.index');
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
            MPhysical::where('id', '=', $id)->delete();

            return redirect()->route('physical.index');
        } catch (QueryException $ex) {
            return redirect()->route('physical.index');
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
        $physical = MPhysical::find($id);
        return view('physical.formstatus', compact('physical', 'aid'));
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
            $physical = MPhysical::find($id);
            $physical->statusspp = $statusspp;
            $physical->save();
        } else {
            $request->validate([
                'statuscustomer' => 'required',
            ]);
            $statuscustomer = $request->statuscustomer;
            $physical = MPhysical::find($id);
            $physical->statuscustomer = $statuscustomer;
            $physical->save();
        }

        return redirect()->route('physical.index');
    }
}
