<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css" integrity="sha512-CbQfNVBSMAYmnzP3IC+mZZmYMP2HUnVkV4+PwuhpiMUmITtSpS7Prr3fNncV1RBOnWxzz4pYQ5EAGG4ck46Oig==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h4 class="card-title">Data Pasien Poliklinik [RME]</h4>
            </div>
            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">NoRekamMedis</label>
                                <input type="text" name="norm" id="norm" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien</label>
                                <input type="text" name="patientname" id="patientname" class="form-control filter-input" autocomplete="off">

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

            <div class="mt-5 table-responsive viewdata"></div>
        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    // $('select2').select2({
    //     theme: 'bootstrap4',
    // });

    function dataRegisterPoli() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/ambildataRMEMedis') ?>",
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

        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/caridataregisterpoliRMEMEdis') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                poli: poli
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