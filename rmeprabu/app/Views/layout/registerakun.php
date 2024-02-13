<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="login-box card">
    <div class="card-body">
        <?php if (session()->get('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->get('success') ?>
            </div>

        <?php endif; ?>


        <form class="form-horizontal form-material" id="loginform" method="post" action="<?= base_url(); ?>/UsersAkun/register">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 text-center">
                <div class="social">
                    <h3 class="p-2 rounded-title mb-3"><b>Register</b> Aplikasi SIMRS</h3>
                </div>
            </div>

            <?= csrf_field(); ?>

            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control" type="text" name="firstname" id="firstname" autocomplete="off" value="<?= set_value('firstname'); ?>" placeholder="Nama lengkap">
                    <input class="form-control" type="hidden" name="lastname" id="lastname" autocomplete="off" value="NONE" placeholder="Alias ">
                </div>
            </div>
            <div class="form-group ">
                <div class="col-xs-12">
                    <input class="form-control" type="text" name="email" id="email" value="<?= set_value('email'); ?>" autocomplete="off" placeholder="email">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="password" name="password" id="password" value="" placeholder="Password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <input class="form-control" type="password" name="password_confirm" id="password_confirm" value="" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <select name="locationname" id="locationname" class="select2" style="width: 100%" required>
                        <option value="">Pilih Lokasi</option>
                        <?php foreach ($lokasi as $l) : ?>
                            <option data-id="<?= $l['id']; ?>" class="select-smf"><?php echo $l['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" readonly placeholder="Kode Lokasi">
                </div>
            </div>

            <div class="form-group">
                <div class="col-xs-12">
                    <select name="level" id="level" class="select2" style="width: 100%" required>
                        <option value="">Pilih Akses Modul</option>
                        <?php foreach ($levelakses as $level) : ?>
                            <option value="<?= $level['code']; ?>" class="select-level"><?php echo $level['name']; ?></option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>

            <?php if (isset($validation)) : ?>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors() ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group text-center mt-3">
                <div class="col-xs-12">
                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Register</button>
                </div>
            </div>

        </form>

    </div>
</div>

<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();

        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#locationname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_lokasi') ?>",
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

</body>

<?= $this->endSection(); ?>