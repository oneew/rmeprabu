<table id="datarujukan" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>JenisPelayanan</th>
            <th>NomorKartu</th>
            <th>Nama</th>
            <th>KelasRawat</th>
            <th>NomorRujukan</th>
            <th>NomorSep</th>
            <th>Poli</th>
            <th>Diagnosa</th>
            <th>TglSep</th>
            <th>TglPulangSep</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;

        $response = $sep;
        if ($response !== null) {
            foreach ($response as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['jnsPelayanan']; ?></td>
                    <td><?= $row['noKartu']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['kelasRawat']; ?></td>
                    <td><?= $row['noRujukan']; ?></td>
                    <td><?= $row['noSep']; ?></td>
                    <td><?= $row['poli']; ?></td>
                    <td><?= $row['diagnosa']; ?></td>
                    <td><?= $row['tglPlgSep']; ?></td>
                    <td><?= $row['tglSep']; ?></td>
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