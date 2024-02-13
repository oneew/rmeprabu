<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    ;
</style>

<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">

<div id="modalpinjamfotoradiologi" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Informasi Peminjaman Foto Radiologi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->
                    <?php
                    foreach ($pasienlama as $pasien) :
                    ?>
                        <div class="col-lg-3 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $tgllahir = $tanggallahir;
                                    $dob = strtotime($tgllahir);
                                    $current_time = time();
                                    $age_years = date('Y', $current_time) - date('Y', $dob);
                                    $age_months = date('m', $current_time) - date('m', $dob);
                                    $age_days = date('d', $current_time) - date('d', $dob);

                                    if ($age_days < 0) {
                                        $days_in_month = date('t', $current_time);
                                        $age_months--;
                                        $age_days = $days_in_month + $age_days;
                                    }

                                    if ($age_months < 0) {
                                        $age_years--;
                                        $age_months = 12 + $age_months;
                                    }

                                    $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";
                                    if (($jeniskelamin == 'L') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecillaki.jpeg';
                                    } else if (($jeniskelamin == 'P') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecilperempuan.jpeg';
                                    } else if (($jeniskelamin == 'L') and ($age_years >= 6) and ($age_years <= 12)) {
                                        $gambar = base_url() . '/assets/images/users/remajapria.jpeg';
                                    } else if (($jeniskelamin == 'P') and ($age_years >= 6) and ($age_years <= 12)) {

                                        $gambar = base_url() . '/assets/images/users/remajaperempuan.jpeg';
                                    } else if (($jeniskelamin == 'L') and ($age_years >= 13) and ($age_years <= 59)) {
                                        $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                                    } else if (($jeniskelamin == 'P') and ($age_years >= 13) and ($age_years <= 59)) {

                                        $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                                    } else if (($jeniskelamin == 'L') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/priatua.jpeg';
                                    } else if (($jeniskelamin == 'P') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/wanitatua.jpeg';
                                    }
                                    ?>
                                    <div class="mt-4 text-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                        <h4 class="card-title mt-2"><?= $pasien['relationname']; ?></h4>
                                        <h6 class="card-subtitle text-dark"><b><?= $pasien['name']; ?></b></h6>
                                        <h6 class="card-subtitle"><?= $pasien['doktername']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['paymentmethodname']; ?></h6>

                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="card-body"> <small class="text-muted">Alamat </small>
                                    <h6><?= $alamat; ?></h6> <small class="text-muted pt-4 d-block">NIK</small>
                                    <h6></h6> <small class="text-muted pt-4 d-block">No Asuransi</small>
                                    <h6><?= $nokartu; ?></h6>
                                    <div class="map-box"></div>

                                    <small class="text-muted pt-4 d-block">Tanggal Lahir</small>

                                    <h6>
                                        <?= $tanggallahir; ?> </h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-12">
                            <div class="card">
                                <div class="modal-body">
                                    <div id="form-filter-bawah" style="display: block;">
                                        <div class="text-center">
                                            <?= form_open('PelayananRadiologi/simpandataPinjam', ['class' => 'formperawat']); ?>
                                            <?= csrf_field(); ?>
                                            <form action="#">
                                                <div class="form-body">
                                                    <div class="row pt-3">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">No Expertise/ Foto</label>
                                                                <input type="text" autocomplete="off" id="expertisepinjam" name="expertisepinjam" class="form-control" required value="<?= $pasien['expertiseid']; ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">Unit/ ruangan Peminjam</label>
                                                                <select name="asalpeminjam" id="asalpeminjam" class="select2" style="width: 100%;">
                                                                    <?php foreach ($unit as $unit) : ?>
                                                                        <option value="<?= $unit['name']; ?>"><?= $unit['name']; ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Tanggal Pinjam</label>
                                                                <input type="text" autocomplete="off" id="datepicker-autoclose" name="pinjamdate" class="form-control" required value="<?= date('d/m/Y'); ?>">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-3">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">Nama Peminjam</label>
                                                                <input type="text" id="peminjamname" name="peminjamname" class="form-control" required onkeyup="this.value = this.value.toUpperCase()">
                                                                <input type="hidden" id="statuspinjam" name="statuspinjam" class="form-control" value="0">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-actions text-right">
                                                    <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                                                        Simpan</button>
                                                    <button type="button" class="btn btn-inverse">Batal</button>
                                                </div>
                                                <?= form_close() ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="modal-body">
                                    <div class="table-responsive mt-4">
                                        <h4 class="card-title-center">Histori Peminjaman Foto/ Expertise</h4>
                                    </div>
                                    <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasien['relation']; ?>" readonly>
                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $pasien['journalnumber']; ?>" readonly>
                                    <input type="hidden" id="expertiseid" name="expertiseid" class="form-control" value="<?= $pasien['expertiseid']; ?>" readonly>
                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>" readonly>

                                    <div class="table-responsive viewpinjam">

                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                    <!-- Column -->
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="viewmodalbaru" style="display:none;"></div>

<script>
    function datakunjungan() {
        $.ajax({

            url: "<?php echo base_url('PelayananRadiologi/HistoriPinjam') ?>",
            data: {
                expertiseid: $('#expertiseid').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewpinjam').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datakunjungan();


    });
</script>

<script>
    jQuery('#datepicker-autoclose').datepicker({
        dateFormat: "dd/mm/yy",
        autoclose: true,
        todayHighlight: true
    });

    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {


            days: 6
        }
    });
</script>
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
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
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


<script>
    $(document).ready(function() {
        $('.formperawat').submit(function(e) {
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
                        if (response.error.peminjamname) {
                            $('#peminjamname').addClass('form-control-danger');
                            $('.peminjamname').html(response.error.peminjamname);
                        } else {
                            $('#peminjamname').removeClass('form-control-danger');
                            $('.errorpeminjamname').html('');
                        }



                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                datakunjungan();
                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>