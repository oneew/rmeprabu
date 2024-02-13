<table id="datamonitoring" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>NoSep</th>
            <th>TglSep</th>
            <th>TglPulangSep</th>
            <th>Norm</th>
            <th>NomorKartuBpjs</th>
            <th>JenisPelayanan</th>
            <th>Poli</th>
            <th>Diagnosa</th>
            <th>NomorKartu</th>
            <th>Nama</th>
            <th>TanggalKejadian</th>
            <th>NoRegister</th>
            <th>StatusDijamin</th>
            <th>StatusDikirim</th>
            <th>Plafon</th>
            <th>JumlahDibayar</th>
            <th>ResultJasaRaharja</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        $list = $response->response->jaminan;
        if ($response->response->jaminan !== null) {
            foreach ($list as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->sep->noSEP; ?></td>
                    <td><?= $row->sep->tglSEP; ?></td>
                    <td><?= $row->sep->tglPlgSEP; ?></td>
                    <td><?= $row->sep->noMr ?></td>
                    <td><?= $row->peserta->noKartu ?></td>
                    <td><?= $row->peserta->noMR ?></td>
                    <td><?= $row->sep->jnsPelayanan ?></td>
                    <td><?= $row->sep->poli ?></td>
                    <td><?= $row->sep->diagnosa ?></td>
                    <td><?= $row->sep->peserta->noKartu ?></td>
                    <td><?= $row->sep->peserta->nama ?></td>
                    <td><?= $row->jasaRaharja->tglKejadian ?></td>
                    <td><?= $row->jasaRaharja->noRegister ?></td>
                    <td><?= $row->jasaRaharja->ketStatusDijamin ?></td>
                    <td><?= $row->jasaRaharja->ketStatusDikirim ?></td>
                    <td><?= $row->jasaRaharja->plafon ?></td>
                    <td><?= $row->jasaRaharja->jmlDibayar ?></td>
                    <td><?= $row->jasaRaharja->resultsJasaRaharja ?></td>

                </tr>

        <?php endforeach;
        } ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datakontrol').DataTable();
    });
</script>