<?php

namespace App\Http\Controllers;

use App\Models\MCustomer;
use App\Models\MSitename;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('index');
    }
    public function root(Request $request)
    {
        $cbu = MSitename::member(Session::get('kdcustomer'))
            ->kategori('cbu')
            ->where('f_aktif', '1')
            ->get();

        $sitename = MSitename::member(Session::get('kdcustomer'))
            ->kategori('sitename')
            ->get();

        return view('index', compact('cbu', 'sitename'));
    }
    public function kpiavailability(Request $request)
    {
        $tahun =  date('Y', strtotime($request->tglakhir));
        $bulan =  date('m', strtotime($request->tglakhir));

        $filter = $request->get('filter');

        $mperiode = $tahun . '-' . $bulan;

        $arraykpi = [];
        if ($filter == 'sitename') {
            $sitename = $request->idsitename;
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idsitename='$sitename'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idsitename='$sitename') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype");

        } elseif ($request->filter == 'region') {
            $sitename = $request->idregion;
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idregion='$sitename'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idregion='$sitename') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype");
        } elseif ($request->filter == 'cbu') {
            $sitename = $request->idcbu;
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idcbu='$sitename'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idcbu='$sitename') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype");
        } elseif ($request->filter == 'allsn') {
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idcbu='SN'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idcbu='SN') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype");
        } elseif ($request->filter == 'allwater') {
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idcbu='Waters'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idcbu='Waters') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype");
        } elseif ($request->filter == 'allsnwater') {
            DB::statement("SET SQL_MODE=''");
            $kpi = DB::select("select qunittype.jmlunit, qpa.* from (
                SELECT idforklifttype, forklifttype.namaforklifttype, count(kdunit) as jmlunit, idcbu,idregion,idsitename from unit join forklifttype on unit.idforklifttype=forklifttype.id
                where unit.idcbu='SN' or unit.idcbu='Waters'
                group by idforklifttype) as qunittype join (

            select idforklifttype, namaforklifttype,  sum(planunitkerja) as sumplanunitkerja, sum(totaljamkerja) as sumtotaljamkerja, avg(paforklift) as avgpaforklift from physicalavailable join unit on unit.kdunit = physicalavailable.kdunit join forklifttype on unit.idforklifttype=forklifttype.id where periode like '$mperiode%' and (unit.idcbu='SN' or unit.idcbu='Waters') and forklifttype.f_dashboard= 'Y' group By namaforklifttype, idforklifttype) as qpa on qunittype.idforklifttype=qpa.idforklifttype;");
        }
        $i = 0;
        $jmlunit = 0;
        $sumplanunitkerja = 0;
        $sumtotaljamkerja = 0;
        foreach ($kpi as $k) {
            if ($k->sumtotaljamkerja==0){
                $avgforklit=0;
            }
            else {
                $avgforklit=number_format(($k->sumtotaljamkerja / $k->sumplanunitkerja) * 100, 2);
            }
            $arraykpi[$i] = [
                'idforklifttype' => $k->idforklifttype,
                'namaforklifttype' => $k->namaforklifttype,
                'jmlunit' => $k->jmlunit,
                'sumplanunitkerja' => $k->sumplanunitkerja,
                'sumtotaljamkerja' => $k->sumtotaljamkerja,
                'totalbreakdown' => $k->sumplanunitkerja - $k->sumtotaljamkerja,
                'avgpaforklift' => $avgforklit,
            ];
            $jmlunit = $jmlunit + $k->jmlunit;
            $sumplanunitkerja = $sumplanunitkerja + $k->sumplanunitkerja;
            $sumtotaljamkerja = $sumtotaljamkerja + $k->sumtotaljamkerja;

            $i++;
        }
        if ($sumtotaljamkerja==0){
            $avgforklit=0;
        }
        else {
            $avgforklit=number_format(($sumtotaljamkerja / $sumplanunitkerja) * 100, 2);
        }

        return response()->json(
            [
                'isSuccess' => true,
                'Message' => 'Data Found',
                'kpi' => $arraykpi,
                'jmlunit' => $jmlunit,
                'sumplanunitkerja' => number_format($sumplanunitkerja/60),
                'sumtotaljamkerja' => number_format($sumtotaljamkerja/60),
                'totalbreakdown' => $sumplanunitkerja - $sumtotaljamkerja,
                'avgpaforklift' => $avgforklit,
            ],
            200,
        ); // Status code here

    }
    public function kpiunit(Request $request)
    {
        $tglakhir = $request->get('tglakhir');
        $filter = $request->get('filter');
        $kdbulan= date('Y', strtotime($tglakhir)).'-' . date('m', strtotime($tglakhir));

        if ($filter == 'sitename') {
            $sitename = $request->idsitename;
            $jmlunit = count(DB::select("select * from unit where idsitename='$sitename' and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' "));
            $jmlunitout = count(DB::select("select * from unitout where idsitename='$sitename' and dateout <= '$tglakhir'"));

            $jmlunitactual = count(DB::select("select * from unit where idsitename='$sitename' and showcustomer='Y' and dateactual <= '$tglakhir' and  (dateactual is not null) and (dateactual !='0000-00-00') and flag_actual='Y' and flag_baru='B' "));

            $jmlunitactualotif = count(DB::select("select * from unit where idsitename='$sitename' and showcustomer='Y' and (dateactual is not null) and (dateactual !='0000-00-00') and (dateactual <= daterequest) and dateactual <='$tglakhir' and flag_baru='B' and flag_actual='Y'"));

            if ($kdbulan=="2023-10"){

                $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                CASE
                        WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1

                END AS JMBULAN,
                CASE
                        WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1) *(price*0.05)

                END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idsitename='$sitename'");
                }
                else {
                    $tglawal= date('Y-m-01', strtotime($tglakhir));


                    $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                    CASE
                            WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                            WHEN dateactual is NOT null and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                            WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1

                    END AS JMBULAN,
                    CASE
                            WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                            WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                            WHEN dateactual is NOT null  and dateactual>='$tglawal' THEN (TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1) *(price*0.05)

                    END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idsitename='$sitename'");
                }


            $payment = DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' ");


        } elseif ($filter == 'region') {
            $sitename = $request->idregion;
            $jmlunit = count(DB::select("select * from unit where idregion='$sitename' and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' "));
            $jmlunitout = count(DB::select("select * from unitout where idregion='$sitename' and dateout <= '$tglakhir'"));

            $jmlunitactual = count(DB::select("select * from unit where idregion='$sitename' and showcustomer='Y' and dateactual <= '$tglakhir' and  (dateactual is not null) and (dateactual !='0000-00-00') and flag_actual='Y' and flag_baru='B' "));

            $jmlunitactualotif = count(DB::select("select * from unit where idregion='$sitename' and showcustomer='Y' and (dateactual is not null) and (dateactual !='0000-00-00') and (dateactual <= daterequest) and dateactual <='$tglakhir' and flag_baru='B' and flag_actual='Y'"));

            if ($kdbulan=="2023-10"){

                $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                CASE
                        WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1

                END AS JMBULAN,
                CASE
                        WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1) *(price*0.05)

                END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idregion='$sitename'");
                }
                else {
                    $tglawal= date('Y-m-01', strtotime($tglakhir));


                    $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                    CASE
                            WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                            WHEN dateactual is NOT null and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                            WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1

                    END AS JMBULAN,
                    CASE
                            WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                            WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                            WHEN dateactual is NOT null  and dateactual>='$tglawal' THEN (TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1) *(price*0.05)

                    END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idregion='$sitename'");
                }

            $payment = DB::select("select * from unit where idregion='$sitename' and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' ");
        } elseif ($filter == 'cbu') {
            $sitename = $request->idcbu;
            $jmlunit = count(DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' "));
            $jmlunitout = count(DB::select("select * from unitout where idcbu='$sitename' and dateout <= '$tglakhir'"));

            $jmlunitactual = count(DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and dateactual <= '$tglakhir' and  (dateactual is not null) and (dateactual !='0000-00-00') and flag_actual='Y' and flag_baru='B' "));

            $jmlunitactualotif = count(DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and (dateactual is not null) and (dateactual !='0000-00-00') and (dateactual <= daterequest) and dateactual <='$tglakhir' and flag_baru='B' and flag_actual='Y'"));

            if ($kdbulan=="2023-10"){

                $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                CASE
                        WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1

                END AS JMBULAN,
                CASE
                        WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1) *(price*0.05)

                END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idregion='$sitename'");
                }
                else {
                    $tglawal= date('Y-m-01', strtotime($tglakhir));


                    $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                    CASE
                            WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                            WHEN dateactual is NOT null and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                            WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1

                    END AS JMBULAN,
                    CASE
                            WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                            WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                            WHEN dateactual is NOT null  and dateactual>='$tglawal' THEN (TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1) *(price*0.05)

                    END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idcbu='$sitename'");
                }
            $payment = DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' ");

        } elseif ($filter == 'allsn') {
            $sitename = 'SN';
            $jmlunit = count(DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' "));
            $jmlunitout = count(DB::select("select * from unitout where idcbu='$sitename' and dateout <= '$tglakhir'"));

            $jmlunitactual = count(DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and dateactual <= '$tglakhir' and  (dateactual is not null) and (dateactual !='0000-00-00') and flag_actual='Y' and flag_baru='B' "));

            $jmlunitactualotif = count(DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and (dateactual is not null) and (dateactual !='0000-00-00') and (dateactual <= daterequest) and dateactual <='$tglakhir' and flag_baru='B' and flag_actual='Y'"));

            if ($kdbulan=="2023-10"){

            $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
            CASE
                    WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                    WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                    WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1

            END AS JMBULAN,
            CASE
                    WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                    WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                    WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1) *(price*0.05)

            END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idcbu='SN'");
            }
            else {
                $tglawal= date('Y-m-01', strtotime($tglakhir));


                $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                CASE
                        WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                        WHEN dateactual is NOT null and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                        WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1

                END AS JMBULAN,
                CASE
                        WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and dateactual>='$tglawal' THEN (TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1) *(price*0.05)

                END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idcbu='SN'");
            }




                        $payment = DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' ");
        } elseif ($filter == 'allwater') {

            $sitename = 'Waters';
            $jmlunit = count(DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' "));
            $jmlunitout = count(DB::select("select * from unitout where idcbu='$sitename' and dateout <= '$tglakhir'"));

            $jmlunitactual = count(DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and dateactual <= '$tglakhir' and  (dateactual is not null) and (dateactual !='0000-00-00') and flag_actual='Y' and flag_baru='B' "));

            $jmlunitactualotif = count(DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and (dateactual is not null) and (dateactual !='0000-00-00') and (dateactual <= daterequest) and dateactual <='$tglakhir' and flag_baru='B' and flag_actual='Y'"));
            if ($kdbulan=="2023-10"){

                $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                CASE
                        WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1

                END AS JMBULAN,
                CASE
                        WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1) *(price*0.05)

                END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idcbu='Waters'");
                }
                else {
                    $tglawal= date('Y-m-01', strtotime($tglakhir));


                    $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                    CASE
                            WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                            WHEN dateactual is NOT null and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                            WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1

                    END AS JMBULAN,
                    CASE
                            WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                            WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                            WHEN dateactual is NOT null  and dateactual>='$tglawal' THEN (TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1) *(price*0.05)

                    END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and idcbu='Waters'");
                }            $payment = DB::select("select * from unit where idcbu='$sitename' and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' ");

        } elseif ($filter == 'allsnwater') {
            $jmlunit = count(DB::select("select * from unit where (idcbu= 'SN' or idcbu='Waters')  and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' "));
            $jmlunitout = count(DB::select("select * from unitout where (idcbu= 'SN' or idcbu='Waters')  and dateout <= '$tglakhir'"));

            $jmlunitactual = count(DB::select("select * from unit where (idcbu= 'SN' or idcbu='Waters')  and showcustomer='Y' and dateactual <= '$tglakhir' and  (dateactual is not null) and (dateactual !='0000-00-00') and flag_actual='Y' and flag_baru='B' "));

            $jmlunitactualotif = count(DB::select("select * from unit where (idcbu= 'SN' or idcbu='Waters')  and showcustomer='Y' and (dateactual is not null) and (dateactual !='0000-00-00') and (dateactual <= daterequest) and dateactual <='$tglakhir' and flag_baru='B' and flag_actual='Y'"));
            if ($kdbulan=="2023-10"){

                $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                CASE
                        WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1

                END AS JMBULAN,
                CASE
                        WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual>='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, '$tglakhir')+1)*(price*0.05)
                        WHEN dateactual is NOT null  and daterequest<'$tglakhir' and dateactual<='$tglakhir' THEN (TIMESTAMPDIFF(MONTH, daterequest, dateactual)+1) *(price*0.05)

                END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and (idcbu= 'SN' or idcbu='Waters') ");
                }
                else {
                    $tglawal= date('Y-m-01', strtotime($tglakhir));


                    $unitlate = DB::select("SELECT kdunit,serialnumber, flag_otif,price,price*0.05,daterequest,dateactual,
                    CASE
                            WHEN dateactual is null THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                            WHEN dateactual is NOT null and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1
                            WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1

                    END AS JMBULAN,
                    CASE
                            WHEN dateactual is null THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                            WHEN dateactual is NOT null  and dateactual>='$tglawal'  THEN (TIMESTAMPDIFF(MONTH, '$tglawal', '$tglakhir')+1)*(price*0.05)
                            WHEN dateactual is NOT null  and dateactual>='$tglawal' THEN (TIMESTAMPDIFF(MONTH, '$tglawal', dateactual)+1) *(price*0.05)

                    END AS penalty  FROM unit WHERE flag_otif='LATE' and (dateactual is null or dateactual is not null) and flag_baru='B' and (idcbu= 'SN' or idcbu='Waters') ");
                }
                            $payment = DB::select("select * from unit where (idcbu= 'SN' or idcbu='Waters') and showcustomer='Y' and daterequest <= '$tglakhir' and flag_target='Y' ");

        } else {
            $jmlunit = 0;
        }

        if ($jmlunit == 0) {
            $jmlunit = 0;
            $jmlunitactual = 0;
            if ($unitlate == null) {
                $unitlate = 0;
                $totalpenalty = 0;
            }
            return response()->json(
                [
                    'isSuccess' => true,
                    'Message' => 'Data Found',
                    'jmlunit' => 0,
                    'jmlunitactual' => 0,
                    'prosunit' => 0,
                    'jmlunitactualotif' => 0,
                    'proslate' => 0,
                    'totalpenalty' => 0,
                    'unitlate' => 0,
                ],
                200,
            );
        } else {
            $jmlunitfix = $jmlunit - $jmlunitout;
            $prosunit = number_format($jmlunitactual / $jmlunitfix * 100, 2);
            $proslate = number_format(($jmlunitfix - $jmlunitactualotif) / $jmlunitfix * 100, 2);
            $totalpenalty = 0;
            $totalpayment =0;
            if (count($unitlate) < 1) {
                $totalpenalty = 0;
            } else {
                foreach ($unitlate as $units) {

                    $totalpenalty = $units->penalty + $totalpenalty;
                }
                $totalpenalty = number_format($totalpenalty);
            }
            if (count($payment) < 1) {
                $totalpayment = 0;
            } else {
                foreach ($payment as $payments) {
                    $totalpayment = $payments->price + $totalpayment;
                }
                $totalpayment = number_format($totalpayment);
            }
            return response()->json(
                [
                    'isSuccess' => true,
                    'Message' => 'Data Found',
                    'jmlunit' => $jmlunitfix,
                    'jmlunitout' => $jmlunitout,
                    'jmlunitactual' => $jmlunitactual,
                    'prosunit' => $prosunit,
                    'jmlunitactualotif' => $jmlunitactualotif,
                    'proslate' => $proslate,
                    'totalpenalty' => $totalpenalty,
                    'totalpayment' => $totalpayment,
                ],
                200,
            ); // Status code here
        }
    }
    public function kpisparepart(Request $request)
    {
        $tglawal = $request->get('tglawal');
        $tglakhir = $request->get('tglakhir');
        $filter = $request->get('filter');
        if ($filter == 'sitename') {
            $sitename = $request->idsitename;
            $restkpisparepart = DB::table('sparepartstok')
            ->select(DB::raw('sum(qty) as jmlqty, sum(stok) as jmlstok, avg((stok/qty)*100) as kpisparepart'))
            ->where('idsitename', $sitename)
                ->get();
                if ($restkpisparepart) {
                    foreach ($restkpisparepart as $item) {
                        $kpisparepart = $item->kpisparepart;
                        $jmlqty = $item->jmlqty;
                        $jmlstok = $item->jmlstok;
                    }
                } else {
                    $kpisparepart = 0;
                    $jmlqty = 0;
                    $jmlstok = 0;
                }
            } elseif ($filter == 'region') {
            $sitename = $request->idregion;
            $restkpisparepart = DB::table('sparepartstok')
            ->select(DB::raw('sum(qty) as jmlqty, sum(stok) as jmlstok, avg((stok/qty)*100) as kpisparepart'))
            ->where('idregion', $sitename)
                ->get();
                if ($restkpisparepart) {
                    foreach ($restkpisparepart as $item) {
                        $kpisparepart = $item->kpisparepart;
                        $jmlqty = $item->jmlqty;
                        $jmlstok = $item->jmlstok;
                    }
                } else {
                    $kpisparepart = 0;
                    $jmlqty = 0;
                    $jmlstok = 0;
                }
            } elseif ($filter == 'cbu') {
            $sitename = $request->idcbu;
            $restkpisparepart = DB::table('sparepartstok')
                ->select(DB::raw('sum(qty) as jmlqty, sum(stok) as jmlstok, avg((stok/qty)*100) as kpisparepart'))
                ->where('idcbu', $sitename)
                ->get();
                if ($restkpisparepart) {
                    foreach ($restkpisparepart as $item) {
                        $kpisparepart = $item->kpisparepart;
                        $jmlqty = $item->jmlqty;
                        $jmlstok = $item->jmlstok;
                    }
                } else {
                    $kpisparepart = 0;
                    $jmlqty = 0;
                    $jmlstok = 0;
                }
            } elseif ($filter == 'allsn') {
            $sitename = 'SN';
            $restkpisparepart = DB::table('sparepartstok')
            ->select(DB::raw('sum(qty) as jmlqty, sum(stok) as jmlstok, avg((stok/qty)*100) as kpisparepart'))
            ->where('idcbu', $sitename)
                ->get();
                if ($restkpisparepart) {
                    foreach ($restkpisparepart as $item) {
                        $kpisparepart = $item->kpisparepart;
                        $jmlqty = $item->jmlqty;
                        $jmlstok = $item->jmlstok;
                    }
                } else {
                    $kpisparepart = 0;
                    $jmlqty = 0;
                    $jmlstok = 0;
                }
            } elseif ($filter == 'allwater') {
            $sitename = 'Waters';
            $restkpisparepart = DB::table('sparepartstok')
            ->select(DB::raw('sum(qty) as jmlqty, sum(stok) as jmlstok, avg((stok/qty)*100) as kpisparepart'))
            ->where('idcbu', $sitename)
                ->get();
                if ($restkpisparepart) {
                    foreach ($restkpisparepart as $item) {
                        $kpisparepart = $item->kpisparepart;
                        $jmlqty = $item->jmlqty;
                        $jmlstok = $item->jmlstok;
                    }
                } else {
                    $kpisparepart = 0;
                    $jmlqty = 0;
                    $jmlstok = 0;
                }
            }
            elseif ($filter == 'allsnwater') {
            $restkpisparepart = DB::select("select sum(qty) as jmlqty, sum(stok) as jmlstok, avg((stok/qty)*100) as kpisparepart from sparepartstok where (idcbu= 'SN' or idcbu='Waters')");
            if ($restkpisparepart) {
                foreach ($restkpisparepart as $item) {
                    $kpisparepart = $item->kpisparepart;
                    $jmlqty = $item->jmlqty;
                    $jmlstok = $item->jmlstok;
                }
            } else {
                $kpisparepart = 0;
                $jmlqty = 0;
                $jmlstok = 0;
            }
        } else {
            $kpisparepart = 0;
            $jmlqty = 0;
            $jmlstok = 0;
        }

        if ($kpisparepart == 0) {
            $kpisparepart = 0;
            return response()->json(
                [
                    'isSuccess' => true,
                    'Message' => 'Data Found',
                    'jmlstok'=>0,
                    'jmlqty'=>0,
                    'kpisparepart' => 0,
                ],
                200,
            );
        } else {
            return response()->json(
                [
                    'isSuccess' => true,
                    'Message' => 'Data Found',
                    'jmlstok'=>number_format($jmlstok),
                    'jmlqty'=>number_format($jmlqty),
                    'kpisparepart' => number_format($kpisparepart, 2) . " %",
                ],
                200,
            ); // Status code here
        }
    }


    public function registrasi()
    {
        return view('auth-register');
    }
    public function restrictpage()
    {
        return view('restrict-page');
    }
}
