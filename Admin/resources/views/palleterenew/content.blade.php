    <table class="table table-striped dt-responsive nowrap w-100"
        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="datatable-buttons" >
        <thead>
            <tr>
                <th scope="col" style="width: 50px;">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </th>
                <th scope="col">CBU</th>
                <th scope="col">Region</th>
                <th scope="col">Site Name</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Total Rented Pallete</th>
                <th scope="col">Qty</th>
                <th scope="col">Status SPP</th>
                <th scope="col">Status Customer</th>
                <th style="width: 80px; min-width: 80px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($palleterenew as $key)
            <tr>
                <th scope="row">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="contacusercheck1">
                        <label class="form-check-label" for="contacusercheck1"></label>
                    </div>
                </th>
                <th scope="col">{{ $key->getcbu->namacbu }}</th>
                <th scope="col">{{ $key->getregion->namaregion }}</th>
                <th scope="col">{{ $key->getsitename->namasitename }}</th>                
                <th scope="col">{{ $key->tanggal }}</th> 
                <th scope="col">{{ $key->totalrent }}</th> 
                <th scope="col">{{ $key->qty }}</th>
                <th scope="col">@if ($key->statusspp=="CLOSE") 
                    <span class="badge badge-pill badge-soft-success font-size-12">CLOSE</span>
                    @else
                    <span class="badge badge-pill badge-soft-danger font-size-12">OPEN</span>
                    @endif</th>
                <th scope="col">@if ($key->statuscustomer=="CLOSE") 
                    <span class="badge badge-pill badge-soft-success font-size-12">CLOSE</span>
                    @else
                    <span class="badge badge-pill badge-soft-danger font-size-12">OPEN</span>
                    @endif
                </th>
                <th style="width: 80px; min-width: 80px;">
                <div class="dropdown">
                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('palleterenew.edit',$key->id) }}">Edit</a></li>
                                <li><form action="{{ route('palleterenew.destroy',$key->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="dropdown-item"
                                            onclick="return confirm('Hapus Data ini?');">Hapus</button>
                                    </form></li>
                            </ul>
                        </div>
                                   
            
            </th>
            </tr>
            @endforeach
        </tbody>
    </table>