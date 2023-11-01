<table id="example"
class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11"
cellspacing="0" style="border-collapse: collapse;  widtd: 100%;">
<thead>
    <tr>
        <th SCOPE="COL">CODE UNIT</th>
        <th SCOPE="COL">EQUIPMENT</th>
        <th SCOPE="COL">FORKLIFT TYPE</th>
        <th SCOPE="COL">MERK</th>
        <th SCOPE="COL">TYPE</th>
        <th SCOPE="COL">MODEL</th>
        <th SCOPE="COL">SERIAL NUMBER</th>
        <th SCOPE="COL">CAPACITY (KILOGRAM)</th>
        <th SCOPE="COL">MAST (STAGE)</th>
        <th SCOPE="COL">HEIGHT (METER)</th>
        <th SCOPE="COL">IMAGE</th>
    </tr>
</thead>
<tbody>
    @php $i=1; @endphp
    @foreach ($units as $key)
        <tr>



            <td scope="col">{{ $key->kdunit }}</td>
            <td scope="col">{{ $key->equipment }}</td>
            <td scope="col">{{ $key->getforklifttype->namaforklifttype }}</td>
            <td scope="col">{{ $key->merk }}</td>
            <td scope="col">{{ $key->type }}</td>
            <td scope="col">{{ $key->model }}</td>
            <td scope="col">{{ $key->serialnumber }}</td>
            {{-- <td scope="col">{{ $key->capcity }}</td> --}}
            <td scope="col">{{ number_format($key->capcity) }}</td>
            <td scope="col">{{ $key->mast }}</td>
            <td scope="col">{{ $key->masheight }}</td>
            <td scope="col"><img src="{{ asset('/img/'.$key->foto) }}" width="100px" ></td>


        </tr>
    @endforeach
</tbody>
</table>
