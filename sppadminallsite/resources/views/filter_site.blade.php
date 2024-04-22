<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<select name="filter" class="form-select">
    <option value="" {{ request()->get('filter') == '' ? 'selected' : '' }}>
        -- select filter --</option>
    @if (Auth::user()->roles_id == '1')
        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
            SITENAME</option>
        <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
            REGION</option>
        <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
            CBU</option>
        <option value="allsn" {{ request()->get('filter') == 'allsn' ? 'selected' : '' }}>
            ALL SN</option>
        <option value="allwater" {{ request()->get('filter') == 'allwater' ? 'selected' : '' }}>
            ALL WATERS</option>
        <option value="allsnwater" {{ request()->get('filter') == 'allsnwater' ? 'selected' : '' }}>
            ALL SN & WATERS</option>
    @elseif (Auth::user()->roles_id == '2')
        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
            SITENAME</option>
    
    @elseif (Auth::user()->roles_id == '5')
        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
            SITENAME</option>
        <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
            REGION</option>
        <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
            CBU</option>
        <option value="allsn" {{ request()->get('filter') == 'allsn' ? 'selected' : '' }}>
            ALL SN</option>
        <option value="allwater" {{ request()->get('filter') == 'allwater' ? 'selected' : '' }}>
            ALL WATERS</option>
        <option value="allsnwater" {{ request()->get('filter') == 'allsnwater' ? 'selected' : '' }}>
            ALL SN & WATERS</option>
    @elseif (Auth::user()->roles_id == '6')
        <option value="sitename" {{ request()->get('filter') == 'sitename' ? 'selected' : '' }}>
            SITENAME</option>
        <option value="region" {{ request()->get('filter') == 'region' ? 'selected' : '' }}>
            REGION</option>
        <option value="cbu" {{ request()->get('filter') == 'cbu' ? 'selected' : '' }}>
            CBU</option>
        <option value="allsn" {{ request()->get('filter') == 'allsn' ? 'selected' : '' }}>
            ALL SN</option>
        <option value="allwater" {{ request()->get('filter') == 'allwater' ? 'selected' : '' }}>
            ALL WATERS</option>
        <option value="allsnwater" {{ request()->get('filter') == 'allsnwater' ? 'selected' : '' }}>
            ALL SN & WATERS</option>
    @endif
</select>
<div id="filtersitename" style="width:300px" >
    <select name="xidsitename" id="xidsitename" class="form-select">
        @if (Session::get('runidsitename') != null)
            <option value="{{ Session::get('runidsitename') }}" selected>
                {{ Session::get('runnamasitename') }}</option>
        @endif
    </select>
</div>
<div id="filterregion"  style="width:150px"><select name="xidregion" id="xidregion" class="form-select">
    @if (Session::get('runidregion') != null)
        <option value="{{ Session::get('runidregion') }}" selected>
            {{ Session::get('runnamaregion') }}</option>
    @endif
</select>
</div>
<div id="filtercbu"  style="width:150px">
    
    <select class="form-select" aria-label="Default select example" name="xidcbu"
    id="xidcbu">
    @if (Session::get('runidcbu') != null)
        <option value="{{ Session::get('runidcbu') }}" selected>
            {{ Session::get('runnamacbu') }}</option>
    @endif

    <option value="">-- select --</option>
        @foreach ($cbu as $itemcbu)
            <option value="{{ $itemcbu->id }}">{{ $itemcbu->namasitename }}</option>
        @endforeach

</select>
</div>
<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $("#filtersitename").hide();
        $("#filterregion").hide();
        $("#filtercbu").hide();
        var filter = $("select[name='filter']").val();
        if (filter == "sitename") {
                $("#filtersitename").show();
                $("#filterregion").hide();
                $("#filtercbu").hide();
            } else if (filter == "region") {
                $("#filtersitename").hide();
                $("#filterregion").show();
                $("#filtercbu").hide();
            
        } else if (filter== "cbu") {
                $("#filtersitename").hide();
                $("#filterregion").hide();
                $("#filtercbu").show();
            } 
            else {
                $("#filtersitename").hide();
                $("#filterregion").hide();
                $("#filtercbu").hide();
            }
       

    });

    $("select[name='filter']").change(function() {
            if ($(this).val() == "sitename") {
                $("#filtersitename").show();
                $("#filterregion").hide();
                $("#filtercbu").hide();
            } else if ($(this).val() == "region") {
                $("#filtersitename").hide();
                $("#filterregion").show();
                $("#filtercbu").hide();
            
        } else if ($(this).val() == "cbu") {
                $("#filtersitename").hide();
                $("#filterregion").hide();
                $("#filtercbu").show();
            } 
            else {
                $("#filtersitename").hide();
                $("#filterregion").hide();
                $("#filtercbu").hide();
            }
        });

    $("#xidsitename").select2({
        placeholder: '-- select sitename --',
        ajax: {
            url: "{{ route('sitename.getsitename') }}",
            type: "GET",
            dataType: 'JSON',
            delay: 250,
            data: function(params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });

    $("#xidregion").select2({
        placeholder: '-- select region --',
        ajax: {
            url: "{{ route('sitename.getregion') }}",
            type: "GET",
            dataType: 'JSON',
            delay: 250,
            data: function(params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
</script>
