@extends('layouts.master')
@section('content')
    @include('layouts.tabel')

    <div class="row">
        <div class="col-12">

            <a href="{{ route('presensi.index') }}">
                <div id="viewData" class="btn btn-info">Refresh</div>
            </a>
            <a href="{{ route('presensi.add') }}">
                <div id="viewData" class="btn btn-info">Tambah presensi</div>
            </a>
            <form action="{{ route('presensi.index') }}" method="GET">
                <div class="form-group>
                                <label for="">Tampilkan berdasar Tanggal
                    </label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ request()->get('tanggal') }}"
                        required="required" title="">

                    <button type="submit" class="btn btn-primary" id="btncetak"> View</button>
                </div>
            </form>

            <br>
            <br>
            <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11"
                cellspacing="0" style="border-collapse: collapse;  width: 100%;">
                <thead>
                    <tr>

                        <th>
                            No
                        </th>
                        <th>
                            Nama Pegawai
                        </th>
                        <th>
                            NIK
                        </th>
                        <th>
                            Status Presensi
                        </th>
                        <th>
                            Tanggal
                        </th>
                        <th>
                            Jam Datang
                        </th>
                        <th>
                            Jam Pulang
                        </th>
                        <th>Gambar</th>
                        <th>
                            Aksi
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @php $i=1; @endphp
                    @foreach ($presensis as $key)
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $key->mekanik->namamekanik; ?></td>
                            <td><?php echo $key->idmekanik; ?></td>
                            <td><?php echo $key->statuspresensi; ?></td>
                            <td><?php echo $key->tanggal; ?></td>
                            <td><?php echo $key->jamdatang; ?></td>
                            <td><?php echo $key->jampulang; ?></td>
                            <td>
                                @if (!empty($key->getgambar))
                                    @foreach ($key->getgambar as $item)
                                        <img src="{{ asset('assets/inventory/' . $item->filename) }}" width="75">
                                    @endforeach
                                @endif

                            </td>
                            <td>
                                <div style="display: inline;  float:right; width:35px">
                                    <form action="{{ route('presensi.delete', $key->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus presensi ini?');"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            <br>
            <br>
        </div>
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
