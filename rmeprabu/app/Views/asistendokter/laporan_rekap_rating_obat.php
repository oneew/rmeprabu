<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h4 class="card-title">Laporan Rating Pemberian Resep Obat</h4>
            </div>
            <form action="#">
                <div class="form-body">
                    <div class="row pt-1">
                        <div class="col-md-3">
                            <label class="control-label">Tanggal Pelayanan</label>
                            <div class="input-group">

                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-info caridata" id="btn-cari" type="button">Cek!</button>
                                </div>
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

            url: "<?php echo base_url('AsistenDokter/ambildataRekapRatingObat') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataDTPBF();

    });
    $('.caridata').click(function(e) {
        e.preventDefault();
        let DateOut = $('#DateOut').val();
        $.ajax({
            url: "<?php echo base_url('AsistenDokter/caridataRekapRatingObat') ?>",
            type: 'POST',
            data: {
                DateOut: DateOut
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>


<?= $this->endSection(); ?>