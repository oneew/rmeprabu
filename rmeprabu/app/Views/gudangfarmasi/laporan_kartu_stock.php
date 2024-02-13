<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Kartu Stock</h4>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-1">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Kode Barang</label>
                                <input type="text" name="kode" id="kode" class="form-control filter-input" autocomplete="off">
                                <input type="hidden" name="code" id="code" class="form-control filter-input" autocomplete="off">
                                <input type="hidden" name="classroom" id="classroom" class="form-control" autocomplete="off" value="1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-input-group">
                                <label class="control-label">Tanggal Terima</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                            </div>

                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-info" id="caristok" type="button"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="#">
                <div class="form-body">
                    <div class="row pt-1">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Lokasi : Gudang Farmasi</label>
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
    function dataDTPBF() {
        $.ajax({

            url: "<?php echo base_url('LaporanGudangFarmasi/ambildataKartuStock') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataDTPBF();

    });

    $('.filter-input2').on('input apply.daterangepicker', function() {

        let code = $('#code').val();
        let DateOut = $('#DateOut').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanGudangFarmasi/caridataKartuStock') ?>",
            dataType: "json",
            data: {
                code: code,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var kelas = document.getElementById("classroom").value;
        $("#kode").autocomplete({
            source: "<?php echo base_url('LaporanGudangFarmasi/ajax_obat'); ?>?kelas=" + kelas,
            select: function(event, ui) {
                $('#kode').val(ui.item.value);
                $('#code').val(ui.item.code);
            }
        });
    });
</script>

<script>
    //$('.filter-input').on('change', function() {
    $('#caristok').click(function(e) {
        e.preventDefault();

        let code = $('#code').val();
        let DateOut = $('#DateOut').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanGudangFarmasi/caridataKartuStock') ?>",
            dataType: "json",
            data: {
                code: code,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<?= $this->endSection(); ?>