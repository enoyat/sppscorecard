public function root(Request $request)
    {

        if ($request->filled('periode')) {
            $mperiode = $request->periode;
        } else {
            $mperiode = now()->format('Y-m');
            $periode  = now()->format('Y-m');
        }

        if ($request->get('filter')) {
            $filter = $request->get('filter');
        } else {
            $filter = "sitename";
        }

        // hitung KPI
        $query = MPhysical::query()
            ->join('unit', 'physicalavailable.kdunit', '=', 'unit.kdunit')
            ->join('forklifttype', 'unit.idforklifttype', '=', 'forklifttype.id');

        $subTrouble = DB::table('troubleaction')
            ->selectRaw("
        periode,
        kdunit,
        SUM(lapsetime) total_breakdown,
        SUM(backup_minutes) total_backup
    ")
            ->where('periode', $mperiode)
            ->groupBy('periode', 'kdunit');

        $query->leftJoinSub($subTrouble, 'tb', function ($join) {

            $join->on('physicalavailable.kdunit', '=', 'tb.kdunit')
                ->on('physicalavailable.periode', '=', 'tb.periode');

        });

        $query->selectRaw("

forklifttype.id idforklifttype,

forklifttype.namaforklifttype,

count(*) jumlah_unit,

sum(planunitkerja) total_plan,

sum(COALESCE(tb.total_breakdown,0)) total_breakdown,
sum(COALESCE(tb.total_backup,0)) total_backup,

sum(planunitkerja-COALESCE(tb.total_breakdown,0)) total_work,

ROUND(

(sum(planunitkerja-COALESCE(tb.total_breakdown,0)+COALESCE(tb.total_backup,0))

/

sum(planunitkerja))

*100

,2) pa

");
        $query->groupBy(

            'forklifttype.id',

            'forklifttype.namaforklifttype'

        );
        $query->where('physicalavailable.periode', $mperiode);

        switch ($filter) {

            case 'sitename':

                $query->where(
                    'physicalavailable.idsitename',
                    request('xidsitename')
                );

                break;

            case 'region':

                $query->where(
                    'physicalavailable.idregion',
                    request('xidregion')
                );

                break;

            case 'cbu':

                $query->where(
                    'physicalavailable.idcbu',
                    request('xidcbu')
                );

                break;

        }
        $dashboard = $query->get();
        foreach ($dashboard as $row) {

            $row->namaforklifttype;

            $row->jumlah_unit;

            $row->total_plan;

            $row->total_breakdown;

            $row->total_work;

            $row->pa;

        }
        $cbu      = MSitename::member(Session::get('kdcustomer'))->kategori("cbu")->where('f_aktif', '1')->get();
        $sitename = MSitename::member(Session::get('kdcustomer'))->kategori("sitename")->get();
        $customer = MCustomer::where('kdcustomer', Session::get('kdcustomer'))->first();

        Session::put('logo', $customer->logo);

        $customer = MCustomer::get();
        $forklifttype = DB::table('forklifttype')->get();
        $arraykpi = ['kpidelivery' => 0, 'delivery' => 0, 'delivered' => 0, 'kpisparepart' => 0];

        return view('index', compact('dashboard', 'mperiode', 'filter', 'cbu', 'sitename', 'customer', 'arraykpi', 'periode', 'forklifttype'));
    }