<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
<div id="modaldatapindahcabar" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Pindah Cara Bayar Pasien Rawat Inap</h4>
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
                                        <div class="form-group">
                                            <label class="control-label">Tgl Pindah Cara Bayar</label>
                                            <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Identitas Pasien</label>
                                            <input type="text" name="identitaspasien" id="identitaspasien" class="form-control filter-input" autocomplete="off">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdatahistoriuangmuka"></div>
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
    function dataRegisteruangmuka() {
        $.ajax({

            url: "<?php echo base_url('KasirRanap/ambildata_pindahcabar') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdatahistoriuangmuka').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisteruangmuka();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let DateOut = $('#DateOut').val();
        let identitaspasien = $('#identitaspasien').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRanap/caridata_pindahcabar') ?>",
            dataType: "json",
            data: {
                DateOut: DateOut,
                identitaspasien: identitaspasien
            },
            success: function(response) {
                $('.viewdatahistoriuangmuka').html(response.data);

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