<table id="datahistori" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>DPJP</th>
            <th>NoSEP</th>
            <th>NoSRB</th>
            <th>TglSRB</th>
            <th>NoKartu</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>ProgramPRB</th>
            <th>Keterangan</th>
            <th>Saran</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        $list = $response->list;
        foreach ($list as $row) :
            $no++; ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row->DPJP->nama; ?>
                </td>
                <td><?= $row->noSEP; ?></td>
                <td><?= $row->noSRB; ?></td>
                <td><?= $row->tglSRB; ?>
                </td>
                <td><?= $row->peserta->noKartu; ?></td>
                <td><?= $row->peserta->nama; ?></td>
                <td><?= $row->peserta->alamat; ?></td>
                <td><?= $row->peserta->email; ?></td>
                <td><?= $row->programPRB; ?></td>
                <td><?= $row->keterangan; ?></td>
                <td><?= $row->saran; ?></td>
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