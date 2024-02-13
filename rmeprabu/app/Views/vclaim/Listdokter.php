<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Dokter</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="control-label">Jenis Pelayanan</label>
                                <select name="filter" id="filter" class="form-control custom-select">
                                    <option value="1">Rawat Inap</option>
                                    <option value="2">Rawat Jalan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="control-label">Spesialis/ Sub Spesialis</label>
                                <input type="text" class="form-control filter-input" name="spesialis" id="spesialis">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Tanggal Pelayanan</label>
                            <div class="input-group">
                                <input type="text" class="form-control filter-input" name="tglPelayanan" id="tglPelayanan" value="<?= date('Y-m-d'); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="icon-calender"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive viewfaskes"></div>
        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>
<script>
    $('.filter-input').on('change', function() {
        let tglPelayanan = $('#tglPelayanan').val();
        let filter = $('#filter').val();
        let spesialis = $('#spesialis').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/referensiDokterVclaim') ?>",
            dataType: "json",
            data: {
                tglPelayanan: tglPelayanan,
                filter: filter,
                spesialis: spesialis
            },
            success: function(response) {
                $('.viewfaskes').html(response.data);

            }
        });
    });
</script>
<?= $this->endSection(); ?>