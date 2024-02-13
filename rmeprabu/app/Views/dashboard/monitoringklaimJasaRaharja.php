<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Monitoring Klaim Jasa Raharja</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim)</code></h6>
            </div>
            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-4">
                            <label class="control-label">Periode</label>
                            <div class="input-group">
                                <input type="text" name="periode" id="periode" class="form-control daterange filter-input" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="icon-calender"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive viewdatamonitoringJasaRaharja"></div>

        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        $('.filter-input').on('input apply.daterangepicker', function() {
            let periode = $('#periode').val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('MonitoringBpjs/caridataklaimJasaRaharja') ?>",
                dataType: "json",
                data: {
                    periode: periode
                },
                success: function(response) {
                    $('.viewdatamonitoringJasaRaharja').html(response.data);

                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>