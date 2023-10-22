@if ($key->f_status == 'order')
<span class="badge bg-danger">{{ $key->f_status }}</span>
@elseif($key->f_status == 'accsite')
<span class="badge bg-warning">{{ $key->f_status }}</span>
@elseif($key->f_status == 'accho')
<span class="badge bg-success">{{ $key->f_status }}</span>
@elseif($key->f_status == 'accgudang')
<span class="badge bg-info">{{ $key->f_status }}</span>
@elseif($key->f_status == 'close')
<span class="badge bg-danger">{{ $key->f_status }}</span>
@elseif($key->f_status == 'Cancel')
<span class="badge bg-secondary">{{ $key->f_status }}</span>
@elseif($key->f_status == 'Done')
<span class="badge bg-secondary">{{ $key->f_status }}</span>
@endif
