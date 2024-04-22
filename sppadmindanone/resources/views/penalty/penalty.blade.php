@include('layouts.tabel')
    <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11" cellspacing="0"
        style="border-collapse: collapse;  width: 100%;"  >
    <thead>
        <tr>
            <TH SCOPE="COL">PERIODE</TH>
            <TH SCOPE="COL">CODE UNIT</TH>
            <TH SCOPE="COL">PRICE</TH>
            <TH SCOPE="COL">OTIF</TH>
            <th scope="col">LATE (MONTH)</th>
            <th scope="col">Price 5%</th>
            <th scope="col">Panalty</th>
            <TH SCOPE="COL">DATE REQUEST</TH>
            <TH SCOPE="COL">DATE ACTUAL</TH>
            <TH SCOPE="COL">B/L</TH>
            <TH SCOPE="COL">CBU</TH>
            <TH SCOPE="COL">REGION</TH>
            <TH SCOPE="COL">SITE NAME</TH>


        </tr>
    </thead>
    <tbody>
        @php $i=1; @endphp
        @foreach ($penalty as $key)
        <tr>
            <th scope="col">{{ $key->periode }}</th>
            <th scope="col">{{ $key->kdunit }}</th>
            <th scope="col" style="text-align: right">{{ number_format($key->price) }}</th>
            <th scope="col" >{{ $key->flag_otif }}</th>
            <th scope="col" >{{ $key->JMBULAN }}</th>
            <th scope="col" style="text-align: right">{{ number_format($key->price5) }}</th>
            <th scope="col" style="text-align: right">{{ number_format($key->jmlpenalty) }}</th>

            <th scope="col" >{{ $key->daterequest }}</th>
            <th scope="col" >{{ $key->dateactual }}</th>
            <th scope="col" >{{ $key->flag_baru }}</th>
            <th scope="col">{{ $key->idcbu }}</th>
            <th scope="col">{{ $key->idregion }}</th>
            <th scope="col">{{ $key->namasitename }}</th>



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
