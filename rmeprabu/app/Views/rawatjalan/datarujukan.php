<table id="datarujukan" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>NoRm</th>
            <th>Nama</th>
            <th>NoKartu</th>
            <th>NIK</th>
            <th>TglLahir</th>
            <th>JenisKelamin</th>
            <th>HakKelas</th>
            <th>JenisPeserta</th>
            <th>NoRujukan</th>
            <th>Keluhan</th>
            <th>Diagnosa</th>
            <th>Tujuan</th>
            <th>Perujuk</th>
            <th>TanggalKunjungan</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 0;

        if ($response !== null) {
            foreach ($response['rujukan'] as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['peserta']['mr']['noMR']; ?></td>
                    <td><?= $row['peserta']['nama']; ?></td>
                    <td><?= $row['peserta']['noKartu']; ?></td>
                    <td><?= $row['peserta']['nik']; ?></td>
                    <td><?= $row['peserta']['tglLahir']; ?></td>
                    <td><?= $row['peserta']['sex']; ?></td>
                    <td><?= $row['peserta']['hakKelas']['keterangan']; ?></td>
                    <td><?= $row['peserta']['jenisPeserta']['keterangan']; ?></td>
                    <td><?= $row['noKunjungan']; ?></td>
                    <td><?= $row['keluhan']; ?></td>
                    <td><?= $row['diagnosa']['kode']; ?><?= $row['diagnosa']['nama']; ?></td>
                    <td><?= $row['poliRujukan']['nama']; ?></td>
                    <td><?= $row['provPerujuk']['nama']; ?></td>
                    <td><?= $row['tglKunjungan']; ?></td>
                </tr>

        <?php endforeach;
        } ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datarujukan1').DataTable({
            responsive: true
        });
    });
</script>