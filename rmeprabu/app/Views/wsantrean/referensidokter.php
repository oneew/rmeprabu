<table id="datapoli" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Dokter</th>
            <th>Kode Dokter</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($response as $row) :
            $no++; ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['namadokter']; ?></td>
                <td><?= $row['kodedokter']; ?></td>
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