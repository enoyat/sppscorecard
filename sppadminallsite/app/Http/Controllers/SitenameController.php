<?php

namespace App\Http\Controllers;
use App\Models\MSitename;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class SitenameController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->with(['parent'])->get();

        return view('sitename.index', compact('sitename'));
    }
    public function create()
    {
        $region=MSitename::member(Session::get('kdcustomer'))->kategori("region")->get();

        return view('sitename.create',compact('region'));
    }
    public function edit($id)
    {
        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->with(['parent'])->where('id',$id)->first();
        $region=MSitename::member(Session::get('kdcustomer'))->kategori("region")->get();
        return view('sitename.edit',compact('sitename','region'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id'=>'required|unique:sitename,id',
            'namasitename'=>'required',
            'idregion'=>'required'
        ]);




        $sitename = new MSitename();
        $sitename->id = $request->id;
        $sitename->namasitename = $request->namasitename;
        $sitename->parentid = $request->idregion;
        $sitename->kategori = "sitename";
        $sitename->kdcustomer = Session::get('kdcustomer');
        $simpan = $sitename->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('sitename.index');

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
            'idregion'=>'required'
        ]);



        $sitename = MSitename::find($id);
        $sitename->id = $request->id;
        $sitename->namasitename = $request->namasitename;
        $sitename->parentid = $request->idregion;
        $simpan = $sitename->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('sitename.index');

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
            return redirect()->route('sitename.index');
        } catch (QueryException $ex) {
            return redirect()->route('sitename.index');
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
    public function getregion(Request $request){
        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("region")->
        where('namasitename', 'LIKE', '%'.$request->search.'%')->orderBy('namasitename', 'ASC')->get();

        $response = array();
        foreach ($sitename as $value) {
            $response[] = array(
                "id" => $value->id,
                "text" => $value->namasitename
            );
        }

        return response()->json($response);
    }
    public function getsitename(Request $request){
        if (Auth::user()->roles_id == '4') {
            $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->where('id',Session::get('runidsitename'))->get();
        }
        else {
        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->
        where('namasitename', 'LIKE', '%'.$request->search.'%')->orderBy('namasitename', 'ASC')->get();
        }
        $response = array();
        foreach ($sitename as $value) {
            $response[] = array(
                "id" => $value->id,
                "text" => $value->namasitename
            );
        }

        return response()->json($response);
    }

}
