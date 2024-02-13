<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Suplesi Jasa Raharja</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>
            <form action="#">
                <div class="form-body">
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-12 col-md-12">
                            <form action="#">
                                <div class="form-body">

                                    <div class="row pt-3">
                                        <div class="col-md-3">
                                            <div class="form-group has-success">
                                                <label class="control-label">No Kartu</label>
                                                <input type="text" name="noKartu" id="noKartu" class="form-control filter-input" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <div class="col-md-12">
                                                    <label class="control-label">Tanggal Pelayanan</label>
                                                    <input type="text" name="rencanakontrol" id="rencanakontrol" class="form-control daterange filter-input" autocomplete="off">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group has-success">
                                                <label class="control-label"></label>
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" id="caripeserta" type="button"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive viewdatasuplesi"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    $('.filter-input2').on('input apply.daterangepicker', function() {
        let rencanakontrol = $('#rencanakontrol').val();
        let filter = $('#noKartu').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/dataSuplesiJR') ?>",
            dataType: "json",
            data: {
                rencanakontrol: rencanakontrol,
                filter: filter
            },
            success: function(response) {
                if (response.success) {
                    $('.viewdatasuplesi').html(response.data);
                } else {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        icon: 'error',
                        title: 'error'
                    });
                    $('.viewpeserta').html(response.data);
                }

            }
        });
    });
</script>


<script>
    $('#caripeserta').click(function(e) {
        e.preventDefault();
        let rencanakontrol = $('#rencanakontrol').val();
        let filter = $('#noKartu').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/dataSuplesiJR') ?>",
            type: 'POST',
            data: {
                rencanakontrol: rencanakontrol,
                filter: filter
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewdatasuplesi').html(response.data);
                } else {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        icon: 'error',
                        title: 'error'
                    });
                    $('.viewpeserta').html(response.data);
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>