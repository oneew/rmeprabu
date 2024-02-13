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
                    <h4 class="card-title"><?= $pasienname; ?><button class="btn btn-outline-info waves-effect waves-light" type="button" onclick="ubahFRS('<?= $id ?>')"><i class="fa fa-edit"></i></button>

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
                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Resume & Ekpertise</a></li>
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
                            <button type="button" class="btn btn-primary" onclick="Forensik('<?= $id ?>')"> <i class="fas fa-file-medical-alt"></i> Tambah Pemeriksaan/ Pelayanan Forensik</button>
                            <button type="button" class="btn btn-danger" onclick="Visum('<?= $journalnumber ?>')"> <i class="fas fa-notes-medical"></i> Expertise Visum</button>
                            <button type="button" class="btn btn-warning" onclick="SK('<?= $journalnumber ?>')"> <i class="fas fa-first-aid"></i> Surat Kematian</button>
                            <button id="print" class="btn btn-danger btnprinttagihan" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Cetak Tagihan</button>
                            <button id="print" class="btn btn-info btnprintrincian" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Cetak Rincian</button>
                        </div>
                        <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                        <p class="mt-4 viewdataresume">

                        </p>
                        </p>

                    </div>
                </div>

                <!--second tab-->
            </div>
        </div>
    </div>
    <!-- Column -->
</div>


<div class="viewmodal" style="display:none;"></div>

<script>
    function dataresume() {

        $.ajax({

            url: "<?php echo base_url('PelayananFRS/resumeGabung') ?>",
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
    function resumeexpertise() {

        $.ajax({

            url: "<?php echo base_url('PelayananFRS/resumeexpertise') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewexpertise').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeexpertise();


    });
</script>


<script>
    function ubahFRS(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananFRS/formubahmaster'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaleditFRS').modal('show');

                }
            }

        });


    }
</script>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });

    function Forensik(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananFRS/AddPemeriksaan'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputFRS').modal('show');

                }
            }

        });


    }
</script>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });


    function Visum(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananFRS/CreateExpertise'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalexpertisevisum').modal('show');

                }
            }

        });


    }

    function SK(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananFRS/CreateSuratKematian'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalsuratkematian').modal('show');

                }
            }

        });


    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprinttagihan').on('click', function() {
            let id = $('#journalnumber').val();
            window.open("<?php echo base_url('KasirRAD/printdetailkwitansiTagihan') ?>?page=" + id, "_blank");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintrincian').on('click', function() {
            let id = $('#journalnumber').val();
            window.open("<?php echo base_url('KasirRAD/printdetailkwitansiTagihanKonvensional') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=600");
        })
    });
</script>

<?= $this->endSection(); ?>