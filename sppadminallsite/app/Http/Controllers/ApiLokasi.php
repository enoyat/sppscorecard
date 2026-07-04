<?php
namespace App\Http\Controllers;

use App\Models\MCustomer;
use App\Models\MSitename;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class ApiLokasi extends Controller
{

    public function getcbu($id)
    {
        $cbu = MSitename::where('parentid', $id)->get();
        return Response::json($cbu);
    }
    public function getregion($id)
    {
        $region = MSitename::where('parentid', $id)->get();
        return Response::json($region);
    }
    public function getsitename($id)
    {
        $sitename = MSitename::where('parentid', $id)->get();
        return Response::json($sitename);
    }
    public function setsitename(Request $request)
    {
        $id       = $request->id;
        $sitename = MSitename::where('id', $id)->first();

        // dd($sitename->getregion->getcbu->namasitename);
        if ($sitename->count() == 0) {
            Session::put('runidcbu', '');
            Session::put('runnamacbu', '');
            Session::put('runidregion', '');
            Session::put('runnamaregion', '');
            Session::put('runidsitename', $id);
            Session::put('runnamasitename', '');
            return Response::json($sitename);
        } else {
            $region = MSitename::where('id', $sitename->parentid)->first();
            $cbu    = MSitename::where('id', $region->parentid)->first();
            Session::put('runidcbu', $cbu->id);
            Session::put('runnamacbu', $cbu->namasitename);
            Session::put('runidregion', $region->id);
            Session::put('runnamaregion', $region->namasitename);
            Session::put('runidsitename', $id);
            Session::put('runnamasitename', $sitename->namasitename);

            return Response::json($sitename);

        }
    }
    public function customer()
    {
        $customer = MCustomer::get();
        $cbu      = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->where('f_aktif', '1')->get();
        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        return view('customer.index', compact('customer', 'cbu', 'sitename'));
    }

    public function setcustomer(Request $request)
    {
        $customer = MCustomer::where('kdcustomer', $request->id)->first();
        if ($customer) {
            Session::put('kdcustomer', $customer->kdcustomer);
            Session::put('namacustomer', $customer->namacustomer);
            Session::put('runidcbu', '');
            Session::put('runnamacbu', '');
            Session::put('runidregion', '');
            Session::put('runnamaregion', '');
            Session::put('runidsitename', '');
            Session::put('runnamasitename', '');
            Session::put('category', $customer->category);
            return Response::json($customer);
        } else {
            Session::put('kdcustomer', '');
            Session::put('namacustomer', '');
            Session::put('category', '');

            return Response::json($customer);

        }
    }
    public function filtersite(Request $request)
    {
        $filter = $request->get('filter');
        if ($filter == "sitename") {
            $id       = $request->get('xidsitename');
            $sitename = MSitename::where('id', $id)->first();
            $region   = MSitename::where('id', $sitename->parentid)->first();
            $cbu      = MSitename::where('id', $region->parentid)->first();
            Session::put('runidcbu', $cbu->id);
            Session::put('runnamacbu', $cbu->namasitename);
            Session::put('runidregion', $region->id);
            Session::put('runnamaregion', $region->namasitename);
            Session::put('runidsitename', $id);
            Session::put('runnamasitename', $sitename->namasitename);

        }
        if ($filter == "region") {
            $id       = $request->get('xidregion');
            $region   = MSitename::where('id', $id)->first();
            $cbu      = MSitename::where('id', $region->parentid)->first();
            $sitename = MSitename::where('parentid', $id)->first();
            Session::put('runidcbu', $cbu->id);
            Session::put('runnamacbu', $cbu->namasitename);
            Session::put('runidregion', $region->id);
            Session::put('runnamaregion', $region->namasitename);
            Session::put('runidsitename', $sitename->id);
            Session::put('runnamasitename', $sitename->namasitename);

        }
        return redirect()->back();
    }

}
