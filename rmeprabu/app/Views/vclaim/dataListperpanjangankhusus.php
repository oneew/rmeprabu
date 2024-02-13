<table id="datarujukan" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>IdRujukan</th>
            <th>NomorRujukan</th>
            <th>NoKapst</th>
            <th>Nama</th>
            <th>Diagnosa</th>
            <th>Tanggal rujukan awal</th>
            <th>Tanggal Rujukan akhir</th>
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
                    <td><?= $row['idrujukan']; ?></td>
                    <td><?= $row['norujukan']; ?></td>
                    <td><?= $row['nokapst']; ?></td>
                    <td><?= $row['nmpst']; ?></td>
                    <td><?= $row['diagppk']; ?></td>
                    <td><?= $row['tglrujukan_awal']; ?></td>
                    <td><?= $row['tglrujukan_berakhir']; ?></td>
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