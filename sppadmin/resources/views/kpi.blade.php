<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="row">
    <div class="col-md-6">



        <div class="input-group mx-1">



            <input type="date" name="tglakhir" id="tglakhir" value="" class="form-control">
            <select name="filter" id="filter" class="form-control">
                <option value="" {{ request()->get('filter') == '' ? 'selected' : '' }}>
                    -- select filter --</option>
                @if (Auth::user()->roles_id == '1')
                    <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
                        SITENAME</option>
                    <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
                        REGION</option>
                    <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
                        CBU</option>

                    <option value="allsnwater" {{ request()->get('filter') == 'allsnwater' ? 'selected' : '' }}>
                        ALL SN & WATERS</option>
                @elseif (Auth::user()->roles_id == '2')
                    <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
                        SITENAME</option>
                @elseif (Auth::user()->roles_id == '5')
                    <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
                        SITENAME</option>
                    <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
                        REGION</option>
                    <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
                        CBU</option>

                    <option value="allsnwater" {{ request()->get('filter') == 'allsnwater' ? 'selected' : '' }}>
                        ALL SN & WATERS</option>
                @elseif (Auth::user()->roles_id == '6')
                    <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
                        SITENAME</option>
                    <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
                        REGION</option>
                    <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
                        CBU</option>

                    <option value="allsnwater" {{ request()->get('filter') == 'allsnwater' ? 'selected' : '' }}>
                        ALL SN & WATERS</option>
                @endif
            </select>
            <div id="filtersitename" style="width:300px">
                <select name="xidsitename" id="xidsitename" class="form-control">
                    @if (Session::get('runidsitename') != null)
                        <option value="{{ Session::get('runidsitename') }}" selected>
                            {{ Session::get('runnamasitename') }}</option>
                    @endif
                </select>
            </div>
            <div id="filterregion" style="width:150px">
                <select name="xidregion" id="xidregion" class="form-control">
                    @if (Session::get('runidregion') != null)
                        <option value="{{ Session::get('runidregion') }}" selected>
                            {{ Session::get('runnamaregion') }}</option>
                    @endif
                </select>
            </div>
            <div id="filtercbu" style="width:150px">

                <select class="form-control" aria-label="Default select example" name="xidcbu" id="xidcbu">
                    @if (Session::get('runidcbu') != null)
                        <option value="{{ Session::get('runidcbu') }}" selected>
                            {{ Session::get('runnamacbu') }}</option>
                    @endif

                    <option value="">-- select --</option>
                    @foreach ($cbu as $itemcbu)
                        <option value="{{ $itemcbu->id }}">{{ $itemcbu->namasitename }}</option>
                    @endforeach

                </select>
            </div>



            <button type="submit" class="btn btn-primary" id="btnfilter"><i class="fas fa-search"></i></button>

        </div>

    </div>

</div>


