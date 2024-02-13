<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    ;
</style>

<div id="modalubahrajal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Upload Digitalisasi Arsip Rekam Medik</h4>
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
                                    $tanggallahir = $pasien['pasiendateofbirth'];
                                    $dob = strtotime($tanggallahir);
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
                                    if (($pasien['pasiengender'] == 'L') and ($age_years <= 5)) {
                                        $gambar = './assets/images/users/anakkecillaki.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years <= 5)) {
                                        $gambar = './assets/images/users/anakkecilperempuan.jpeg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 6) and ($age_years <= 12)) {
                                        $gambar = './assets/images/users/remajapria.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 6) and ($age_years <= 12)) {

                                        $gambar = './assets/images/users/remajaperempuan.jpeg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 13) and ($age_years <= 59)) {
                                        $gambar = './assets/images/users/pasienlaki.jpg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 13) and ($age_years <= 59)) {

                                        $gambar = './assets/images/users/pasienperempuan.jpg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 60)) {

                                        $gambar = './assets/images/users/priatua.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 60)) {

                                        $gambar = './assets/images/users/wanitatua.jpeg';
                                    }
                                    ?>
                                    <div class="mt-4 text-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                        <h4 class="card-title mt-2"><?= $pasien['pasienname']; ?></h4>
                                        <h6 class="card-subtitle"><?= $pasien['poliklinikname']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['doktername']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['paymentmethodname']; ?></h6>

                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="card-body"> <small class="text-muted">Alamat </small>
                                    <h6><?= $pasien['pasienaddress']; ?></h6> <small class="text-muted pt-4 d-block">NIK</small>
                                    <h6><?= $pasien['pasienssn']; ?></h6> <small class="text-muted pt-4 d-block">No Asuransi</small>
                                    <h6><?= $pasien['paymentcardnumber']; ?></h6>
                                    <div class="map-box"></div>

                                    <small class="text-muted pt-4 d-block">Tanggal Lahir</small>

                                    <h6><?= $pasien['pasiendateofbirth']; ?> [<?= $umur; ?>]</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-12">
                            <div class="card">
                                <?= form_open('DigitalisasiRawatJalan/simpanDataArsipRajal', ['class' => 'formperawat']); ?>
                                <?= csrf_field(); ?>
                                <div class="modal-body">
                                    <div class="row pt-1">
                                        <div class="col-md-3">
                                            <div class="form-group">

                                                <input type="hidden" id="pasienid" name="pasienid" class="form-control" readonly value="<?= $pasien['pasienid']; ?>">
                                                <input type="hidden" id="pasienname" name="pasienname" class="form-control" readonly value="<?= $pasien['pasienname']; ?>">
                                                <input type="hidden" id="oldcode" name="oldcode" class="form-control" readonly value="<?= $pasien['oldcode']; ?>">
                                                <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" readonly value="<?= $pasien['journalnumber']; ?>">

                                                <?php
                                                helper('text');
                                                $token = random_string('alnum', 8);
                                                ?>
                                                <input type="hidden" id="token_rajal" name="token_rajal" value="<?= $token; ?>" class="form-control">

                                                <select name="paymentmethodname" id="paymentmethodname" class="form-control" style="width: 100%" required>

                                                    <?php foreach ($cabar as $carabayar) : ?>
                                                        <option data-id="<?= $carabayar['id']; ?>" class="select-cabar" <?php if ($carabayar['name'] == $pasien['paymentmethodname']) { ?> selected="selected" <?php } ?>><?php echo $carabayar['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if ($pasien['paymentmethod'] == "") {
                                                    $cabarasli = 'NONE';
                                                } else {
                                                    $cabarasli = $pasien['paymentmethod'];
                                                }
                                                ?>
                                                <input type="hidden" id="iddaftar" name="iddaftar" class="form-control" value="<?= $pasien['id']; ?>">
                                                <input type="hidden" id="paymentmethodname2" name="paymentmethodname2" class="form-control" value="<?= $pasien['paymentmethodname']; ?>">

                                                <input type="hidden" id="groups" name="groups" class="form-control" value="IRJ">

                                                <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= $pasien['documentdate']; ?>">
                                                <input type="hidden" id="createdBy" name="createdBy" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group">

                                                <input type="text" class="form-control" id="pasiencard" name="pasiencard" placeholder="No.Kartu Asuransi" value="<?= $pasien['paymentcardnumber']; ?>">
                                                <div class="input-group-append">
                                                    <button class="btn btn-info" id="btn-cardrajal" type="button">Cek!</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="poliklinikname" id="poliklinikname" class="form-control" style="width: 100%" required>
                                                    <option value="">Pilih Poli</option>
                                                    <?php foreach ($namasmf as $NSMF) : ?>

                                                        <option data-id="<?= $NSMF['id']; ?>" class="select-smf" <?php if ($NSMF['name'] == $pasien['poliklinikname']) { ?> selected="selected" <?php } ?>><?= $NSMF['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" readonly value="<?= $pasien['poliklinik']; ?>">
                                                <input type="hidden" id="email" name="email" class="form-control" value="deniapriali@gmail.com">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="ibsdoktername" id="ibsdoktername" class="form-control" style="width: 100%">
                                                    <option value>Pilih Dokter Pemeriksa</option>
                                                    <?php foreach ($list as $dpjp) { ?>
                                                        <option data-id="<?= $dpjp['id']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $pasien['doktername']) { ?> selected="selected" <?php } ?>><?= $dpjp['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" name="ibsdokter" id="ibsdokter" value="<?= $pasien['dokter']; ?>">
                                                <div class="form-control-feedback erroribsdoktername">
                                                </div>
                                                <input type="hidden" id="email2" value="pasien@gmail.com" name="email2" class="form-control">
                                                <div class="form-control-feedback errorEmail">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center m-4" id="test">
                                        <div class="col-12">
                                            <div class="row justify-content-center preview mb-3">
                                                <!-- <div class="col-4 preview"></div> -->
                                            </div>
                                        </div>
                                        <div class="col-3 btn btn-large btn-outline-info unggah" data-id="test" data-url="#" data-count="0">Pilih File Arsip Rekam Medis</div>
                                    </div>

                                    <button type="submit" class="btn btn-warning btnsimpanperubahan"><i class="fa fa-check"></i> Simpan </button>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                        <div class="modal-footer">

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



        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // 
                        page: params.page
                    };
                },
                processResults: function(data, params) {

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
            },
            minimumInputLength: 1,

        });
    });
