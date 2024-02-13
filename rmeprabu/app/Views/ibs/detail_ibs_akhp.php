<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-md-12">
        <div class="card profile-card"> <img class="card-img profile-img" src="<?= base_url(); ?>/assets/images/background/kamaroperasi.jpg" alt="Card image">
            <div class="card-img-overlay card-inverse social-profile d-flex justify-content-center">
                <?php


                if ($pasiengender == 'L') {


                    $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                } else {
                    $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                }

                ?>
                <div class="align-self-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                    <h4 class="card-title"><?= $pasienname; ?><button class="btn btn-outline-info waves-effect waves-light" type="button" onclick="ubah('<?= $id ?>')"><i class="fa fa-edit"></i></button>

                    </h4>
                    <h4 class="card-title"><?= $pasienid; ?>
                    </h4>
                    <h6 class="card-subtitle"><?= $email; ?></h6>
                    <p class="text-white"><?= $pasienaddress; ?> <?= $pasiensubareaname; ?></p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <small class="text-muted">Cara Bayar</small>
                <h6><?= $paymentmethodname; ?></h6>
                <small class="text-muted mt-2 d-block">Kartu Asusuransi</small>
                <h6><?= $paymentcardnumber; ?></h6>
                <small class="text-muted mt-2 d-block">No. Registrasi IBS</small>
                <h6><?= $journalnumber; ?> <?= ' _ '; ?>Tanggal Registrasi : <?= $documentdate; ?></h6>
                <small class="text-muted mt-2 d-block">Dokter Penanggung Jawab</small>
                <h6><?= $doktername; ?><?= ' _ '; ?>SMF : <?= $smfname; ?></h6>
                <small class="text-muted mt-2 d-block">Dokter Operator</small>
                <h6><?= $ibsdoktername; ?><?= ' _ '; ?>Anestesi : <?= $ibsanestesiname; ?></h6>
                <small class="text-muted mt-2 d-block">Ruang & Kelas Perawatan</small>
                <h6><?= $roomname; ?><?= ' _ '; ?>Kelas : <?= $classroomname; ?></h6>
                <small class="text-muted mt-2 d-block">Diagnosa</small>
                <h6><?= $icdxname; ?><?= ' _ '; ?>Kode ICD X : <?= $icdx; ?></h6>
                <small class="text-muted mt-2 d-block">Catatan</small>
                <h6><?= $memo; ?></h6>
                <small class="text-muted pt-4 d-block">Kirim Email</small>
                <button class="btn btn-outline-warning waves-effect waves-light" type="button"><span class="mr-1"><i class="far fa-envelope"></i></span>Mail</button>
                <button class="btn btn-info" type="button" onclick="AKHPBHP('<?= $id ?>')"><span class="mr-1"><i class="fas fa-parachute-box"></i></span>AKHP & BHP</button>
                <input type="text" id="journalnumber2" name="journalnumber2" class="form-control" value="<?= $journalnumber; ?>" readonly>

            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Resume Pemakaian AKHP BHP</a>
                </li>

            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="profiletimeline position-relative">

                            <div class="sl-item mt-2 mb-3">
                                <div class="sl-left float-left mr-3"> <img src="<?= base_url(); ?>/assets/images/users/catatan.png" alt="user" class="rounded-circle"> </div>
                                <div class="sl-right">
                                    <div><a href="#" class="link">Data Pemakaian AKHP BHP</a> <span class="sl-date text-muted">
                                            <blockquote class="mt-2">
                                                <p class="card-text viewdata">
                                                </p>
                                            </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--second tab-->
            </div>
        </div>
    </div>
    <!-- Column -->
</div>

<div class="viewmodalakhp" style="display:none;"></div>
<div class="viewmodal" style="display:none;"></div>

<script>
    function dataperawat() {

        $.ajax({

            url: "<?php echo base_url('FarmasiPelayananAKHP/resumepelayananAKHPCL') ?>",
            data: {
                journalnumber: $('#journalnumber2').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataperawat();


    });
</script>

<script>
    function datahistori() {

        $.ajax({

            url: "<?php echo base_url('rawatinap/ambildatadetailibs_histori') ?>",
            data: {
                pasienid: $('#relation').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata2').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datahistori();


    });
</script>


<script>
    function datahistoritindakan() {

        $.ajax({

            url: "<?php echo base_url('rawatinap/ambildatadetailibs_histori_tindakan') ?>",
            data: {
                pasienid: $('#relation').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata3').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datahistoritindakan();


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
                        if (response.error.doktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        } else {
                            $('#doktername').removeClass('form-control-danger');
                            $('.erroroktername').html('');
                        }

                        if (response.error.name) {
                            $('#name').addClass('form-control-danger');
                            $('.errorname').html(response.error.name);
                        } else {
                            $('#name').removeClass('form-control-danger');
                            $('.errorname').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })


                        dataperawat();
                        datahistoritindakan();
                        $('#name').val('');
                        $('#nameOperasi').val('');
                        $('#price').val('');


                    }
                }


            });
            return false;
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        var kelas = document.getElementById("classroom").value;
        $("#nameOperasi").autocomplete({
            source: "<?php echo base_url('rawatinap/ajax_pelayanan_ibs'); ?>?kelas=" + kelas,
            select: function(event, ui) {
                $('#nameOperasi').val(ui.item.value);
                $('#name').val(ui.item.value);
                $('#code').val(ui.item.code);
                $('#groupname').val(ui.item.groupname);
                $('#priceori').val(ui.item.price);

                $('#category').val(ui.item.category);
                $('#categoryname').val(ui.item.categoryname);
                $('#groups').val(ui.item.groups);
                $('#share1ori').val(ui.item.share1ori);
                $('#share2ori').val(ui.item.share2ori);

            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#doktername').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#doktername option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#doktername').val(data.name);
                    $('#dokter').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })


        $('#doktergeneralname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#doktergeneralname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#doktergeneralname').val(data.name);
                    $('#doktergeneral').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

    });
</script>

<script>
    function ubah(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('rawatinap/formubah'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');

                }
            }

        });


    }
</script>

<script type="text/javascript">
    $('#koinsiden').on('change', function() {
        if ($('#koinsiden').val() == 1) {
            $('#koinsiden').val(0);
            $('#koinsiden2').val(1);

        } else {
            $('#koinsiden').val(1);
            $('#koinsiden2').val(0);
        }
    })
</script>


<script>
    function AKHPBHP(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananAKHP/orderesepranap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalakhp').html(response.sukses).show();
                    $('#modaleresep_ranap').modal('show');
                }
            }
        });
    }
</script>
<?= $this->endSection(); ?>