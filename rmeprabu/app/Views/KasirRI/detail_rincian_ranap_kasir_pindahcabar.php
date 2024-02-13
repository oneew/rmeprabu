<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-md-12">
        <div class="card profile-card"> <img class="card-img profile-img" src="../assets/images/background/kamaroperasi.jpg" alt="Card image">
            <div class="card-img-overlay card-inverse social-profile d-flex justify-content-center">
                <?php


                if ($pasiengender == 'L') {


                    $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                } else {
                    $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                }

                ?>
                <div class="align-self-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                    <h4 class="card-title"><?= $pasienname; ?>
                        <?php if ($statusrawatinap <> "PULANG") { ?>
                            <button class="btn btn-outline-info waves-effect waves-light" type="button" onclick="ubah('<?= $id ?>')"><i class="fa fa-edit"></i></button>
                        <?php } ?>

                    </h4>
                    <h4 class="card-title"><?= $pasienid; ?>
                    </h4>
                    <h6 class="card-subtitle"></h6>
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
                <small class="text-muted mt-2 d-block">No. Registrasi</small>
                <h6><?= $journalnumber; ?> <?= ' _ '; ?>Tanggal Registrasi : <?= $documentdate; ?></h6>
                <small class="text-muted mt-2 d-block">Dokter Penanggung Jawab</small>
                <h6><?= $doktername; ?><?= ' _ '; ?>SMF : <?= $smfname; ?></h6>

                <small class="text-muted mt-2 d-block">Ruang & Kelas Perawatan</small>
                <h6><?= $roomname; ?><?= ' _ '; ?>Kelas : <?= $classroomname; ?></h6>
                <small class="text-muted mt-2 d-block">Diagnosa</small>
                <h6><?= $icdxname; ?><?= ' _ '; ?>Kode ICD X : <?= $icdx; ?></h6>
                <small class="text-muted mt-2 d-block">Catatan</small>
                <h6><?= $memo; ?></h6>
                <div class="text-left">
                    <button class="btn btn-outline-success waves-effect waves-light btn-card" data-pasiencard="<?= $paymentcardnumber; ?>" data-registerdate="<?= $documentdate; ?>"><span class="mr-1"><i class="fas fa-id-card-alt"></i></span>Asuransi</button>

                </div>


            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Resume</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane active" id="profile3" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                                <br>
                                <p class="text-muted"><?= $pasienid; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                                <br>
                                <p class="text-muted"><?= $pasienname; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Tanggal Lahir</strong>
                                <br>
                                <p class="text-muted"><?= $pasiendateofbirth; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Alamat</strong>
                                <br>
                                <p class="text-muted"><?= $pasienaddress; ?></p>
                            </div>
                        </div>
                        <hr>
                        <?= form_open('KasirRanap/validasi_pindahcabar', ['class' => 'formvalidasibayar']); ?>
                        <?= csrf_field(); ?>
                        <p class="mt-4 viewdataresume"></p>
                        <?= form_close() ?>

                        </p>
                    </div>
                </div>



                <div class="tab-pane" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                                <br>
                                <p class="text-muted"><?= $pasienid; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                                <br>
                                <p class="text-muted"><?= $pasienname; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Tanggal Lahir</strong>
                                <br>
                                <p class="text-muted"><?= $pasiendateofbirth; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Alamat</strong>
                                <br>
                                <p class="text-muted"><?= $pasienaddress; ?></p>
                            </div>
                        </div>


                        <hr>
                        <div class="btn-list">
                            <!-- Standard  modal -->
                            <?php if ($statusrawatinap <> "PULANG") { ?>
                                <button type="button" class="btn btn-primary" onclick="TNO('<?= $id ?>')"> <i class="fa fa-tags"></i> Tindakan Keperawatan</button>
                                <button type="button" class="btn btn-info" onclick="PSN('<?= $id ?>')"> <i class="fa fa-tags"></i> Tindakan Persalinan</button>
                                <button type="button" class="btn btn-success" onclick="APG('<?= $id ?>')"> <i class="fa fa-tags"></i> Asuhan Pelayanan Gizi</button>
                                <button type="button" class="btn btn-primary" onclick="GIZI('<?= $id ?>')"> <i class="fa fa-tags"></i> Pelayanan Gizi</button>
                            <?php } ?>

                        </div>
                        <hr>
                        <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                        <p class="mt-4 viewTNO">

                        </p>
                        </p>

                    </div>
                </div>
                <!--second tab-->
                <div class="tab-pane" id="profile" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                                <br>
                                <p class="text-muted"><?= $pasienid; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                                <br>
                                <p class="text-muted"><?= $pasienname; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Tanggal Lahir</strong>
                                <br>
                                <p class="text-muted"><?= $pasiendateofbirth; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Alamat</strong>
                                <br>
                                <p class="text-muted"><?= $pasienaddress; ?></p>
                            </div>
                        </div>


                        <hr>
                        <div class="btn-list">
                            <!-- Standard  modal -->
                            <?php if ($statusrawatinap <> "PULANG") { ?>
                                <button type="button" class="btn btn-danger" onclick="VISITE('<?= $id ?>')"> <i class="fa fa-tags"></i> Visitasi Dokter</button>
                            <?php } ?>
                        </div>
                        <hr>

                        <p class="mt-4 viewVISITE">

                        </p>
                        </p>

                    </div>
                </div>

                <div class="tab-pane" id="profile2" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                                <br>
                                <p class="text-muted"><?= $pasienid; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                                <br>
                                <p class="text-muted"><?= $pasienname; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Tanggal Lahir</strong>
                                <br>
                                <p class="text-muted"><?= $pasiendateofbirth; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Alamat</strong>
                                <br>
                                <p class="text-muted"><?= $pasienaddress; ?></p>
                            </div>
                        </div>


                        <hr>
                        <div class="btn-list">
                            <!-- Standard  modal -->
                            <?php if ($statusrawatinap <> "PULANG") { ?>
                                <button type="button" class="btn btn-danger" onclick="ASKEP('<?= $id ?>')"> <i class="fa fa-tags"></i> Asuhan Keperawatan / Kebidanan / Farmasi Klinik / Visite Kamar Operasi</button>
                            <?php } ?>
                        </div>
                        <hr>
                        <p class="mt-4 viewASKEP">

                        </p>
                        </p>

                    </div>
                </div>


                <div class="tab-pane" id="OP" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                                <br>
                                <p class="text-muted"><?= $pasienid; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                                <br>
                                <p class="text-muted"><?= $pasienname; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Tanggal Lahir</strong>
                                <br>
                                <p class="text-muted"><?= $pasiendateofbirth; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Alamat</strong>
                                <br>
                                <p class="text-muted"><?= $pasienaddress; ?></p>
                            </div>
                        </div>

                        <hr>
                        <p class="mt-4 viewOperasi">

                        </p>
                        </p>

                    </div>
                </div>


                <div class="tab-pane" id="AsupanGizi" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                                <br>
                                <p class="text-muted"><?= $pasienid; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                                <br>
                                <p class="text-muted"><?= $pasienname; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Tanggal Lahir</strong>
                                <br>
                                <p class="text-muted"><?= $pasiendateofbirth; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Alamat</strong>
                                <br>
                                <p class="text-muted"><?= $pasienaddress; ?></p>
                            </div>
                        </div>

                        <hr>
                        <p class="mt-4 viewAsupanGizi">

                        </p>
                        </p>

                    </div>
                </div>


                <div class="tab-pane" id="Penunjang" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                                <br>
                                <p class="text-muted"><?= $pasienid; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                                <br>
                                <p class="text-muted"><?= $pasienname; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Tanggal Lahir</strong>
                                <br>
                                <p class="text-muted"><?= $pasiendateofbirth; ?></p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Alamat</strong>
                                <br>
                                <p class="text-muted"><?= $pasienaddress; ?></p>
                            </div>
                        </div>

                        <hr>
                        <p class="mt-4 viewPenunjang">

                        </p>
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Column -->
</div>


