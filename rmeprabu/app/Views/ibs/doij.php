<div class="table-responsive">
    <table id="data" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Tanggal</th>
                <th>JournalNumber</th>
                <th>Dokter Operator</th>
                <th>Nama Tindakan</th>
                <th>Jenis Tindakan</th>
                <th>Tarif</th>
                <th>Bhp</th>
                <th>Total Tarif</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn btn-info btn-rounded btn-sm" onclick="jadwalkan('<?= $row['id'] ?>')"> <i class="fa fa-plus"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['doktername']  ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['categoryname'] ?></td>
                    <td><?= number_format($row['price'], 0, ",", ".") ?></td>
                    <td><?= number_format($row['totalbhp'], 0, ",", ".") ?></td>
                    <td><?= number_format($row['subtotal'], 0, ",", ".") ?></td>


                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
    function jadwalkan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('EdukasiBedah/formsetupjadwal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaljadwal').modal('show');

                }
            }

        });


    }
</script>