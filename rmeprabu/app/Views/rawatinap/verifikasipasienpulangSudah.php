<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12" >
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Data Pasien Pulang Rawat Inap Sudah Verifikasi</h4>
            </div>

            <form action="#">
                <div class="form-body">

                    <div class="row pt-3">
                       
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Tanggal Verifikasi</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
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

<div class="viewmodalpindah" style="display:none;"></div>
<script>
    function dataRegisterPoli() {
        $.ajax({

            url: "<?php echo base_url('PelayananRanap/ambildataVerifikasiSudah') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterPoli();

    });
    $('.filter-input').on('input apply.daterangepicker', function() {

 
        let DateOut = $('#DateOut').val();
    

        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/caridatapasienVerifikasiSudah') ?>",
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