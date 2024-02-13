<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Laporan Stok Barang</h4>
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
                                <label class="control-label">Lokasi</label>
                                <select name="locationcode" id="locationcode" class="form-control-select2 filter-input" style="width: 100%">
                                    <option>Pilih Lokasi</option>
                                    <?php foreach ($lokasi as $l) : ?>
                                        <option value="<?php echo $l['code']; ?>" class="select-smf"><?php echo $l['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Jenis</label>
                                <select name="types" id="types" class="form-control-select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Jenis</option>
                                    <?php foreach ($kelompok as $k) : ?>
                                        <option value="<?php echo $k['name']; ?>" class="select-smf"><?php echo $k['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
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
    $('.filter-input').on('change', function() {

        let locationcode = $('#locationcode option:selected').val();
        let types = $('#types option:selected').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanApotekFarmasi/caridataStok') ?>",
            dataType: "json",
            data: {
                locationcode: locationcode,
                types: types
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>



<?= $this->endSection(); ?>