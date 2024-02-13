<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Pelayanan Laboratorium Patologi Klinik</h4>
            </div>
            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Asal Daftar</label>
                                <select name="poli" id="poli" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Asal Daftar</option>
                                    <option value="IRJ">Rawat Jalan</option>
                                    <option value="IGD">IGD</option>
                                    <option value="IRI">Rawat Inap</option>
                                    <option value="DL">Pasien Luar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">NoRekamMedis</label>
                                <input type="text" name="norm" id="norm" class="form-control filter-input" placeholder="Nomor RekamMedis" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien</label>
                                <input type="text" name="patientname" id="patientname" class="form-control filter-input" placeholder="Nama Pasien" autocomplete="off">

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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tgl Pelayanan</label>
                                <div class="input-group">
                                    <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-search" type="button"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive viewdata"></div>
        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterPoli() {
        $.ajax({

            url: "<?php echo base_url('PelayananRegisterLPK/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterPoli();
        
        setInterval(() => {
            dataRegisterPoli();
        }, 15000);

    });


    $('.btn-search').click(function() {

        let patientname = $('#patientname').val();
        let norm = $('#norm').val();
        let metodepembayaran = $('#metodepembayaran').val();
        let DateOut = $('#DateOut').val();
        let poli = $('#poli').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRegisterLPK/caridataregisterpoli') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                poli: poli
            },
            beforeSend: function() {
                $('.btn-search').attr('disabled', true);
                $('.btn-search').html('<i class="fa fa-spin fa-spinner "></i>');
            },
            complete: function() {
                $('.btn-search').removeAttr('disabled');
                $('.btn-search').html('<i class="fas fa-search"></i>');
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>
<?= $this->endSection(); ?>