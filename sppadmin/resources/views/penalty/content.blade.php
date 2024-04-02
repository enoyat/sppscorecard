@include('layouts.tabel')
    <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11" cellspacing="0"
        style="border-collapse: collapse;  width: 100%;"  >
    <thead>
        <tr>
            <TH SCOPE="COL">PERIODE</TH>
            <TH SCOPE="COL">CODE UNIT</TH>
            <TH SCOPE="COL">SERIAL NUMBER</TH>
            <TH SCOPE="COL">PRICE</TH>
            <TH SCOPE="COL">OTIF</TH>
            <TH SCOPE="COL">B/L</TH>
            <TH SCOPE="COL">penalty</TH>
            <TH SCOPE="COL">CBU</TH>
            <TH SCOPE="COL">REGION</TH>
            <TH SCOPE="COL">SITE NAME</TH>
            <TH >ACTION</TH>


        </tr>
    </thead>
    <tbody>
        @php $i=1; @endphp
        @foreach ($penalty as $key)
        <tr>
            <th scope="col">{{ $key->periode }}</th>
            <th scope="col">{{ $key->kdunit }}</th>
            <th scope="col">{{ $key->getunit->serialnumber }}</th>
            <th scope="col" style="text-align: right">{{ number_format($key->price) }}</th>
            <th scope="col" >{{ $key->flag_otif }}</th>
            <th scope="col" >{{ $key->flag_baru }}</th>
            <th scope="col" style="text-align: right">{{ number_format($key->penalty) }}</th>
            <th scope="col">{{ $key->getcbu->namasitename }}</th>
            <th scope="col">{{ $key->getregion->namasitename }}</th>
            <th scope="col">{{ $key->getsitename->namasitename }}</th>


            <th style="width: 200px; min-width: 80px;">
                <div style="float:right; width:60px"><a class="btn btn-sm btn-warning" href="{{ route('penalty.edit',$key->idpenalty) }}">Edit</a></div>
                <div style="float:right; width:60px"><form action="{{ route('penalty.destroy',$key->idpenalty) }}" method="POST">
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
