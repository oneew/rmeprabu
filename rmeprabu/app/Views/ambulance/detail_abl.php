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
                <small class="text-muted pt-4 d-block">Kirim Email</small>
                <button class="btn btn-outline-warning waves-effect waves-light" type="button"><span class="mr-1"><i class="far fa-envelope"></i></span>Mail</button>

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
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Histori Pelayanan Ambulance</a></li>
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
                        <div class="btn-list">
                            <!-- Standard  modal -->
                            <button type="button" class="btn btn-danger" onclick="ABL('<?= $id ?>')"> <i class="mdi mdi-ambulance"></i> Tambah Pelayanan Ambulance</button>
                        </div>
                        <hr>
                        <?= form_open('PelayananABL/update_admission', ['class' => 'formvalidasiadmission']); ?>
                        <?= csrf_field(); ?>
                        <p class="mt-4 viewdataadmission"></p>
                        <?= form_close() ?>
                        <hr>
                        <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                        <p class="mt-4 viewdataresume">
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
                        <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                        <input type="hidden" id="relation" name="relation" class="form-control" value="<?= $pasienid; ?>" readonly>
                        <p class="mt-4 viewhistori">

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

            url: "<?php echo base_url('PelayananABL/resumeGabung') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
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
    function dataadmission() {

        $.ajax({

            url: "<?php echo base_url('PelayananABL/admission') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataadmission').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataadmission();


    });
</script>

<script>
    function historiradiologi() {
        $.ajax({

            url: "<?php echo base_url('PelayananABL/historiABL') ?>",
            data: {
                relation: $('#relation').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewhistori').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        historiradiologi();
    });
</script>




<script>
    function ubah(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananBD/formubahmaster'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaleditBD').modal('show');

                }
            }

        });


    }
</script>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });

    function ABL(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananABL/AddPemeriksaan'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputABL').modal('show');

                }
            }

        });


    }
</script>

<?= $this->endSection(); ?>