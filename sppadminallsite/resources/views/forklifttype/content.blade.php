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
                <TH SCOPE="COL">CODE FORKLIFTTYPE</TH>
                <TH SCOPE="COL">FORKLIFTTYPE</TH>
                <TH SCOPE="COL">DASHBOARD</TH>
                <th style="width: 80px; min-width: 80px;">ACTION</th>


            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($forklifttype as $key)
                <tr>
                    <td scope="row">
                        <div class="form-check font-size-16">
                            <input type="checkbox" class="form-check-input" id="contacusercheck1">
                            <label class="form-check-label" for="contacusercheck1"></label>
                        </div>
                    </td>
                    <td scope="col">{{ $key->id }}</td>
                    <td scope="col">{{ $key->namaforklifttype }}</td>
                    <td scope="col">{{ $key->f_dashboard }}</td>
                    <td style="width: 80px; min-width: 80px;">
                        <div class="dropdown">
                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('forklifttype.edit', $key->id) }}">Edit</a>
                                </li>
                                <li>
                                    <form action="{{ route('forklifttype.destroy', $key->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('Hapus Data ini?');">Hapus</button>
                                    </form>
                                </li>
                            </ul>
                        </div>


                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
