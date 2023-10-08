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
                <TH STYLE="WIDTH: 80PX; MIN-WIDTH: 80PX;">ACTION</TH>


            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($sparepartstok as $key)
            <tr>
                <th scope="row">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="contacusercheck1">
                        <label class="form-check-label" for="contacusercheck1"></label>
                    </div>
                </th>
                <th scope="col">{{ $key->getcbu->namasitename }}</th>
                <th scope="col">{{ $key->getregion->namasitename }}</th>
                <th scope="col">{{ $key->getsitename->namasitename }}</th>
                <th scope="col">{{ $key->getsparepart->namasparepart }}</th>
                <th scope="col">{{ $key->qty }}</th>
                <th scope="col">{{ $key->getsparepart->uom }}</th>
                <th style="width: 80px; min-width: 80px;">
                <div class="dropdown">
                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('sparepartstok.edit',$key->id) }}">Edit</a></li>
                                <li><form action="{{ route('sparepartstok.destroy',$key->id) }}" method="POST">
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
