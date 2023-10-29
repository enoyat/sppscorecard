@extends('layouts.master')
@section('style')
    <!-- Select 2 -->
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
    <!-- Responsive Table css -->
    <link href="{{ asset('assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive Table js -->
    <script src="{{ asset('assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>
@endsection

@section('content')
@section('title', 'Shipments Payout Invoice')
@foreach ($orders as $item)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="panel-body">
                        <div class="clearfix">
                            <div class="float-start">
                                <h3>Satria Piranti Perkasa</h3>
                            </div>
                            <div class="float-end">
                                <h4>Orders # <br>
                                    <strong>{{ $item->noorder }}</strong>
                                </h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="float-start mt-3">
                                    <p>
                                        <strong>Order Date: </strong> {{ $item->dateorder }}<br>
                                        <strong>Area: </strong> #{{ $item->getsitename->namasitename }} <br>
                                        <strong>Mechanic : </strong> #{{ $item->iduser }} - {{ $item->getmekanik->namamekanik }} <br>
                                        <strong>Unit : </strong> #{{ $item->kdunit }}<br>
                                    </p>

                                </div>
                                <div class="float-end mt-3">
                                    {{-- <p>
                                        <strong>Kategori : </strong> {{ $item->getrute->getkategori->namakategori }}<br>
                                        <strong>Customer : </strong> {{ $item->getcustomer->namacustomer }}<br>
                                        <strong>Project : </strong> {{ $item->getrute->getproject->namaproject }}<br>
                                        <strong>Driver: </strong> <span
                                            class="label label-pink">{{ $item->getdriver->namadriver }}</span><br>
                                        <strong>Unit : </strong> #{{ $item->getunit->kdunit }} - {{ $item->getunit->plat }} - {{ $item->getunit->merk }}
                                    </p> --}}
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class=" mt-2">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th scope="col">Code Part</th>
                                                <th scope="col">Part Name</th>
                                                <th scope="col">QTY</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            ?>
                                            @foreach ($item->getdetailorder as $data)
                                                <tr>
                                                    <td width="3%">{{ $i }}</td>
                                                    <td width="10%">{{ $data->codepart }}</td>
                                                    <td width="50%">{{ $data->description }}</td>
                                                    <td width="5%">{{ $data->qty }}</td>


                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="d-print-none">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i
                                        class="fa fa-print"></i></a>
                                <a href="{{ route('orders.index') }}"
                                    class="btn btn-primary waves-effect waves-light">Close</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endforeach
@endsection
