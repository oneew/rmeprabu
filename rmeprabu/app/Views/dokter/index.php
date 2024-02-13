<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<!-- .row -->
<div class="row">
    <?php foreach ($list as $dokter) { ?>
        <!-- .col -->
        <div class="col-md-6 col-lg-6 col-xl-4">
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-4 col-lg-3 text-center">

                        <?php
                        //pengeceken jika foto dalam database kosong akan menampilkan foto default
                        $foto = !is_null($dokter['foto']) ? $dokter['foto'] : 'default.jpg'; ?>

                        <a data-foto="<?= $dokter['foto']; ?>" data-id="<?= $dokter['code']; ?>" class="btn-form-upload"><img id="foto-<?= $dokter['code']; ?>" src="<?= base_url(); ?>/assets/images/dokter/<?= $foto; ?>" alt="dokter" width="90" class="rounded-circle img-fluid"></a>
                    </div>
                    <div class="col-md-8 col-lg-9 text-center text-md-left">
                        <h6 class="mb-0"><?= $dokter['name']; ?></h6> <small><?= $dokter['locationname']; ?></small>
                        <address>
                            <?= $dokter['address']; ?>
                            <br />
                            <br />
                            <abbr title="Phone">Phone:</abbr> <?= $dokter['telephone']; ?>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    <?php } ?>

</div>

<div class="modal-upload">

</div>

<script type="text/javascript">
    $(document).ready(function() {
        // ajax dengan mengirimkan code dan foto dokter(database)
        $('.btn-form-upload').on('click', function() {
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('doktergallery/upload') ?>",
                data: {
                    code: $(this).data('id'),
                    foto: $(this).data('foto')
                },
                success: function(response) {
                    $('.modal-upload').html(response);
                }
            })
        })
    })
</script>


<?= $this->endSection(); ?>