<div id="area-print">
    <table width="100%">
        <tr>
            <td style="background: white; padding:10px"><img src="{{ URL::asset('img/logo.png') }}" alt=""
                    height="50">
            </td>
            <td style="background:rgb(9, 136, 153); padding:10px">
                <div style="font-size: 16px; color: white;"><b>AVAILABILITY DASHBOARD
                    </b></div>
            </td>
            <td style="background:rgb(9, 136, 153); color: white; padding:10px">Update: {{ date('Y/m/d') }}</td>
        </tr>
    </table>
    <br>
    <br>
    <div class="row">

            <!-- card -->
            <div class="row">
            <div class="col-6">

                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">YTD</span>
                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">DELIVERY</span>
                            <div class="col-4">
                                <div class="card" style="border:1px solid; ">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row ">

                                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">TARGET
                                                (UNIT)</span>

                                            <div id="jmlunit"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card" style="border:1px solid; ">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row ">

                                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">ACTUAL
                                                (UNIT)</span>

                                            <div id="jmlunitactual"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card" style="border:1px solid; ">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row ">

                                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">% DELIVERED
                                                (UNIT)</span>

                                            <div id="prosunit"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">OTIF</span>
                            <div class="col-4">
                                <div class="card" style="border:1px solid; ">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row ">

                                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">TARGET
                                                (UNIT)</span>

                                            <div id="jmlunitotif"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card" style="border:1px solid; ">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row ">

                                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">ACTUAL
                                                (UNIT)</span>

                                            <div id="jmlunitactualotif"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card" style="border:1px solid; ">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row ">

                                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">% LATE
                                                (UNIT)</span>

                                            <div id="proslate"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900"> TOTAL PENALTY :</span>
                            <div class="col-4">
                                <div class="card" style="border:1px solid; ">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row ">


                                            <div id="totalpenalty"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>



                </div><!-- end card body -->
            <!-- end card -->
            </div>
            <div class="col-6">

                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">

                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">MTD</span>
                            <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">AVAILABILITY</span>
                                <div class="col-4">
                                    <div class="card" style="border:1px solid; ">
                                        <!-- card body -->
                                        <div class="card-body">
                                            <div class="row ">

                                                <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">TARGET (HOUR)</span>

                                                <div id="sumplanunitkerja"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card" style="border:1px solid; ">
                                        <!-- card body -->
                                        <div class="card-body">
                                            <div class="row ">

                                                <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">ACTUAL (HOUR)</span>

                                                <div id="sumtotaljamkerja"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card" style="border:1px solid; ">
                                        <!-- card body -->
                                        <div class="card-body">
                                            <div class="row ">

                                                <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">% AVAILABILITY (HOUR)</span>

                                                <div id="avgpaforklift"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900"> TOTAL PAYMENT :</span>
                                <div class="col-4">
                                    <div class="card" style="border:1px solid; ">
                                        <!-- card body -->
                                        <div class="card-body">
                                            <div class="row ">


                                                <div id="totalpayment"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900"> SPAREPART</span>
                                <div class="col-4">
                                    <div class="card" style="border:1px solid; ">
                                        <!-- card body -->
                                        <div class="card-body">
                                            <div class="row ">

                                                <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">TARGET (PCS)</span>

                                                <div id="jmlqty"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card" style="border:1px solid; ">
                                        <!-- card body -->
                                        <div class="card-body">
                                            <div class="row ">

                                                <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">ACTUAL (PCS)</span>

                                                <div id="jmlstok"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card" style="border:1px solid; ">
                                        <!-- card body -->
                                        <div class="card-body">
                                            <div class="row ">

                                                <span class="text-muted mb-3 lh-1 d-block text-truncate" style="font-weight: 900">%</span>

                                                <div id="kpisparepart"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>


                    </div><!-- end card body -->

            </div>
            </div>


    </div><!-- end col -->
    {{-- <div class="col-xl-4 col-md-4">
            @if (count($arraykpi) > 0)
                <?php $i = 0; ?>
                <div class="card card-h-100" style="border:1px solid; ">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate" id="detnamatype"></span>
                                <h4 class="mb-3">
                                    <span class="counter-value" id="detkpi"></span> %
                                </h4>
                            </div>

                        </div>
                        <div class="row">
                            <div id="pie-chart"
                                data-colors='["#0625c2", "#d7f23a", "#4ba6ef", "#ffbf53", "#5156be", "#32a852"]'
                                class="e-charts">
                            </div>

                        </div>
                        <div class="text-nowrap">
                            <span class="badge bg-primary " id="detjmlunit"></span>
                            <span class="ms-1 text-muted font-size-13">Units</span>
                        </div>
                        <div class="text-nowrap">
                            <span class="badge bg-primary " id="dettargetavailable"></span>
                            <span class="ms-1 text-muted font-size-13">Target Available (Minutes)</span>
                        </div>
                        <div class="text-nowrap">
                            <span class="badge badge-soft-success text-success" id="dettotalavailable"></span>
                            <span class="ms-1 text-muted font-size-13">Total Available (Minutes)</span>
                        </div>
                        <div class="text-nowrap">
                            <span class="badge badge-soft-danger text-success" id="dettotalbreakdown"></span>
                            <span class="ms-1 text-muted font-size-13">Breakdown (Minutes)</span>
                        </div>
                    </div><!-- end card body -->
                </div>
                <?php $i++; ?>
            @endif
        </div><!-- end card --> --}}



</div>


</div>


<style>
    .apexcharts-tooltip span {
        color: #ffffff;
    }
</style>
{{-- <div style="text-align: center;"><button type="button" class="btn btn-primary" id="cetak"
        onclick="printDiv('area-print')">Print KPI</button></div> --}}
