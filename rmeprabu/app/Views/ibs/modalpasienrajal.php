<link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="<?= base_url(); ?>/assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/wizard/steps.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/css/colors/default-dark.css" id="theme" rel="stylesheet">



<div id="modalpasienrajal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Pasien IGD & Rajal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <form action="#">
                            <div class="form-body">
                                <div class="row pt-1">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Norm</label>
                                            <input type="text" name="norm" id="norm" class="form-control filter-input" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Nama Pasien</label>
                                            <input type="text" name="patientname" id="patientname" class="form-control filter-input" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Tgl Pelayanan</label>
                                            <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdatapasien"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->

                    <!-- Column -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    function dataRegisterPoli() {
        $.ajax({

            url: "<?php echo base_url('EnJadwal/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterPoli();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let patientname = $('#patientname').val();
        let norm = $('#norm').val();
        let DateOut = $('#DateOut').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('EnJadwal/caridataregisterpoli') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdatapasien').html(response.data);

            }
        });
    });
</script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="<?= base_url(); ?>/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
<script>
    $('.daterange').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        }
    });