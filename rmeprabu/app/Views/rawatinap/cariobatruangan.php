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
            <input type="hidden" name="tandastock" id="tandastock" class="form-control filter-input" autocomplete="off" value="<?= $tanda; ?>">
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
                    <td><?php if ($tanda == 1) {
                            echo round($row['stock']);
                        } else {
                            echo "0";
                        } ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function daftar(code) {
        let locationcode = $('#locationcode').val();
        let tandastock = $('#tandastock').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('AmprahFarmasiRuangan/detailobat'); ?>",
            data: {
                code: code,
                locationcode: locationcode,
                tanda: tandastock
            },
            dataType: "json",
            success: function(response) {
                $('#code').val(response.code);
                $('#name').val(response.name);
                $('#uom').val(response.uom);
                $('#qtystock').val(response.stock);
                $('#modalcariobatruangan').modal('hide');
            }
        });
    }
</script>