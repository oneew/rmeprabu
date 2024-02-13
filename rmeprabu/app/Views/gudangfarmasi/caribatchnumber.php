<div class="container" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black">
    <table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap" style="color: black; color:black" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>KodeObat</th>
                <th>Nomor Batch</th>
                <th>Satuan</th>
                <th>Exp.Date</th>
                <th>PosisiStok</th>
                <th>Tanggal create</th>
            </tr>
        </thead>
        <tbody>
            <form id="div-form-tambah" method="post">
                <?php $no = 0;
                foreach ($tampildata as $row) :
                    $no++; ?>
                    <tr>
                        <td><button type="button" class="btn btn-info btn-sm" onclick="daftar('<?= $row['code'] ?>')"> <i class="fa fa-tags"></i></button></td>
                        <td><?= $no ?></td>
                        <td><?= $row['code'] ?></td>
                        <td><?= $row['batchnumber'] ?></td>
                        <td><?= $row['uom'] ?></td>
                        <td><?= $row['expireddate'] ?></td>
                        <td><?= $row['balance'] ?>
                        <td><?= $row['createddate'] ?>

                    </tr>
                <?php endforeach; ?>
            </form>
        </tbody>
    </table>
</div>


<script>
    function daftar(code) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ObatMasukGudang/detailobat'); ?>",
            data: {
                code: code
            },
            dataType: "json",
            success: function(response) {
                $('#code').val(response.code);
                $('#name').val(response.name);
                $('#uom').val(response.uom);
                //$('#purchasepricebefore').val(response.purchaseprice.toFixed(2));
                $('#purchasepricebefore').val(response.hargasebelum);
                $('#modalcariobat').modal('hide');
            }
        });
    }
</script>