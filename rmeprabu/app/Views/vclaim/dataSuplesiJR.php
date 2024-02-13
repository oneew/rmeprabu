<table id="datahistori" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>No Register</th>
            <th>NoSep</th>
            <th>NoSep Awal</th>
            <th>No Surat Jaminan</th>
            <th>Tanggal Kejadian</th>
            <th>Tanggal Sep</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        $list = $response['jaminan'];
        foreach ($list as $row) :
            $no++; ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['noRegister']; ?></td>
                <td><?= $row['noSep']; ?></td>
                <td><?= $row['noSepAwal']; ?></td>
                <td><?= $row['noSuratJaminan']; ?></td>
                <td><?= $row['tglKejadian']; ?></td>
                <td><?= $row['tglSep']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datahistori').DataTable(); {
            responsive: true
        }
    });
</script>