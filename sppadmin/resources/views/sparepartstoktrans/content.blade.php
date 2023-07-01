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
                <th scope="col">Spare Part</th>
                <th scope="col">Qty</th>
                <th scope="col">Uom</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Qty </th>
                <th scope="col">Stock %</th>
                <th scope="col">Confirmation By Plant</th>
                <th scope="col">Average %</th>
                <th style="width: 80px; min-width: 80px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($sparepartstoktrans as $key)
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
                <th scope="col">{{ $key->getsparepart->namasparepart }}</th>
                <th scope="col">{{ $key->qty }}</th>  
                <th scope="col">{{ $key->getsparepart->uom }}</th>  
                <th scope="col">{{ $key->tanggal }}</th>  
                <th scope="col">{{ $key->qtytrans }}</th>  
                <th scope="col">{{ $key->stockpros }}</th>  
                <th scope="col">{{ $key->confirmation }}</th>  
                <th scope="col">{{ $key->avgpros }}</th>  

                <th style="width: 80px; min-width: 80px;">
                <div class="dropdown">
                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('sparepartstoktrans.edit',$key->id) }}">Edit</a></li>
                                <li><form action="{{ route('sparepartstoktrans.destroy',$key->id) }}" method="POST">
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