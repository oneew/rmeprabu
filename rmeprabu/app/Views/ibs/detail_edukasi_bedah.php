<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="<?= base_url(); ?>/assets/plugins/summernote/dist/summernote-bs4.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">


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
                <button class="btn btn-outline-danger waves-effect waves-light" type="button" onclick="lihatEPB('<?= $id ?>')"><span class="mr-1"><i class="far fa-heart"></i></span>EPB</button>
                <button class="btn btn-outline-primary waves-effect waves-light" type="button" onclick="InformConcent('<?= $id ?>')"><span class="mr-1"><i class="fa fa-check"></i></span>Persetujuan Tindakan Operasi</button>

            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Resume</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile5" role="tab">Edukasi</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Penjadwalan Operasi</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">Setup Team Pelaksana</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Ceklis Dokumen Pra Bedah- Anestesi</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
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
                                <div class="sl-left float-left mr-3"> <img src="../assets/images/users/catatan.png" alt="user" class="rounded-circle"> </div>
                                <div class="sl-right">
                                    <div><a href="#" class="link">Data Operasi</a> <span class="sl-date text-muted">
                                            <form method="post" id="form-filter">
                                                <?php helper('form') ?>
                                                <?= csrf_field(); ?>
                                                <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                                <input type="hidden" id="relation" name="relation" class="form-control" value="<?= $pasienid; ?>" readonly>
                                            </form>
                                            <blockquote class="mt-2">
                                                <p class="card-text dataoperasiresume">
                                                </p>
                                            </blockquote>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="sl-item mt-2 mb-3">
                                <div class="sl-left float-left mr-3"> <img src="<?= base_url(); ?>/assets/images/users/catatan.png" alt="user" class="rounded-circle"> </div>
                                <div class="sl-right">
                                    <div><a href="#" class="link">Data Jadwal Operasi</a> <span class="sl-date text-muted">
                                            <form method="post" id="form-filter">

                                                <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                                <input type="hidden" id="journalnumbertim" name="journalnumbertim" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                                <input type="hidden" id="relation" name="relation" class="form-control" value="<?= $pasienid; ?>" readonly>
                                            </form>
                                            <blockquote class="mt-2">
                                                <p class="card-text jadwaloperasiresume">
                                                </p>
                                            </blockquote>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="sl-item mt-2 mb-3">
                                <div class="sl-left float-left mr-3"> <img src="<?= base_url(); ?>/assets/images/users/catatan.png" alt="user" class="rounded-circle"> </div>
                                <div class="sl-right">
                                    <div><a href="#" class="link">Tim Pelaksana Operasi</a> <span class="sl-date text-muted">
                                            <blockquote class="mt-2">
                                                <p class="card-text pelaksanaoperasiresume">
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
                        <hr>
                        <p class="mt-4 dataoperasiinputjadwal">
                        </p>
                        <p class="card-text jadwaloperasiresume">
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

                        <p class="mt-4 jadwaluntukinput_tim">
                        </p>
                    </div>
                </div>


                <div class="tab-pane card-body view-dpb" id="profile3" role="tabpanel">
                    <div class="">


                        <div class="row ">

                        </div>

                    </div>
                </div>


                <div class="tab-pane" id="profile4" role="tabpanel">
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

                        </p>


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
                        <div id="slimtest4">
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
                                                <input type="hidden" id="signature" name="signature" class="form-control tandatangan">
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
                                                <button class="button-mic"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <label class="control-label">Kondisi Pasien</label>
                                                <textarea id="kondisipasien" name="kondisipasien" class="textarea_editor form-control" rows="3" value="<?= $kondisipasien; ?>" placeholder="Enter text ..."><?= $kondisipasien; ?></textarea>
                                                <div class="form-control-feedback errorkondisipasien">

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-success">
                                                <button class="button-name"><i class="fa fa-microphone" aria-hidden="true"></i></button>
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
                                                <button class="button-manfaattindakan"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <label class="control-label">Manfaat Tindakan</label>
                                                <textarea id="manfaattindakan" name="manfaattindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."><?= $manfaattindakan; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-success">
                                                <button class="button-tatacara"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <label class="control-label">Tata cara Uraian singkat prosedur</label>
                                                <textarea id="tatacara" name="tatacara" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."><?= $tatacara; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-success">
                                                <button class="button-risikotindakan"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <label class="control-label">Risiko Tindakan</label>
                                                <textarea id="risikotindakan" name="risikotindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."><?= $risikotindakan; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-success">
                                                <button class="button-komplikasitindakan"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <label class="control-label">Komplikasi Tindakan</label>
                                                <textarea id="komplikasitindakan" name="komplikasitindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."><?= $komplikasitindakan; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-success">
                                                <button class="button-dampaktindakan"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <label class="control-label">Dampak Tindakan</label>
                                                <textarea id="dampaktindakan" name="dampaktindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."><?= $dampaktindakan; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-success">
                                                <button class="button-prognosistindakan"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <label class="control-label">Prognosis Tindakan</label>
                                                <textarea id="prognosistindakan" name="prognosistindakan" class="textarea_editor form-control" rows="3" placeholder="Prognosis vital, prognosis fungsi dan prognosis kesembuhan"><?= $prognosistindakan; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-success">
                                                <button class="button-alternatif"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <label class="control-label">Kemungkinan Alternatif Tindakan</label>
                                                <textarea id="alternatif" name="alternatif" class="textarea_editor form-control" rows="3" placeholder="enter text.."><?= $alternatif; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group has-success">
                                                <button class="button-bilatidakditindak"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                                <label class="control-label">Kemungkinan hasil bila tidak dilakukan tindakan</label>
                                                <textarea id="bilatidakditindak" name="bilatidakditindak" class="textarea_editor form-control" rows="3" placeholder="enter text.."><?= $bilatidakditindak; ?></textarea>
                                                <div class="form-control-feedback errorbilatidakditindak">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-success">
                                                <p>Sign Below:</p>
                                                <div class="js-signature" data-width="400" data-height="100" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="false"></div>
                                                <p><button id="clearBtn" class="btn btn-default">Clear Canvas</button></p>
                                                <div id="signature">
                                                    <p><em></em></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($signature <> '') { ?>
                                            <div class="col-md-6">
                                                <div class="form-group has-success">
                                                    <p>Sign:</p>
                                                    <div class="card">
                                                        <div class="el-card-item">
                                                            <div class="el-card-avatar el-overlay-1"> <img src="<?= $signature ?>" alt="user" />
                                                                <div class="el-overlay">
                                                                    <ul class="el-info">

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="el-card-content">
                                                                <h5 class="mb-0"><?= $doktername; ?></h5> <small><?= $smfname; ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                                        Simpan</button>
                                    <button type="button" class="btn btn-inverse">Cancel</button>
                                </div>
                            </form>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <!-- Column -->
</div>


<div class="viewmodal" style="display:none;"></div>

<!-- <script type="text/javascript">
    function berangkat() {
        var page = document.getElementById("journalnumber").value;

        window.location.href = "<?php echo base_url('BedahTim/keluar'); ?>?page=" + page;
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(window).keyup(function(e) {
            if (e.keyCode == 44) {
                $("body").hide();
                $("body").html(' ');
            }

        });
    });
