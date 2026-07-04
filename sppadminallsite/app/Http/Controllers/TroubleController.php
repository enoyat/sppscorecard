<?php

namespace App\Http\Controllers;


use App\Models\MDokumentrouble;
use App\Models\MForklifttype;
use App\Models\MTrouble;
use App\Models\MTroubleaction;
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
use Illuminate\Support\Str;

class TroubleController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $sitename=MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $listactions=MTroubleaction::join('unit','troubleaction.kdunit','=','unit.kdunit')->where('idsitename',Session::get('runidsitename'))->get();
        return view('trouble.index', compact('listactions','cbu','sitename'));
    }
    public function create()
    {
        if(Session::get('roles_id')==2) {
            $cbu=MCbu::where('id',Session::get('runidcbu'))->get();
        } else {
            $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        }
        $forklifttype = MForklifttype::get();
        return view('trouble.create',compact('cbu','forklifttype'));
    }
    public function edit($id)
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $forklifttype = MForklifttype::get();
        $trouble = MTrouble::find($id);
        return view('trouble.edit',compact('cbu','forklifttype','trouble'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcbu'=>'required',
            'idregion'=>'required',
            'idsitename'=>'required',
            'kdunit'=>'required',
            'tanggal'=>'required',
            'statusspp'=>'required',
        ]);



        $trouble = new MTrouble;
        $trouble->idcbu = $request->idcbu;
        $trouble->idregion = $request->idregion;
        $trouble->idsitename = $request->idsitename;
        $trouble->kdunit = $request->kdunit;
        $trouble->tanggal = $request->tanggal;
        $trouble->issue = $request->issue;
        $trouble->targetcompletedate= $request->targetcompletedate;
        $trouble->actionplanspp= $request->actionplanspp;
        $trouble->statusspp = $request->statusspp;
        $trouble->statuscustomer = "OPEN";

        $simpan = $trouble->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('trouble.index');

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
            'statusspp'=>'required',
        ]);



        $trouble = MTrouble::find($id);
        $trouble->idcbu = $request->idcbu;
        $trouble->idregion = $request->idregion;
        $trouble->idsitename = $request->idsitename;
        $trouble->kdunit = $request->kdunit;
        $trouble->tanggal = $request->tanggal;
        $trouble->issue = $request->issue;
        $trouble->targetcompletedate= $request->targetcompletedate;
        $trouble->actionplanspp= $request->actionplanspp;
        $trouble->actualcompletedate = $request->actualcompletedate;
        $trouble->confirmationplan= $request->confirmationplan;
        $trouble->statusspp = $request->statusspp;
        $simpan = $trouble->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('trouble.index');

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
            MTrouble::where('id', '=', $id)->delete();

            return redirect()->route('trouble.index');
        } catch (QueryException $ex) {
            return redirect()->route('trouble.index');
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
    public function listdokumen($id)
    {
        $dokumentrouble=MDokumentrouble::where('idaction',$id)->get();
        return view('trouble.listdokumen', compact('dokumentrouble','id'));
    }

    public function dokumendestroy(Request $request)
    {
        try {
            $id = $request->id;
            $data=MDokumentrouble::where('id', '=', $id)->first();
            $file=$data->filename;
            $path = public_path().'/assets/inventory/'.$file;
            unlink($path);
            MDokumentrouble::where('id', '=', $id)->delete();
            return redirect()->back();
        } catch (QueryException $ex) {
            return redirect()->back();
        }
    }
    public function listaction($id)
    {
        $listactions=MTroubleaction::where('kdunit',$id)->get();
        return view('trouble.listaction', compact('listactions','id'));
    }
    public function actiondestroy(Request $request)
    {
        try {
            $id = $request->id;
            MTroubleaction::where('id', '=', $id)->delete();
            return redirect()->back();
        } catch (QueryException $ex) {
            return redirect()->back();
        }
    }

    public function formstatus(Request $request)
    {
        $id = $request->id;
        $aid = $request->aid;
        $trouble = MTroubleaction::find($id);
        return view('trouble.formstatus', compact('trouble','aid'));
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
            $trouble = MTroubleaction::find($id);
            $trouble->statusspp = $statusspp;
            $trouble->save();
        }
        else {
            $request->validate([
                'statuscustomer'=>'required',
            ]);
            $statuscustomer = $request->statuscustomer;
            $trouble = MTroubleaction::find($id);
            $trouble->statuscustomer = $statuscustomer;
            $trouble->save();
        }

        return redirect()->back();
    }
    public function formaction(Request $request)
    {
        $trouble = MTroubleaction::findOrFail($request->id);

        return view(
            'trouble.formaction',
            compact('trouble')
        );
    }

    public function actionupdate(Request $request, MTroubleaction $trouble)
    {
       
        $request->validate([
            'shift'        => 'required',
            'periode'     => 'required',
            'actionplan'   => 'required',
            'sparepart'    => 'nullable',
            'tanggalmulai' => 'required',
            'tanggalakhir' => 'nullable',
        ]);

        $trouble->update([
            'periode'      => $request->periode,

            'shift'        => $request->shift,

            'actionplan'   => $request->actionplan,

            'sparepart'    => $request->sparepart,

            'tanggalmulai' => $request->tanggalmulai,

            'tanggalakhir' => $request->tanggalakhir,
            'lapsetime'    => $request->lapsetime,
            'terbackup'      => $request->terbackup,
            'backup_minutes' => $request->backup_minutes,

        ]);

        return redirect()
            ->route('trouble.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function dokumenstore(Request $request)
    {
        $request->validate([

            'description' => 'required',

            'images'      => 'required',

            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:4096',

        ]);

        foreach ($request->file('images') as $image) {

            $filename = time() . '_' . Str::random(5) . '.' . $image->extension();

            $image->move(
                public_path('assets/inventory'),
                $filename
            );

            MDokumentrouble::create([

                'idaction'   => $request->trouble_id,

                'keterangan' => $request->description,

                'filename'   => $filename,

            ]);

        }

        return back()->with(
            'success',
            'Foto berhasil diupload.'
        );
    }


}
