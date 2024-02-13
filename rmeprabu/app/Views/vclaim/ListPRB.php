<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data PRB</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>
            <form action="#">
                <div class="form-body">
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-12 col-md-12">
                            <form action="#">
                                <div class="form-body">
                                    <div class="row pt-3">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Tgl SRB</label>
                                                <input type="text" name="tglSrb" id="tglSrb" class="form-control daterange filter-input" autocomplete="off">
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
            </form>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    $('.filter-input').on('input apply.daterangepicker', function() {
        let tglSrb = $('#tglSrb').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/dataListPRB') ?>",
            dataType: "json",
            data: {
                tglSrb: tglSrb
            },
            success: function(response) {
                if (response.success) {
                    $('.viewdatahistoriSep').html(response.data);
                } else {

                    $('.viewdatahistoriSep').html('');
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                    });
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>