@include('layouts.tabel')
    <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11" cellspacing="0"
        style="border-collapse: collapse;  width: 100%;"  >
    <thead>
        <tr>
            <TH SCOPE="COL">PERIODE</TH>
            <TH SCOPE="COL">CODE UNIT</TH>

            <TH SCOPE="COL">PRICE</TH>
            <TH SCOPE="COL">PERCENTAGE (%)</TH>
            <TH SCOPE="COL">PAYMENT</TH>
            <TH SCOPE="COL">CBU</TH>
            <TH SCOPE="COL">REGION</TH>
            <TH SCOPE="COL">SITE NAME</TH>
            <TH >ACTION</TH>


        </tr>
    </thead>
    <tbody>
        @php $i=1; @endphp
        @foreach ($payment as $key)
        <tr>
            <th scope="col">{{ $key->periode }}</th>
            <th scope="col">{{ $key->kdunit }}</th>

            <th scope="col">{{ number_format($key->price) }}</th>
            <th scope="col">{{ number_format($key->prosentase) }}</th>
            <th scope="col">{{ number_format($key->pay) }}</th>
            <th scope="col">{{ $key->getcbu->namasitename }}</th>
            <th scope="col">{{ $key->getregion->namasitename }}</th>
            <th scope="col">{{ $key->getsitename->namasitename }}</th>


            <th style="width: 200px; min-width: 80px;">
                <div style="float:right; width:60px"><a class="btn btn-sm btn-warning" href="{{ route('payment.edit',$key->idpayment) }}">Edit</a></div>
                <div style="float:right; width:60px"><form action="{{ route('payment.destroy',$key->idpayment) }}" method="POST">
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
