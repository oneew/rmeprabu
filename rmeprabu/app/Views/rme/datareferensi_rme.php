<table id="dataRME" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>SMF</th>
            <th>Keterangan</th>
            <th>Subjective</th>
            <th>Objective</th>
            <th>Asesmen</th>
            <th>Planning</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td>
                        <button type="button" class="btn btn-circle btn-info btn-sm" onclick="lihatRME('<?= $row['id'] ?>')"> <i class="mdi mdi-eye"></i></button>
                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['smf'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $row['subjective'] ?></td>
                    <td><?= $row['objective'] ?></td>
                    <td><?= $row['asesmen'] ?></td>
                    <td><?= $row['planning'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>




<script>
    $(document).ready(function() {
        $('dataRME').DataTable({});
    });

    function lihatRME(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/ViewRME'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldiagnosarme').html(response.sukses).show();
                    $('#modal_diagnosa_rme').modal('show');
                }
            }
        });
    }
</script>