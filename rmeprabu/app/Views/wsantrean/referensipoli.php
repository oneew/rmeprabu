<table id="datapoli" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Poli</th>
            <th>Nama Sub Spesialis</th>
            <th>Kode Sub Spesialis</th>
            <th>Kode Poli</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        // $response = $list;
        foreach ($response as $row) :
            $no++; ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['nmpoli']; ?></td>
                <td><?= $row['nmsubspesialis']; ?></td>
                <td><?= $row['kdsubspesialis']; ?></td>
                <td><?= $row['kdpoli']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#datapoli').DataTable({
            responsive: true
        });
    });
</script>