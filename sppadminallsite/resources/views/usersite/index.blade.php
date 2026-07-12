@extends('layouts.master')
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
    <div class="table-responsive mb-4" id="tablecontent">

        <table id="example" class="table table-sm table-striped table-hover table-bordered nowrap w-100 align-middle">

            <thead>

                <tr>

                    <th>Mechanic</th>
                    <th>Email</th>


                    <th>Site</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($mechanics as $m)
                    <tr>

                        <td>{{ $m->name }}</td>
                        <td>{{ $m->email }}</td>
                        <td>

                            @foreach ($m->sites as $site)
                                <span class="badge bg-success">

                                    {{ $site->namasitename }}

                                </span>
                            @endforeach

                        </td>

                        <td>

                            <a href="{{ route('usersite.edit', $m) }}" class="btn btn-warning btn-sm">

                                Edit

                            </a>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
    <script>
        $(document).ready(function() {

            $('#example').DataTable({

                responsive: true,

                pageLength: 25,

                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, 'Semua']
                ],

                order: [
                    [0, 'asc']
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
    <!-- Buttons examples -->
    {{-- <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script> --}}
    <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    {{-- <script src="{{ URL::asset('build/libs/pdfmake/vfs_fonts.js') }}"></script> --}}
    {{-- <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
</script> --}}

    <!-- Datatable init js -->
    <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
@endsection
