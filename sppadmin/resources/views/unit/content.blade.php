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
                <th scope="col">Kode Unit</th>
                <th scope="col">Equipment</th>
                <th scope="col">Forklift Type</th>
                <th scope="col">Merk</th>
                <th scope="col">Type</th>
                <th scope="col">Model</th>
                <th scope="col">Capcity</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Specification</th>
                <th scope="col">Qty</th>
                <th scope="col">CBU</th>
                <th scope="col">Region</th>
                <th scope="col">Site Name</th>
                <th scope="col">Action</th>
  
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($unit as $key)
            <tr>
                <th scope="row">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="contacusercheck1">
                        <label class="form-check-label" for="contacusercheck1"></label>
                    </div>
                </th>
              
                
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
                <th scope="col">{{ $key->getcbu->namacbu }}</th>
                <th scope="col">{{ $key->getregion->namaregion }}</th>
                <th scope="col">{{ $key->getsitename->namasitename }}</th>
                <th scope="col">
                    <a href="{{ route('unit.edit',$key->kdunit) }}" class="btn btn-sm btn-warning">Edit</a> 
                                <form action="{{ route('unit.destroy',$key->kdunit) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        onclick="return confirm('Hapus Data ini?');">Hapus</button>
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