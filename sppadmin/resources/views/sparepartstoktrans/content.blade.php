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
                <TH SCOPE="COL">CBU</TH>
                <TH SCOPE="COL">REGION</TH>
                <TH SCOPE="COL">SITE NAME</TH>
                <TH SCOPE="COL">SPARE PART</TH>
                <TH SCOPE="COL">QTY</TH>
                <TH SCOPE="COL">UOM</TH>
                <TH SCOPE="COL">TANGGAL</TH>
                <TH SCOPE="COL">QTY </TH>
                <TH SCOPE="COL">STOCK %</TH>
                <TH SCOPE="COL">CONFIRMATION BY PLANT</TH>
                <TH SCOPE="COL">AVERAGE %</TH>
                <TH STYLE="WIDTH: 80PX; MIN-WIDTH: 80PX;">ACTION</TH>


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