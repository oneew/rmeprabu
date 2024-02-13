<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h4 class="card-title">Laporan Rating Penggunaan Obat/AKHP/BHP di Ruangan <?php echo session()->get('locationname'); ?></h4>
            </div>
            <form action="#">
                <div class="form-body">
                    <div class="row pt-1">
                        <div class="col-md-3">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="cariobat" type="button"><i class="fas fa-search"></i> Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive viewdata"></div>
        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataDTPBF() {
        $.ajax({

            url: "<?php echo base_url('LaporanFarmasiRuangan/ambildataRekapRatingObat') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataDTPBF();

    });

    $('#cariobat').click(function(e) {
        e.preventDefault();
        let DateOut = $('#DateOut').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanFarmasiRuangan/caridataRekapRatingObat') ?>",
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

<?= $this->endSection(); ?>