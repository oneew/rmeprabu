<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Monitoring Klaim Jasa Raharja</h4>
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
                                                <label class="control-label">Tanggal Klaim</label>
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
            </form>
            <div class="table-responsive viewdatamonitoring"></div>
        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    $('.filter-input').on('input apply.daterangepicker', function() {
        let rencanakontrol = $('#rencanakontrol').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/caridataklaimJasaRaharja') ?>",
            dataType: "json",
            data: {
                rencanakontrol: rencanakontrol
            },
            success: function(response) {
                $('.viewdatahistoriSep').html(response.data);

            }
        });
    });
</script>
<?= $this->endSection(); ?>