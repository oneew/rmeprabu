<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row px-3">
                <h4 class="card-title">Data Pelayanan Radiologi</h4>
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="row pt-3">
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
                        <label class="control-label">Pembayaran</label>
                        <select name="metodepembayaran" id="metodepembayaran" class="select2 filter-input" style="width: 100%">
                            <option value="">Pembayaran</option>
                            <?php foreach ($list as $b) : ?>
                                <option value="<?php echo $b['name']; ?>"><?php echo $b['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Tgl Pelayanan</label>
                        <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="cariPasien"><i class="fas fa-search"></i></button>
            <div class="table-responsive mt-4 viewdatarad">
                
            </div>
        </div>
    </div>
</div>

<script>
    function dataRegisterPoli() {
        $.ajax({
            url: "<?php echo base_url('PasienRadiologi/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdatarad').html(response.data);
            }
        });
    }

    $(document).ready(function(){

        dataRegisterPoli();
        
        setInterval(() => {
            dataRegisterPoli(); 
        }, 15000);

        $("#norm").attr("readonly", false);
        $("#patientname").attr("readonly", false);
        $("#metodepembayaran").attr("readonly", false);
        $("#DateOut").attr("readonly", false);
        $("#DateOut").val("");
    })

    $('#cariPasien').click(function(e) {
        e.preventDefault();

        let patientname = $('#patientname').val();
        let norm = $('#norm').val();
        let metodepembayaran = $('#metodepembayaran').val();
        let DateOut = $('#DateOut').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('PasienRadiologi/caridatapasien') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
            },
            beforeSend: function() {
                $('#cariPasien').attr('disabled', true);
                $('#cariPasien').html('<i class="fa fa-spin fa-spinner "></i>');
            },
            complete: function() {
                $('#cariPasien').removeAttr('disabled');
                $('#cariPasien').html('<i class="fas fa-search"></i>');
            },
            success: function(response) {
                $('.viewdatarad').html(response.data);

            }
        });
    });
</script>

<?= $this->endSection(); ?>