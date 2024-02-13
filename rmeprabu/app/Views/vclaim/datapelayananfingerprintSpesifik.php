<table id="datahistori" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

        <tr>
            <td><span class="badge badge-info"><?= $response['kode']; ?></span>
            </td>
            <td><?= $response['status']; ?></td>
        </tr>

    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datahistori').DataTable(); {
            responsive: true
        }
    });
</script>