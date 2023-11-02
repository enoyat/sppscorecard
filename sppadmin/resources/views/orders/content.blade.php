    <table class="table table-hover table-centered mb-0" id="tableorder">
        <thead>
            <tr>
                <th scope="col" style="width: 50px;">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </th>
                <TH SCOPE="COL">NO ORDER</TH>
                <TH SCOPE="COL">DATE ORDER</TH>
                <TH SCOPE="COL">CODE UNIT</TH>
                <TH SCOPE="COL">MECHANIC</TH>
                <TH SCOPE="COL">AREA</TH>

                <TH SCOPE="COL">STATUS</TH>
                <TH SCOPE="COL">ITEM ORDER</TH>
                <TH SCOPE="COL">ACC SITE</TH>
                <TH SCOPE="COL">ACC HO</TH>
                <TH SCOPE="COL">ACC INVENTORY</TH>

                <th style="width: 80px; min-width: 80px;">ACTION</th>


            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($orders as $key)
                <tr>
                    <td scope="row">
                        <div class="form-check font-size-16">
                            <input type="checkbox" class="form-check-input" id="contacusercheck1">
                            <label class="form-check-label" for="contacusercheck1"></label>
                        </div>
                    </td>
                    <td scope="col">{{ $key->noorder }}</td>
                    <td scope="col">{{ $key->dateorder }}</td>
                    <td scope="col">{{ $key->kdunit }}</td>
                    <td scope="col">{{ $key->getmekanik->namamekanik }}</td>
                    <td scope="col">{{ $key->getsitename->namasitename }}</td>
                    <td scope="col">@include('statusorders.statusorder')
                        
                    </td>
                    <td scope="col"> <a href="{{ route('orders.docorder', $key->noorder) }}"
                            class="btn btn-sm btn-dark"><i class="fa fa-print" aria-hidden="false">
                            </i></a></td>
                    <td scope="col">{{ $key->dateaccsite }}</td>
                    <td>{{ $key->dateaccho }}</td>
                    <td>{{ $key->dateaccgudang }}</td>
                    <td scope="col">
                        <div id="f_status" style="display: none">{{ $key->f_status }}</div>
                        <div id="kode" style="display: none">{{ $key->noorder }}</div>
                        @if ($key->f_status == 'order' && (Auth::user()->roles_id == '1' || Auth::user()->roles_id == '2'))
                            <div class="accsite btn btn-sm btn-pink">Acc Site</div>
                        @endif
                        @if ($key->f_status == 'accsite' && Auth::user()->roles_id == '100')
                                <div class="accsite btn btn-sm btn-warning">Acc HO</div>
                        @endif
                        @if ($key->f_status == 'accho' && Auth::user()->roles_id == '101')
                                <div class="accsite btn btn-sm btn-success">Acc Inventory</div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        var csrf = $('meta[name="csrf-token"]').attr('content');


        $('.accsite').click(function() {
            var id = $(this).siblings('#kode').text();
            var confirmText = "Agree Orders?";
            var f_status = $(this).siblings('#f_status').text();            
            var url = "{{ route('orders.accsite') }}";
            if (confirm(confirmText)) {
                $.ajax({
                    type: "post",
                    data: {
                        id: id,
                        f_status: f_status,
                        _token: csrf
                    },
                    url: url,
                    success: function() {
                        location.reload();

                    },
                });
            }
            return false;
        });
    </script>
