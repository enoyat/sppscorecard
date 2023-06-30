<?php

namespace App\Http\Controllers;

use App\Models\MCbu;

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
        $cbu=MCbu::get();
        $physical = MPhysical::with('getunit')->where('idsitename',Session::get('runidsitename'))->get();
        $forklifttype = MForklifttype::get();
        return view('physical.index', compact('physical','forklifttype','cbu'));
    }
    public function create()
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        return view('physical.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MCbu::get();
        $forklifttype = MForklifttype::get();
        $physical = MPhysical::find($id);
        return view('physical.edit',compact('cbu','forklifttype','physical'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required',
            'idsitename'=>'required',
            'tanggal'=>'required',
            'kdunit'=>'required',
            'harikerja'=>'required',
            'statusspp'=>'required',
        ]);

      
        
        $physical = new MPhysical;
        $physical->idcbu = $request->idcbu;
        $physical->idregion = $request->idregion;
        $physical->idsitename = $request->idsitename;
        $physical->tanggal = date('Y-m',strtotime($request->tanggal));
        $physical->kdunit = $request->kdunit;
        $physical->harikerja = $request->harikerja;
        $physical->remarkunit = $request->remarkunit;
        $physical->confirmationplan = $request->confirmationplan;
        $physical->remarks = $request->remarks;
        $physical->statusspp  = $request->statusspp;
        $physical->statuscustomer   = "OPEN";        
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required',
            'idsitename'=>'required',
            'tanggal'=>'required',
            'kdunit'=>'required',
            'harikerja'=>'required',
            'planunitkerja'=>'required',           
            'statusspp'=>'required',
        ]);

      
        
        $physical = MPhysical::find($id);
        $physical->idcbu = $request->idcbu;
        $physical->idregion = $request->idregion;
        $physical->idsitename = $request->idsitename;
        $physical->tanggal = $request->tanggal;
        $physical->kdunit = $request->kdunit;
        $physical->harikerja = $request->harikerja;
        $physical->planunitkerja = $request->planunitkerja;
        $physical->totalbreakdown = $request->totalbreakdown;
        $physical->totaljamkerja = $request->totaljamkerja;
        $physical->paforklift = $request->paforklift;
        $physical->remarkunit = $request->remarkunit;
        $physical->confirmationplan = $request->confirmationplan;
        $physical->remarks = $request->remarks;
        $physical->statusspp  = $request->statusspp;
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
        return view('physical.formstatus', compact('physical','aid'));
    }
    public function updatestatus(Request $request)
    {
       
        $id = $request->id;
        $aid = $request->aid;
        if($request->aid == 'spp'){
            $request->validate([
                'statusspp'=>'required',
            ]);
            $statusspp = $request->statusspp;
            $physical = MPhysical::find($id);
            $physical->statusspp = $statusspp;
            $physical->save();
        }
        else {
            $request->validate([
                'statuscustomer'=>'required',
            ]);
            $statuscustomer = $request->statuscustomer;
            $physical = MPhysical::find($id);
            $physical->statuscustomer = $statuscustomer;
            $physical->save();
        }
       
        return redirect()->route('physical.index');
    }


}
