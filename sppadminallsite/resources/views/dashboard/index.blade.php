@extends('layouts.master')
@section('title', 'Availability Dashboard')
@section('css')
    <link href="{{ asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
                    Dashboard
                </h2>
                <small class="text-muted">
                    Forklift Monitoring System
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
                                <option value="CBU" {{ request('filterby') == 'CBU' ? 'selected' : '' }}>
                                    CBU
                                </option>
                                <option value="Region" {{ request('filterby') == 'Region' ? 'selected' : '' }}>
                                    Region
                                </option>
                                <option value="Site" {{ request('filterby') == 'Site' ? 'selected' : '' }}>
                                    Site
                                </option>
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
                            <div class="card-value fs-3">
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
                            <div class="card-title">KPI Availability</div>
                            <div class="card-value fs-3">
                                {{ in_array(round($dashboard['pa'], 2), [0, 100]) ? round($dashboard['pa']) : number_format($dashboard['pa'], 2) }}%
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
                                {{ number_format($dashboard['totalWork']) }}
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
                            <div class="card-value fs-3">
                                {{ number_format($dashboard['breakdown']) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-text">
                        Total Breakdown Minutes
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
                            <div class="card-value fs-3">
                                {{ number_format($dashboard['backup']) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-text">
                        Backup Time Minutes
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
                            <div class="card-title">Plan Work</div>
                            <div class="card-value fs-3">
                                {{ number_format($dashboard['working']) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer-text">
                        Total Planned Work Hours
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            {{-- KPI --}}
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="bi bi-pie-chart-fill text-success"></i>
                            KPI Availability
                        </h5>
                    </div>

                    <div class="card-body">

                        <div style="height:430px">
                            <canvas id="availabilityChart"></canvas>
                        </div>

                        <div class="row text-center mt-3">

                            <div class="col">
                                <h2 class="text-success fw-bold" style="color: #10B981">
                                    {{ in_array(round($dashboard['pa'], 2), [0, 100]) ? round($dashboard['pa']) : number_format($dashboard['pa'], 2) }}%

                                </h2>
                                <small>Available</small>
                            </div>

                            <div class="col">
                                <h2 class="text-danger fw-bold">

                                    @if ($dashboard['pa'] == 0)
                                        0 %
                                    @else
                                        {{ in_array(round($dashboard['pa'], 2), [0, 100]) ? round(100 - $dashboard['pa']) : number_format(100 - $dashboard['pa'], 2) }}%
                                    @endif
                                </h2>
                                <small>Breakdown</small>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{-- Kanan --}}
            <div class="col-lg-4">

                {{-- Delivery --}}
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-white">
                        <h6 class="mb-0">
                            <i class="bi bi-truck text-primary"></i>
                            Delivery Schedule
                        </h6>
                    </div>

                    <div class="card-body">

                        <div style="height:170px">
                            <canvas id="deliveryChart"></canvas>
                        </div>

                        <div class="row text-center mt-2">

                            <div class="col">
                                <h5 class="text-success fw-bold">
                                    {{ in_array(round($kpidelivery['on_time'], 2), [0, 100]) ? round($kpidelivery['on_time']) : number_format($kpidelivery['on_time'], 2) }}%

                                </h5>
                                <small>On Time</small>
                            </div>

                            <div class="col">
                                <h5 class="text-danger fw-bold">
                                    {{ in_array(round($kpidelivery['late_delivery'], 2), [0, 100]) ? round($kpidelivery['late_delivery']) : number_format($kpidelivery['late_delivery'], 2) }}%
                                </h5>
                                <small>Late</small>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- Sparepart --}}
                <div class="card shadow-sm border-0">

                    <div class="card-header bg-white">
                        <h6 class="mb-0">
                            <i class="bi bi-box-seam text-warning"></i>
                            Spare Part
                        </h6>
                    </div>

                    <div class="card-body">

                        <div style="height:170px">
                            <canvas id="sparePartChart"></canvas>
                        </div>

                        <div class="row text-center mt-2">

                            <div class="col">
                                <h5 class="text-success fw-bold">
                                    {{ in_array(round($kpisparepart['stokavailable'], 2), [0, 100]) ? round($kpisparepart['stokavailable']) : number_format($kpisparepart['stokavailable'], 2) }}%
                                </h5>
                                <small>Available</small>
                            </div>

                            <div class="col">
                                <h5 class="text-danger fw-bold">
                                    {{ in_array(round($kpisparepart['notavailable'], 2), [0, 100]) ? round($kpisparepart['notavailable']) : number_format($kpisparepart['notavailable'], 2) }}%
                                </h5>
                                <small>Not Available</small>
                            </div>

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
                                    <td>
                                        @php
                                            $breakdownPercentage = 100 - $dashboard['pa'];
                                        @endphp
                                        {{ number_format(100 - $dashboard['pa'], 2) }}%</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger"
                                                style="width:{{ $breakdownPercentage }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Working Time</td>
                                    <td>100%</td>
                                    <td>
                                        @php
                                            $workingTimePercentage = $dashboard['pa'];
                                        @endphp
                                        {{ number_format($workingTimePercentage, 2) }}%</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary"
                                                style="width:{{ $workingTimePercentage }}%">
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
                                    <th>Jumlah Unit</th>
                                    <th>Category</th>
                                    <th class="text-end">
                                        Minutes
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topBreakdown as $breakdown)
                                    <tr>
                                        <td>{{ $breakdown->jumlah_unit }}</td>
                                        <td>{{ $breakdown->namaforklifttype }}</td>
                                        <td class="text-end text-danger">
                                            {{ $breakdown->breakdown_total }}
                                        </td>
                                    </tr>
                                @endforeach

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
                                                        } @endphp <div class="progress-bar {{ $color }}"
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
                    labels: @json($labels),
                    datasets: [{
                        data: @json($dataUnit),
                        backgroundColor: [
                            '#0d6efe',
                            '#fdd1a1',
                            '#ffc107',
                            '#dc35ff',
                            '#6f42c1',
                            '#20c997',
                            '#fd7e14',
                            '#6610f2'
                        ],
                        borderWidth: 1
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
                                    return context.label + " : " + context.parsed;
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
                            {{ $kpidelivery['on_time'] }},
                            {{ $kpidelivery['late_delivery'] }}
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
                            {{ $kpisparepart['stokavailable'] }},
                            {{ $kpisparepart['notavailable'] }}
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

    @endsection
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/dashboard/dashboard.js') }}"></script>
@endsection
