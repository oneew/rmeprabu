<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">LAPORAN REKAP PEMAKAIAN PSIKOTROPIKA PER-PASIEN</h4>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-1">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Lokasi Pelayanan</label>
                                <select name="locationcode" id="locationcode" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Lokasi</option>
                                    <?php foreach ($lokasi as $l) : ?>
                                        <option value="<?php echo $l['code']; ?>" class="select-smf"><?php echo $l['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Pelayanan</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-info" id="caripenjualan" type="button"><i class="fas fa-search"></i></button>
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
    function dataDTPBF() {
        $.ajax({

            url: "<?php echo base_url('LaporanGudangFarmasi/ambildataRekapResepPsiko') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataDTPBF();

    });

    $('#caripenjualan').click(function(e) {
        e.preventDefault();


        let DateOut = $('#DateOut').val();
        let locationcode = $('#locationcode').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanGudangFarmasi/caridataRekapResepPsiko') ?>",
            dataType: "json",
            data: {
                DateOut: DateOut,
                locationcode: locationcode
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<?= $this->endSection(); ?>