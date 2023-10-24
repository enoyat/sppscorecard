<table class="table">
    <thead>
        <tr>
            <th>
                userid
            </th>
            <th>
                message
            </th>
            <th>
                time
            </th>
            <th>
                status
            </th>
        </tr>
    </thead>
    <tbody>
        @php $i=1; @endphp
        @foreach ($tickets as $key)
        <tr>
            <td>@if ($key->type=="0")
                Admin
                @else
                {{ $key->getcustomer->getusers->name }}
                @endif
            </td>
            <td><?php echo $key->message; ?></td>
            <td><?php echo $key->created_at; ?></td>
            <td>
                @if ($key->type=="0")

                @else
                @if($key->status=="unread")
                <div id="kode" style="display:none">{{ $key->id }}</div>
                <a class="btn btn-xs btn-warning  btn-action" data-url="" id="btnAction1">read</a>
                @else
                readed
                @endif
                @endif

            </td>
        </tr>
        <?php $i++; ?>
        @endforeach
    </tbody>
</table>
