@extends('layouts.master')

@section('title') PT. Satria Piranti Perkasa @endsection

@section('content')

@component('components.breadcrumb')
@slot('li_1') Forms @endslot
@slot('title') Create forklifttype @endslot
@endcomponent


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form forklifttype</h4>
            </div>
            <div class="card-body p-4">

                <form action="{{ route('forklifttype.store') }}" method="POST">
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
                                    <label for="example-password-input" class="form-label">Nama Spare Part</label>
                                    <input class="form-control" type="text" value="" name="namaforklifttype" id="namaforklifttype">
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