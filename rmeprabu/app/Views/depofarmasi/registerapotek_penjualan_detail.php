<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Laporan Penjualan Apotek (Detail Item)</h4>
            </div>
            <form action="#">
                <div class="form-body">

                    <div class="row pt-3">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Apotek</label>
                                <select name="apotek" id="apotek" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Apotek</option>
                                    <?php foreach ($lokasi as $lok) : ?>
                                        <option value="<?php echo $lok['code']; ?>"><?php echo $lok['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
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
                        <div class="col-md-4">
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

            url: "<?php echo base_url('LaporanApotekDetail/ambildataPenjualan') ?>",
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
        let apotek = $('#apotek').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanApotekDetail/caridataregisterpenjualan') ?>",
            dataType: "json",
            data: {
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                apotek: apotek,
            },
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    });
</script>

<?= $this->endSection(); ?>