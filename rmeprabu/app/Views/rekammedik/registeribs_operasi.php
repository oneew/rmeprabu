<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Laporan Detail Tindakan Operatif Bedah Sentral</h4>
            </div>
            <form action="#">
                <div class="form-body">

                    <div class="row pt-3">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label"></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Dokter Operator</label>
                                <select name="dokter" id="dokter" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Dokter Operator</option>
                                    <?php foreach ($dokter as $dok) : ?>
                                        <option value="<?php echo $dok['name']; ?>"><?php echo $dok['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">SMF</label>
                                <select name="smf" id="smf" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih SMF</option>
                                    <?php foreach ($smf as $smf) : ?>
                                        <option value="<?php echo $smf['name']; ?>"><?php echo $smf['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Metode Pembayaran</label>
                                <select name="metodepembayaran" id="metodepembayaran" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <?php foreach ($list as $b) : ?>
                                        <option value="<?php echo $b['name']; ?>"><?php echo $b['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Tgl Pelayanan</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                            </div>
                        </div>

                    </div>
                </div>
            </form>

            <div class="table-responsive viewdata">


            </div>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterPoli() {
        $.ajax({

            url: "<?php echo base_url('RekMedIBS/ambildata') ?>",
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


        let metodepembayaran = $('#metodepembayaran').val();
        let DateOut = $('#DateOut').val();
        let smf = $('#smf').val();
        let dokter = $('#dokter').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RekMedIBS/caridataregisterpoli') ?>",
            dataType: "json",
            data: {
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                smf: smf,
                dokter: dokter
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>


<?= $this->endSection(); ?>