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

                <TH STYLE="WIDTH: 80PX; MIN-WIDTH: 80PX;">ACTION</TH>


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
                    <td scope="col">{{ $key->email }}</td>
                    <td scope="col">{{ $key->getsitename->namasitename }}</td>
                    <td scope="col">@include('statusorders.statusorder')
                    <input type="hidden" name="f_status" id="f_status" value="{{ $key->f_status }}">
                    </td>
                    <td scope="col">Detail</td>
                    <td scope="col">{{ $key->dateaccsite }}</td>
                    <td>{{ $key->dateaccsite }}</td>
                    <td>{{ $key->dateaccgudang }}</td>
                    <td scope="col">
                        <a href="{{ route('orders.docorder',$key->noorder) }}"
                            class="btn btn-sm btn-dark"><i class="fa fa-print"
                                aria-hidden="false">
                            </i></a>
                        <div id="kode" style="display: none">{{ $key->noorder }}</div>
                        @if ($key->f_status == 'order')
                            <div class="accsite btn btn-sm btn-pink">Acc Site</div>
                        @elseif ($key->f_status == 'accsite')
                            <div class="accsite btn btn-sm btn-warning">Acc HO</div>
                        @elseif ($key->f_status == 'accho')
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
            var f_status=$("#f_status").val();
            var url="{{ route('orders.accsite') }}";
            if (confirm(confirmText)) {
                $.ajax({
                    type: "post",
                    data: {
                        id: id,
                        f_status:f_status,
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