<div class="viewmodal" style="display:none;"></div>








<script>
    function dataresume(data = null) {

        $.ajax({

            url: "<?php echo base_url('KasirRanap/resumeGabung_pindahcabar') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataresume').html(response.data);
                if (data != null) {
                    $('#paymentamount').val(data.jumlahbayar);
                    $('#payersname').val(data.pembayar);
                    $('#memo').val(data.memo);
                    $('#form-filter-atas').css('display', 'none');
                    $('#form-filter-bawah').css('display', 'block');

                }
            }
        });
    }
    $(document).ready(function() {
        dataresume();


    });
</script>

<script>
    function resumeTNO() {

        $.ajax({

            url: "<?php echo base_url('PelayananRanap/resumeTNO') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewTNO').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeTNO();


    });
</script>

<script>
    function resumeVisite() {

        $.ajax({

            url: "<?php echo base_url('PelayananRanap/resumeVisite') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewVISITE').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeVisite();


    });
</script>


<script>
    function resumeAskep() {

        $.ajax({

            url: "<?php echo base_url('PelayananRanap/resumeAskep') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewASKEP').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeAskep();


    });
</script>

<script>
    function resumeOperasi() {

        $.ajax({

            url: "<?php echo base_url('PelayananRanap/resumeOperasi') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewOperasi').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeOperasi();


    });
</script>


<script>
    function resumeAsupanGizi() {

        $.ajax({

            url: "<?php echo base_url('PelayananRanap/resumeAsupanGizi') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewAsupanGizi').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeAsupanGizi();


    });
</script>

<script>
    function resumePenunjang() {

        $.ajax({

            url: "<?php echo base_url('PelayananRanap/resumePenunjang') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewPenunjang').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumePenunjang();


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

                        //$('#modaltambah').modal('hide');
                        dataperawat();
                        datahistoritindakan();

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

        // Fungsi autocomplete pelayanan yang baru menggunakan jquery ui
        $("#name").autocomplete({
            source: "<?php echo base_url('PelayananRanap/ajax_pelayanan'); ?>?kelas=" + kelas,
            select: function(event, ui) {
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
                    //mengisi value input nama dan lainnya
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
                    //mengisi value input nama dan lainnya
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
            url: "<?php echo base_url('PelayananRanap/formubahmaster'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaleditranap').modal('show');

                }
            }

        });


    }
</script>

<script>
    function pulangkan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/pulangpasien'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalpulangranap').modal('show');

                }
            }

        });


    }
