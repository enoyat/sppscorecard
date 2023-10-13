<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<div id="area-print">
    <div class="card" style="border: 1px solid black">
        <div class="card-body">

            <table width="100%">
                <tr>
                    <td style="background: white; padding:10px"><img src="{{ URL::asset('img/logo.png') }}" alt=""
                            height="50">
                    </td>
                    <td style="background:rgb(9, 136, 153); padding:10px">
                        <div style="font-size: 16px; color: white;"><b>KPI DASHBOARD
                                {{ Session::get('runnamaregion') }}</b></div>
                    </td>
                    <td style="background:rgb(9, 136, 153); color: white; padding:10px">Update: {{ date('Y/m/d') }}</td>
                </tr>
            </table>
            <br>
            <br>
            <div class="row">
                <div class="col-3">
                    <div
                        style="border-top-left-radius: 20px; border: 1px solid grey; padding:10px; border-bottom-right-radius:20px">
                        <div
                            style="margin-top:-25px; margin-left:10px; width:200px; height:30px; background: rgb(9, 136, 153); border-radius:10px; padding:5px; color:white; text-align:center">
                            Total Unit</div>
                        <table width="100%">
                            <tr>
                                <td style="text-align: center; font-size: 20px; color:blue"><b>{{ $jmlunit }}</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-3">
                    <div
                        style="border-top-left-radius: 20px; border: 1px solid grey; padding:10px; border-bottom-right-radius:20px">
                        <div
                            style="margin-top:-25px; margin-left:10px; width:200px; height:30px; background: rgb(9, 136, 153); border-radius:10px; padding:5px; color:white; text-align:center">
                            KPI</div>
                        <table width="100%">
                            <tr>
                                <td style="text-align: center; font-size: 20px; color:blue"><b>{{ $avgkpi }}</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-3">
                    <div
                        style="border-top-left-radius: 20px; border: 1px solid grey; padding:10px; border-bottom-right-radius:20px">
                        <div
                            style="margin-top:-25px; margin-left:10px; width:200px; height:30px; background: rgb(9, 136, 153); border-radius:10px; padding:5px; color:white; text-align:center">
                            Delivery Schedule</div>
                        <table width="100%">
                            <tr>
                                <td style="text-align: center; font-size: 20px; color:blue"><b>0</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-3">
                    <div
                        style="border-top-left-radius: 20px; border: 1px solid grey; padding:10px; border-bottom-right-radius:20px">
                        <div
                            style="margin-top:-25px; margin-left:10px; width:200px; height:30px; background: rgb(9, 136, 153); border-radius:10px; padding:5px; color:white; text-align:center">
                            Spare Parts</div>
                        <table width="100%">
                            <tr>
                                <td style="text-align: center; font-size: 20px; color:blue"><b>0</b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <br>

            <div class="table-responsive">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title mb-0">UNIT DIAGRAM CHART</h4>
                    </div>
                    <div class="card-body">
                        <div id="pie_chart" data-colors='["#077a75", "#5156be", "#fd625e"]'' class="apex-charts"
                            dir="ltr">

                        </div>

                    </div>
                </div>
                <!--end card-->
            </div>

        </div>
    </div>
</div>
<style>
    .apexcharts-tooltip span {
        color: #ffffff;
    }
</style>
<div style="text-align: center;"><button type="button" class="btn btn-primary" id="cetak"
        onclick="printDiv('area-print')">Print KPI</button></div>
<script>
    /*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Apex Chart init js
*/

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

    // pie chart
    var pieColors = getChartColorsArray("#pie_chart");
    var options = {
        chart: {
            height: 320,
            type: 'pie',
            events: {
                dataPointSelection: function(event, chartContext, config) {
                    alert(config.w.config.labels[config.dataPointIndex]);
                    alert(config.w.config.series[config.dataPointIndex]);
                }

            }

        },


        series: {{ $unit }},
        labels: <?php echo $kategori; ?>,
        colors: pieColors,
        legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
            verticalAlign: 'middle',
            floating: false,
            fontSize: '14px',
            offsetX: 0,
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: true
                },
            }
        }],

    }

    var chart = new ApexCharts(
        document.querySelector("#pie_chart"),
        options
    );

    chart.render();
</script>
