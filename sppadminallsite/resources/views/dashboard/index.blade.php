@extends('layouts.master')

@section('title', 'Availability Dashboard')

@section('css')

    <link href="{{ asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('assets/dashboard/dashboard.css') }}" rel="stylesheet">

    <style>
        .dashboard-card {

            background: #fff;

            border-radius: 18px;

            padding: 22px;

            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);

            transition: .3s;

            overflow: hidden;

            position: relative;

            height: 170px;

        }

        .dashboard-card:hover {

            transform: translateY(-5px);

            box-shadow: 0 18px 35px rgba(0, 0, 0, .12);

        }

        .dashboard-card::after {

            content: '';

            position: absolute;

            left: 0;

            right: 0;

            bottom: 0;

            height: 12px;

            opacity: .12;

        }

        .card-primary::after {

            background: #4F46E5;

        }

        .card-success::after {

            background: #10B981;

        }

        .card-info::after {

            background: #3B82F6;

        }

        .card-danger::after {

            background: #EF4444;

        }

        .card-warning::after {

            background: #F59E0B;


        }

        .card-dark::after {

            background: #374151;

        }

        .card-top {

            display: flex;

            align-items: center;

            gap: 18px;

        }

        .icon-box {

            width: 55px;

            height: 55px;

            border-radius: 15px;

            display: flex;

            justify-content: center;

            align-items: center;

            color: #fff;

            font-size: 24px;

        }

        .card-primary .icon-box {

            background: #4F46E5;

        }

        .card-success .icon-box {

            background: #10B981;

        }

        .card-info .icon-box {

            background: #3B82F6;

        }

        .card-danger .icon-box {

            background: #EF4444;

        }

        .card-warning .icon-box {

            background: #F59E0B;

        }

        .card-dark .icon-box {

            background: #374151;

        }

        .card-title {

            font-size: 14px;

            color: #6B7280;

            font-weight: 600;

        }

        .card-value {

            font-size: 38px;

            font-weight: 700;

            color: #1F2937;

            margin-top: 8px;

        }

        .card-footer-text {

            margin-top: 20px;

            color: #9CA3AF;

            font-size: 13px;

        }
    </style>


@endsection

