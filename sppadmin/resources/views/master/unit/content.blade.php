@include('layouts.tabel')
    <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11" cellspacing="0"
        style="border-collapse: collapse;  width: 100%;"  >
        <thead>
            <tr>
                <th SCOPE="COL">CODE UNIT</th>
                <th SCOPE="COL">EQUIPMENT</th>
                <th SCOPE="COL">FORKLIFT TYPE</th>
                <th SCOPE="COL">MERK</th>
                <th SCOPE="COL">TYPE</th>
                <th SCOPE="COL">MODEL</th>
                <th SCOPE="COL">SERIAL NUMBER</th>
                <th SCOPE="COL">CAPACITY (KILOGRAM)</th>
                <th SCOPE="COL">MAST (STAGE)</th>
                <th SCOPE="COL">HEIGHT (METER)</th>
                <th SCOPE="COL">ACTION</th>




            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($unit as $key)
            <tr>



                <th scope="col"><a href="{{ route('maintenance.listaction',$key->kdunit) }}">{{ $key->kdunit }}</a></th>
                <td scope="col">{{ $key->equipment }}</td>
                <td scope="col">{{ $key->getforklifttype->namaforklifttype }}</td>
                <td scope="col">{{ $key->merk }}</td>
                <td scope="col">{{ $key->type }}</td>
                <td scope="col">{{ $key->model }}</td>
                <td scope="col">{{ $key->serialnumber }}</td>
                <td scope="col">{{ number_format($key->capcity) }}</td>
                <td scope="col">{{ $key->mast }}</td>
                <td scope="col">{{ $key->masheight }}</td>
                <th scope="col">

                                <form action="{{ route('masterunit.destroy',$key->kdunit) }}" method="POST">
                                    @csrf
                                    <a href="{{ route('masterunit.edit',$key->kdunit) }}" class="btn btn-sm btn-warning">Edit</a>
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
