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
            <th scope="col">SITENAME CODE</th>
            <th scope="col">SITENAME NAME</th>
            <th scope="col">REGION</th>
            <th style="width: 80px; min-width: 80px;">Action</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1; @endphp
        @foreach ($sitename as $key)
            <tr>
                <th scope="row">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="contacusercheck1">
                        <label class="form-check-label" for="contacusercheck1"></label>
                    </div>
                </th>
                <th scope="col">{{ $key->id }}</th>
                <th scope="col">{{ $key->namasitename }}</th>
                <th scope="col">
                    @if ($key->parent->namasitename != null)
                        {{ $key->parent->namasitename }}
                    @endif
                </th>
                <th style="width: 80px; min-width: 80px;">
                    <div class="dropdown">
                        <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-horizontal-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('sitename.edit', $key->id) }}">Edit</a></li>
                            <li>
                                <form action="{{ route('sitename.destroy', $key->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item"
                                        onclick="return confirm('Hapus Data ini?');">Hapus</button>
                                </form>
                            </li>
                        </ul>
                    </div>


                </th>
            </tr>
        @endforeach
    </tbody>
</table>
