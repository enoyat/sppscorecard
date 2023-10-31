<div class="row">
    @csrf
    @if (Session::get('category') == '10' || Session::get('category') == '1')
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col-12">

                            <span class="text-muted mb-3 lh-1 d-block text-truncate"> CBU</span>
                            <h4 class="mb-3">

                                <select class="form-select" aria-label="Default select example" name="idcbu"
                                    id="idcbu">
                                    @if (Session::get('runidcbu') != null)
                                        <option value="{{ Session::get('runidcbu') }}" selected>
                                            {{ Session::get('runnamacbu') }}</option>
                                    @endif

                                    <option value="">-- select --</option>
                                    @if (Auth::user()->roles_id == '1' || Auth::user()->roles_id == '5')
                                        @foreach ($cbu as $itemcbu)
                                            <option value="{{ $itemcbu->id }}">{{ $itemcbu->namasitename }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </h4>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">REGION</span>
                            <h4 class="mb-3">
                                <select class="form-select" aria-label="Default select example" name="idregion"
                                    id="idregion">
                                    <option value="">-- select --</option>
                                    @if (Session::get('runidregion') != null)
                                        <option value="{{ Session::get('runidregion') }}" selected>
                                            {{ Session::get('runnamaregion') }}</option>
                                    @endif

                                </select>

                            </h4>
                        </div>
                    </div>

                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col-->
    @endif
    <div class="col-xl-4 col-md-6">
        <!-- card -->
        <div class="card card-h-100">
            <!-- card body -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">SITE NAME</span>

                        <h4 class="mb-3">

                            <select class="form-select" aria-label="Default select example" name="idsitename"
                                id="idsitename">

                                <option value="">-- select --</option>
                                @if (Session::get('roles_id') == '1' || Session::get('roles_id') == '5')
                                    @foreach ($sitename as $itemsitename)
                                        <option value="{{ $itemsitename->id }}"
                                            @if (Session::get('runidsitename') == $itemsitename->id) selected @endif>
                                            {{ $itemsitename->namasitename }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </h4>


                    </div>

                </div>

            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row-->
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    jQuery('#idcbu').click(function() {
        jQuery('#idregion').html('');
        var id = $(this).val();
        var string = "{{ asset('/lokasi/getregion/') }}/" + id;
        $.ajax({
            type: 'GET',
            url: string,
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
                datax = JSON.stringify(data);
                datax = JSON.parse(datax);
                var i;
                var html = '';
                var html = '<option>Select</option>';
                for (i = 0; i < datax.length; i++) {
                    html += "<option value='" + datax[i].id + "'>" + datax[i].namasitename +
                        "</option>";
                }
                $('#idregion').html(html);
            }
        });
    });
    jQuery('#idregion').click(function() {
        jQuery('#idsitename').html('');
        var id = $(this).val();
        var string = "{{ asset('/lokasi/getsitename/') }}/" + id;
        $.ajax({
            type: 'GET',
            url: string,
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
                datax = JSON.stringify(data);
                datax = JSON.parse(datax);
                var i;
                var html = '';
                var html = '<option>Select</option>';
                for (i = 0; i < datax.length; i++) {
                    html += "<option value='" + datax[i].id + "'>" + datax[i].namasitename +
                        "</option>";
                }
                $('#idsitename').html(html);
            }
        });
    });
    jQuery('#idsitename').change(function() {
        var id = $(this).val();

        $.ajax({
            type: 'GET',
            url: "{{ route('lokasi.setsitename') }}",
            data: {
                id: id,
                _token: CSRF_TOKEN
            },
            dataType: 'json',
            success: function(data) {
                location.reload();
            }
        });
    });
</script>
