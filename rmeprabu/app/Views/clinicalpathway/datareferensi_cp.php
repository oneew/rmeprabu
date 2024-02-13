<table id="dataCP" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>Diagnosa</th>
            <th>ICD</th>
            <th>LOS</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td>
                        <button type="button" class="btn btn-circle btn-info btn-sm" onclick="lihatCP('<?= $row['id'] ?>')"> <i class="mdi mdi-eye"></i></button>
                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['diagnosa'] ?></td>
                    <td><?= $row['icd'] ?></td>
                    <td><?= $row['los'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>




<script>
    $(document).ready(function() {
        $('#dataCP').DataTable({});
    });

    function lihatCP(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ClinicalPathway/ViewCP'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldiagnosacp').html(response.sukses).show();
                    $('#modalreferensi_cp').modal('show');
                }
            }
        });
    }
</script>