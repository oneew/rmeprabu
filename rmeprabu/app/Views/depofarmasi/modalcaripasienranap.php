<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">

<div id="modalcaripasienranap" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Pasien Rawat Inap</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="form-body">
                        <div class="row pt-3">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nomor Rekam Medis</label>
                                    <input type="text" name="norm" id="norm" class="form-control filter-input" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nama Pasien</label>
                                    <input type="text" name="namapasien" id="namapasien" class="form-control filter-input" autocomplete="off">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Ruangan Rawat Inap</label>
                                    <select name="roomname" id="roomname" class="form-control-select2 filter-input" style="width: 100%">
                                        <option value="">Pilih Ruangan</option>
                                        <?php foreach ($ruangan as $l) : ?>
                                            <option value="<?php echo $l['roomname']; ?>" class="select-smf"><?php echo $l['roomname']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdataranap">
                                </div>
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
    $('.filter-input').on('change', function() {
        let norm = $('#norm').val();
        let namapasien = $('#namapasien').val();
        let roomname = $('#roomname option:selected').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananRanap/caridatapasienranap') ?>",
            dataType: "json",
            data: {

                norm: norm,
                namapasien: namapasien,
                roomname: roomname

            },
            success: function(response) {
                $('.viewdataranap').html(response.data);

            }
        });
    });
</script>