<!-- echarts init -->
<!-- echarts js -->
<script src="{{ URL::asset('build/libs/echarts/echarts.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // <?php $i = 0; ?>
        // chartunit();

        $("#btnfilter").click(function() {
            kpiavailability();
            kpiunit();
            kpisparepart();
        });



    });

    function kpiunit() {

        var tglakhir = $("#tglakhir").val();
        var filter = $("#filter").val();
        var idcbu = $("#xidcbu").val();
        var idsitename = $("#xidsitename").val();
        var idregion = $("#xidregion").val();
        $.ajax({
            type: "GET",
            url: "{{ url('kpiunit') }}",
            data: {
                filter: filter,
                tglakhir: tglakhir,
                idcbu: idcbu,
                idsitename: idsitename,
                idregion: idregion
            },
            dataType: "json",
            success: function(data) {
                $("#jmlunit").html(data.jmlunit);
                $("#xjmlunit").html(data.jmlunit);
                $("#jmlunitactual").html(data.jmlunitactual);
                $("#prosunit").html(data.prosunit);
                $("#jmlunitotif").html(data.jmlunit);
                $("#jmlunitactualotif").html(data.jmlunitactualotif);
                $("#proslate").html(data.proslate);
                $("#totalpenalty").html(data.totalpenalty);
                $("#totalpayment").html(data.totalpayment);



            }
        });
    }

    function kpiavailability() {

        var tglakhir = $("#tglakhir").val();
        var filter = $("#filter").val();
        var idcbu = $("#xidcbu").val();
        var idsitename = $("#xidsitename").val();
        var idregion = $("#xidregion").val();
        $.ajax({
            type: "GET",
            url: "{{ url('kpiavailability') }}",
            data: {
                filter: filter,
                tglakhir: tglakhir,
                idcbu: idcbu,
                idsitename: idsitename,
                idregion: idregion
            },
            dataType: "json",
            success: function(data) {
                $("#sumplanunitkerja").html(data.sumplanunitkerja);
                $("#sumtotaljamkerja").html(data.sumtotaljamkerja);
                $("#avgpaforklift").html(data.avgpaforklift);


            }
        });
    }

    function kpisparepart() {

        var tglakhir = $("#tglakhir").val();
        var filter = $("#filter").val();
        var idcbu = $("#xidcbu").val();
        var idsitename = $("#xidsitename").val();
        var idregion = $("#xidregion").val();


        $.ajax({
            type: "GET",
            url: "{{ url('kpisparepart') }}",
            data: {
                filter: filter,
                tglakhir: tglakhir,
                idcbu: idcbu,
                idsitename: idsitename,
                idregion: idregion
            },
            dataType: "json",
            success: function(data) {
                $("#jmlqty").html(data.jmlqty);
                $("#jmlstok").html(data.jmlstok);
                $("#kpisparepart").html(data.kpisparepart);


            }
        });
    }
</script>

<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $("#filtersitename").hide();
        $("#filterregion").hide();
        $("#filtercbu").hide();
        var filter = $("select[name='filter']").val();
        if (filter == "sitename") {
            $("#filtersitename").show();
            $("#filterregion").hide();
            $("#filtercbu").hide();
        } else if (filter == "region") {
            $("#filtersitename").hide();
            $("#filterregion").show();
            $("#filtercbu").hide();

        } else if (filter == "cbu") {
            $("#filtersitename").hide();
            $("#filterregion").hide();
            $("#filtercbu").show();
        } else {
            $("#filtersitename").hide();
            $("#filterregion").hide();
            $("#filtercbu").hide();
        }


    });

    $("select[name='filter']").change(function() {
        if ($(this).val() == "sitename") {
            $("#filtersitename").show();
            $("#filterregion").hide();
            $("#filtercbu").hide();
        } else if ($(this).val() == "region") {
            $("#filtersitename").hide();
            $("#filterregion").show();
            $("#filtercbu").hide();

        } else if ($(this).val() == "cbu") {
            $("#filtersitename").hide();
            $("#filterregion").hide();
            $("#filtercbu").show();
        } else {
            $("#filtersitename").hide();
            $("#filterregion").hide();
            $("#filtercbu").hide();
        }
    });

    $("#xidsitename").select2({
        placeholder: '-- select sitename --',
        ajax: {
            url: "{{ route('sitename.getsitename') }}",
            type: "GET",
            dataType: 'JSON',
            delay: 250,
            data: function(params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });

    $("#xidregion").select2({
        placeholder: '-- select region --',
        ajax: {
            url: "{{ route('sitename.getregion') }}",
            type: "GET",
            dataType: 'JSON',
            delay: 250,
            data: function(params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
</script>
