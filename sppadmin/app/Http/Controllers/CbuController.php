<?php

namespace App\Http\Controllers;

use App\Models\MSitename;
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
        $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        return view('cbu.index', compact('cbu'));
    }
    public function create()
    {
        $cbu=MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        return view('cbu.create',compact('cbu'));
    }
    public function edit($id)
    {
        $cbu = MSitename::find($id);
        return view('cbu.edit',compact('cbu'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id'=>'required|unique:sitename,id',
            'namasitename'=>'required',
        ]);



        $cbu = new MSitename();
        $cbu->id = $request->id;
        $cbu->namasitename = $request->namasitename;
        $cbu->kdcustomer = Session::get('kdcustomer');
      //  $cbu->parentid = $request->parentid;
        $cbu->kategori = "cbu";

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
            'id'=>'required|unique:sitename,id,'.$id.',id',
            'namasitename'=>'required',
        ]);



        $cbu = MSitename::find($id);
        $cbu->id = $request->id;
        $cbu->namasitename = $request->namasitename;
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
            Msitename::where('id', '=', $id)->delete();
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

}
