<div class="container" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black">
    <table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap" style="color: black; color:black" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>KodeObat</th>
                <th>NamaObat</th>
                <th>Satuan</th>
                <th>HargaSebelumnya</th>
                <th>Isi Kemasan (Box)</th>
            </tr>
        </thead>
        <tbody>
            <form id="div-form-tambah" method="post">
                <?php $no = 0;
                foreach ($tampildata as $row) :
                    $no++; ?>
                    <tr>
                        <td><button type="button" class="btn btn-info btn-sm" onclick="daftar('<?= $row['id'] ?>')"> <i class="fa fa-tags"></i></button></td>
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
    function daftar(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ObatMasukGudang/detailobat'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#code').val(response.code);
                $('#name').val(response.name);
                $('#uom').val(response.uom);
                $('#volume').val(response.volume);
                $('#purchasepricebefore').val(response.purchaseprice);
                $('#pabrik').val(response.manufacturename);
                $('#price').val(response.salesprice);
                $('#modalcariobat').modal('hide');
            }
        });
    }
</script>