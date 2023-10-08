@extends('layouts.master')

@section('title')
    PT. Satria Piranti Perkasa
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1')
            Forms
        @endslot
        @slot('title')
        CREATE CUSTOMER
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">CREATE CUSTOMER</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('customer.store') }}" method="POST">
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
                                        <label for="example-password-input" class="form-label">CUSTOMER CODE</label>
                                        <input class="form-control" type="text" value="" name="kdcustomer"
                                            id="kdcustomer">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">Name</label>
                                        <input class="form-control" type="text" value="" name="namacustomer"
                                            id="namacustomer">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">LOCATION</label>
                                        <input class="form-control" type="text" value="" name="location"
                                            id="location">
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-password-input" class="form-label">CATEGORY</label>
                                        <select class="form-control" name="category" id="category">
                                            <option value="1">WITH CBU</option>
                                            <option value="2">NO CBU</option>
                                        </select>
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
