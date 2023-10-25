@extends('layouts.master')

@section('title') PT. Satria Piranti Perkasa @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Update sparepart @endslot
@endcomponent

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form sparepart</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('sparepartstok.update',$sparepart->id) }}" method="POST">
                    @method('PUT')
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
                            <div>

                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Spare Part</label>
                                    <input class="form-control" type="hidden" value="{{ $sparepart->codepart }}"
                                        name="codepart" id="codepart">{{ $sparepart->getsparepart->partname }}

                                </div>
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Qty</label>
                                    <input class="form-control" type="text" value="{{ $sparepart->qtytrans }}" name="qtytrans" id="qtytrans">
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






@endsection
