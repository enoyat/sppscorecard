<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use App\Models\MRegion;
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
        $region = MRegion::get();
        return view('region.index', compact('region'));
    }
    public function create()
    {
        $cbu=MCbu::get();
        return view('region.create',compact('cbu'));
    }
    public function edit($id)
    {
        $region = MRegion::find($id);
        $cbu=MCbu::get();        
        return view('region.edit',compact('region','cbu'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'namaregion'=>'required',   
            'idcbu'=>'required'         
        ]);

      
        
        $region = new MRegion;
        $region->namaregion = $request->namaregion;
        $region->idcbu = $request->idcbu;
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
            'namaregion'=>'required',
            'idcbu'=>'required'     
        ]);

      
        
        $region = MRegion::find($id);
        $region->namaregion = $request->namaregion;
        $region->idcbu = $request->idcbu;
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
            MRegion::where('id', '=', $id)->delete();
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
    public function getregion(Request $request){
        $region = MRegion::where('namaregion', 'LIKE', '%'.$request->search.'%')->orderBy('namaregion', 'ASC')->get();

        $response = array();
        foreach ($region as $value) {
            $response[] = array(
                "id" => $value->id,
                "text" => $value->namaregion
            );
        }

        return response()->json($response);
    }
}
