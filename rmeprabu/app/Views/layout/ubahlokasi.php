<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-lg-12">
    <div class="row">
        <div class="login-box card">
            <div class="card-body">
                <?= form_open('UsersAkun/updatelokasi', ['class' => 'formlokasi']); ?>
                <?= csrf_field(); ?>

                <form class="form-horizontal form-material" id="loginform" method="post">
                    <?= csrf_field(); ?>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="firstname" id="firstname" value="<?= session()->get('firstname'); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" readonly name="email" id="email" value="<?= session()->get('email'); ?>" readonly>
                            <input class="form-control" type="hidden" readonly name="id" id="id" value="<?= $id; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <select name="locationname" id="locationname" class="select2" style="width: 100%" required>
                                <option value="">Pilih Lokasi</option>
                                <?php foreach ($lokasi as $l) : ?>
                                    <option data-id="<?= $l['locationcode']; ?>" class="select-smf"><?php echo $l['locationname']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden"id="locationcode" name="locationcode" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="form-group text-center mt-3">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light btnsimpan" type="submit">Ubah Lokasi</button>
                        </div>
                    </div>

                </form>
                <?= form_close() ?>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#locationname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_lokasi_user') ?>",
                'data': {
                    key: $('#locationname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#locationname').val(data.name);
                    $('#locationcode').val(data.code);
                    $('#autocomplete-dokter').html('');
                }
            })
        })


    });
</script>
<script type="text/javascript">
    function berangkat() {
        window.location.href = "<?php echo base_url('Users/logout'); ?>";
    }
</script>

<script>
    $(document).ready(function() {
        $('.formlokasi').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.locationcode) {
                            $('#locationcode').addClass('form-control-danger');
                            $('.errorlocationcode').html(response.error.locationcode);
                        } else {
                            $('#locationcode').removeClass('form-control-danger');
                            $('.errorlocationcode').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        berangkat();

                    }
                }


            });
            return false;
        });
    });
</script>
<?= $this->endSection(); ?>