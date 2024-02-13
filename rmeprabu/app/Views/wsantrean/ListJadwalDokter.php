<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Jadwal Dokter </h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim HFIS)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Jenis Pelayanan</label>
                                <select name="filter" id="filter" class="select2 filter-input" style="width: 100%">
                                    <option>Pilih</option>
                                    <?php foreach ($pelayanan as $PL) : ?>
                                        <option value="<?= $PL['bpjscode']; ?>" class="select-pelayanan"><?= $PL['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Tanggal Pelayanan</label>
                            <div class="input-group">
                                <input type="date" class="form-control filter-input" name="tglPelayanan" id="tglPelayanan" value="<?= date('Y-m-d'); ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="icon-calender"></i>
                                    </span>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="cariJadwal" type="button"><i class="fas fa-search"></i> Cari</button>
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
    $('#cariJadwal').click(function(e) {
        e.preventDefault();
        let tglPelayanan = $('#tglPelayanan').val();
        let filter = $('#filter').val();
        $.ajax({
            url: "<?php echo base_url('WsAntrean/DataJadwalDokter') ?>",
            type: 'POST',
            data: {
                tglPelayanan: tglPelayanan,
                filter: filter
            },
            dataType: "json",
            success: function(response) {
                if (response.gagal) {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        //icon: 'warning',
                        //title: 'Perhatian',
                        //text: response.pesantambahan,
                    });
                    $('.viewfaskes').html('');
                } else {

                    $('.viewfaskes').html(response.data);
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>