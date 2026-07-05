<?php
namespace App\Http\Controllers;

use App\Models\MDelivery;
use App\Models\MForklifttype;
use App\Models\MSitename;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class DeliveryController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (Auth::user()->roles_id != 6) {
            if (Session::get('runidsitename') == null) {
                Alert::warning('Warning', 'Please select site name first!');
                return redirect()->route('root');
            }
        }
        $this->daysoflapse();
        if ($request->filled('filterby')) {
            $filter = $request->filterby;

        } else {
            $filter = 'Site';

        }

        $arraykpi = [];
        if ($filter == "Site") {

            $delivery = MDelivery::where('idsitename', Session::get('runidsitename'))->get();
            $id       = Session::get('runidsitename');
            $sitename = MSitename::where('id', $id)->first();
            $region   = MSitename::where('id', $sitename->parentid)->first();
            $cbu      = MSitename::where('id', $region->parentid)->first();

        } else if ($filter == "Region") {
            $delivery = MDelivery::where('idregion', Session::get('runidregion'))->get();
            $id       = Session::get('runidregion');
            $region   = MSitename::where('id', $id)->first();
            $cbu      = MSitename::where('id', $region->parentid)->first();
            $sitename = MSitename::where('parentid', $id)->first();

        } else if ($filter == "CBU") {

            $delivery = MDelivery::where('idcbu', Session::get('runidcbu'))->get();

            $id       = Session::get('runidcbu');
            $cbu      = MSitename::where('id', $id)->first();
            $region   = MSitename::where('parentid', $cbu->id)->first();
            $sitename = MSitename::where('parentid', $region->id)->first();

        }
        $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();

        $sitename     = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $forklifttype = MForklifttype::get();
        return view('delivery.index', compact('delivery', 'forklifttype', 'cbu', 'sitename'));
    }
    public function create()
    {
        if (Session::get('roles_id') == 2) {
            $cbu = MCbu::where('id', Session::get('runidcbu'))->get();
        } else {
            $cbu = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        }
        $forklifttype = MForklifttype::get();
        return view('delivery.create', compact('cbu', 'forklifttype'));
    }
    public function edit($id)
    {
        $cbu          = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->get();
        $forklifttype = MForklifttype::get();
        $delivery     = MDelivery::find($id);
        return view('delivery.edit', compact('cbu', 'forklifttype', 'delivery'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'idcbu'          => 'required',
            'idregion'       => 'required',
            'idsitename'     => 'required',
            'serialnumber'   => 'required',
            'idforklifttype' => 'required',
            'capacity'       => 'required',
            'mast'           => 'required',
            'masheight'      => 'required',
            'dateestimated'  => 'required',
            'statusspp'      => 'required',

        ]);

        $delivery                 = new MDelivery;
        $delivery->idcbu          = $request->idcbu;
        $delivery->idregion       = $request->idregion;
        $delivery->idsitename     = $request->idsitename;
        $delivery->serialnumber   = $request->serialnumber;
        $delivery->idforklifttype = $request->idforklifttype;
        $delivery->capacity       = $request->capacity;
        $delivery->mast           = $request->mast;
        $delivery->masheight      = $request->masheight;
        $delivery->dateestimated  = $request->dateestimated;
        $delivery->reason         = $request->reason;
        $delivery->daterequest    = $request->daterequest;
        $delivery->ponumber       = $request->ponumber;
        $delivery->daysoflapse    = $request->daysoflapse;

        $delivery->dateactual = $request->dateactual;

        $delivery->statusspp      = $request->statusspp;
        $delivery->statuscustomer = "OPEN";
        $simpan                   = $delivery->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('delivery.index');

        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message'   => "Something went wrong!",
            ], 200); // Status code here
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'idcbu'          => 'required',
            'idregion'       => 'required',
            'idsitename'     => 'required',
            'serialnumber'   => 'required',
            'idforklifttype' => 'required',
            'capacity'       => 'required',
            'masheight'      => 'required',
            'mast'           => 'required',
            'dateestimated'  => 'required',
            'statusspp'      => 'required',
        ]);

        $delivery                 = MDelivery::find($id);
        $delivery->idcbu          = $request->idcbu;
        $delivery->idregion       = $request->idregion;
        $delivery->idsitename     = $request->idsitename;
        $delivery->serialnumber   = $request->serialnumber;
        $delivery->idforklifttype = $request->idforklifttype;
        $delivery->capacity       = $request->capacity;
        $delivery->mast           = $request->mast;
        $delivery->masheight      = $request->masheight;
        $delivery->dateestimated  = $request->dateestimated;
        $delivery->reason         = $request->reason;
        $delivery->daterequest    = $request->daterequest;
        $delivery->ponumber       = $request->ponumber;
        $delivery->daysoflapse    = $request->daysoflapse;

        $delivery->dateactual = $request->dateactual;

        $delivery->statusspp = $request->statusspp;
        $simpan              = $delivery->save();

        if ($simpan) {
            Session::flash('message', 'Data berhasil disimpan!');
            return redirect()->route('delivery.index');

        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            return response()->json([
                'isSuccess' => true,
                'Message'   => "Something went wrong!",
            ], 200); // Status code here
        }
    }
    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            MDelivery::where('id', '=', $id)->delete();

            return redirect()->route('delivery.index');
        } catch (QueryException $ex) {
            return redirect()->route('delivery.index');
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

    public function formstatus(Request $request)
    {
        $id  = $request->id;
        $aid = $request->aid;
        if ($request->aid == 'spp') {
            $delivery = MDelivery::find($id);
            return view('delivery.formstatus', compact('delivery', 'aid'));
        } else {
            $delivery = MDelivery::find($id);
            return view('delivery.formstatuscustomer', compact('delivery', 'aid'));
        }

    }
    public function updatestatus(Request $request)
    {

        $id  = $request->id;
        $aid = $request->aid;
        if ($request->aid == 'spp') {
            $request->validate([
                'statusspp' => 'required',
            ]);
            $statusspp           = $request->statusspp;
            $delivery            = MDelivery::find($id);
            $delivery->statusspp = $statusspp;
            $delivery->save();
        } else {
            $request->validate([
                'statuscustomer' => 'required',
            ]);
            $statuscustomer = $request->statuscustomer;

            $delivery                 = MDelivery::find($id);
            $delivery->statuscustomer = $statuscustomer;
            $delivery->remarkplan     = $request->remarkplan;
            $delivery->save();
        }

        return redirect()->route('delivery.index');
    }

    public function daysoflapse()
    {
        $delivery = MDelivery::where('statuscustomer', 'OPEN')->get();
        foreach ($delivery as $key => $value) {
            $date1 = Carbon::parse($value->dateestimated);
            $date2 = Carbon::now();
            if ($date2 > $date1) {
                $diff                  = $date1->diffInDays($date2);
                $delivery              = MDelivery::find($value->id);
                $delivery->daysoflapse = $diff;
                $delivery->save();
            } else {
                $delivery              = MDelivery::find($value->id);
                $delivery->daysoflapse = 0;
                $delivery->save();
            }

        }
        return 'success';

    }

}
