
        <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11"
            cellspacing="0" style="border-collapse: collapse;  width: 100%;">
            <thead>
                <tr>

                    <TH SCOPE="COL">STATUS SPP</TH>
                    <TH SCOPE="COL">STATUS MEKANIK</TH>
                    <TH SCOPE="COL">STATUS CUSTOMER</TH>
                    <th scope="col">id User/Mekanik</th>
                    <th scope="col">CODE Unit</th>
                    <th scope="col">List Foto</th>
                    <th scope="col">START DATE</th>
                    <th scope="col">DATE OF COMPLETION</th>
                    <th scope="col">shift</th>
                    <th scope="col">Action Plan</th>
                    <th scope="col">Spareparts</th>
                    <th scope="col">HM</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach ($listactions as $key)
                    <tr>

                        <th scope="col">

                            @if ($key->statusspp == 'CLOSE')
                                <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statusspp }}</span>
                            @else
                                <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statusspp }}</span>
                                @if (Auth::user()->roles_id == '1' || Auth::user()->roles_id == '4')
                                    <a class="btn btn-sm btn-info  btn-action"
                                        data-url="{{ URL('maintenance/formstatus?aid=spp&id=' . $key->id) }}"
                                        id="btnAction1"><i class=" fas fa-key"></i></a>
                                @endif
                            @endif
                        </th>
                        <th scope="col">
                            @if ($key->statusmekanik == 'CLOSE')
                                <span
                                    class="badge badge-pill badge-soft-success font-size-12">{{ $key->statusmekanik }}</span>
                            @else
                                <span
                                    class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statusmekanik }}</span>
                            @endif
                        </th>
                        <th scope="col">
                            @if ($key->statuscustomer == 'CLOSE')
                                <span
                                    class="badge badge-pill badge-soft-success font-size-12">{{ $key->statuscustomer }}</span>
                            @else
                                <span
                                    class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statuscustomer }}</span>
                                @if (Auth::user()->roles_id == '5' || Auth::user()->roles_id == '4')
                                    <a class="btn btn-sm btn-info  btn-action"
                                        data-url="{{ URL('maintenance/formstatus?aid=customer&id=' . $key->id) }}"
                                        id="btnAction1"><i class=" fas fa-key"></i></a>
                                @endif
                            @endif
                        </th>
                        <th scope="col">{{ $key->getuser->name }}</th>
                        <th scope="col">{{ $key->kdunit }}</th>
                        <th scope="col"><a href="{{ route('maintenance.listdokumen', $key->id) }}"
                                class="btn btn-warning btn-sm" target="_blank">List Foto</a></th>

                        <th scope="col">{{ $key->tanggalmulai }}</th>
                        <th scope="col">{{ $key->tanggalakhir }}</th>
                        <th scope="col">{{ $key->shift }}</th>
                        <th scope="col">{{ $key->actionplan }}</th>
                        <th scope="col">{{ $key->sparepart }}</th>
                        <th scope="col">{{ $key->hm }}</th>

                    </tr>
                @endforeach
            </tbody>
        </table>
