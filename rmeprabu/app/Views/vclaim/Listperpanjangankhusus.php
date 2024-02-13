<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">List Data Rujukan Khusus</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="control-label">Bulan</label>
                                <select name="filter" id="filter" class="select2" style="width: 100%;">
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">Nopember</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Tahun</label>
                            <div class="input-group">
                                <input type="number" class="form-control filter-input" name="tahun" id="tahun" value="2021">

                                <div class="input-group-append">
                                    <button class="btn btn-info" id="cariKunjungan" type="button"><i class="fas fa-search"></i> Cari</button>
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
    $('#cariKunjungan').click(function(e) {
        e.preventDefault();
        let tahun = $('#tahun').val();
        let filter = $('#filter').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/DataRujukanKhusus') ?>",
            type: 'POST',
            data: {
                tahun: tahun,
                filter: filter
            },
            dataType: "json",
            success: function(response) {

                if (response.success) {
                    $('.viewfaskes').html(response.data);
                } else {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        icon: 'warning',
                        title: 'Perhatian',
                        text: response.pesan,
                    });
                    $('.viewfaskes').html(response.data);
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>