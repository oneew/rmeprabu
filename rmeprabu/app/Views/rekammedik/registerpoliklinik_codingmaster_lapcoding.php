<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Data Master Pasien</h4>
            </div>

            <form action="#">
                <div class="form-body">

                    <div class="row pt-3">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">NoRekamMedis</label>
                                <input type="text" name="norm" id="norm" class="form-control filter-input" placeholder="Nomor RekamMedis" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Pulang</label>
                                <input type="text" name="dateOut" id="dateOut" class="form-control daterange filter-input" autocomplete="off">
                            </div>

                            <!-- <div class="form-group">
                                <label class="control-label">Tanggal Coding</label>
                                <input type="text" name="crated_at" id="created_at" class="form-control daterange filter-input" autocomplete="off">
                            </div> -->
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

            url: "<?php echo base_url('RekMedCodingMaster/ambildataLapCoding') ?>",
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

        let patientname = $('#patientname').val();
        let norm = $('#norm').val();
        let metodepembayaran = $('#metodepembayaran').val();
        let dateOut = $('#dateOut').val();
        // let created_at = $('#created_at').val();
        // let dateIn = $('#dateIn').val();


        $.ajax({
            type: "post",
            url: "<?php echo base_url('RekMedCodingMaster/caridataregisterpoliLapCoding') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                dateOut: dateOut
                // created_at: created_at
                // dateIn: dateIn
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>


<?= $this->endSection(); ?>