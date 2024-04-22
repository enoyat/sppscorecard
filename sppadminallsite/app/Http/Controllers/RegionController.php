<?php

namespace App\Http\Controllers;
use App\Models\MSitename;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class RegionController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $region = MSitename::member(Session::get('kdcustomer'))->kategori("region")->with(['parent'])->get();

        return view('region.index', compact('region'));
    }
    public function create()
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        return view('region.create',compact('cbu'));
    }
    public function edit($id)
    {
        $region = MSitename::member(Session::get('kdcustomer'))->kategori("region")->with(['parent'])->where('id',$id)->first();
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        return view('region.edit',compact('region','cbu'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id'=>'required|unique:sitename,id',
            'namasitename'=>'required',
            'idcbu'=>'required'
        ]);




        $region = new MSitename();
        $region->id = $request->id;
        $region->namasitename = $request->namasitename;
        $region->parentid = $request->idcbu;
        $region->kategori = "region";
        $region->kdcustomer = Session::get('kdcustomer');
        $simpan = $region->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('region.index');

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
            'id'=>'required|unique:sitename,id,'.$id.',id',
            'namasitename'=>'required',
            'idcbu'=>'required'
        ]);



        $region = MSitename::find($id);
        $region->id = $request->id;
        $region->namasitename = $request->namasitename;
        $region->parentid = $request->idcbu;
        $simpan = $region->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('region.index');

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
            MSitename::where('id', '=', $id)->delete();
            return redirect()->route('region.index');
        } catch (QueryException $ex) {
            return redirect()->route('region.index');
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

}
