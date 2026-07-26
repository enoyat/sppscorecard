<?php

namespace App\Http\Controllers;

use App\Models\MForklifttype;
use App\Models\MMaintenanceaction;
use App\Models\MSitename;
use App\Models\MTroubleaction;
use App\Models\MUnit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class MasterUnitController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $cbu      = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $unit     = MUnit::where('idsitename', Session::get('runidsitename'))->get();
        return view('master.unit.index', compact('unit', 'cbu', 'sitename'));
    }
    public function create()
    {
        $cbu          = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $forklifttype = MForklifttype::get();
        return view('master.unit.create', compact('cbu', 'forklifttype'));
    }
    public function edit($id)
    {
        $cbu          = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $unit         = MUnit::find($id);
        $forklifttype = MForklifttype::get();
        return view('master.unit.edit', compact('cbu', 'unit', 'forklifttype'));
    }
    public function store(Request $request)
    {
        $unit = MUnit::where('kdunit', $request->kdunit)->first();

        if ($unit) {
            return back()
                ->withErrors([
                    'kdunit' => "Kode Unit sudah digunakan.
            Site Name: {$unit->getsitename->namasitename}",
                ])
                ->withInput();
        }
        $request->validate([
            'idcbu'          => 'required',
            'idregion'       => 'required',
            'idsitename'     => 'required',
            'kdunit'         => 'required|unique:unit,kdunit',
            'hm'             => 'required',
            'price'          => 'required',
            'idforklifttype' => 'required',
            'showcustomer'   => 'required',
            'flag_baru'      => 'required',

        ]);

        $filename = '';
        $siloname = '';

        if (! empty($request->filefoto)) {
            $file       = $request->filefoto;
            $pathUpload = 'img';

            $extension = $file->getClientOriginalExtension();
            $filename  = time() . "." . $extension;
            $file->move($pathUpload, $filename);
        } else {
            $filename = 'default.png';
        }

        if (! empty($request->fileSilo)) {
            $file     = $request->fileSilo;
            $pathSilo = 'img';

            $extension = $file->getClientOriginalExtension();
            $siloname  = time() . "silo." . $extension;
            $file->move($pathSilo, $siloname);
        }

        $unit                 = new MUnit;
        $unit->idcbu          = $request->idcbu;
        $unit->idregion       = $request->idregion;
        $unit->idsitename     = $request->idsitename;
        $unit->kdunit         = $request->kdunit;
        $unit->idforklifttype = $request->idforklifttype;

        $unit->equipment     = $request->equipment;
        $unit->merk          = $request->merk;
        $unit->type          = $request->type;
        $unit->model         = $request->model;
        $unit->capcity       = $request->capcity;
        $unit->serialnumber  = $request->serialnumber;
        $unit->specification = $request->specification;
        $unit->qty           = $request->qty;
        $unit->mast          = $request->mast;
        $unit->masheight     = $request->masheight;
        $unit->namaunit      = $request->kdunit;
        $unit->hm            = $request->hm;
        $unit->price         = $request->price;

        $unit->foto          = $filename;
        $unit->showcustomer  = $request->showcustomer;
        $unit->flag_baru     = $request->flag_baru;
        $unit->daterequest   = $request->daterequest;
        $unit->dateestimated = $request->dateestimated;
        $unit->dateactual    = $request->dateactual;
        $unit->reason        = $request->reason;
        $unit->flag_otif     = $request->flag_otif;
        $unit->flag_target   = $request->flag_target;
        $unit->flag_actual   = $request->flag_actual;
        $unit->file_silo     = $siloname;
        $unit->date_silo     = $request->siloDate;
        $simpan              = $unit->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('masterunit.index');
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message'   => "Something went wrong!",
            ], 200); // Status code here
        }
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'idcbu'       => 'required',
            'idregion'    => 'required',
            'idsitename'  => 'required',

        ]);

        $unit = MUnit::find($id);

        if (! empty($request->filefoto)) {
            $file       = $request->filefoto;
            $pathUpload = 'img';

            $extension = $file->getClientOriginalExtension();
            $filename  = time() . "." . $extension;
            $file->move($pathUpload, $filename);
        } else {
            $filename = 'default.png';
        }

        if (! empty($request->fileSiloNew)) {
            if ($unit->file_silo) {
                $pathUpload = 'img' . $unit->file_silo;
                if (file_exists($pathUpload)) {
                    unlink($pathUpload);
                }
            }

            $file     = $request->fileSiloNew;
            $pathSilo = 'img';

            $extension = $file->getClientOriginalExtension();
            $siloname  = time() . "silo." . $extension;
            $file->move($pathSilo, $siloname);

            $unit->file_silo = $siloname;
        }

        $unit->idcbu          = $request->idcbu;
        $unit->idregion       = $request->idregion;
        $unit->idsitename     = $request->idsitename;
        $unit->kdunit         = $request->kdunit;
        $unit->idforklifttype = $request->idforklifttype;
        $unit->equipment      = $request->equipment;
        $unit->merk           = $request->merk;
        $unit->type           = $request->type;
        $unit->model          = $request->model;
        $unit->capcity        = $request->capcity;
        $unit->serialnumber   = $request->serialnumber;
        $unit->specification  = $request->specification;
        $unit->mast           = $request->mast;
        $unit->masheight      = $request->masheight;
        $unit->qty            = $request->qty;
        $unit->showcustomer   = $request->showcustomer;

        $unit->namaunit      = $request->kdunit;
        $unit->price         = $request->price;
        $unit->foto          = $filename;
        $unit->flag_baru     = $request->flag_baru;
        $unit->daterequest   = $request->daterequest;
        $unit->dateestimated = $request->dateestimated;
        $unit->dateactual    = $request->dateactual;
        $unit->reason        = $request->reason;
        $unit->flag_otif     = $request->flag_otif;
        $unit->flag_target   = $request->flag_target;
        $unit->flag_actual   = $request->flag_actual;
        $unit->date_silo     = $request->siloDate;

        $simpan = $unit->save();
        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('masterunit.index');
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message'   => "Something went wrong!",
            ], 200); // Status code here
        }
    }
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            MUnit::where('kdunit', '=', $id)->delete();
            Alert::success('sukses dihapus');
            return redirect()->route('masterunit.index');
        } catch (QueryException $ex) {
            Alert::error('Gagal hapus, ada relasi data dengan yang lain');
            return redirect()->route('masterunit.index');
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
    public function getunit(Request $request)
    {
        $unit = MUnit::where('idsitename', $request->idsitename)->where('kdunit', 'LIKE', '%' . $request->search . '%')->orderBy('kdunit', 'ASC')->get();

        $response = [];
        foreach ($unit as $value) {
            $response[] = [
                "id"   => $value->kdunit,
                "text" => $value->kdunit,
            ];
        }

        return response()->json($response);
    }

    public function search(Request $request)
    {

        $units              = MUnit::where('kdunit', 'LIKE', '%' . $request->keyword . '%')->orderBy('kdunit', 'ASC')->get();
        $listactions        = $listactions        = MMaintenanceaction::where('kdunit', $request->keyword)->get();
        $listtroubleactions = MTroubleaction::where('kdunit', $request->keyword)->get();
        return view('masterunit.search', compact('units', 'listactions', 'listtroubleactions'));
    }
}