</script>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });

    function TNO(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/TNO'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputTNO').modal('show');

                }
            }

        });


    }

    function PSN(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/PSN'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputPSN').modal('show');

                }
            }

        });


    }

    function APG(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/APG'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputAPG').modal('show');

                }
            }

        });


    }

    function GIZI(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/GIZI'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputGIZI').modal('show');

                }
            }

        });


    }

    function VISITE(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/VISITE'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputVISITE').modal('show');

                }
            }

        });


    }

    function ASKEP(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/ASKEP'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputASKESP').modal('show');

                }
            }

        });


    }
</script>

<script>
    function email(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('SendEmail'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Email Berhasil Dikirim',


                    })

                }
            }

        });


    }
</script>
<script type="text/javascript">
    $(document).ready(function() {

    });


    $('.btn-card').on('click', function() {

        if ($('#pasiencard').val() == '' || $('#registerdate').val == '') {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Tidak Boleh Kosong'

            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bpjs/check_card') ?>",
                data: {
                    card: $(this).data('pasiencard'),
                    date: $(this).data('registerdate')
                },
                success: function(response) {
                    let parseResponse = JSON.parse(response);
                    if (parseResponse.metaData.code == 200) {

                        Swal.fire({
                            html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                '<br>Hak Kelas: ' + parseResponse.response.peserta.pisa + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
                                '<br>Kode Faskes 1: ' + parseResponse.response.peserta.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.peserta.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.peserta.tglTMT,

                            icon: 'success',
                            text: parseResponse.metaData.message,
                        });
                        $('#faskesname').val(parseResponse.response.peserta.provUmum.nmProvider);
                        $('#faskes').val(parseResponse.response.peserta.provUmum.kdProvider);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            //title: 'Error',
                            text: parseResponse.metaData.message

                        });
                    }
                }
            })
        }

    })
</script>

<script>
    function pindahkamar(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/pindahkamar'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalpindahkamar').modal('show');

                }
            }

        });


    }
</script>

<?= $this->endSection(); ?>