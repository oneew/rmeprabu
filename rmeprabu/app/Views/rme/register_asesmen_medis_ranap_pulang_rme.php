<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h4 class="card-title">Data Pasien Pulang Rawat Inap [RME-ASESMEN MEDIS Rawat Inap]</h4>
            </div>
            <form action="<?= base_url('PelayananRawatJalanRME/caridataRMEMedisRanapPulang') ;?>" method="post" class="d-flex flex-column flex-sm-row" id="form-search">
                <?= csrf_field() ;?>
                <div class="form-group mb-0 mr-2">
                    <label for="norm">No RM</label>
                    <input type="text" class="form-control" id="norm" name="norm">
                </div>
                <div class="form-group mb-0 mr-2">
                    <label for="name">Nama Pasien</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group mb-0 mr-2">
                    <label for="name">DPJP</label>
                    <br>
                    <select name="dpjp" id="dpjp" class="form-control select2 w-100">
                        <option value="">Pilih dpjp</option>
                        <?php foreach ($list_dokter as $item) : ?>
                            <option value="<?= $item['name'] ;?>"><?= $item['name'] ;?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group mb-0 mr-2">
                    <label for="name">Tanggal Pulang</label>
                    <input type="text" class="form-control daterange filter-input" id="dateOut" name="dateOut">
                </div>
                <button class="btn btn-success" id="btn-search"><i class="fas fa-search"></i></button>
            </form>
            <span class="text-muted">Note: Pasien yang muncul sesuai dengan tanggal kepulangan pasien, apa bila tidak muncul silahkan cari menggunakan form di atas.</span>
            <div class="mt-5 table-responsive viewdata"> </div>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterPoli() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/ambildataRMEMedisRanapPulang') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterPoli();
        $('#norm').attr('readonly', false)
        $('#name').attr('readonly', false)
        $('#dateOut').attr('readonly', false)
        $('#dateOut').val(null)

        $('#form-search').submit(function(e){
            e.preventDefault()
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#btn-search').attr('disable', 'disabled');
                    $('#btn-search').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('#btn-search').removeAttr('disable');
                    $('#btn-search').html('<i class="fas fa-search"></i>');
                },
                success: function(response) {
                    $('.viewdata').html(response.data);
                }
            });
            return false;
        })
    });
</script>
<?= $this->endSection(); ?>