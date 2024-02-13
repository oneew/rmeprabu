<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
<div id="modaldaftarkontrol" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Rencana Kontrol (Sumber Data : Vclaim)</h4>
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
                                            <label class="control-label">Kriteria</label>
                                            <select name="filter" id="filter" class="form-control custom-select filter-input">
                                                <option value="1">Tanggal Terbit Kontrol</option>
                                                <option value="2">Tanggal Rencana Kontrol</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Tgl Rencana Kontrol</label>
                                            <input type="text" name="rencanakontrol" id="rencanakontrol" class="form-control daterange filter-input" autocomplete="off">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdatkontrol">


                                </div>
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


<div class="viewmodalbaru" style="display:none;"></div>
<script>
    $('.filter-input').on('input apply.daterangepicker', function() {
        let rencanakontrol = $('#rencanakontrol').val();
        let filter = $('#filter').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/caridatarencanakontrol') ?>",
            dataType: "json",
            data: {
                rencanakontrol: rencanakontrol,
                filter: filter
            },
            success: function(response) {
                $('.viewdatkontrol').html(response.data);

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