<table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Komposisi</th>
            <th>No</th>
            <th>KodeObat</th>
            <th>NamaObat</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn btn-info btn-sm" onclick="resep('<?= $row['id'] ?>')"> <i class="fas fa-hand-point-right"></i></button></td>
                    <td><button type="button" class="btn btn-success btn-sm" onclick="komposisi('<?= $row['id'] ?>')"> <i class="fas fa-globe"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['name'] ?></td>||
                    <td><?= $row['uom'] ?></td>
                    <td><?= number_format($row['salesprice'], 2, ",", "."); ?></td>
                    <td><?= round($row['stock']) ?></td>

                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function resep(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananRanap/detailobat'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#code').val(response.code);
                $('#name').val(response.name);
                $('#uom').val(response.uom);
                $('#composition').val(response.composition);
                $('#price').val(response.salesprice);
                $('#modalcariobatpelayanan_eresep').modal('hide');
            }
        });
    }

    function komposisi(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananRanap/viewFarmasiKlinis'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesobatklinis) {
                    $('.viewmodalklinis').html(response.suksesobatklinis).show();
                    $('#modalviewobatklinis').modal();
                }
            }
        });
    }
</script>