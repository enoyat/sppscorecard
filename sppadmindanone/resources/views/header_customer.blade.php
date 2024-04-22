@if (Auth::user()->roles_id == '1')
@csrf
    <select class="form-select" aria-label="Default select example" name="kdcustomer" id="kdcustomer">
        <option value="{{ Session::get('kdcustomer') }}" selected>{{ Session::get('namacustomer') }}</option>
        <option value="">-- Select --</option>
        @foreach ($customer as $itemcustomer)
            <option value="{{ $itemcustomer->kdcustomer }}">{{ $itemcustomer->namacustomer }}</option>
        @endforeach
    </select>
@endif
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    jQuery('#kdcustomer').change(function() {
        var id = $(this).val();
        var string = "{{ route('lokasi.setcustomer') }}";
        $.ajax({
            type: 'GET',
            url: string,
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
