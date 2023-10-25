
        <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11"
            cellspacing="0" style="border-collapse: collapse;  width: 100%;">
            <thead>
                <tr>

                    <TH SCOPE="COL">STATUS MEKANIK</TH>
                    <TH SCOPE="COL">STATUS CUSTOMER</TH>
                    <TH SCOPE="COL">ID USER/MEKANIK</TH>
                    <TH SCOPE="COL">CODE UNIT</TH>
                    <TH SCOPE="COL">START DATE</TH>
                    <TH SCOPE="COL">DATE OF COMPLETION</TH>
                    <TH SCOPE="COL">LAPSE TIME (MINUTE)</TH>
                    <TH SCOPE="COL">BACKUP</TH>
                    <TH SCOPE="COL">SHIFT</TH>
                    <TH SCOPE="COL">ACTION PLAN</TH>
                    <TH SCOPE="COL">SPAREPARTS</TH>
                    <TH SCOPE="COL">DOCUMENTS</TH>


                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach ($listtroubleactions as $key)
                    <tr>

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
                                        data-url="{{ URL('trouble/formstatus?aid=customer&id=' . $key->id) }}"
                                        id="btnAction1"><i class=" fas fa-key"></i></a>
                                @endif
                            @endif
                        </th>
                        <th scope="col">{{ $key->getuser->name }}</th>
                        <th scope="col">{{ $key->kdunit }} </th>
                        <th scope="col">{{ $key->tanggalmulai }}</th>
                        <th scope="col">{{ $key->tanggalakhir }}</th>
                        <th scope="col">{{ $key->lapsetime }}</th>
                        <th scope="col">{{ $key->terbackup }}</th>
                        <th scope="col">{{ $key->shift }}</th>
                        <th scope="col">{{ $key->actionplan }} </th>
                        <th scope="col">{{ $key->sparepart }}</th>
                        <th scope="col"><a href="{{ route('trouble.listdokumen', $key->id) }}"
                                class="btn btn-sm btn-warning" target="_blank">List Foto</a></th>

                    </tr>
                @endforeach
            </tbody>
        </table>
