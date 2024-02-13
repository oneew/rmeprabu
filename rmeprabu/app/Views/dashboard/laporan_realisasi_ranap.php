<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Laporan Realisasi Rawat Inap Pasien JKN Non TMO</h4>
            </div>
            <form action="#">
                <div class="form-body">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Tanggal Realisasi</label>
                            <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">

                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-info" id="carifaktur" type="button"><i class="fas fa-search"></i></button>
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

            url: "<?php echo base_url('LaporanGudangFarmasi/ambildataDTPBF2') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataDTPBF();

    });

    //$('.filter-input').on('input apply.daterangepicker', function() {
    $('#carifaktur').click(function(e) {
        e.preventDefault();

        let DateOut = $('#DateOut').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('LapRealisasi/caridataRealisasi') ?>",
            dataType: "json",
            data: {

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