@section('content')


    <x-dashboard-filter :showCBU="true" :showRegion="true" :showSite="true" />
    <div class="container-fluid">

        {{-- =========================
        HEADER
    ========================== --}}

        <div class="row mb-4">

            <div class="col-lg-8">

                <h2 class="fw-bold mb-0">
                    <i class="bi bi-speedometer2 text-primary"></i>
                    Availability Dashboard
                </h2>

                <small class="text-muted">
                    Forklift Availability Monitoring System
                </small>

            </div>

            <div class="col-lg-4 text-end">

                <div class="dashboard-clock">

                    <div id="clock"></div>

                    <small class="text-muted">

                        Last Update :
                        {{ now()->format('d M Y H:i') }}

                    </small>

                </div>

            </div>

        </div>

        {{-- =========================
        FILTER
    ========================== --}}

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-body">

                <form method="GET">

                    <div class="row g-3">

                        <div class="col-lg-2">

                            <label class="form-label">

                                Periode

                            </label>

                            <input type="month" class="form-control" name="periode"
                                value="{{ request('periode', $periode) }}">

                        </div>
                        <div class="col-lg-2">

                            <label class="form-label">
                                Filter By

                            </label>
                            <select class="form-select" name="filterby">

                                <option value="allcbu">CBU</option>
                                <option value="allregion">Region</option>
                                <option value="allsite">Site</option>


                            </select>
                        </div>


                        {{-- <div class="col-lg-2">

                            <label class="form-label">

                                Forklift Type

                            </label>

                            <select class="form-select" name="idforklifttype">

                                <option>

                                    All Type

                                </option>

                                @foreach ($forklifttype as $row)
                                    <option value="{{ $row->id }}">

                                        {{ $row->namaforklifttype }}

                                    </option>
                                @endforeach

                            </select>

                        </div> --}}

                        <div class="col-lg-2 d-flex align-items-end">

                            <button class="btn btn-primary w-100">

                                <i class="bi bi-search"></i>

                                Filter

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

        {{-- =========================
    SUMMARY
========================== --}}

        <div class="row g-4 mb-4">

            {{-- Total Unit --}}
            <div class="col-xl-2 col-lg-4 col-md-6">
                <div class="dashboard-card card-primary">
                    <div class="card-top">
                        <div class="icon-box">
                            <i class="bi bi-truck"></i>
                        </div>
                        <div>
                            <div class="card-title">Total Unit</div>
                            <div class="card-value">
                                {{ number_format($dashboard['totalUnit']) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-text">
                        Active Unit
                    </div>
                </div>
            </div>

            {{-- Availability --}}
            <div class="col-xl-2 col-lg-4 col-md-6">
                <div class="dashboard-card card-success">
                    <div class="card-top">
                        <div class="icon-box">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div>
                            <div class="card-title">Availability</div>
                            <div class="card-value">
                                {{ number_format($dashboard['pa'], 2) }}%
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-text">
                        Good Performance
                    </div>
                </div>
            </div>

            {{-- Working --}}
            <div class="col-xl-2 col-lg-4 col-md-6">
                <div class="dashboard-card card-info">
                    <div class="card-top">
                        <div class="icon-box">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div>
                            <div class="card-title">Working Time</div>
                            <div class="card-value fs-3">
                                {{ number_format($dashboard['working']) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-text">
                        Total Working Minutes
                    </div>
                </div>
            </div>

            {{-- Breakdown --}}
            <div class="col-xl-2 col-lg-4 col-md-6">
                <div class="dashboard-card card-danger">
                    <div class="card-top">
                        <div class="icon-box">
                            <i class="bi bi-tools"></i>
                        </div>
                        <div>
                            <div class="card-title">Breakdown</div>
                            <div class="card-value">
                                {{ number_format($dashboard['breakdown']) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-text">
                        Total Breakdown
                    </div>
                </div>
            </div>

            {{-- Backup --}}
            <div class="col-xl-2 col-lg-4 col-md-6">
                <div class="dashboard-card card-warning">
                    <div class="card-top">
                        <div class="icon-box">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <div>
                            <div class="card-title">Backup</div>
                            <div class="card-value">
                                {{ number_format($dashboard['backup']) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-text">
                        Backup Time
                    </div>
                </div>
            </div>

            {{-- MTTR --}}
            <div class="col-xl-2 col-lg-4 col-md-6">
                <div class="dashboard-card card-dark">
                    <div class="card-top">
                        <div class="icon-box">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <div>
                            <div class="card-title">MTTR</div>
                            <div class="card-value">
                                {{ number_format($dashboard['mttr'], 2) }}
                                <small>Hr</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-text">
                        Average Repair Time
                    </div>
                </div>
            </div>

        </div>
        {{-- ===========================================================
    CHART KPI AVAILABLE
============================================================ --}}

        <div class="row">

            {{-- Donut Chart --}}
            <div class="col-lg-4 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-header bg-white">

                        <h5 class="mb-0">

                            <i class="bi bi-pie-chart-fill text-success"></i>

                            KPI

                        </h5>

                    </div>

                    <div class="card-body">

                        <div style="height:280px;">
                            <canvas id="availabilityChart"></canvas>
                        </div>

                        <div class="row text-center mt-4">

                            <div class="col">

                                <h3 class="text-success">

                                    {{ number_format($dashboard['pa'], 2) }}%

                                </h3>

                                <small class="text-muted">

                                    Available

                                </small>

                            </div>

                            <div class="col">

                                <h3 class="text-danger">

                                    {{ number_format(100 - $dashboard['pa'], 2) }}%

                                </h3>

                                <small class="text-muted">

                                    Breakdown

                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- ===========================================================
    CHART DELIVERY
============================================================ --}}


            {{-- Donut Chart --}}
            <div class="col-lg-4 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-header bg-white">

                        <h5 class="mb-0">

                            <i class="bi bi-pie-chart-fill text-success"></i>

                            Delivery Schedule

                        </h5>

                    </div>

                    <div class="card-body">

                        <div style="height:280px;">
                            <canvas id="deliveryChart"></canvas>
                        </div>

                        <div class="row text-center mt-4">

                            <div class="col">

                                <h3 class="text-success">

                                    {{ number_format($dashboard['padelivery'], 2) }}%

                                </h3>

                                <small class="text-muted">

                                    On Time Delivery

                                </small>

                            </div>

                            <div class="col">

                                <h3 class="text-danger">

                                    {{ number_format(100 - $dashboard['padelivery'], 2) }}%

                                </h3>

                                <small class="text-muted">

                                    Late Delivery

                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            {{-- ===========================================================
    CHART sparepart
============================================================ --}}


            {{-- Donut Chart --}}
            <div class="col-lg-4 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-header bg-white">

                        <h5 class="mb-0">

                            <i class="bi bi-pie-chart-fill text-success"></i>

                            Spare Part

                        </h5>

                    </div>

                    <div class="card-body">

                        <div style="height:280px;">
                            <canvas id="sparePartChart"></canvas>
                        </div>

                        <div class="row text-center mt-4">

                            <div class="col">

                                <h3 class="text-success">

                                    {{ number_format($dashboard['pasparepart'], 2) }}%

                                </h3>

                                <small class="text-muted">

                                    Available

                                </small>

                            </div>

                            <div class="col">

                                <h3 class="text-danger">

                                    {{ number_format(100 - $dashboard['pasparepart'], 2) }}%

                                </h3>

                                <small class="text-muted">

                                    Breakdown

                                </small>

                            </div>

                        </div>

                    </div>

                </div>





            </div>


            {{-- ===========================================================
    KPI
============================================================ --}}

            <div class="row">

                <div class="col-lg-6 mb-4">

                    <div class="card shadow-sm border-0">

                        <div class="card-header bg-white">

                            <h5>

                                <i class="bi bi-award-fill text-warning"></i>

                                KPI Performance

                            </h5>

                        </div>

                        <div class="card-body">

                            <table class="table table-hover">

                                <thead>

                                    <tr>

                                        <th>KPI</th>

                                        <th width="25%">Target</th>

                                        <th width="25%">Actual</th>

                                        <th width="30%">Progress</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td>Availability</td>

                                        <td>98%</td>

                                        <td>

                                            {{ number_format($dashboard['pa'], 2) }}%

                                        </td>

                                        <td>

                                            <div class="progress">

                                                <div class="progress-bar bg-success" style="width:99%">

                                                </div>

                                            </div>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>Breakdown</td>

                                        <td>
                                            < 2%</td>

                                        <td>{{ number_format(100 - $dashboard['pa'], 2) }}%</td>

                                        <td>

                                            <div class="progress">

                                                <div class="progress-bar bg-danger" style="width:28%">

                                                </div>

                                            </div>

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>Working Time</td>

                                        <td>100%</td>

                                        <td>{{ number_format($dashboard['pa'], 2) }}%</td>

                                        <td>

                                            <div class="progress">

                                                <div class="progress-bar bg-primary" style="width:99%">

                                                </div>

                                            </div>

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                {{-- Top Breakdown --}}

                <div class="col-lg-6 mb-4">

                    <div class="card shadow-sm border-0">

                        <div class="card-header bg-white">

                            <h5>

                                <i class="bi bi-exclamation-triangle-fill text-danger"></i>

                                Top Breakdown

                            </h5>

                        </div>

                        <div class="card-body">

                            <table class="table table-sm">

                                <thead>

                                    <tr>

                                        <th>Unit</th>

                                        <th>Category</th>

                                        <th class="text-end">

                                            Minutes

                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <tr>

                                        <td>FD25-001</td>

                                        <td>Counter Balance</td>

                                        <td class="text-end text-danger">

                                            220

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>FD25-015</td>

                                        <td>Reach Truck</td>

                                        <td class="text-end text-danger">

                                            180

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>FD30-011</td>

                                        <td>Reach Truck</td>

                                        <td class="text-end text-danger">

                                            170

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>FD15-008</td>

                                        <td>Electric</td>

                                        <td class="text-end text-danger">

                                            140

                                        </td>

                                    </tr>

                                    <tr>

                                        <td>FD20-005</td>

                                        <td>Counter Balance</td>

                                        <td class="text-end text-danger">

                                            120

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>
                {{-- ======================================================
    KPI PER KATEGORI UNIT
====================================================== --}}

                <div class="row">

                    <div class="col-lg-12">

                        <div class="card shadow-sm border-0">

                            <div class="card-header bg-white">

                                <div class="d-flex justify-content-between align-items-center">

                                    <h5 class="mb-0">

                                        <i class="bi bi-truck text-primary"></i>

                                        Availability by Forklift Category

                                    </h5>

                                    <span class="badge bg-primary">

                                        {{ count($kpi ?? []) }} Categories

                                    </span>

                                </div>

                            </div>

                            <div class="card-body p-0">

                                <div class="table-responsive">

                                    <table class="table table-hover align-middle mb-0">

                                        <thead class="table-light">

                                            <tr>

                                                <th width="30">

                                                    #

                                                </th>

                                                <th>

                                                    Forklift Category

                                                </th>

                                                <th class="text-center">

                                                    Unit

                                                </th>

                                                <th class="text-end">

                                                    Target

                                                </th>

                                                <th class="text-end">

                                                    Working

                                                </th>

                                                <th class="text-end">

                                                    Breakdown

                                                </th>

                                                <th class="text-end">

                                                    Backup

                                                </th>

                                                <th width="180">

                                                    Availability

                                                </th>

                                                <th width="90">

                                                    PA

                                                </th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            @forelse($kpi as $row)
                                                <tr>

                                                    <td>

                                                        {{ $loop->iteration }}

                                                    </td>

                                                    <td>

                                                        <strong>

                                                            {{ $row['namaforklifttype'] }}

                                                        </strong>

                                                    </td>

                                                    <td class="text-center">

                                                        <span class="badge bg-primary">

                                                            {{ $row['jmlunit'] }}

                                                        </span>

                                                    </td>

                                                    <td class="text-end">

                                                        {{ number_format($row['sumplanunitkerja']) }}

                                                    </td>

                                                    <td class="text-end">

                                                        {{ number_format($row['sumtotaljamkerja']) }}

                                                    </td>

                                                    <td class="text-end text-danger">

                                                        {{ number_format($row['totalbreakdown']) }}

                                                    </td>

                                                    <td class="text-end text-success">

                                                        {{ number_format($row['totalbackup']) }}

                                                    </td>

                                                    <td>

                                                        <div class="progress" style="height:10px">

                                                            @php

                                                                $color = 'bg-success';

                                                                if ($row['avgpaforklift'] < 98) {
                                                                    $color = 'bg-warning';
                                                                }
                                                                if ($row['avgpaforklift'] < 95) {
                                                                    $color = 'bg-danger';
                                                            } @endphp <div
                                                                class="progress-bar {{ $color }}"
                                                                style="width:{{ $row['avgpaforklift'] }}%">

                                                            </div>

                                                        </div>

                                                    </td>

                                                    <td>

                                                        @if ($row['avgpaforklift'] >= 98)
                                                            <span class="badge bg-success">

                                                                {{ number_format($row['avgpaforklift'], 2) }}%

                                                            </span>
                                                        @elseif($row['avgpaforklift'] >= 95)
                                                            <span class="badge bg-warning">

                                                                {{ number_format($row['avgpaforklift'], 2) }}%

                                                            </span>
                                                        @else
                                                            <span class="badge bg-danger">

                                                                {{ number_format($row['avgpaforklift'], 2) }}%

                                                            </span>
                                                        @endif

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td colspan="9">

                                                        <div class="text-center py-5">

                                                            No Data Available

                                                        </div>

                                                    </td>

                                                </tr>
                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>



                </div>
            </div>
        </div>


    </div>

    @section('script')

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('availabilityChart');

            new Chart(ctx, {

                type: 'pie',

                data: {

                    labels: [
                        'Available',
                        'Breakdown'
                    ],

                    datasets: [{

                        data: [
                            {{ $dashboard['pa'] }},
                            {{ 100 - $dashboard['pa'] }}
                        ],

                        backgroundColor: [
                            '#10B981',
                            '#EF4444'
                        ],

                        borderWidth: 0,

                        hoverOffset: 15

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,



                    plugins: {

                        legend: {

                            position: 'bottom'

                        },

                        tooltip: {

                            callbacks: {

                                label: function(context) {

                                    return context.label + " : " + context.parsed + "%";

                                }

                            }

                        }

                    }

                }

            });
        </script>
        <script>
            let deliveryChart;
            const ctxx = document.getElementById('deliveryChart');
            if (deliveryChart) {
                deliveryChart.destroy();
            }
            deliveryChart = new Chart(ctxx, {

                type: 'pie',

                data: {

                    labels: [
                        'On Time Delivery',
                        'Late Delivery'
                    ],

                    datasets: [{

                        data: [
                            {{ $dashboard['padelivery'] }},
                            {{ 100 - $dashboard['padelivery'] }}
                        ],

                        backgroundColor: [
                            '#1255B5',
                            '#EF4444'
                        ],

                        borderWidth: 0,

                        hoverOffset: 15

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,



                    plugins: {

                        legend: {

                            position: 'bottom'

                        },

                        tooltip: {

                            callbacks: {

                                label: function(context) {

                                    return context.label + " : " + context.parsed + "%";

                                }

                            }

                        }

                    }

                }

            });
        </script>
        <script>
            let sparePartChart;
            const ctxxx = document.getElementById('sparePartChart');

            if (sparePartChart) {
                sparePartChart.destroy();
            }
            sparePartChart = new Chart(ctxxx, {

                type: 'pie',

                data: {

                    labels: [
                        'Available',
                        'Breakdown'
                    ],

                    datasets: [{

                        data: [
                            {{ $dashboard['pasparepart'] }},
                            {{ 100 - $dashboard['pasparepart'] }}
                        ],

                        backgroundColor: [
                            '#6412B5',
                            '#EF4444'
                        ],

                        borderWidth: 0,

                        hoverOffset: 15

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,



                    plugins: {

                        legend: {

                            position: 'bottom'

                        },

                        tooltip: {

                            callbacks: {

                                label: function(context) {

                                    return context.label + " : " + context.parsed + "%";

                                }

                            }

                        }

                    }

                }

            });
        </script>
        <script>
            const trendChart = document.getElementById('trendChart');

            new Chart(trendChart, {

                type: 'line',

                data: {

                    labels: [
                        'Jan',
                        'Feb',
                        'Mar',
                        'Apr',
                        'May',
                        'Jun',
                        'Jul',
                        'Aug',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec'
                    ],

                    datasets: [{

                        label: 'Availability',

                        data: [

                            98.2,

                            98.5,

                            98.7,

                            99.1,

                            99.2,

                            99.3,

                            99.4,

                            99.5,

                            99.6,

                            99.4,

                            99.3,

                            99.7

                        ],

                        borderColor: '#2563eb',

                        backgroundColor: 'rgba(37,99,235,.1)',

                        tension: .4,

                        fill: true,

                        pointRadius: 5

                    }]

                },

                options: {

                    responsive: true,

                    plugins: {

                        legend: {

                            display: false

                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: false,

                            min: 95,

                            max: 100

                        }

                    }

                }

            });



            const breakdownChart = document.getElementById('chartBreakdown');

            new Chart(breakdownChart, {

                type: 'bar',

                data: {

                    labels: [

                        'Counter',

                        'Reach',

                        'Stacker',

                        'Electric',

                        'Hand'

                    ],

                    datasets: [{

                        label: 'Minutes',

                        data: [

                            220,

                            180,

                            120,

                            80,

                            40

                        ],

                        backgroundColor: [

                            '#dc2626',

                            '#ea580c',

                            '#f59e0b',

                            '#16a34a',

                            '#2563eb'

                        ]

                    }]

                },

                options: {

                    plugins: {

                        legend: {

                            display: false

                        }

                    }

                }

            });
        </script>

    @endsection


@endsection

@section('script')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{ asset('assets/dashboard/dashboard.js') }}"></script>

@endsection
