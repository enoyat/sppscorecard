<h4>Preview Image</h4>
<hr>

<div class="row">
    <div class="col" align="center">
        @if ($type == 'siloImage')
        <img src="{{ asset('/img/' . $file->file_silo) }}" alt="Preview" width="100%">
        @elseif ($type == 'forkliftImage')
        <img src="{{ asset('/img/' . $file->foto) }}" alt="Preview" height="800px">
        @endif
    </div>
</div>