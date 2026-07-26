@extends('layouts.master')

@section('title', 'Customer')

@section('css')

    <link href="{{ asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <style>
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
        }

        .page-subtitle {
            color: #8b98a5;
            font-size: 14px;
        }

        .dashboard-card {

            background: #fff;

            border-radius: 18px;

            box-shadow: 0 5px 18px rgba(0, 0, 0, .06);

            border: none;

        }

        .card-header-modern {

            padding: 18px 25px;

            border-bottom: 1px solid #edf2f7;

            display: flex;

            justify-content: space-between;

            align-items: center;

        }

        .card-header-modern h5 {

            margin: 0;

            font-weight: 600;

        }

        .card-body-modern {

            padding: 25px;

        }

        .btn-modern {

            border-radius: 10px;

            padding: 8px 18px;

        }
    </style>

@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Master
        @endslot

        @slot('title')
            Customer
        @endslot
    @endcomponent


    <div class="row mb-4">

        <div class="col-md-6">

            <h2 class="page-title">

                <i class="bx bx-buildings text-primary"></i>

                Customer

            </h2>

            <div class="page-subtitle">

                Customer Management

            </div>

        </div>

        <div class="col-md-6 text-end">

            <a href="{{ route('lokasi.customer') }}" class="btn btn-primary btn-modern">

                <i class="bx bx-refresh"></i>

                Refresh

            </a>

        </div>

    </div>


    <div class="card dashboard-card">

        <div class="card-header-modern">

            <h5>

                <i class="bx bx-list-ul text-primary"></i>

                Customer List

            </h5>

            <span class="badge bg-primary">

                Data Customer

            </span>

        </div>

        <div class="card-body-modern">

            @include('header_customer')

            <hr>

            <x-dashboard-filter :showPeriode="false" :showCBU="true" :showRegion="true" :showSite="true" :showForkliftType="false" />
            @push('codescripts')
                <script src="{{ asset('js/dashboard-filter.js') }}"></script>
            @endpush
        </div>

    </div>
    <script>
        $(document).ready(function() {

            $('.select2').select2({
                width: '100%',
                placeholder: 'Pilih Data'
            });

        });
    </script>
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('build/libs/datatables/datatables.min.js') }}"></script>

    <script src="{{ asset('build/libs/jszip/jszip.min.js') }}"></script>

    <script src="{{ asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>

    <script src="{{ asset('build/js/pages/datatables.init.js') }}"></script>

@endsection
