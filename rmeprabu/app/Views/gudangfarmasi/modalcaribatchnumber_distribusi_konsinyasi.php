<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

<div id="modalcaribatchnumber_distribusi_konsinyasi" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Batch Number >>(Distribusi)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="form-body">
                        <div class="card">
                            <div class="card-body">

                                <table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No</th>
                                            <th>KodeObat</th>
                                            <th>Nomor Batch</th>
                                            <th>Satuan</th>
                                            <th>Exp.Date</th>
                                            <th>PosisiStok</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form id="div-form-tambah" method="post">
                                            <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="<?= $lokasi; ?>" readonly>
                                            <?php $no = 0;
                                            foreach ($tampildata as $row) :
                                                $no++; ?>
                                                <tr>
                                                    <td><button type="button" class="btn btn-info btn-sm" onclick="masukan('<?= $row['id'] ?>')"> <i class="fa fa-tags"></i></button></td>
                                                    <td><?= $no ?></td>
                                                    <td><?= $row['code'] ?></td>
                                                    <td><?= $row['batchnumber'] ?></td>
                                                    <td><?= $row['uom'] ?></td>
                                                    <td><?= $row['expireddate'] ?></td>
                                                    <td><?= round($row['balance']) ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    function masukan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DistribusiAmprahFarmasi/detail_batchnumber'); ?>",
            data: {
                id: id,
                locationcode: $('#locationcode').val()
            },
            dataType: "json",
            success: function(response) {
                $('#batchnumber').val(response.batchnumber);
                $('#stockqty').val(response.balance);
                $('#expireddate').val(response.expireddate);
                $('#qtystock').val(response.balance);
                detailpermintaan();
                $('#modalcaribatchnumber_distribusi').modal('hide');

            }
        });
    }
</script>