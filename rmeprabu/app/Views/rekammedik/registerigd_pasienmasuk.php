<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Data Pasien Masuk IGD</h4>
            </div>
            <form action="<?= base_url('RekMedPasienMasuk/caridataregisterpoliPasienMasukIGD' );?>" method="POST" id="cari-pasien">
                <?= csrf_field() ;?>
                <div class="row pt-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Pelayanan</label>
                            <select name="poli" id="poli" class="select2 filter-input" style="width: 100%">
                                <?php foreach ($poli as $p) : ?>
                                    <option value="<?= $p['name']; ?>"><?= $p['name']; ?></option>
                                <?php endforeach; ?>
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
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary btncari"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>

            <div class="viewdata">


            </div>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterPoli() {
        $.ajax({

            url: "<?php echo base_url('RekMedPasienMasuk/ambildataPasienMasukIGD') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterPoli();

    });

    $('#cari-pasien').submit(function(e) {
        let patientname = $('#patientname').val();
        let norm = $('#norm').val();
        let metodepembayaran = $('#metodepembayaran').val();
        let DateOut = $('#DateOut').val();
        let poli = $('#poli').val();

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                poli: poli
            },
            dataType: "json",
            beforeSend: function() {
                $('.btncari').attr('disable', 'disabled');
                $('.btncari').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btncari').removeAttr('disable');
                $('.btncari').html('<i class="fas fa-search"></i>');
            },
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
        return false;
    });

</script>






<?= $this->endSection(); ?>