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
                                <label class="control-label">Nama</label>
                                <input type="text" id="namaobatbaru" autocomplete="off" name="namaobatbaru" class="form-control filter-input">
                                <input type="hidden" id="namaobat" autocomplete="off" name="namaobat" class="form-control filter-input">
                                <input type="hidden" id="code" autocomplete="off" name="code" class="form-control filter-input">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Lokasi</label>
                                <select name="locationcode" id="locationcode" class="form-control-select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Lokasi</option>
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
                        <div class="input-group-append">
                            <button class="btn btn-info" id="caristok" type="button"><i class="fas fa-search"></i></button>
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
    //$('.filter-input').on('change', function() {
    $('#caristok').click(function(e) {
        e.preventDefault();

        let locationcode = $('#locationcode option:selected').val();
        let types = $('#types option:selected').val();
        let namaobat = $('#code').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanGudangFarmasi/caridataStok') ?>",
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

<script type="text/javascript">
    $(document).ready(function() {

        $("#namaobatbaru").autocomplete({
            source: "<?php echo base_url('MasterObat/ajax_nama_obat'); ?>",
            select: function(event, ui) {
                $('#namaobatbaru').val(ui.item.value);
                $('#code').val(ui.item.code);
                $('#uom').val(ui.item.uom);
                $('#namaobat').val(ui.item.name);

            }
        });
    });
</script>


<?= $this->endSection(); ?>