</script>


<script>
    function copyToClipboard() {
        // Create a "hidden" input
        var aux = document.createElement("input");
        // Assign it the value of the specified element
        aux.setAttribute("value", "Você não pode mais dar printscreen. Isto faz parte da nova medida de segurança do sistema.");
        // Append it to the body
        document.body.appendChild(aux);
        // Highlight its content
        aux.select();
        // Copy the highlighted text
        document.execCommand("copy");
        // Remove it from the body
        document.body.removeChild(aux);
        alert("Print screen ditolak.");
    }

    $(window).keyup(function(e) {
        if (e.keyCode == 44) {
            berangkat();
            copyToClipboard();
        }
    });

    $(window).focus(function() {
        $("body").hide();
    }).blur(function() {
        $("body").hide();
    });
</script>
 -->

<script>
    function view_dpb() {

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('EdukasiBedah/view_dpb') ?>",
            data: {
                journalnumber: $('#journalnumbertim').val()
            },
            success: function(response) {
                $('.view-dpb').html(response);
            }
        });
    }
    $(document).ready(function() {
        view_dpb();

    });
</script>



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

            url: "<?php echo base_url('EdukasiBedah/cek') ?>",
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
    function datajadwal() {

        $.ajax({

            url: "<?php echo base_url('EdukasiBedah/datajadwal') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.jadwaloperasiresume').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datajadwal();
    });
</script>


<script>
    function datajadwalinputtim() {

        $.ajax({

            url: "<?php echo base_url('BedahTim/listjadwaloperasi') ?>",
            data: {
                journalnumber: $('#journalnumbertim').val()
            },
            dataType: "json",
            success: function(response) {
                $('.jadwaluntukinput_tim').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datajadwalinputtim();


    });
</script>


<script>
    function pelaksanaoperasiresume() {

        $.ajax({

            url: "<?php echo base_url('BedahTim/datatim') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.pelaksanaoperasiresume').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        pelaksanaoperasiresume();


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
    function lihatEPB(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('rawatinap/formlihatEPB'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modallihatEPB').modal('show');

                }
            }

        });


    }
</script>

<!-- <script type="text/javascript" src="../assets/plugins/jq-signature/jq-signature.js"></script> -->

<script>
    $(document).ready(function() {
        if ($('.js-signature').length) {
            $('.js-signature').jqSignature();
        }

        $('#clearBtn').on('click', function(e) {
            e.preventDefault();
            $('.js-signature').eq(0).jqSignature('clearCanvas');
            $('#saveBtn').attr('disabled', true);
            //alert($('.js-signature').html());
        });

        $('#saveBtn').on('click', function() {
            let save = $('.js-signature').eq(0).jqSignature('getDataURL');
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('Signature/insert_sign') ?>",
                data: {
                    signature: save
                },
                success: function(response) {
                    $('.list-sign').append(response);
                }
            });

        });

        $('.js-signature').eq(0).on('jq.signature.changed', function() {
            $('.tandatangan').val($(this).jqSignature('getDataURL'));

        });
    });
</script>
<!-- <script src="../assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="../assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script src="../assets/plugins/dropzone-master/dist/dropzone.js"></script>

<script src="../assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="../assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
<script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();

    });
