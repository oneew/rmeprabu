<div class="table-responsive">
    <table id="dataperawat" class="table color-table purple-table">
        <thead>
            <tr>


                <th>#</th>
                <th>No</th>
                <th>Tanggal operasi</th>
                <th>Dokter Operator</th>
                <th>Dokter Anestesi</th>
                <th>Kategori</th>
                <th>Tindakan</th>
                <th>Kamar</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $row['id'] ?>')"> <i class="fa fa-tags"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['dt_advice_op'] ?></td>
                    <td><?= $row['ibsdoktername'] ?></td>
                    <td><?= $row['ibsanestesiname'] ?></td>
                    <td><?= $row['cases'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['room'] ?></td>



                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('EdukasiBedah/formedittim'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaltim').modal('show');

                }
            }

        });


    }
</script>