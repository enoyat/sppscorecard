@include('layouts.tabel')
<table cellpadding="0" cellspacing="0" style="font-size: 11px">

    <tr>
        <td width="100">PERIODE</td>
        <td width="11">:</td>
        <td width="589">{{ $bulan }} {{ $tahun }}</td>
    </tr>
</table>

<table id="example" class="display nowrap table table-striped table-bordered scroll-horizontal font-size-11"
    cellspacing="0" style="border-collapse: collapse;  width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Hadir</th>
            <th>Izin</th>
            <th>Tidak Hadir</th>
            <th>Tepat Waktu</th>
            <th>Terlambat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php

    $i=1;
    foreach ($datatransaksi as $key) {

        echo "<tr>";?>
        <td><?php echo $i; ?></td>

        <td><?php echo $key["nama"]; ?></td>
        <td><?php echo $key["hadir"]; ?></td>
        <td><?php echo $key["izin"]; ?></td>
        <td><?php echo $key["tanpaketerangan"]; ?></td>
        <td><?php echo $key["tepatwaktu"]; ?></td>
        <td><?php echo $key["terlambat"]; ?></td>
        <td><a href="{{ route('laporan.presensi',['bulan'=>$bulan, 'tahun'=>$tahun, 'idmekanik'=>$key["idmekanik"]]) }}" class="btn btn-sm btn-success" target="_blank">Cetak Presensi</a></td>


        <?php
        echo "</tr>";
        $i++;


    }
    ?>
    </tbody>
</table>
<a href="{{ route('laporan.laporantransaction',['bulan'=>$bulan, 'tahun'=>$tahun]) }}" class="btn btn-sm bg-primary" id="cetak" target="_blank">Cetak Laporan Presensi</a>
