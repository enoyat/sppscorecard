@extends('layouts.master')
@section('title')
    Customer List
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        #example {
            font-size: 12px;
        }

        #example thead th {
            padding: 6px 8px;
            white-space: nowrap;
            vertical-align: middle;
            background: #f8f9fa;
        }

        #example tbody td,
        #example tbody th {
            padding: 4px 8px;
            vertical-align: middle;
        }

        #example .btn {
            padding: .20rem .45rem;
            font-size: 11px;
        }

        #example .badge {
            font-size: 10px;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: .5rem;
        }

        .dataTables_wrapper .dataTables_length select {
            width: 70px;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child {

            padding-left: 35px !important;

        }
    </style>
@endsection
@section('content')
    <!-- start page title -->
    @component('components.breadcrumb')
        @slot('li_1')
            Contacts
        @endslot
        @slot('title')
            User List
        @endslot
    @endcomponent

    <div>
        <a href="{{ route('customer.create') }}" class="btn btn-light"><i class="bx bx-plus me-1"></i> Add
            New</a>
    </div>

    <div class="table-responsive mb-4" id="tablecontent">
        <table id="example" class="table table-sm table-striped table-hover table-bordered nowrap w-100 align-middle">
            <thead>
                <tr class="active">
                    <th width="1%">No</th>
                    <th>CUSTOMER CODE</th>
                    <th>CUSTOMER NAME</th>
                    <th>LOCATION</th>
                    <th>CATEGORY</th>
                    <th>ACT</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($customer as $row)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->kdcustomer }}</td>
                        <td>{{ $row->namacustomer }}</td>
                        <td>{{ $row->location }}</td>
                        <td>{{ $row->category }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('customer.edit', $row->kdcustomer) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('customer.destroy', $row->kdcustomer) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                pageLength: 25,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'Semua']
                ],
                order: [
                    [1, 'asc']
                ],
                language: {
                    search: "Cari :",
                    lengthMenu: "Tampilkan _MENU_ data",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    paginate: {
                        previous: "←",
                        next: "→"
                    }
                }
            });
        });
    </script>
@endsection

@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('build/libs/datatables/datatables.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ URL::asset('build/js/pages/datatable-pages.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
@endsection
