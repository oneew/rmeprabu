<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Laporan Rekap Kunjungan Rawat Inap</h4>
            </div>
            <form action="#">
                <div class="form-body">

                    <div class="row pt-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Dokter</label>
                                <select name="doktername" id="doktername" class="select2" style="width: 100%">
                                    <option value="">Pilih Dokter</option>
                                    <?php foreach ($dokter as $dpjp) { ?>
                                        <option value="<?= $dpjp['name']; ?>" class="select-dokter"><?= $dpjp['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-5">
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

            url: "<?php echo base_url('RekMedReKu/ambildataRekapKunjunganRanap') ?>",
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

        let doktername = $('#doktername').val();
        let metodepembayaran = $('#metodepembayaran').val();
        let DateOut = $('#DateOut').val();


        $.ajax({
            type: "post",
            url: "<?php echo base_url('RekMedReKu/caridataregisterpoliRekapKunjunganRanap') ?>",
            dataType: "json",
            data: {
                doktername: doktername,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>



<?= $this->endSection(); ?>