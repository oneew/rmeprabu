<div id="modalrmerajal" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
                    <button class="btn btn-outline-warning waves-effect waves-light" type="button" onclick="email('<?= $id ?>')"><span class="mr-1"><i class="far fa-envelope"></i></span>Mail</button>
                </h4>
            </div>
            <div class="modal-body" style="max-height: 67vh;overflow-y:scroll;">
                <div class="row">
                    <div class="col-lg-3 col-md-12">

                        <div class="card profile-card"> <img class="card-img profile-img" src="<?= base_url(); ?>/assets/images/background/kamaroperasi.jpg" alt="Card image">
                            <div class="card-img-overlay card-inverse social-profile d-flex justify-content-center">
                                <?php


                                if ($pasiengender == 'L') {


                                    $gambar = '../assets/images/users/pasienlaki.jpg';
                                } else {
                                    $gambar = '../assets/images/users/pasienperempuan.jpg';
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

                                <small class="text-muted">Cara Bayar</small>
                                <h6><?= $paymentmethodname; ?> Hak kelas : <?= $pasienclassroom; ?></h6>
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

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12">
                        <div class="card">

                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Resume</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">Tindakan</a></li>


                            </ul>

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
    </div>
</div>

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
</script>