</script> -->

<script src="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>

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
                            nformConcentcon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })


                        // dataperawat();
                        // datahistoritindakan();

                    }
                }


            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.button-mic').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#kondisipasien').html(finalTranscripts);
                    $('#kondisipasien').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#kondisipasien').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })

    $(document).ready(function() {

        $('.button-name').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#name').html(finalTranscripts);
                    $('#name').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#name').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })

    $(document).ready(function() {

        $('.button-manfaattindakan').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#manfaattindakan').html(finalTranscripts);
                    $('#manfaattindakan').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#manfaattindakan').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })

    $(document).ready(function() {

        $('.button-tatacara').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#tatacara').html(finalTranscripts);
                    $('#tatacara').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#tatacara').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })

    $(document).ready(function() {

        $('.button-risikotindakan').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#risikotindakan').html(finalTranscripts);
                    $('#risikotindakan').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#risikotindakan').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })

    $(document).ready(function() {

        $('.button-komplikasitindakan').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#komplikasitindakan').html(finalTranscripts);
                    $('#komplikasitindakan').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#komplikasitindakan').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })

    $(document).ready(function() {

        $('.button-dampaktindakan').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#dampaktindakan').html(finalTranscripts);
                    $('#dampaktindakan').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#dampaktindakan').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })

    $(document).ready(function() {

        $('.button-prognosistindakan').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#prognosistindakan').html(finalTranscripts);
                    $('#prognosistindakan').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#prognosistindakan').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })

    $(document).ready(function() {

        $('.button-alternatif').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#alternatif').html(finalTranscripts);
                    $('#alternatif').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#alternatif').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })

    $(document).ready(function() {

        $('.button-bilatidakditindak').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#bilatidakditindak').html(finalTranscripts);
                    $('#bilatidakditindak').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#bilatidakditindak').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })
</script>

<script>
    function InformConcent(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('rawatinap/forminformconcent'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinformconcent').modal('show');

                }
            }

        });


    }
</script>

<script src="<?= base_url(); ?>/js/jquery.slimscroll.js"></script>
<script src="<?= base_url(); ?>/js/custom.min.js"></script>
<script type="text/javascript">
    $('#slimtest1').slimScroll({
        height: '250px'
    });
    $('#slimtest2').slimScroll({
        height: '250px'
    });
    $('#slimtest3').slimScroll({
        position: 'left',
        height: '1000px',
        railVisible: true,
        alwaysVisible: true
    });
    $('#slimtest4').slimScroll({
        color: '#00f',
        size: '10px',
        height: '600px',
        alwaysVisible: true
    });
</script>

<?= $this->endSection(); ?>