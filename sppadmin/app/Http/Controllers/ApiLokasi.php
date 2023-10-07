<?php

namespace App\Http\Controllers;

use App\Models\Adds;
use App\Models\MCbu;
use App\Models\MRegion;
use App\Models\MSitename;
use App\Models\MCustomer;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class ApiLokasi extends Controller
{

    public function getcbu($id)
    {
        $cbu = MSitename::where('parentid',$id)->get();
        return Response::json($cbu);
    }
    public function getregion($id)
    {
        $region = MSitename::where('parentid',$id)->get();
        return Response::json($region);
    }
    public function getsitename($id)
    {
        $sitename = MSitename::where('parentid',$id)->get();
        return Response::json($sitename);
    }
    public function setsitename($id)
    {
        $sitename = MSitename::where('id',$id)->first();

       // dd($sitename->getregion->getcbu->namacbu);
        if($sitename->count()==0){
            Session::put('runidcbu','');
            Session::put('runnamacbu','');
            Session::put('runidregion','');
            Session::put('runnamaregion','');
            Session::put('runidsitename',$id);
            Session::put('runnamasitename','');
            return Response::json($sitename);
        }
        else {
            $region=MSitename::where('id',$sitename->parentid)->first();
            $cbu=MSitename::where('id',$region->parentid)->first();
            Session::put('runidcbu',$cbu);
            Session::put('runnamacbu',$cbu->namasitename);
            Session::put('runidregion',$region->id);
            Session::put('runnamaregion',$region->namasitename);
            Session::put('runidsitename',$id);
            Session::put('runnamasitename',$sitename->namasitename);

            return Response::json($sitename);

        }
    }

    public function setcustomer(Request $request)
    {
        $customer = MCustomer::where('kdcustomer',$request->id)->first();
        if ($customer){
            Session::put('kdcustomer',$customer->kdcustomer);
            Session::put('namacustomer',$customer->namacustomer);
            Session::put('runidcbu','');
            Session::put('runnamacbu','');
            Session::put('runidregion','');
            Session::put('runnamaregion','');
            Session::put('runidsitename','');
            Session::put('runnamasitename','');
            return Response::json($customer);
        }
        else {
            Session::put('kdcustomer','');
            Session::put('namacustomer','');

            return Response::json($customer);

        }
    }

}
