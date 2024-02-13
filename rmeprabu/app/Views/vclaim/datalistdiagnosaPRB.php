<table id="datarujukan" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Diagnosa</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        $response = $list;
        if ($response !== null) {
            foreach ($response as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['kode']; ?></td>
                    <td><?= $row['nama']; ?></td>
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