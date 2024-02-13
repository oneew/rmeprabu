<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h4 class="card-title">Data Pasien IGD [Mobilisasi Dana]</h4>
            </div>
            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Poliklinik</label>
                                <select name="poli" id="poli" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Poliklinik</option>
                                    <?php foreach ($poli as $p) : ?>
                                        <option value="<?php echo $p['name']; ?>"><?php echo $p['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">NoRm</label>
                                <input type="text" name="norm" id="norm" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien</label>
                                <input type="text" name="patientname" id="patientname" class="form-control filter-input" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-md-2">
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
                                <label class="control-label">Cara Pulang</label>
                                <select name="statuspasien" id="statuspasien" class="select2" style="width: 100%;">
                                    <option value="">Pilih</option>
                                    <?php foreach ($pasienstatus as $pjb) : ?>
                                        <option value="<?php echo $pjb['name']; ?>"><?php echo $pjb['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Tgl Pelayanan</label>
                            <div class="input-group">

                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="icon-calender"></i>
                                    </span>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="caripasien" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

            <div class="mt-5 table-responsive viewdata">


            </div>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterPoli() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/ambildataMobilisasiDanaIGD') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }


    $('#caripasien').click(function(e) {
        e.preventDefault();
        let patientname = $('#patientname').val();
        let norm = $('#norm').val();
        let metodepembayaran = $('#metodepembayaran').val();
        let DateOut = $('#DateOut').val();
        let poli = $('#poli').val();
        let statuspasien = $('#statuspasien').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/caridataregisterMobilisasiDanaIGD') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                poli: poli,
                statuspasien: statuspasien,
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
    $(document).ready(function() {
        dataRegisterPoli();
        $("#norm").attr("readonly", false);
        $("#patientname").attr("readonly", false);
        $("#DateOut").attr("readonly", false);

    });
</script>
<?= $this->endSection(); ?>