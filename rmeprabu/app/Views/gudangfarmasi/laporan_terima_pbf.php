<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Laporan Penerimaan Barang Dari Supplier(PBF)</h4>
            </div>
            <form action="#">
                <div class="form-body">
                    <div class="row pt-1">
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label">Tanggal Terima</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label">Kategori Filter</label>
                                <select name="kategori" id="kategori" class="select2" style="width: 100%" required>
                                    <option value="1">Tanggal Terima</option>
                                    <option value="2">Tanggal Faktur</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label">Supplier</label>
                                <select name="namasupplier" id="namasupplier" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Supplier</option>
                                    <?php foreach ($supplier as $b) : ?>
                                        <option value="<?php echo $b['name']; ?>"><?php echo $b['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label">Kelompok</label>
                                <select name="groups" id="groups" class="select2" style="width: 100%">
                                    <option value="">Pilih Kelompok</option>
                                    <?php foreach ($kelompok as $kl) : ?>
                                        <option value="<?= $kl['name']; ?>"><?= $kl['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label">Nama Obat</label>
                                <input type="text" name="namaobat" id="namaobat" class="form-control" autocomplete="off">
                                <input type="hidden" name="name" id="name" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-info" id="carifaktur" type="button"><i class="fas fa-search"></i></button>
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
            beforeSend: function() {
                $('.viewdata').empty();
                $('.viewdata').html(`<div class="text-center text-danger h5">...processing....</div>`);
            },
            url: "<?php echo base_url('LaporanGudangFarmasi/ambildataDTPBF') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        // dataDTPBF();

    });

    //$('.filter-input').on('input apply.daterangepicker', function() {
    $('#carifaktur').click(function(e) {
        e.preventDefault();

        let namasupplier = $('#namasupplier').val();
        let DateOut = $('#DateOut').val();
        let groups = $('#groups').val();
        let namaobat = $('#name').val();
        let kategori = $('#kategori').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanGudangFarmasi/caridataDTPBF') ?>",
            dataType: "json",
            data: {
                namasupplier: namasupplier,
                DateOut: DateOut,
                groups: groups,
                namaobat: namaobat,
                kategori: kategori
            },
            beforeSend: function() {
                $("#carifaktur").attr("disabled", true);
                $('.viewdata').empty();
                $('.viewdata').html(`<div class="text-center text-danger h5 font-weight-bold">...Sedang Mengambil Data....</div>`);
            },
            success: function(response) {
                $('.viewdata').html(response.data);
                $("#carifaktur").removeAttr("disabled");
            }
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

        $("#namaobat").autocomplete({
            source: "<?php echo base_url('MasterObat/ajax_nama_obat'); ?>",
            select: function(event, ui) {
                $('#namaobat').val(ui.item.value);
                $('#code').val(ui.item.code);
                $('#uom').val(ui.item.uom);
                $('#name').val(ui.item.name);

            }
        });
    });
</script>


<?= $this->endSection(); ?>