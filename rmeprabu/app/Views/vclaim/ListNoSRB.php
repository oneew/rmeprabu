<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data No SRB</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-2">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="nomorSrb" id="nomorSrb" class="form-control" autocomplete="off" placeholder="No SRB">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="noSep" id="noSep" class="form-control" autocomplete="off" placeholder="No Sep">
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="cariSRB" type="button"><i class="fas fa-search"></i> Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive viewsep"></div>
        </div>
    </div>
</div>
</div>



<script>
    $('#cariSRB').click(function(e) {
        e.preventDefault();
        let nomorSrb = $('#nomorSrb').val();
        let noSep = $('#noSep').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/check_ListNoPRB') ?>",
            type: 'POST',
            data: {
                nomorSrb: nomorSrb,
                noSep: noSep
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,

                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: response.pesan,
                    });

                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>