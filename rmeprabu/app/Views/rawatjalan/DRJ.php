<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-md-12">
        <div class="card profile-card"> <img class="card-img profile-img" src="<?= base_url(); ?>/assets/images/background/kamaroperasi.jpg" alt="Card image">
            <div class="card-img-overlay card-inverse social-profile d-flex justify-content-center">
                <?php


                $tanggallahir = $pasiendateofbirth;
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
                if (($pasiengender == 'L') and ($age_years <= 5)) {
                    $gambar = base_url() . '/assets/images/users/anakkecillaki.jpeg';
                } else if (($pasiengender == 'P') and ($age_years <= 5)) {
                    $gambar = base_url() . '/assets/images/users/anakkecilperempuan.jpeg';
                } else if (($pasiengender == 'L') and ($age_years >= 6) and ($age_years <= 12)) {
                    $gambar = base_url() . '/assets/images/users/remajapria.jpeg';
                } else if (($pasiengender == 'P') and ($age_years >= 6) and ($age_years <= 12)) {

                    $gambar = base_url() . '/assets/images/users/remajaperempuan.jpeg';
                } else if (($pasiengender == 'L') and ($age_years >= 13) and ($age_years <= 59)) {
                    $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                } else if (($pasiengender == 'P') and ($age_years >= 13) and ($age_years <= 59)) {

                    $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                } else if (($pasiengender == 'L') and ($age_years >= 60)) {

                    $gambar = base_url() . '/assets/images/users/priatua.jpeg';
                } else if (($pasiengender == 'P') and ($age_years >= 60)) {

                    $gambar = base_url() . '/assets/images/users/wanitatua.jpeg';
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
                <div class="text-center">
                    <button id="print" class="btn btn-info btn-outline btn btntaskid" type="button" onclick="TaskID('<?= $id ?>')"> <span><i class="mdi mdi-network"></i></span> List Task ID JKN Mobile </button>
                </div>
                <div class="text-center">
                    <button id="print" class="btn btn-danger btn-outline btn btnupdateantrean" type="button" onclick="UpdateAntrean('<?= $id ?>')"> <span><i class="mdi mdi-map-marker-radius"></i></span> Update Waktu Antrian JKN Mobile </button>
                </div>
                <small class="text-muted">Cara Bayar</small>
                <h6><?= $paymentmethodname; ?></h6>
                <small class="text-muted mt-2 d-block">Kartu Asuransi</small>
                <button class="btn btn-outline-success waves-effect waves-light btn-card" data-pasiencard="<?= $paymentcardnumber; ?>" data-registerdate="<?= $documentdate; ?>"><span class="mr-1"><i class="fas fa-id-card-alt"></i></span> <?= $paymentcardnumber; ?></button>
                <small class="text-muted mt-2 d-block">No. Registrasi</small>
                <h6><?= $journalnumber; ?> <?= ' _ '; ?>Tanggal Registrasi : <?= $documentdate; ?></h6>
                <small class="text-muted mt-2 d-block">Dokter Penanggung Jawab</small>
                <h6><?= $doktername; ?><?= ' _ '; ?>SMF : <?= $smfname; ?></h6>

                <small class="text-muted mt-2 d-block">Ruang & Kelas Perawatan</small>
                <h6><?= $poliklinikname; ?><?= ' _ '; ?>Kelas : </h6>
                <small class="text-muted mt-2 d-block">Diagnosa</small>
                <h6><?= $icdxname; ?><?= ' _ '; ?>Kode ICD X : <?= $icdx; ?></h6>
                <small class="text-muted mt-2 d-block">Catatan</small>
                <h6><?= $memo; ?></h6>

                <div class="btn-group">
                    <button type="button" class="btn btn-outline-info waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fab fa-medrt"></i></span>
                        Order Penunjang
                    </button>
                    <div class="dropdown-menu animated flipInX">
                        <a class="dropdown-item" href="#" onclick="pesanRAD('<?= $id ?>')">Radiologi</a>
                        <a class="dropdown-item" href="#" onclick="pesanLPK('<?= $id ?>')">Patologi Klinik</a>
                        <a class="dropdown-item" href="#" onclick="pesanLPA('<?= $id ?>')">Patologi Anatomi</a>
                        <a class="dropdown-item" href="#" onclick="pesanBD('<?= $id ?>')">Bank Darah</a>
                        <a class="dropdown-item" href="#" onclick="pesanObat('<?= $id ?>')">Resep Obat</a>
                    </div>
                </div>
                <button class="btn btn-outline-danger waves-effect waves-light" type="button" onclick="validasi('<?= $id ?>')"><span class="mr-1"><i class="fas fa-parachute-box"></i></span>Validasi</button>

                <div class="btn-group">
                    <button type="button" class="btn btn-outline-info waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-couch"></i></span>
                        Menu
                    </button>
                    <div class="dropdown-menu animated flipInX">
                        <a class="dropdown-item" href="<?= base_url(); ?>/RawatJalan">Pendaftaran</a>
                        <a class="dropdown-item" href="<?= base_url(); ?>/PelayananRawatJalan">Pelayanan</a>
                        <a class="dropdown-item" href="<?= base_url(); ?>/PelayananBedInfo">Bed Info</a>
                    </div>
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
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">Tindakan</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Penunjang" role="tab">Penunjang</a></li>
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

                        <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                        <p class="mt-4 viewdataresume"></p>

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
                            <?php if ($validation == "BELUM") { ?>
                                <button type="button" class="btn btn-success" onclick="TNO('<?= $id ?>')"> <i class="fa fa-plus"></i> Tindakan Medis & Keperawatan</button>

                            <?php } ?>
                        </div>
                        <hr>
                        <p class="mt-4 viewTNO">

                        </p>
                        </p>

                    </div>
                </div>
                <!--second tab-->

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
                            <button type="button" class="btn btn-danger" onclick="ASKEP('<?= $id ?>')"> <i class="fa fa-tags"></i> Asuhan Keperawatan / Kebidanan / Farmasi Klinik / Visite Kamar Operasi</button>
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
    function dataresume() {

        $.ajax({

            url: "<?php echo base_url('PelayananRawatJalan/resumeGabung') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataresume').html(response.data);
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

            url: "<?php echo base_url('PelayananRawatJalan/resumeTNO') ?>",
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
    function resumeGizi() {

        $.ajax({

            url: "<?php echo base_url('PelayananRawatJalan/resumeGizi') ?>",
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
        resumeGizi();


    });
</script>

<script>
    function resumePenunjang() {

        $.ajax({

            url: "<?php echo base_url('PelayananRawatJalan/resumePenunjang') ?>",
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
            url: "<?php echo base_url('PelayananRawatJalan/formubahmaster'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaleditrajal').modal('show');

                }
            }

        });


    }
</script>

<script>
    function validasi(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalan/ValidasiPemeriksaan'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalvalidasipoli').modal('show');

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
            url: "<?php echo base_url('PelayananRawatJalan/TNO'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputTNOrajal').modal('show');

                }
            }

        });


    }



    function APG(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalan/APG'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputAPGrajal').modal('show');

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
    function pesanRAD(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('OrderPendaftaranRadiologi/orderrajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalorderdaftarradiologi_rajal').modal('show');
                }
            }
        });
    }

    function pesanLPK(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('OrderPendaftaranPK/orderpkrajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalorderdaftarpk_rajal').modal('show');
                }
            }
        });
    }

    function pesanLPA(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('OrderPendaftaranPA/orderparajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalorderdaftarpa_rajal').modal('show');
                }
            }
        });
    }

    function pesanBD(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('OrderPendaftaranBD/orderbdrajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalorderdaftarbd_rajal').modal('show');
                }
            }
        });
    }
</script>


<script>
    function UpdateAntrean(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('WsAntrean/UpdateTaskID'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodal').html(response.suksesmodalsep).show();
                    $('#modaltaskidrajal').modal();
                }
            }
        });
    }

    function TaskID(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('WsAntrean/TaskID'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                Swal.fire({
                    html: 'Pesan: ' + response.pesan,
                    icon: 'success',
                    timer: 5000
                });
            }
        });
    }
</script>

<?= $this->endSection(); ?>