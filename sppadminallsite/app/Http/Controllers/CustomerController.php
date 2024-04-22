<?php

namespace App\Http\Controllers;

use App\Models\MCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class customerController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listcustomer()
    {
        $customer=MCustomer::get();
        return view('customer.listcustomer', compact('customer'));
    }
    public function create()
    {
        return view('customer.create');
    }
    public function edit($id)
    {
        $customer = MCustomer::find($id);
        return view('customer.edit',compact('customer'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kdcustomer'=>'required|unique:customer,kdcustomer',
            'namacustomer'=>'required',
            'category'=>'required',
            'location'=>'required',
        ]);



        $customer = new MCustomer();
        $customer->namacustomer = $request->namacustomer;
        $customer->kdcustomer = $request->kdcustomer;
        $customer->category = $request->category;
        $customer->location = $request->location;
        $simpan = $customer->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('customer.listcustomer');

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
            'kdcustomer'=>'required|unique:customer,kdcustomer,'.$id.',kdcustomer',
            'namacustomer'=>'required',
            'category'=>'required',
            'location'=>'required',
        ]);



        $customer = MCustomer::find($id);
        $customer->namacustomer = $request->namacustomer;
        $customer->kdcustomer = $request->kdcustomer;
        $customer->category = $request->category;
        $customer->location = $request->location;
        $simpan = $customer->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('customer.listcustomer');

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
            MCustomer::where('kdcustomer', '=', $id)->delete();
            return redirect()->route('customer.listcustomer');
        } catch (QueryException $ex) {
            return redirect()->route('customer.listcustomer');
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
