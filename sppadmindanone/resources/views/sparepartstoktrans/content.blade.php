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

                <TH SCOPE="COL">SPARE PART</TH>
                <TH SCOPE="COL">TANGGAL</TH>
                <TH SCOPE="COL">TRANSACTION </TH>
                <TH SCOPE="COL">QTY </TH>

                <TH SCOPE="COL">CONFIRMATION BY PLANT</TH>
                <TH SCOPE="COL">AVERAGE %</TH>

                <th style="width: 80px; min-width: 80px;">ACTION</th>


            </tr>
        </thead>
        <tbody>
            @php $i=1; @endphp
            @foreach ($sparepartstoktrans as $key)
            <tr>
                <td scope="row">
                    <div class="form-check font-size-16">
                        <input type="checkbox" class="form-check-input" id="contacusercheck1">
                        <label class="form-check-label" for="contacusercheck1"></label>
                    </div>
                </td>

                <td scope="col">{{ $key->getsparepart->partname }}</td>
                <td scope="col">{{ $key->tanggal }}</td>
                <td scope="col">{{ $key->transaction }}</td>
                <td scope="col">{{ $key->qtytrans }}</td>
                <td scope="col">{{ $key->confirmation }}</td>
                <td scope="col">{{ number_format($key->avgpros,2) }}</td>

                <td style="width: 80px; min-width: 80px;">

                           <form action="{{ route('sparepartstoktrans.destroy',$key->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Hapus Data ini?');" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>


            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
