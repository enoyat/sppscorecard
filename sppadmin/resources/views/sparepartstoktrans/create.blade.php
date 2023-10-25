@extends('layouts.master')

@section('title') PT. Satria Piranti Perkasa @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Create Sparepart Stock @endslot
@endcomponent

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Sparepart Stok</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('sparepartstoktrans.store') }}" method="POST">
                    <div class="row">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Ada kesalahan data, silahkan dicek kembali<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @csrf
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="example-password-input" class="form-label">Transaction</label>
                                <select name="transaction" id="transaction" class="form-control">
                                    <option value="">-- select transaction --</option>
                                    <option value="in">in</option>
                                    <option value="out">out</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="example-password-input" class="form-label">Bulan Tahun</label>
                                <input class="form-control" type="date" value="" name="tanggal" id="tanggal">
                            </div>
                            <div class="mb-3">
                                <label for="example-password-input" class="form-label">Name of Spare Part</label>
                                <select name="codepart" id="codepart" required class="form-control"></select>

                            </div>
                            <div class="mb-3">
                                <label for="example-date-input" class="form-label">Total Qty </label>
                                <input class="form-control" type="text" value="" name="qty" id="qty" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="example-date-input" class="form-label">Qty Current</label>
                                <input class="form-control" type="text" value="" name="qtytrans" id="qtytrans">
                            </div>
                            <div class="mb-3">
                                <label for="example-date-input" class="form-label">Confirmation</label>
                                <input class="form-control" type="text" value="" name="confirmation" id="confirmation">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-md">Submit</button>

                            </div>

                        </div>
                    </div>



            </div>
            </form>
        </div>

    </div>
</div> <!-- end col -->
</div>
<!-- end row -->
<script>
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$("#codepart").select2({
    placeholder: 'Pilih Sparepart',
    ajax: {
        url: "{{ route('sparepartstoktrans.getsparepart') }}",
        type: "GET",
        dataType: 'JSON',
        delay: 250,
        data: function(params) {
            return {
                _token: CSRF_TOKEN,
                search: params.term,
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
$("#codepart").change(function() {
    var id = $(this).val();
    $.ajax({
        url: "{{ route('sparepartstoktrans.getstok') }}",
        type: "GET",
        data: {
            id: id
        },
        dataType: 'JSON',
        delay: 250,
        success: function(data) {
            datax = JSON.stringify(data);
            datax = JSON.parse(datax);
            $('#qty').val(datax[0].stok);
        }
    });
});
</script>

@endsection
