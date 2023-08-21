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

            <th scope="col">Periode</th>
            <th scope="col">Kode Unit</th>
            <th scope="col">Serial Number</th>
            <th scope="col">Hari Kerja</th>
            <th scope="col">Plan Kerja Unit (minutes)</th>
            <th scope="col">Total BreakDown Unit (Minutes)</th>
            <th scope="col">Total Jam Kerja Unit</th>
            <th scope="col">PA Forklift (%)</th>
            <th scope="col">CBU</th>
            <th scope="col">Region</th>
            <th scope="col">Site Name</th>
            <th >Action</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1; @endphp
        @foreach ($physical as $key)
        <tr>
            <th scope="row">
                <div class="form-check font-size-16">
                    <input type="checkbox" class="form-check-input" id="contacusercheck1">
                    <label class="form-check-label" for="contacusercheck1"></label>
                </div>
            </th>


            <th scope="col">{{ $key->periode }}</th>
            <th scope="col">{{ $key->kdunit }}</th>
            <th scope="col">{{ $key->getunit->serialnumber }}</th>
            <th scope="col">{{ $key->harikerja }}</th>
            <th scope="col">{{ $key->planunitkerja }}</th>
            <th scope="col"><a href="{{ route('trouble.listaction',$key->kdunit) }}">{{ $key->totalbreakdown }}</a></th>
            <th scope="col">{{ $key->totaljamkerja }}</th>
            <th scope="col">{{ number_format($key->paforklift,2) }}</th>

            <th scope="col">{{ $key->getcbu->namacbu }}</th>
            <th scope="col">{{ $key->getregion->namaregion }}</th>
            <th scope="col">{{ $key->getsitename->namasitename }}</th>


            <th style="width: 200px; min-width: 80px;">
                <div style="float:right; width:60px"><a class="btn btn-sm btn-warning" href="{{ route('physical.edit',$key->id) }}">Edit</a></div>
                <div style="float:right; width:60px"><form action="{{ route('physical.destroy',$key->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Hapus Data ini?');">Hapus</button>
                </form>
                </div>



            </th>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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