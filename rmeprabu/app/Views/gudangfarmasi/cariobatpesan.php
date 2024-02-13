<div class="container" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black">
    <table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap" style="color: black; color:black" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Satuan</th>
                <th>Harga Sebelumnya</th>
                <th>Posisi Stok Gudang</th>
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
</div>

<script>
    function daftar(code) {
        let locationcode = $('#locationcode').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('AmprahFarmasi/detailobatPesan'); ?>",
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
                $('#modalcariobatpesan').modal('hide');
            }
        });
    }
</script>