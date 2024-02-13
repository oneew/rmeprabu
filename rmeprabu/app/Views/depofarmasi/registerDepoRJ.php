<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Data Pelayanan Farmasi Pasien Rawat Jalan</h4>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nomor Rekam Medis</label>
                                <input type="text" name="norm" id="norm" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien</label>
                                <input type="text" name="namapasien" id="namapasien" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Pelayanan</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            
            <button type="button" class="btn btn-warning btn-refresh mb-3">Refresh Data</button>

            <div class="table-responsive viewdata">
            </div>
        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterDDA() {
        $.ajax({

            url: "<?php echo base_url('FarmasiPelayananRajal/ambildataDFPRajal') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterDDA();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let norm = $('#norm').val();
        let namapasien = $('#namapasien').val();
        let DateOut = $('#DateOut').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananRajal/caridataDFPR') ?>",
            dataType: "json",
            data: {
                norm: norm,
                namapasien: namapasien,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });

    $('.btn-refresh').click(function(){
        $.ajax({
            url: "<?php echo base_url('FarmasiPelayananRajal/ambildataDFPRajal') ?>",
            dataType: "json",
            beforeSend: function() {
                $('.btn-refresh').attr('disabled', true);
                $('.btn-refresh').html('<i class="fa fa-spin fa-spinner "></i>');
            },
            complete: function() {
                $('.btn-refresh').removeAttr('disabled');
                $('.btn-refresh').html('Refresh Data');
            },
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    })
</script>

<?= $this->endSection(); ?>