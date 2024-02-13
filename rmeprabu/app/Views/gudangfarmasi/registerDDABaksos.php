<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Data Distribusi Barang (Amprah)</h4>
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
                                <label class="control-label">Nomor Surat Distribusi</label>
                                <input type="text" name="nomorpesanan" id="nomorpesanan" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Distribusi Ke</label>
                                <input type="text" id="locationname" name="locationname" class="form-control filter-input">
                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Distribusi</label>
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

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterDDA() {
        $.ajax({

            url: "<?php echo base_url('DistribusiAmprahFarmasiBaksos/ambildataDDA') ?>",
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

        let nomorpesanan = $('#nomorpesanan').val();
        let locationname = $('#locationname').val();
        let DateOut = $('#DateOut').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DistribusiAmprahFarmasiBaksos/caridataDDA') ?>",
            dataType: "json",
            data: {
                nomorpesanan: nomorpesanan,
                locationname: locationname,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>



<?= $this->endSection(); ?>