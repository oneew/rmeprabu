<div id="modaldactranap" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
                    <button class="btn btn-outline-warning waves-effect waves-light" type="button" onclick="email('<?= $id ?>')"><span class="mr-1"><i class="far fa-envelope"></i></span>Mail</button>
                    <?php if ($koinsiden == 0) {
                        $jeniskoinsiden = "Bukan Pasien Koinsiden";
                        $warna = "btn btn-success waves-effect";
                    } else {
                        $jeniskoinsiden = "Pasien Koinsiden";
                        $warna = "btn btn-danger waves-effect";
                    } ?>
                    <button type="button" class="<?= $warna; ?>"> <i class="fas fa-clone"></i> <?= $jeniskoinsiden; ?></button>
                </h4>
            </div>
            <div class="modal-body" style="max-height: 67vh;overflow-y:scroll;">
                <div class="row">

                    <!-- Column -->
                    <div class="col-lg-3 col-md-12">

                        <div class="card profile-card"> <img class="card-img profile-img" src="<?= base_url(); ?>/assets/images/background/kamaroperasi.jpg" alt="Card image">
                            <div class="card-img-overlay card-inverse social-profile d-flex justify-content-center">
                                <?php


                                if ($pasiengender == 'L') {


                                    $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                                } else {
                                    $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                                }

                                ?>
                                <div class="align-self-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='78'>"; ?>
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
                                <?php if (($pasienclassroom == 'KLS3') and ($classroom == 'KLS3')) {
                                    $kesimpulankelas = 'Sesuai Hak kelas';
                                    $naik = 0;
                                } else {
                                    if (($pasienclassroom == 'KLS3') and ($classroom == 'KLS2')) {
                                        $kesimpulankelas = 'Naik kelas';
                                        $naik = 1;
                                    } else {
                                        if (($pasienclassroom == 'KLS3') and ($classroom == 'KLS1')) {
                                            $kesimpulankelas = 'Naik kelas';
                                            $naik = 1;
                                        } else {
                                            if (($pasienclassroom == 'KLS2') and ($classroom == 'KLS2')) {
                                                $kesimpulankelas = 'Sesuai Hak kelas';
                                                $naik = 0;
                                            } else {
                                                if (($pasienclassroom == 'KLS2') and ($classroom == 'KLS1')) {
                                                    $kesimpulankelas = 'Naik kelas';
                                                    $naik = 1;
                                                } else {
                                                    $kesimpulankelas = '';
                                                    $naik = 0;
                                                }
                                            }
                                        }
                                    }
                                } ?>
                                <small class="text-muted">Cara Bayar</small>
                                <h6><?= $paymentmethodname; ?> Hak kelas : <?= $pasienclassroom; ?> <span class="
                                <?php if ($naik == 1) {
                                    echo "badge badge-danger";
                                } else {
                                    echo "badge badge-success";
                                }  ?>"><?= $kesimpulankelas ?></span></h6>
                                <small class="text-muted mt-2 d-block">Kartu Asusuransi</small>
                                <button class="btn btn-outline-success waves-effect waves-light btn-card" data-pasiencard="<?= $paymentcardnumber; ?>" data-registerdate="<?= $documentdate; ?>"><span class="mr-1"><i class="fas fa-id-card-alt"></i></span> <?= $paymentcardnumber; ?></button>
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
                                    <button class="btn btn-info" type="button" onclick="eresep('<?= $id ?>')"><span class="mr-1"><i class="fas fa-parachute-box"></i></span>e-Resep</button>
                                    <?php if ($statusrawatinap <> "PULANG") { ?>
                                        <button class="btn btn-outline-info waves-effect waves-light" type="button" onclick="pindahkamar('<?= $id ?>')"><span class="mr-1"><i class="fas fa-bed"></i></span>Pindah</button>
                                        <button class="btn btn-outline-danger waves-effect waves-light" type="button" onclick="pulangkan('<?= $id ?>')"><i class="fas fa-shipping-fast"> Pulang</i></button>
                                    <?php } ?>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-info waves-effect waves-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-couch"></i></span>
                                            Menu
                                        </button>
                                        <div class="dropdown-menu animated flipInX">
                                            <a class="dropdown-item" href="<?= base_url(); ?>/ValidasiDaftarRanap">Validasi Pasien Baru</a>
                                            <a class="dropdown-item" href="<?= base_url(); ?>/ValidasiDaftarRanap/ValidasiPindah">Validasi Pasien Pindah</a>
                                            <a class="dropdown-item" href="<?= base_url(); ?>/PelayananRanap">Pelayanan</a>
                                            <a class="dropdown-item" href="<?= base_url(); ?>/PelayananBedInfoRanap">Bed Info</a>
                                        </div>
                                    </div>
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
                                    <p>
                                    <div class="form-group">
                                        <label>
                                            <h6>Rincian</h6>
                                        </label>
                                        <select name="rincian" id="rincian" class="form-control-select2 filter-input" style="width: 100%">
                                            <option value="">Pilih Jenis Rincian</option>
                                            <?php foreach ($merge as $merge) { ?>
                                                <option data-id="<?= $merge['paymentmethodname']; ?>" class="select-rincian"><?= $merge['paymentmethodname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-9 col-md-12">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Resume</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">Tindakan</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Visite</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">Asuhan Keperawatan</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#OP" role="tab">TMO</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#AsupanGizi" role="tab">Gizi</a></li>
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
                                        <hr>
                                        <p class="mt-4 viewdataresume">

                                        </p>
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
                                                <button type="button" class="btn btn-success" onclick="TNO('<?= $id ?>')"> <i class="fa fa-plus"></i> Tindakan Keperawatan</button>
                                                <button type="button" class="btn btn-warning" onclick="PSN('<?= $id ?>')"> <i class="fas fa-child"></i> Tindakan Persalinan</button>
                                                <button type="button" class="btn btn-success" onclick="APG('<?= $id ?>')"> <i class="fas fa-diagnoses"></i> Asuhan Pelayanan Gizi</button>
                                                <button type="button" class="btn btn-primary" onclick="GIZI('<?= $id ?>')"> <i class="fas fa-coffee"></i> Pelayanan Gizi</button>
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
                                                <button type="button" class="btn btn-success" onclick="VISITE('<?= $id ?>')"> <i class="fas fa-assistive-listening-systems"></i> Visitasi Dokter</button>
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
                                                <button type="button" class="btn btn-success" onclick="ASKEP('<?= $id ?>')"> <i class="fas fa-calendar-plus"></i> Asuhan Keperawatan / Kebidanan / Farmasi Klinik / Visite Kamar Operasi</button>
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

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="viewmodaldact" style="display:none;"></div>


<script>
    function dataresume() {

        $.ajax({

            url: "<?php echo base_url('PelayananRanap/resumeGabung') ?>",
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

            url: "<?php echo base_url('PelayananRanap/resumePenunjangDact') ?>",
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
                    $('.viewmodaldact').html(response.sukses).show();
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
                    $('.viewmodaldact').html(response.sukses).show();
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
                    $('.viewmodaldact').html(response.sukses).show();
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
                    $('.viewmodaldact').html(response.sukses).show();
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
                    $('.viewmodaldact').html(response.sukses).show();
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
                    $('.viewmodaldact').html(response.sukses).show();
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
                    $('.viewmodaldact').html(response.sukses).show();
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
                    $('.viewmodaldact').html(response.sukses).show();
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
                    $('.viewmodaldact').html(response.sukses).show();
                    $('#modalpindahkamar').modal('show');

                }
            }

        });


    }
