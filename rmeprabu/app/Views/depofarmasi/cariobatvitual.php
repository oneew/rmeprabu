<table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>KodeObat</th>
            <th>NamaObat</th>
            <th>Satuan</th>
            <th>HargaSebelumnya</th>
            <th>PosisiStok</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <input type="hidden" name="locationcode" id="locationcode" class="form-control filter-input" autocomplete="off" value="<?= $locationcode; ?>">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>

                    <td><button type="button" class="btn btn-info btn-sm" onclick="daftar('<?= $row['code'] ?>')"> <i class="fa fa-tags"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['uom'] ?></td>
                    <td><?= number_format($row['purchaseprice'], 2, ",", "."); ?></td>
                    <td><?= round($row['stock']) ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function daftar(code) {
        let locationcode = $('#locationcode').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('AmprahFarmasi/detailobatvitual'); ?>",
            data: {
                code: code,
                locationcode: locationcode
            },
            dataType: "json",
            success: function(response) {
                $('#code').val(response.code);
                $('#name').val(response.name);
                $('#uom').val(response.uom);
                $('#qtystock').val(response.stock);
                $('#modalcariobatvitual').modal('hide');
            }
        });
    }
</script>