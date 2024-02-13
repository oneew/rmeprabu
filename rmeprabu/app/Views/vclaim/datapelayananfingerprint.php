<table id="datahistori" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>NoKartu</th>
            <th>NoSep</th>
        </tr>
    </thead>

    <tbody>
        <?php $no = 0;
        if ($response !== null) {
            foreach ($list as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><span class="badge badge-info"><?= $row['noKartu']; ?></span>
                    </td>
                    <td><?= $row['noSep']; ?></td>
                </tr>
        <?php endforeach;
        } ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datahistori').DataTable(); {
            responsive: true
        }
    });
</script>