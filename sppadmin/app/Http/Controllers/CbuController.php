<?php

namespace App\Http\Controllers;

use App\Models\MCbu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class CbuController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cbu = MCbu::get();
        return view('cbu.index', compact('cbu'));
    }
    public function create()
    {
        $cbu=MCbu::get();
        return view('cbu.create',compact('cbu'));
    }
    public function edit($id)
    {
        $cbu = MCbu::find($id);
        return view('cbu.edit',compact('cbu'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'namacbu'=>'required',            
        ]);

      
        
        $cbu = new MCbu;
        $cbu->namacbu = $request->namacbu;
        $simpan = $cbu->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('cbu.index');

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
            'namacbu'=>'required',
        ]);

      
        
        $cbu = MCbu::find($id);
        $cbu->namacbu = $request->namacbu;
        $simpan = $cbu->save();

        if ($simpan) {                      
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('cbu.index');

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
            MCbu::where('id', '=', $id)->delete();
            return redirect()->route('cbu.index');
        } catch (QueryException $ex) {
            return redirect()->route('cbu.index');
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
    public function getcbu(Request $request){
        $cbu = MCbu::where('namacbu', 'LIKE', '%'.$request->search.'%')->orderBy('namacbu', 'ASC')->get();

        $response = array();
        foreach ($cbu as $value) {
            $response[] = array(
                "id" => $value->id,
                "text" => $value->namacbu
            );
        }

        return response()->json($response);
    }
}
