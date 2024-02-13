<table id="datapoli" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <td>#</td>
            <th>No</th>
            <th>Kode Sub Spesialis</th>
            <th>Nama Sub Spesialis</th>
            <th>Kode Poli</th>
            <th>Nama Poli</th>
            <th>Hari</th>
            <th>Kapasitas Pasien</th>
            <th>Libur</th>
            <th>Jadwal</th>
            <th>Nama Dokter</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($response as $row) :
            $no++; ?>
            <tr>
                <td><button type="button" class="btn waves-effect btn-rounded btn-outline-info btn-sm btnprintsep" onclick="UpdateJadwal('<?= $row['kodepoli']; ?>','<?= $row['kodesubspesialis']; ?>','<?= $row['kodedokter']; ?>','<?= $row['namadokter']; ?>')"> <i class="mdi mdi-lead-pencil"></i></button></td>
                <td><?= $no ?></td>
                <td><?= $row['kodesubspesialis']; ?></td>
                <td><?= $row['namasubspesialis']; ?></td>
                <td><?= $row['kodepoli']; ?></td>
                <td><?= $row['namapoli']; ?></td>
                <td>[<?= $row['hari']; ?>][<?= $row['namahari']; ?>]</td>
                <td><?= $row['kapasitaspasien']; ?></td>
                <td><?= $row['libur']; ?></td>
                <td><?= $row['jadwal']; ?></td>
                <td><?= $row['namadokter']; ?>[<?= $row['kodedokter']; ?>]</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#datapoli1').DataTable({
            responsive: true
        });
    });
</script>


<script>
    function UpdateJadwal(kodepoli, kodesubspesialis, kodedokter, namadokter) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('WsAntrean/UpdateHFIS'); ?>",
            data: {
                kodepoli: kodepoli,
                kodesubspesialis: kodesubspesialis,
                kodedokter: kodedokter,
                namadokter: namadokter
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupdateHFIS').modal('show');
                }
            }
        });
    }
</script>