<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Monitoring Klaim</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="control-label">Jenis Pelayanan</label>
                                <select name="jnsPelayanan" id="jnsPelayanan" class="form-control custom-select filter-input">
                                    <option value="1">Rawat Inap</option>
                                    <option value="2">Rawat Jalan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="control-label">StatusKlaim</label>
                                <select name="statusKlaim" id="statusKlaim" class="form-control custom-select filter-input">
                                    <option value="1">Proses Verifikasi</option>
                                    <option value="2">Pending Verifikasi</option>
                                    <option value="3">Klaim</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Tanggal Pulang</label>
                            <div class="input-group">

                                <input type="text" class="form-control filter-input" name="tglPulang" id="tglPulang" value="<?= date('Y-m-d'); ?>">
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

            <div class="table-responsive viewdatamonitoring">


            </div>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    $('.filter-input').on('change', function() {
        let jnsPelayanan = $('#jnsPelayanan').val();
        let statusKlaim = $('#statusKlaim').val();
        let tglPulang = $('#tglPulang').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('MonitoringBpjs/caridataklaim') ?>",
            dataType: "json",
            data: {
                jnsPelayanan: jnsPelayanan,
                statusKlaim: statusKlaim,
                tglPulang: tglPulang
            },
            success: function(response) {
                $('.viewdatamonitoring').html(response.data);

            }
        });
    });
</script>
<?= $this->endSection(); ?>