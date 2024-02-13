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

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Diterima Oleh</label>
                                <input type="text" name="referencelocationcode" id="referencelocationcode" class="form-control" autocomplete="off" readonly value="<?= session()->get('locationcode'); ?>">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Terima</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-info" id="cariklaim" type="button"><i class="fas fa-search"></i></button>
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

            url: "<?php echo base_url('AmprahFarmasiRuanganRanap/ambildataDistribusi') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataDistribusi();

    });
    $('#cariklaim').click(function(e) {
        e.preventDefault();

        //$('.filter-input').on('input apply.daterangepicker', function() {

        let referencelocationcode = $('#referencelocationcode').val();
        let DateOut = $('#DateOut').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('AmprahFarmasiRuanganRanap/caridataDistribusi') ?>",
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