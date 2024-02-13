<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Laporan Penerimaan Distribusi Barang</h4>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-1">
                        <div class="col-md-6">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Diterima Oleh</label>
                                <select name="referencelocationcode" id="referencelocationcode" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih</option>
                                    <?php foreach ($lokasi as $b) : ?>
                                        <option value="<?php echo $b['code']; ?>"><?php echo $b['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Terima</label>
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
    function dataDistribusi() {
        $.ajax({

            url: "<?php echo base_url('AmprahFarmasiRuanganIBS/ambildataDistribusi') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataDistribusi();

    });

    $('.filter-input').on('input apply.daterangepicker', function() {

        let referencelocationcode = $('#referencelocationcode').val();
        let DateOut = $('#DateOut').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('AmprahFarmasiRuanganIBS/caridataDistribusi') ?>",
            dataType: "json",
            data: {
                referencelocationcode: referencelocationcode,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<?= $this->endSection(); ?>