@include('layouts.tabel')
    <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11" cellspacing="0"
        style="border-collapse: collapse;  width: 100%;"  >
        <thead>
            <tr>
                <TH SCOPE="COL">CODE UNIT</TH>
                <TH SCOPE="COL">EQUIPMENT</TH>
                <TH SCOPE="COL">FORKLIFT TYPE</TH>
                <TH SCOPE="COL">MERK</TH>
                <TH SCOPE="COL">TYPE</TH>
                <TH SCOPE="COL">MODEL</TH>
                <TH SCOPE="COL">CAPACITY (kg)</TH>
                <TH SCOPE="COL">SERIAL NUMBER</TH>
                <TH SCOPE="COL">SPECIFICATION</TH>
                <TH SCOPE="COL">QUANTITY (UNIT)</TH>
                <TH SCOPE="COL">CBU</TH>
                <TH SCOPE="COL">REGION</TH>
                <TH SCOPE="COL">SITE NAME</TH>
                <TH SCOPE="COL">ACTION</TH>



            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($unit as $key)
            <tr>



                <th scope="col"><a href="{{ route('maintenance.listaction',$key->kdunit) }}">{{ $key->kdunit }}</a></th>
                <th scope="col">{{ $key->equipment }}</th>
                <th scope="col">{{ $key->getforklifttype->namaforklifttype }}</th>
            <th scope="col">{{ $key->merk }}</th>
            <th scope="col">{{ $key->type }}</th>
            <th scope="col">{{ $key->model }}</th>
            <th scope="col">{{ $key->capcity }}</th>
            <th scope="col">{{ $key->serialnumber }}</th>
            <th scope="col">{{ $key->specification }}</th>
            <th scope="col">{{ $key->qty }}</th>
                <th scope="col">{{ $key->getcbu->namasitename }}</th>
                <th scope="col">{{ $key->getregion->namasitename }}</th>
                <th scope="col">{{ $key->getsitename->namasitename }}</th>
                <th scope="col">

                                <form action="{{ route('unit.destroy',$key->kdunit) }}" method="POST">
                                    @csrf
                                    <a href="{{ route('unit.edit',$key->kdunit) }}" class="btn btn-sm btn-warning">Edit</a>
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Hapus Data ini?');" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
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
