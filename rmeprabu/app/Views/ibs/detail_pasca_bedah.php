<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="<?= base_url(); ?>/assets/plugins/wizard/steps.css" rel="stylesheet" type="text/css">

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<?php
$attr_1 = $book['signin_konfirmasiidentitas'] == 1 ? 'checked' : '';
$attr_2 = $book['signin_tempatoperasi'] == 1 ? 'checked' : '';
$attr_3 = $book['signin_mesinanestesi'] == 1 ? 'checked' : '';
$attr_4 = $book['signin_pulseoksimetri'] == 1 ? 'checked' : '';
$attr_5 = $book['signin_riwayatalergi'] == 1 ? 'checked' : '';
$attr_6 = $book['signin_risikoaspirasi'] == 1 ? 'checked' : '';
$attr_7 = $book['signin_risikodarah'] == 1 ? 'checked' : '';
$attr_8 = $book['timeout_konfirmasitim'] == 1 ? 'checked' : '';
$attr_9 = $book['timeout_konfirmasiprosedur'] == 1 ? 'checked' : '';
$attr_10 = $book['timeout_antibiotik'] == 1 ? 'checked' : '';
$attr_11 = $book['signout_prosedur'] == 1 ? 'checked' : '';
$attr_12 = $book['signout_terhitung'] == 1 ? 'checked' : '';
$attr_13 = $book['signout_pelabelan'] == 1 ? 'checked' : '';
$attr_14 = $book['signout_permasalahanalat'] == 1 ? 'checked' : '';
$attr_15 = $book['signout_kesadaranpasien'] == 1 ? 'checked' : '';
?>


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
                <button id="print" class="btn btn-outline-info waves-effect waves-light btnprintlapoperasi" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Laporan Operasi</button>

            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile2" role="tab">Surgical Safety Checklist</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">Laporan Jalannya Operasi</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Asuhan Keperawatan</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile5" role="tab">Anestesi</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="profiletimeline position-relative">
                            <div class="sl-item mt-2 mb-3">
                                <div class="sl-left float-left mr-3"></div>
                                <div class="sl-right">
                                    <div><a href="#" class="link"></a>
                                        <div class="row">
                                            <form method="post" id="form-filter">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sl-item mt-2 mb-3">
                                <div class="sl-left float-left mr-3"> <img src="<?= base_url(); ?>/assets/images/users/catatan.png" alt="user" class="rounded-circle"> </div>
                                <div class="sl-right">
                                    <div><a href="#" class="link">Data Operasi</a> <span class="sl-date text-muted">
                                            <form method="post" id="form-filter">
                                                <?php helper('form') ?>

                                                <?= csrf_field(); ?>
                                                <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                                <input type="hidden" id="relation" name="relation" class="form-control" value="<?= $pasienid; ?>" readonly>
                                            </form>
                                            <blockquote class="mt-2">
                                                <p class="mt-4 dataoperasiinputjadwal">
                                                </p>
                                            </blockquote>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="sl-item mt-2 mb-3">
                                <div class="sl-left float-left mr-3"> <img src="<?= base_url(); ?>/assets/images/users/catatan.png" alt="user" class="rounded-circle"> </div>
                                <div class="sl-right">
                                    <div><a href="#" class="link">Laporan Pasca Operasi</a> <span class="sl-date text-muted">
                                            <form method="post" id="form-filter">
                                                <?php helper('form') ?>

                                                <?= csrf_field(); ?>
                                                <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                                <input type="hidden" id="relation" name="relation" class="form-control" value="<?= $pasienid; ?>" readonly>
                                            </form>
                                            <blockquote class="mt-2">
                                                <p class="mt-4 datalaporanoperasi">
                                                </p>
                                            </blockquote>
                                    </div>
                                </div>
                            </div>

                            <hr>

                        </div>
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
                        <form method="post" id="form-filter2">

                            <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                            <input type="hidden" id="relation" name="relation" class="form-control" value="<?= $pasienid; ?>" readonly>
                        </form>

                    </div>
                </div>

                <div class="tab-pane active" id="profile2" role="tabpanel">
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
                        <form method="post" id="form-filter3">
                            <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body wizard-content">
                                        <h4 class="card-title">Surgical Safety Checklist</h4>

                                        <form action="#" class="tab-wizard wizard-circle">
                                            <!-- Step 1 -->
                                            <h6>Sign In</h6>
                                            <section>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="edukasibedah">Apakah pasien sudah dikonfirmasi identitas, lokasi, prosedur dan informed consent?</label>
                                                            <input type="checkbox" <?= $attr_1; ?> data-size="mini" data-switch="<?= $book['signin_konfirmasiidentitas']; ?>" data-field="signin_konfirmasiidentitas" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signin_konfirmasiidentitas-<?= $book['id']; ?>" name="signin_konfirmasiidentitas" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lastName1">Apakah tempat operasi sudah ditandai?</label>
                                                            <p></p>
                                                            <input type="checkbox" <?= $attr_2; ?> data-size="mini" data-switch="<?= $book['signin_tempatoperasi']; ?>" data-field="signin_tempatoperasi" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signin_tempatoperasi-<?= $book['id']; ?>" name="signin_tempatoperasi" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="emailAddress1">Apakah mesin anestesi dan premedikasi sudah diperiksa dan lengkap?</label>
                                                            <input type="checkbox" <?= $attr_3; ?> data-size="mini" data-switch="<?= $book['signin_mesinanestesi']; ?>" data-field="signin_mesinanestesi" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signin_mesinanestesi-<?= $book['id']; ?>" name="signin_mesinanestesi" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phoneNumber1">Apakah pulse oksimetri sudah terpasang pada pasien dan berfungsi dengan baik?</label>
                                                            <input type="checkbox" <?= $attr_4; ?> data-size="mini" data-switch="<?= $book['signin_pulseoksimetri']; ?>" data-field="signin_pulseoksimetri" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signin_pulseoksimetri-<?= $book['id']; ?>" name="signin_pulseoksimetri" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="location1">Apakah pasien memiliki Riwayat alergi ?</label>
                                                            <p></p>
                                                            <input type="checkbox" <?= $attr_5; ?> data-size="mini" data-switch="<?= $book['signin_riwayatalergi']; ?>" data-field="signin_riwayatalergi" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signin_riwayatalergi-<?= $book['id']; ?>" name="signin_riwayatalergi" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date1">Kesulitan menjaga jalan napas atau risiko aspirasi?</label>
                                                            <p></p>
                                                            <input type="checkbox" <?= $attr_6; ?> data-size="mini" data-switch="<?= $book['signin_risikoaspirasi']; ?>" data-field="signin_risikoaspirasi" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signin_risikoaspirasi-<?= $book['id']; ?>" name="signin_risikoaspirasi" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="location1">Risiko hilangnya darah>500 mL ( 7 mL/kg pada anak-anak )?</label>
                                                            <input type="checkbox" <?= $attr_7; ?> data-size="mini" data-switch="<?= $book['signin_risikodarah']; ?>" data-field="signin_risikodarah" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signin_risikodarah-<?= $book['id']; ?>" name="signin_risikodarah" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <!-- Step 2 -->
                                            <h6>Time Out</h6>
                                            <section>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="jobTitle1">Konfirmasi semua anggota tim sudah memperkenalkan nama dan peran ?</label>
                                                            <input type="checkbox" <?= $attr_8; ?> data-size="mini" data-switch="<?= $book['timeout_konfirmasitim']; ?>" data-field="timeout_konfirmasitim" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="timeout_konfirmasitim-<?= $book['id']; ?>" name="timeout_konfirmasitim" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="videoUrl1">Konfirmasi nama pasien, prosedur, dan di mana insisi akan dilakukan?</label>
                                                            <input type="checkbox" <?= $attr_9; ?> data-size="mini" data-switch="<?= $book['timeout_konfirmasiprosedur']; ?>" data-field="timeout_konfirmasiprosedur" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="timeout_konfirmasiprosedur-<?= $book['id']; ?>" name="timeout_konfirmasiprosedur" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="shortDescription1">Apakah antibiotik profilaksis sudah diberikan dalam 60 menit terakhir?</label>
                                                            <input type="checkbox" <?= $attr_10; ?> data-size="mini" data-switch="<?= $book['timeout_antibiotik']; ?>" data-field="timeout_antibiotik" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="timeout_antibiotik-<?= $book['id']; ?>" name="timeout_antibiotik" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <!-- Step 3 -->
                                            <h6>Sign Out</h6>
                                            <section>
                                                <h6>Sebelum Pasien meninggalkan Ruangan Operasi, Perawat memastikan Secara Verbal</h6>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="int1">Nama prosedur yang dilakukan ?</label>
                                                            <p></p>
                                                            <input type="checkbox" <?= $attr_11; ?> data-size="mini" data-switch="<?= $book['signout_prosedur']; ?>" data-field="signout_prosedur" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signout_prosedur-<?= $book['id']; ?>" name="signout_prosedur" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="intType1">Apakah instrumen. Alat habis pakai, dan jumlah jarum telah terhitung?</label>
                                                            <input type="checkbox" <?= $attr_12; ?> data-size="mini" data-switch="<?= $book['signout_terhitung']; ?>" data-field="signout_terhitung" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signout_terhitung-<?= $book['id']; ?>" name="signout_terhitung" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="Location1">Pelabelan spesimen ( baca label spesimen secara lantang, termasuk nama pasien )?</label>
                                                            <input type="checkbox" <?= $attr_13; ?> data-size="mini" data-switch="<?= $book['signout_pelabelan']; ?>" data-field="signout_pelabelan" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signout_pelabelan-<?= $book['id']; ?>" name="signout_pelabelan" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="jobTitle2">Apakah ada permasalahan dengan pemakaian peralatan? Untuk ahli bedah, ahli anestesi, dan perawat :
                                                                ?</label>
                                                            <input type="checkbox" <?= $attr_14; ?> data-size="mini" data-switch="<?= $book['signout_permasalahanalat']; ?>" data-field="signout_permasalahanalat" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signout_permasalahanalat-<?= $book['id']; ?>" name="signout_permasalahanalat" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Apakah hal yang penting untuk pulih sadar dan perawatan pasien telah diperhatikan?</label>
                                                            <input type="checkbox" <?= $attr_15; ?> data-size="mini" data-switch="<?= $book['signout_kesadaranpasien']; ?>" data-field="signout_kesadaranpasien" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="signout_kesadaranpasien-<?= $book['id']; ?>" name="signout_kesadaranpasien" data-toggle="toggle" data-on="Ya" data-off="tidak">
                                                        </div>
                                                    </div>
                                                </div>

                                            </section>
                                            <!-- Step 4 -->

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <div class="tab-pane" id="profile5" role="tabpanel">
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
                        <?= form_open('BedahTim/simpanedukasi', ['class' => 'formedukasi']); ?>
                        <?= csrf_field(); ?>
                        <form method="post" id="form-filter">
                            <div class="form-body">



                                <div class="row pt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Dokter Pelaksana Tindakan</label>
                                            <input type="text" id="ibsdoktername" name="ibsdoktername" class="form-control" value="<?= $ibsdoktername; ?>">
                                            <input type="hidden" id="id_tproh" name="id_tproh" class="form-control" value="<?= $id; ?>">
                                            <input type="hidden" id="ibsanestesiname" name="ibsanestesiname" class="form-control" value="<?= $ibsanestesiname; ?>">
                                            <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                                            <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                                            <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>">
                                            <input type="hidden" id="pasienname" name="pasienname" class="form-control" value="<?= $pasienname; ?>">
                                            <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>">
                                            <input type="hidden" id="roomname" name="roomname" class="form-control" value="<?= $roomname; ?>">
                                            <input type="hidden" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasiendateofbirth; ?>">




                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group has-danger">
                                            <label class="control-label">Pemberi Informasi</label>
                                            <input type="text" id="pemberiinformasi" name="pemberiinformasi" value="<?= $pemberiinformasi; ?>" class="form-control">
                                            <div class="form-control-feedback errorpemberiinformasi">

                                            </div>
                                        </div>

                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <label class="control-label">Penerima Infromasi</label>
                                            <input type="text" id="penerimainformasi" name="penerimainformasi" class="form-control" value="<?= $namapjb; ?>">
                                            <div class="form-control-feedback errorpenerimainformasi">

                                            </div>
                                        </div>

                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Diagnosis</label>
                                            <input type="text" id="diagnosis" name="diagnosis" class="form-control" value="<?= $icdxname; ?>">
                                            <div class="form-control-feedback errordiagnosis">

                                            </div>
                                        </div>

                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-success">
                                            <label class="control-label">Kondisi Pasien</label>
                                            <textarea id="kondisipasien" name="kondisipasien" class="textarea_editor form-control" rows="3" value="<?= $kondisipasien; ?>" placeholder="Enter text ..."></textarea>
                                            <div class="form-control-feedback errorkondisipasien">

                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-success">
                                            <label class="control-label">Tindakan Kedokteran Yang Diusulkan</label>
                                            <input type="text" id="name" name="name" class="form-control" value="<?= $tindakandiusulkan; ?>">
                                            <div class="form-control-feedback errorname">

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-success">
                                            <label class="control-label">Manfaat Tindakan</label>
                                            <textarea id="manfaattindakan" name="manfaattindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-success">
                                            <label class="control-label">Tata cara Uraian singkat prosedur</label>
                                            <textarea id="tatacara" name="tatacara" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-success">
                                            <label class="control-label">Risiko Tindakan</label>
                                            <textarea id="risikotindakan" name="risikotindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-success">
                                            <label class="control-label">Komplikasi Tindakan</label>
                                            <textarea id="komplikasitindakan" name="komplikasitindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-success">
                                            <label class="control-label">Dampak Tindakan</label>
                                            <textarea id="dampaktindakan" name="dampaktindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-success">
                                            <label class="control-label">Prognosis Tindakan</label>
                                            <textarea id="prognosistindakan" name="prognosistindakan" class="textarea_editor form-control" rows="3" placeholder="Prognosis vital, prognosis fungsi dan prognosis kesembuhan"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-success">
                                            <label class="control-label">Kemungkinan Alternatif Tindakan</label>
                                            <textarea id="alternatif" name="alternatif" class="textarea_editor form-control" rows="3" placeholder="enter text.."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group has-success">
                                            <label class="control-label">Kemungkinan hasil bila tidak dilakukan tindakan</label>
                                            <textarea id="bilatidakditindak" name="bilatidakditindak" class="textarea_editor form-control" rows="3" placeholder="enter text.."></textarea>
                                            <div class="form-control-feedback errorbilatidakditindak">

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <!--/row-->
                                <!--/row-->

                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                                    Simpan</button>
                                <button type="button" class="btn btn-inverse">Cancel</button>
                            </div>
                        </form>
                        <?= form_close() ?>

                        <p class="mt-4 ">

                        </p>


                    </div>
                </div>

                <div class="tab-pane" id="profile6" role="tabpanel">
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
                        <p class="mt-4 ">
                        <div class="col-lg-3 col-md-6">
                            <div class="card">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1"> <img src="../assets/images/gallery/persetujuan.jpg" alt="user" />
                                        <div class="el-overlay">
                                            <ul class="el-info">
                                                <li><a class="btn default btn-outline image-popup-vertical-fit" href="../assets/images/users/1.jpg"></a></li>

                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

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
    function dataperawat() {

        $.ajax({

            url: "<?php echo base_url('EdukasiBedah/ambildatadetailibs') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.dataoperasiresume').html(response.data);
            }
        });
    }
    $(document).ready(function() {

        dataperawat();

    });
