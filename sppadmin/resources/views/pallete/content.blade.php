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
                <TH SCOPE="COL">STATUS SPP</TH>
                <TH SCOPE="COL">STATUS CUSTOMER</TH>

                <TH SCOPE="COL">REQUEST</TH>
                <TH SCOPE="COL">QTY</TH>
                <TH SCOPE="COL">DATE REQUEST</TH>
                <TH SCOPE="COL">TARGET DATE</TH>
                <TH SCOPE="COL">ACTUAL DATE</TH>
                <TH SCOPE="COL">LAPSE TIME</TH>
                <TH SCOPE="COL">GAP</TH>
                <TH SCOPE="COL">REMARK</TH>
                <TH SCOPE="COL">CBU</TH>
                <TH SCOPE="COL">REGION</TH>
                <TH SCOPE="COL">SITE NAME</TH>
                <TH STYLE="WIDTH: 80PX; MIN-WIDTH: 80PX;">ACTION</TH>


            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($pallete as $key)
            <tr>
                <th scope="row">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="contacusercheck1">
                        <label class="form-check-label" for="contacusercheck1"></label>
                    </div>
                </th>
                <th scope="col">
                    
                    @if ($key->statusspp=="CLOSE") 
                        <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statusspp }}</span>
                        @else
                        <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statusspp }}</span>
                        @if(Session::get('globalidsitename')=='999')
                        <a class="btn btn-sm btn-info  btn-action" data-url="{{ URL('pallete/formstatus?aid=spp&id='.$key->id) }}" id="btnAction1"><i class=" fas fa-key"></i></a>
                        @endif
                        @endif</th>
                    <th scope="col">@if ($key->statuscustomer=="CLOSE") 
                        <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statuscustomer }}</span>
                        @else
                        
                        <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statuscustomer }}</span>
                        @if(Session::get('globalidsitename')==Session::get('runidsitename'))
                        <a class="btn btn-sm btn-info  btn-action" data-url="{{ URL('pallete/formstatus?aid=customer&id='.$key->id) }}" id="btnAction1"><i class=" fas fa-key"></i></a>
                        @endif
                        
                        @endif
                    </th>

                <th scope="col">{{ $key->jenisrequest }}</th>
                <th scope="col">{{ $key->qty }}</th>
                <th scope="col">{{ $key->daterequest }}</th>
                <th scope="col">{{ $key->targetdate }}</th> 
                <th scope="col">{{ $key->actualdate }}</th>
                <th scope="col">{{ $key->lapsetime }}</th>
                <th scope="col">{{ $key->gap }}</th>
                <th scope="col">{{ $key->remark }}</th>
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
                                <li><a class="dropdown-item" href="{{ route('pallete.edit',$key->id) }}">Edit</a></li>
                                <li><form action="{{ route('pallete.destroy',$key->id) }}" method="POST">
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