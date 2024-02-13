<table id="datahistori" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>NamaPeserta</th>
            <th>NoRujukan</th>
            <th>NoSep</th>
            <th>PpkPelayanan</th>
            <th>TglSep</th>
            <th>TglPulangSep</th>
            <th>JenisPelayanan</th>
            <th>Diagnosa</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        $list = $response->response->histori;
        foreach ($list as $row) :
            $no++; ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row->namaPeserta; ?>
                    <br><span class="badge badge-info"><?= $row->noKartu; ?></span>
                </td>
                <td><?= $row->noRujukan; ?></td>
                <td><?= $row->noSep; ?></td>
                <td><?= $row->ppkPelayanan; ?>
                    <br><span class="badge badge-success"><?= $row->poli; ?></span>
                </td>
                <td><?= $row->tglSep; ?></td>
                <td><?= $row->tglPlgSep; ?></td>
                <td><?= $row->jnsPelayanan; ?></td>
                <td><?= $row->diagnosa; ?></td>
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