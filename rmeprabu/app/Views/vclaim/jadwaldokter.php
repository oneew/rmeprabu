<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Jadwal Dokter</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data HFIS)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Pelayanan</label>
                                <select name="poli" id="poli" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Poliklinik</option>
                                    <?php foreach ($poli as $p) : ?>
                                        <option value="<?php echo $p['bpjscode']; ?>"><?php echo $p['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
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
            <div class="table-responsive viewhfis"></div>
        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    $('.filter-input').on('change', function() {
        let jnsPelayanan = $('#poli').val();
        let tglPelayanan = $('#tglPelayanan').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/referensiDokterHfis') ?>",
            dataType: "json",
            data: {
                jnsPelayanan: jnsPelayanan,
                tglPelayanan: tglPelayanan
            },
            success: function(response) {
                $('.viewhfis').html(response.data);

            }
        });
    });
</script>
<?= $this->endSection(); ?>