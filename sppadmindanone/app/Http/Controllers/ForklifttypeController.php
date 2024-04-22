<?php

namespace App\Http\Controllers;

use App\Models\MForklifttype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class forklifttypeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $forklifttype = MForklifttype::get();
        return view('forklifttype.index', compact('forklifttype'));
    }
    public function create()
    {
        $forklifttype=MForklifttype::get();
        return view('forklifttype.create',compact('forklifttype'));
    }
    public function edit($id)
    {
        $forklifttype = MForklifttype::find($id);
        return view('forklifttype.edit',compact('forklifttype'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'namaforklifttype'=>'required',
            'f_dashboard'=>'required',
        ]);



        $forklifttype = new MForklifttype;
        $forklifttype->namaforklifttype = $request->namaforklifttype;
        $forklifttype->f_dashboard = $request->f_dashboard;
        $simpan = $forklifttype->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('forklifttype.index');

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
            'namaforklifttype'=>'required',
            'f_dashboard'=>'required',
        ]);



        $forklifttype = MForklifttype::find($id);
        $forklifttype->namaforklifttype = $request->namaforklifttype;
        $forklifttype->f_dashboard = $request->f_dashboard;
        $simpan = $forklifttype->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('forklifttype.index');

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
            MForklifttype::where('id', '=', $id)->delete();
            return redirect()->route('forklifttype.index');
        } catch (QueryException $ex) {
            return redirect()->route('forklifttype.index');
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
    public function getforklifttype(Request $request){
        $forklifttype = MForklifttype::where('namaforklifttype', 'LIKE', '%'.$request->search.'%')->orderBy('namaforklifttype', 'ASC')->get();

        $response = array();
        foreach ($forklifttype as $value) {
            $response[] = array(
                "id" => $value->id,
                "text" => $value->namaforklifttype
            );
        }

        return response()->json($response);
    }
}