</script>




<script>
    function pesanRAD(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('OrderPendaftaranRadiologi/order'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldact').html(response.sukses).show();
                    $('#modalorderdaftarradiologi').modal('show');
                }
            }
        });
    }

    function pesanLPK(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('OrderPendaftaranPK/order'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldact').html(response.sukses).show();
                    $('#modalorderdaftarpk').modal('show');
                }
            }
        });
    }

    function pesanLPA(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('OrderPendaftaranPA/order'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldact').html(response.sukses).show();
                    $('#modalorderdaftarpa').modal('show');
                }
            }
        });
    }

    function pesanBD(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('OrderPendaftaranBD/order'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldact').html(response.sukses).show();
                    $('#modalorderdaftarbd').modal('show');
                }
            }
        });
    }

    function eresep(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananRajal/orderesepranap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldact').html(response.sukses).show();
                    $('#modaleresep_ranap').modal('show');
                }
            }
        });
    }
</script>

<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script>
    $(function() {
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

        });
    });
</script>



<script>
    $('.filter-input').on('change', function() {
        let rincian = $('#rincian').val();
        let referencenumber = $('#referencenumber').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/resumeGabungPilihan') ?>",
            dataType: "json",
            data: {
                pilihancabar: rincian,
                referencenumber: referencenumber

            },
            success: function(response) {
                $('.viewdataresume').html(response.data);

            }
        });
    });
</script>