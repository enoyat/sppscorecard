<table class="table table-striped dt-responsive nowrap w-100" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;" id="datatable-buttons">
    <thead>
        <tr>
            <th scope="col" style="width: 50px;">
                <div class="form-check font-size-16">
                    <input type="checkbox" class="form-check-input" id="checkAll">
                    <label class="form-check-label" for="checkAll"></label>
                </div>
            </th>
            <th scope="col">ID Berita</th>
            <th scope="col">Status Pengirim</th>
            <th scope="col">Status Penerima</th>
            <th scope="col">Pengirim</th>
            <th scope="col">Penerima</th>
            <th scope="col">Tanggal Upload</th>
            <th scope="col">Tanggal Terima</th>
            <th scope="col">File Dokumen</th>
            <th style="width: 80px; min-width: 80px;">Action</th>
        </tr>
    </thead>
    <tbody>
        @php $i=1; @endphp
        @foreach ($beritaacara as $key)
        <tr>
            <th scope="row">
                <div class="form-check font-size-16">
                    <input type="checkbox" class="form-check-input" id="contacusercheck1">
                    <label class="form-check-label" for="contacusercheck1"></label>
                </div>
            </th>
            <th scope="col">{{ $key->id }}</th>
            <th scope="col">@if ($key->statuspengirim=="CLOSE")
                <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statuspengirim }}</span>
                @else
                <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statuspengirim }}</span>
                @endif
            </th>
            <th scope="col">@if ($key->statuspenerima=="CLOSE")

                <span class="badge badge-pill badge-soft-success font-size-12">{{ $key->statuspenerima }}</span>
                @else
                <span class="badge badge-pill badge-soft-danger font-size-12">{{ $key->statuspenerima }}</span>

                <a class="btn btn-sm btn-info  btn-action" data-url="{{ URL('beritaacara/formterima?id='.$key->id) }}" id="btnAction1">Terima</a>
                @endif

            </th>
            <th scope="col">{{ $key->getpengirim->namasitename }}</th>
            <th scope="col">{{ $key->getpenerima->namasitename }}</th>
            <th scope="col">{{ $key->tanggal }}</th>
            <th scope="col">{{ $key->tanggalterima}}</th>
            <th scope="col"><a href="{{ asset('assets/inventory/'.$key->filename) }}" target="_blank"><img src="{{ asset('assets/inventory/'.$key->filename) }}" width="100"></a></th>

            <th style="width: 80px; min-width: 80px;">

                <form action="{{ route('beritaacara.destroy',$key->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item" onclick="return confirm('Hapus Data ini?');">Hapus</button>
                </form>


            </th>
        </tr>
        @endforeach
        <tr>
            <td>
                <!-- Static Backdrop Modal -->
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

            </td>
        </tr>
    </tbody>
</table>
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