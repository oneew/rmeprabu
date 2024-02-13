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
                <small class="text-muted mt-2 d-block">Order Pemeriksaan :</small>
                <h6><?= $orderpemeriksaan; ?></h6>
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
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Histori</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">Expertise</a></li>

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
                                <p class="text-muted"><?= $pasiendateofbirth; ?>
                                    <br> <?php
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
                                            echo $umur;

                                            ?>
                                </p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Alamat</strong>
                                <br>
                                <p class="text-muted"><?= $pasienaddress; ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Status Pemeriksaan</strong>
                                <br>
                                <p class="text-muted text-uppercase"><?= $status_pemeriksaan; ?> periksa</p>
                            </div>
                        </div>
                        <hr>
                        <div class="btn-list">
                            <!-- Standard  modal -->

                            <button type="button" class="btn btn-success" onclick="PaketLPA('<?= $id ?>')"> <i class="fab fa-react"></i> Tambah Pemeriksaan</button>
                            <button id="print" class="btn btn-danger btnprinttagihan" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Cetak Tagihan</button>
                            <button id="print" class="btn btn-info btnprintrincian" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Cetak Rincian</button>
                            <div class="btn-group ml-1">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Status Pemeriksaan
                                </button>
                                <div class="dropdown-menu">
                                    <button type="button" class="dropdown-item" onclick="updateStatus('<?= $id; ?>', 'sedang', '<?= $pasienname ;?>')">Sedang diperiksa</button>
                                    <button type="button" class="dropdown-item" onclick="updateStatus('<?= $id; ?>', 'sudah', '<?= $pasienname ;?>')">Sudah diperiksa</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger" onclick="deleteBlanko('<?= $id; ?>', '<?= $pasienname ;?>')"><i class="fa fa-trash mr-1"></i>Hapus Blanko</button>
                        </div>
                        <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                        <p class="mt-4 viewdataresume">

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
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Status Pemeriksaan</strong>
                                <br>
                                <p class="text-muted text-uppercase"><?= $status_pemeriksaan; ?> periksa</p>
                            </div>
                        </div>
                        <hr>
                        <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                        <input type="hidden" id="relation" name="relation" class="form-control" value="<?= $pasienid; ?>" readonly>
                        <p class="mt-4 viewhistori">

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
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Status Pemeriksaan</strong>
                                <br>
                                <p class="text-muted text-uppercase"><?= $status_pemeriksaan; ?> periksa</p>
                            </div>
                        </div>
                        <hr>
                        <p class="mt-4 viewexpertise">

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

            url: "<?php echo base_url('PelayananLPA/resumeGabung') ?>",
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
    function historiradiologi() {
        $.ajax({

            url: "<?php echo base_url('PelayananLPA/historiLPA') ?>",
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
    function resumeexpertise() {

        $.ajax({

            url: "<?php echo base_url('PelayananLPA/resumeexpertise') ?>",
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
    function ubah(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananLPA/formubahmaster'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaleditLPA').modal('show');

                }
            }

        });


    }
</script>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });

    function LPA(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananLPA/AddPemeriksaan'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputLPA').modal('show');

                }
            }

        });
    }

    function PaketLPA(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananLPA/AddPemeriksaanPaket'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputPaketLPA').modal('show');

                }
            }

        });
    }

    function updateStatus(id, status, nama) {
        Swal.fire({
            title: 'Update',
            text: "Apakah anda yakin akan melakukan Update pemeriksaan pasien " + nama+  " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PasienRadiologi/ubahStatus'); ?>",
                    data: {
                        id: id,
                        status: status
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                            window.location.reload();
                        }
                    }
                });
            }
        })
    }

    function deleteBlanko(id, nama) {
        Swal.fire({
            title: 'Hapus !!',
            text: "Apakah anda yakin menghapus blanko pemeriksaan pasien " + nama+  ", data blanko yang sudah dihapus tidak dapat dikembalikan dan hasil pemeriksaan pada blanko ini akan terhapus ??",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PasienRadiologi/hapusBlanko'); ?>",
                    data: {
                        id: id,
                        status: status
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                            window.location.href = '<?= base_url('PelayananRegisterLPA') ?>';
                        }
                    }
                });
            }
        })
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