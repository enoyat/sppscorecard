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
                <th scope="col">Status SPP</th>
                <th scope="col">Status Customer</th>
                <th scope="col">Status Mekanik</th>


                <th scope="col">Kode Unit</th>
                <th scope="col">HM</th>
                <th scope="col">status</th>
                <th scope="col">Tanggal</th>
                <th scope="col">CBU</th>
                <th scope="col">Region</th>
                <th scope="col">Site Name</th>
  
            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($maintenance as $key)
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
                    <a class="btn btn-sm btn-info  btn-action" data-url="{{ URL('maintenance/formstatus?aid=spp&kdunit='.$key->kdunit) }}" id="btnAction1"><i class=" fas fa-key"></i></a>
                    @endif
                    @endif</th>
                <th scope="col">@if ($key->statuscustomer=="CLOSE") 
                    <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statuscustomer }}</span>
                    @else
                    
                    <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statuscustomer }}</span>
                    @if(Session::get('globalidsitename')==Session::get('runidsitename'))
                    <a class="btn btn-sm btn-info  btn-action" data-url="{{ URL('maintenance/formstatus?aid=customer&kdunit='.$key->kdunit) }}" id="btnAction1"><i class=" fas fa-key"></i></a>
                    @endif
                    
                    @endif
                </th>
                <th scope="col">@if ($key->statusmekanik=="CLOSE") 
                    <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statusmekanik }}</span>
                    @else
                    <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statusmekanik }}</span>
                    @endif
                </th>                
                
                <th scope="col"><a href="{{ route('maintenance.listaction',$key->kdunit) }}">{{ $key->kdunit }}</a></th>
                <th scope="col">{{ $key->hm }}</th>
                <th scope="col">
                    <?php 
                        if(intdiv($key->hm,5000) % 2==1){
                            echo "OverHaul besar";
                        }
                        else {
                            echo "OverHaul kecil";
                        }
                    ?>
                </th>
                <th scope="col">{{ $key->tanggal }}</th> 
                <th scope="col">{{ $key->getcbu->namacbu }}</th>
                <th scope="col">{{ $key->getregion->namaregion }}</th>
                <th scope="col">{{ $key->getsitename->namasitename }}</th>
                
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