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
                <TH SCOPE="COL">CODE SPARE PART</TH>
                <TH SCOPE="COL">SPARE PART</TH>
                <TH SCOPE="COL">MERK</TH>
                <TH STYLE="WIDTH: 80PX; MIN-WIDTH: 80PX;">ACTION</TH>


            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($sparepart as $key)
            <tr>
                <td scope="row">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="contacusercheck1">
                        <label class="form-check-label" for="contacusercheck1"></label>
                    </div>
                </td>
                <td scope="col">{{ $key->codepart }}</td>
                <td scope="col">{{ $key->simplename }}</td>
                <td scope="col">{{ $key->merkpart }}</td>
                <td style="width: 80px; min-width: 80px;">
                <div class="dropdown">
                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('sparepart.edit',$key->codepart) }}">Edit</a></li>
                                <li><form action="{{ route('sparepart.destroy',$key->codepart) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="dropdown-item"
                                            onclick="return confirm('Hapus Data ini?');">Hapus</button>
                                    </form></li>
                            </ul>
                        </div>


            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
