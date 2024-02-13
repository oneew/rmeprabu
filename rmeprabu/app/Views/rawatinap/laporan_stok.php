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
                        <div class="col-md-3">
                            <div class="form-group">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nama</label>
                                <input type="text" id="namaobat" autocomplete="off" name="namaobat" class="form-control filter-input">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Lokasi</label>
                                <input type="text" id="locationcode" autocomplete="off" name="locationcode" value="<?= session()->get('locationcode'); ?>" class="form-control filter-input" readonly>
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

        let locationcode = $('#locationcode').val();
        let types = $('#types option:selected').val();
        let namaobat = $('#namaobat').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanFarmasiCL/caridataStok') ?>",
            dataType: "json",
            data: {
                locationcode: locationcode,
                types: types,
                namaobat: namaobat
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>



<?= $this->endSection(); ?>