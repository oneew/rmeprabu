<table id="datahistori" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>LastUpdate</th>
            <th>NamaKamar</th>
            <th>KodeKamar</th>
            <th>JenisKelas</th>
            <th>Kapasitas</th>
            <th>TersediaPriaWanita</th>
            <th>TersediaPria</th>
            <th>TersediaWanita</th>
            <th>Tersedia</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        $list = $response->response->list;
        foreach ($list as $row) :
            $no++; ?>
            <tr>
                <td class="text-center"><?= $no ?></td>
                <td><?= $row->lastupdate; ?></td>
                <td><?= $row->namaruang; ?></td>
                <td><?= $row->koderuang; ?></td>
                <td><?= $row->namakelas; ?></td>
                <td class="text-center"><?= $row->kapasitas; ?></td>
                <td class="text-center"><?= $row->tersediapriawanita; ?></td>
                <td class="text-center"><?= $row->tersediapria; ?></td>
                <td class="text-center"><?= $row->tersediawanita; ?></td>
                <td class="text-center"><?= $row->tersedia; ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datahistori1').DataTable(); {
            responsive: true
        }
    });
</script>