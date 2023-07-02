<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MRegion;
use App\Models\MSitename;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class SitenameController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sitename = MSitename::get();
        return view('sitename.index', compact('sitename'));
    }
    public function create()
    {
        $cbu=MCbu::get();
        $region=MRegion::get();
        $sitename=Msitename::get();
        return view('sitename.create',compact('cbu','region','sitename'));
    }
    public function edit($id)
    {
        $sitename = Msitename::find($id);
        $cbu=MCbu::get();  
        $region=MRegion::get();      
        return view('sitename.edit',compact('sitename','cbu','region'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'namasitename'=>'required',   
            'idregion'=>'required'         
        ]);

      
        
        $sitename = new Msitename;
        $sitename->namasitename = $request->namasitename;
        $sitename->idregion = $request->idregion;
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
            'namasitename'=>'required',
            'idregion'=>'required'     
        ]);

      
        
        $sitename = Msitename::find($id);
        $sitename->namasitename = $request->namasitename;
        $sitename->idregion = $request->idregion;
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
            Msitename::where('id', '=', $id)->delete();
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
    public function getsitename(Request $request){
        $sitename = Msitename::where('namasitename', 'LIKE', '%'.$request->search.'%')->orderBy('namasitename', 'ASC')->get();

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
