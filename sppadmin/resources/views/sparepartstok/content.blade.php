    <table class="table table-striped dt-responsive nowrap w-100"
        style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="datatable-buttons">
        <thead>
            <tr>
                <th scope="col" style="width: 50px;">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </th>

                <TH SCOPE="COL">SPARE PART</TH>
                <TH SCOPE="COL">TARGET QUANTITY</TH>
                <TH SCOPE="COL">ACTUAL STOCK</TH>
                <TH SCOPE="COL">CBU</TH>
                <TH SCOPE="COL">REGION</TH>
                <TH SCOPE="COL">SITE NAME</TH>
                <TH SCOPE="COL">REMARK</TH>
                <th style="width: 80px; min-width: 80px;">ACTION</th>


            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($sparepartstok as $key)
                <tr>
                    <td scope="row">
                        <div class="form-check font-size-16">
                            <input type="checkbox" class="form-check-input" id="contacusercheck1">
                            <label class="form-check-label" for="contacusercheck1"></label>
                        </div>
                    </td>

                    <td scope="col">{{ $key->getsparepart->partname }}</td>
                    <td scope="col">{{ $key->qty }}</td>
                    <td scope="col">{{ $key->stok }}</td>
                    <td scope="col">{{ $key->getcbu->namasitename }}</td>
                    <td scope="col">{{ $key->getregion->namasitename }}</td>
                    <td scope="col">{{ $key->getsitename->namasitename }}</td>
                    <td scope="col">{{ $key->remark }}</td>
                    <td style="width: 80px; min-width: 80px;">
                        @if (Auth::user()->roles_id == '1' || Auth::user()->roles_id == '2')
                            <div class="dropdown">
                                <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item"
                                            href="{{ route('sparepartstok.edit', $key->id) }}">Edit</a></li>
                                    <li>
                                        <form action="{{ route('sparepartstok.destroy', $key->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Hapus Data ini?');">Hapus</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
