<div id="modaldactranappindah" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
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
                                <h6><?= $paymentmethodname; ?> Hak kelas : <?= $pasienclassroom; ?> <span class="<?php if ($naik == 1) {
                                                                                                                        echo "badge badge-danger";
                                                                                                                    } else {
                                                                                                                        echo "badge badge-success";
                                                                                                                    }  ?>"><?= $kesimpulankelas ?></span></h6>
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

<div class="viewmodalentridactpindah" style="display:none;"></div>