</script>
<script>
    function dataoperasi() {

        $.ajax({

            url: "<?php echo base_url('PascaBedah/cek') ?>",
            data: {

                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.dataoperasiinputjadwal').html(response.data);
            }
        });
    }
    $(document).ready(function() {

        dataoperasi();

    });
</script>

<script>
    function datalaporanoperasi() {

        $.ajax({

            url: "<?php echo base_url('PascaBedah/ceklaporanoperasi') ?>",
            data: {

                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.datalaporanoperasi').html(response.data);
            }
        });
    }
    $(document).ready(function() {

        datalaporanoperasi();

    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        var kelas = document.getElementById("classroom").value;

        // Fungsi autocomplete pelayanan yang baru menggunakan jquery ui
        $("#name").autocomplete({
            source: "<?php echo base_url('rawatinap/ajax_pelayanan'); ?>?kelas=" + kelas,
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
        // ketika select nama dokter maka akan menjalankan fungsi dibawah
        $('#doktername').on('change', function() {
            $.ajax({
                'type': "POST",
                //'url': "http://localhost/simrs/public/index.php/autocomplete/fill_dokter",
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




<script>
    $(document).ready(function() {
        $('.formedukasi').submit(function(e) {
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
                        if (response.error.pemberiinformasi) {
                            $('#pemberiinformasi').addClass('form-control-danger');
                            $('.errorpemberiinformasi').html(response.error.pemberiinformasi);
                        } else {
                            $('#pemberiinformasi').removeClass('form-control-danger');
                            $('.errorpemberiinformasi').html('');
                        }

                        if (response.error.penerimainformasi) {
                            $('#penerimainformasi').addClass('form-control-danger');
                            $('.errorpenerimainformasi').html(response.error.penerimainformasi);
                        } else {
                            $('#penerimainformasi').removeClass('form-control-danger');
                            $('.errorpenerimainformasi').html('');
                        }

                        if (response.error.diagnosis) {
                            $('#diagnosis').addClass('form-control-danger');
                            $('.errordiagnosis').html(response.error.diagnosis);
                        } else {
                            $('#diagnosis').removeClass('form-control-danger');
                            $('.errordiagnosis').html('');
                        }

                        if (response.error.kondisipasien) {
                            $('#kondisipasien').addClass('form-control-danger');
                            $('.errorkondisipasien').html(response.error.kondisipasien);
                        } else {
                            $('#kondisipasien').removeClass('form-control-danger');
                            $('.errorkondisipasien').html('');
                        }
                        if (response.error.name) {
                            $('#name').addClass('form-control-danger');
                            $('.errorname').html(response.error.name);
                        } else {
                            $('#name').removeClass('form-control-danger');
                            $('.errorname').html('');
                        }
                        if (response.error.bilatidakditindak) {
                            $('#bilatidakditindak').addClass('form-control-danger');
                            $('.errorbilatidakditindak').html(response.error.bilatidakditindak);
                        } else {
                            $('#bilatidakditindak').removeClass('form-control-danger');
                            $('.errorbilatidakditindak').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                    }
                }


            });
            return false;
        });
    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/wizard/jquery.steps.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/wizard/jquery.validate.min.js"></script>
<script>
    //Custom design form example
    $(".tab-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Done"
        },
        onFinished: function(event, currentIndex) {
            swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");

        }
    });


    var form = $(".validation-wizard").show();

    $(".validation-wizard").steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
        titleTemplate: '<span class="step">#index#</span> #title#',
        labels: {
            finish: "Submit"
        },
        onStepChanging: function(event, currentIndex, newIndex) {
            return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error").remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")), form.validate().settings.ignore = ":disabled,:hidden", form.valid())
        },
        onFinishing: function(event, currentIndex) {
            return form.validate().settings.ignore = ":disabled", form.valid()
        },
        onFinished: function(event, currentIndex) {
            swal("Form Submitted!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        }
    }), $(".validation-wizard").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger",
        successClass: "text-success",
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element)
        },
        rules: {
            email: {
                email: !0
            }
        }
    })
</script>

<script type="text/javascript">
    $('.label-toggle').on('click', function() {
        $('#' + $(this).attr('for')).bootstrapToggle('toggle');
    })

    $('.make-switch').change(function() {
        if ($(this).data('switch') == 0) {

            $(this).data('switch', 1);
            ajax_switch($(this).data('field'), $(this).data('switch'), $(this).data('id'));

        } else {
            //alert(0);
            $(this).data('switch', 0);
            ajax_switch($(this).data('field'), $(this).data('switch'), $(this).data('id'));

        }
    });

    function ajax_switch(field, value, id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('PascaBedah/ajax_SSC') ?>',
            data: {
                field: field,
                value: value,
                id: id
            },
            success: function(response) {

            }
        })
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintlapoperasi').on('click', function() {

            let id = $('#journalnumber').val();
            window.open("<?php echo base_url('EdukasiBedah/printlaporanoperasi') ?>?page=" + id, "_blank");

        })
    });
</script>



<?= $this->endSection(); ?> -->