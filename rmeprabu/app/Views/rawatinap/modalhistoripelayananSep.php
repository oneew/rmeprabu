<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
<div id="modalhistoripelayananSep" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Histori Pelayanan Pasien (Sumber Data : Vclaim)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <form action="#">
                            <div class="form-body">

                                <div class="row pt-3">
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="control-label">No Kartu</label>
                                            <input type="text" name="noKartu" id="noKartu" class="form-control filter-input" autocomplete="off" value="<?= $noKartu; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Tgl Histori Pelayanan</label>
                                            <input type="text" name="rencanakontrol" id="rencanakontrol" class="form-control daterange filter-input" autocomplete="off">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdatahistoriSep"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="viewmodalbaru" style="display:none;"></div>
<script>
    $('.filter-input').on('input apply.daterangepicker', function() {
        let rencanakontrol = $('#rencanakontrol').val();
        let filter = $('#noKartu').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/datahistoripelayananSepVclaim') ?>",
            dataType: "json",
            data: {
                rencanakontrol: rencanakontrol,
                filter: filter
            },
            success: function(response) {
                $('.viewdatahistoriSep').html(response.data);

            }
        });
    });
</script>

<!-- Date Picker Plugin JavaScript -->
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="<?= base_url(); ?>/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<script>
    /*******************************************/
    // Basic Date Range Picker
    /*******************************************/
    $('.daterange').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });
</script>