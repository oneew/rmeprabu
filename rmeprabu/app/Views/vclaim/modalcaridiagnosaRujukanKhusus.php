<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
<div id="modalcaridiagnosaRujukanKhusus" class="modal fade" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Diagnosa (Sumber Data : Vclaim)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <form action="#">
                            <div class="form-body">
                                <div class="row pt-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Kode Diagnosa/ Nama Diagnosa</label>
                                            <input type="text" name="filter" id="filter" class="form-control filter-input" autocomplete="off">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card">
                            <div class="table-responsive viewdiagnosa"></div>
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


<script>
    $('.filter-input').on('change', function() {
        let filter = $('#filter').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/referensiDiagnosaRujukanKhusus') ?>",
            dataType: "json",
            data: {
                filter: filter
            },
            success: function(response) {
                $('.viewdiagnosa').html(response.data);

            }
        });
    });
</script>