@include('layouts.tabel')
    <table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11" cellspacing="0"
        style="border-collapse: collapse;  width: 100%;"  >
        <thead>
            <tr>
                
                <TH SCOPE="COL">STATUS SPP</TH>
                <TH SCOPE="COL">STATUS CUSTOMER</TH>
                <TH SCOPE="COL">DATE REQUEST <br>(YYYY/MM/DD)</TH>
                <TH SCOPE="COL">PO NUMBER</TH>
                <TH SCOPE="COL">SERIAL NUMBER</TH>
                <TH SCOPE="COL" >FORKLIFT TYPE</TH>
                <TH SCOPE="COL">CAPACITY (TON)</TH>
                <TH SCOPE="COL">MAST HEIGHT (MTR)</TH>
                <TH SCOPE="COL">ESTIMATED DELIVERY</TH>
                <TH SCOPE="COL">REASON OF LAPSE</TH>
                <TH SCOPE="COL">DAYS OF LAPSE</TH>
                <TH SCOPE="COL">REMARK PLANT</TH>
                <TH SCOPE="COL">ACTUAL DELIVERY</TH>
                <TH SCOPE="COL">CONFIRMATION BY PLANT</TH>
                <TH SCOPE="COL">CBU</TH>
                <TH SCOPE="COL">REGION</TH>
                <TH SCOPE="COL">SITE NAME</TH>

                <TH STYLE="WIDTH: 80PX; MIN-WIDTH: 80PX;">ACTION</TH>


            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($delivery as $key)
            <tr>
                <th scope="col">
                    
                @if ($key->statusspp=="CLOSE") 
                    <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statusspp }}</span>
                    @else
                    <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statusspp }}</span>
                    @if(Session::get('globalidsitename')=='999')
                    <a class="btn btn-sm btn-info  btn-action" data-url="{{ URL('delivery/formstatus?aid=spp&id='.$key->id) }}" id="btnAction1"><i class=" fas fa-key"></i></a>
                    @endif
                    @endif</th>
                <th scope="col">@if ($key->statuscustomer=="CLOSE") 
                    <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statuscustomer }}</span>
                    @else
                    
                    <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statuscustomer }}</span>
                    @if(Session::get('globalidsitename')==Session::get('runidsitename'))
                    <a class="btn btn-sm btn-info  btn-action" data-url="{{ URL('delivery/formstatus?aid=customer&id='.$key->id) }}" id="btnAction1"><i class=" fas fa-key"></i></a>
                    @endif
                    
                    @endif
                </th>
                <th scope="col">{{ $key->daterequest }}</th>
                <th scope="col">{{ $key->ponumber }}</th>
                <th scope="col">{{ $key->serialnumber }}</th>
                <th scope="col">{{ $key->getforklifttype->namaforklifttype }}</th> 
                <th scope="col">{{ $key->capacity }}</th>
                <th scope="col">{{ $key->masheight }}</th>
                <th scope="col">{{ $key->dateestimated }}</th>
                <th scope="col">{{ $key->reason }}</th>

                <th scope="col">{{ $key->daysoflapse }}</th>
                <th scope="col">{{ $key->remarkplant }}</th>
                <th scope="col">{{ $key->dateactual }}</th>
                <th scope="col">{{ $key->confirmationplan }}</th>
                <th scope="col">{{ $key->getcbu->namacbu }}</th>
                <th scope="col">{{ $key->getregion->namaregion }}</th>
                <th scope="col">{{ $key->getsitename->namasitename }}</th>

                <th style="width: 80px; min-width: 80px;">
                <div class="dropdown">
                            <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('delivery.edit',$key->id) }}">Edit</a></li>
                                <li><form action="{{ route('delivery.destroy',$key->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="dropdown-item"
                                            onclick="return confirm('Hapus Data ini?');">Hapus</button>
                                    </form></li>
                            </ul>
                        </div>
                                   
            
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