</script>




<script type="text/javascript">
    function berangkat() {
        window.location.href = "<?php echo base_url('RawatJalan'); ?>";
    }
</script>

<script type="text/javascript">
    function berangkatrestore() {
        window.location.href = "<?php echo base_url('RawatJalan/Batal'); ?>";
    }
</script>


<script>
    $(document).ready(function() {

        $('.unggah').on('click', function() {

            let index = $(this).data('count');

            let input = `<div class="col-3 card ml-3 d-none" id="container${index}">
                        <div style="height:100px;">
                            <img src="" id="viewImg${index}" class="img-fluid mh-100" alt="...">
                        </div>
                        <input type="file" name="file-foto[]" class="d-none file-foto" id="input${index}">
                        <button class="btn btn-outline-danger btn-sm mt-1 mb-1 unggah-close">Hapus File</button>
                    </div>`;

            $('#' + $(this).data('id') + ' .preview').append(input);

            $('#input' + index).trigger('click');
            $('#input' + index).on('input', function() {

                $('#viewImg' + index).attr('src', URL.createObjectURL(event.target.files[0]));
                $('#container' + index).removeClass('d-none');
            })

            $(this).data('count', $(this).data('count') + 1);
        })

        $('body').on('click', function(e) {
            if (e.target.classList.contains('unggah-close')) {
                e.target.parentElement.remove();
            }
        })


        $('.formperawat').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            let count = 0;
            $('.file-foto').each(function() {
                formData.append('file', $('.file-foto')[count].files[count]);
                count++;
            })

            let data = $('#file-foto').val();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
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
                        if (response.error.kelompok) {
                            $('#kelompok').addClass('form-control-danger');
                            $('.errorkelompok').html(response.error.kelompok);
                        } else {
                            $('#kelompok').removeClass('form-control-danger');
                            $('.errorkelompok').html('');
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error,

                        })
                        //end
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modalubahrajal').modal('hide');
                            }
                        });

                    }
                }
            });
            return false;
        });
    });
</script>