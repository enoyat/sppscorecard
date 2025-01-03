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
<form action="#" method="get">
    @csrf
    <div class="row">
        <div class="col-md-6">



            <div class="input-group mx-1">



                <input type="text" name="periode" id="periode"
                    value="@if (request()->get('periode') != null) {{ request()->get('periode') }} @endif"
                    placeholder="yyyy-mm" class="form-control">

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
                    @elseif (Auth::user()->roles_id == '2')
                        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
                            SITENAME</option>
                    @elseif (Auth::user()->roles_id == '4')
                        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
                            SITENAME</option>
                    @elseif (Auth::user()->roles_id == '5')
                        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
                            SITENAME</option>
                        <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
                            REGION</option>
                        <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
                            CBU</option>
                    @elseif (Auth::user()->roles_id == '6')
                        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
                            SITENAME</option>
                        <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
                            REGION</option>
                        <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
                            CBU</option>
                    @endif
                </select>
                <div id="filtersitename" style="width:300px">
                    <select name="xidsitename" id="xidsitename" class="form-control">
                        @if (request()->get('xidsitename') != null)
                            <option value="{{ request()->get('xidsitename') }}" selected>
                                {{ request()->get('xidsitename') }}</option>
                        @endif
                    </select>
                </div>
                <div id="filterregion" style="width:150px">
                    <select name="xidregion" id="xidregion" class="form-control">
                        @if (request()->get('xidregion') != null)
                            <option value="{{ request()->get('xidregion') }}" selected>
                                {{ request()->get('xidregion') }}</option>
                        @endif
                    </select>
                </div>
                <div id="filtercbu" style="width:150px">

                    <select class="form-control" aria-label="Default select example" name="xidcbu" id="xidcbu">
                        @if (request()->get('xidcbu') != null)
                            <option value="{{ request()->get('xidcbu') }}" selected>
                                {{ request()->get('xidcbu') }}</option>
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
</form>
<div id="area-print">
    <table width="100%">
        <tr>
            <td style="background: white; padding:10px">
                @if (!empty(Session::get('logo')))
                    <a href="{{ route('root') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('img/' . Session::get('logo')) }}" alt="" class="img-fluid"
                                style="max-height:50px">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('img/' . Session::get('logo')) }}" alt="" class="img-fluid"
                                style="max-height:50px">
                            <span class="logo-txt"></span>
                        </span>
                    </a>
                @else
                    {{ Session::get('logo') }}
                @endif


            </td>
            <td style="background:rgb(9, 136, 153); padding:10px">
                <div style="font-size: 16px; color: white;"><b>KPI DASHBOARD
                    </b></div>
            </td>
            <td style="background:rgb(9, 136, 153); color: white; padding:10px">Update: {{ date('Y/m/d') }}</td>
        </tr>
    </table>
    <br>
    <br>
    <div class="row">
        <div class="col-xl-8 col-md-8">
            <!-- card -->
            <div class="card card-h-100" style="border:1px solid; ">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Units</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $jmlunit }}">0</span>
                            </h4>
                        </div>
                        <div id="pie-chartunit"
                            data-colors='["#0625c2", "#d7f23a", "#4ba6ef", "#ffbf53", "#5156be", "#32a852"]'
                            class="e-charts">
                        </div>

                    </div>

                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-4 col-md-4">
            <!-- card -->
            <div class="card" style="border:1px solid; ">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">KPI</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $avgkpi }}">0</span>%
                            </h4>
                        </div>

                    </div>
                </div>
            </div><!-- end card body -->
            <div class="card" style="border:1px solid; ">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Delivery Schedule</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $kpidelivery }}">0</span>%
                            </h4>
                        </div>

                    </div>
                </div>
            </div><!-- end card body -->
            <div class="card" style="border:1px solid; ">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Spare Parts</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $kpisparepart }}">0</span>%
                            </h4>
                        </div>

                    </div>
                </div>
            </div><!-- end card body -->
        </div><!-- end card -->



    </div>

    <div class="row">
        <?php $i = 0; ?>
        @foreach ($arraykpi as $item)
            <div class="col-xl-4 col-md-8">
                <!-- card -->
                <div class="card card-h-100" style="border:1px solid; ">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span
                                    class="text-muted mb-3 lh-1 d-block text-truncate">{{ $item['namaforklifttype'] }}</span>
                                <h4 class="mb-3">
                                    <?php $kpi = ($item['sumtotaljamkerja'] / $item['sumplanunitkerja']) * 100; ?>

                                    <span class="counter-value" data-target="{{ number_format($kpi, 2) }}">0</span>%
                                </h4>
                            </div>

                        </div>
                        <div class="row">
                            <div id="pie-chart{{ $i }}"
                                data-colors='["#0625c2", "#d7f23a", "#4ba6ef", "#ffbf53", "#5156be"]'
                                class="e-charts">
                            </div>
                            <input type="hidden" name="totalbreakdown{{ $i }}"
                                id="totalbreakdown{{ $i }}" value="{{ $item['totalbreakdown'] }}">

                            <input type="hidden" name="sumtotaljamkerja{{ $i }}"
                                id="sumtotaljamkerja{{ $i }}" value="{{ $item['sumtotaljamkerja'] }}">

                        </div>
                        <div class="text-nowrap">
                            <span class="badge bg-primary ">{{ number_format($item['jmlunit']) }}</span>
                            <span class="ms-1 text-muted font-size-13">Units</span>
                        </div>
                        <div class="text-nowrap">
                            <span class="badge bg-primary ">{{ number_format($item['sumplanunitkerja']) }}</span>
                            <span class="ms-1 text-muted font-size-13">Target Available (Minutes)</span>
                        </div>
                        <div class="text-nowrap">
                            <span
                                class="badge badge-soft-success text-success">{{ number_format($item['sumtotaljamkerja']) }}</span>
                            <span class="ms-1 text-muted font-size-13">Total Available (Minutes)</span>
                        </div>
                        <div class="text-nowrap">
                            <span
                                class="badge badge-soft-danger text-success">{{ number_format($item['totalbreakdown']) }}</span>
                            <span class="ms-1 text-muted font-size-13">Breakdown (Minutes)</span>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div>
            <?php $i++; ?>
        @endforeach
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
        <?php $i = 0; ?>
        @foreach ($arraykpi as $item)
            generatechart({{ $i }});
            <?php $i++; ?>
        @endforeach
        chartunit();
    });

    function chartunit() {
        // pie chart
        var pieColors = getChartColorsArray("#pie-chartunit");
        var dom = document.getElementById("pie-chartunit");

        var myChart = echarts.init(dom);

        var app = {};
        option = null;
        option = {
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            // legend: {
            //     orient: 'horizontal',
            //     left: 'left',
            //     data: {{ $kategori }},
            //     textStyle: {
            //         color: '#858d98'
            //     }
            // },
            color: pieColors, //['#fd625e', '#2ab57d', '#4ba6ef', '#ffbf53', '#5156be'],
            series: [{
                name: 'Type',
                type: 'pie',
                radius: '75%',
                // center: ['50%', '60%'],
                data: [
                    @foreach ($arraykpi as $item)
                        {
                            value: {{ $item['jmlunit'] }},
                            name: "{{ $item['namaforklifttype'] }}"
                        },
                    @endforeach
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };;
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
    }


    // get colors array from the string
    function getChartColorsArray(chartId) {
        var colors = $(chartId).attr('data-colors');
        var colors = JSON.parse(colors);
        return colors.map(function(value) {
            var newValue = value.replace(' ', '');
            if (newValue.indexOf('--') != -1) {
                var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                if (color) return color;
            } else {
                return newValue;
            }
        })
    }

    function generatechart(i) {
        // pie chart
        var pieColors = getChartColorsArray("#pie-chart" + i);
        var dom = document.getElementById("pie-chart" + i);
        var totalbreakdown = document.getElementById("totalbreakdown" + i).value;
        var sumtotaljamkerja = document.getElementById("sumtotaljamkerja" + i).value;
        var myChart = echarts.init(dom);

        var app = {};
        option = null;
        option = {
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'horizontal',
                left: 'left',
                data: ['Available', 'Breakdown'],
                textStyle: {
                    color: '#858d98'
                }
            },
            color: pieColors, //['#fd625e', '#2ab57d', '#4ba6ef', '#ffbf53', '#5156be'],
            series: [{
                name: 'KPI',
                type: 'pie',
                radius: '40%',
                // center: ['50%', '60%'],
                data: [{
                        value: sumtotaljamkerja,
                        name: 'Available'
                    },
                    {
                        value: totalbreakdown,
                        name: 'Breakdown'
                    },
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };;
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
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
