<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Induk Kecelakaan</h4>
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
                                            <div class="input-group">
                                                <label class="control-label"></label>
                                                <input type="text" name="noKartu" id="noKartu" class="form-control filter-input" placeholder="Input NoKa" autocomplete="off">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" id="cariinduk" type="button"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">

                            <div class="table-responsive viewdatainduk"></div>

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
    $('#cariinduk').click(function(e) {
        e.preventDefault();
        let filter = $('#noKartu').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/dataIndukKecelakaan') ?>",
            type: 'POST',
            data: {
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