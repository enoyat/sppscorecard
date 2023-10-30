
        <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11"
            cellspacing="0" style="border-collapse: collapse;  width: 100%;">
            <thead>
                <tr>


                    <TH SCOPE="COL">ID USER/MEKANIK</TH>
                    <TH SCOPE="COL">CODE UNIT</TH>
                    <TH SCOPE="COL">LIST FOTO</TH>
                    <TH SCOPE="COL">START DATE</TH>
                    <TH SCOPE="COL">DATE OF COMPLETION</TH>
                    <TH SCOPE="COL">SHIFT</TH>
                    <TH SCOPE="COL">ACTION PLAN</TH>
                    <TH SCOPE="COL">SPAREPARTS</TH>
                    <TH SCOPE="COL">HM</TH>
                    <TH SCOPE="COL">STATUS MEKANIK</TH>
                    <TH SCOPE="COL">STATUS SPP</TH>
                    <TH SCOPE="COL">STATUS CUSTOMER</TH>

                </tr>
            </thead>
            <tbody>
                @php $i=1; @endphp
                @foreach ($listactions as $key)
                    <tr>


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
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
<script>

$('.btn-action').click(function() {
var url = $(this).data("url");

$.ajax({
    url: url,
    dataType: 'html',
    success: function(res) {
        var data = res;
        $('.modal-body').html(data);
        $('#staticBackdrop').modal('show');
    },
    error: function(request, status, error) {
        console.log("ajax call went wrong:" + request.responseText);
    }
});
});
</script>
