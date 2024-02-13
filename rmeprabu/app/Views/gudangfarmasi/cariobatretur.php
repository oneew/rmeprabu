<div class="container" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black">
    <table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap" style="color: black; color:black" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>KodeObat</th>
                <th>Nomor Batch</th>
                <th>Supplier</th>
                <th>No Faktur</th>
                <th>Tanggal Terima</th>
                <th>Qty Box</th>
                <th>Volume</th>
                <th>Harga</th>
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
                        <td><?= $row['code'] ?>
                            </br><?= $row['name'] ?>
                            </br><?= $row['uom'] ?></td>
                        <td><?= $row['batchnumber'] ?></td>
                        <td><?= $row['relationname'] ?></td>
                        <td><?= $row['referencenumber'] ?></td>
                        <td><?= $row['receiptdate'] ?></td>
                        <td><?= ABS($row['qtybox']) ?></td>
                        <td><?= ABS($row['volume']) ?></td>
                        <td><?= number_format(ABS($row['subtotal']), 2, ",", "."); ?></td>

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
            url: "<?php echo base_url('ObatKeluarGudang/detailobatretur'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#code').val(response.code);
                $('#name').val(response.name);
                $('#uom').val(response.uom);
                $('#volume').val(response.volume);
                $('#qtybox').val(response.qtybox);
                $('#expireddate').val(response.expireddate);
                $('#price').val(response.price);
                $('#batchnumber').val(response.batchnumber);
                $('#referencenumber').val(response.referencenumber);
                $('#modalcariobatretur').modal('hide');
            }
        });
    }
</script>