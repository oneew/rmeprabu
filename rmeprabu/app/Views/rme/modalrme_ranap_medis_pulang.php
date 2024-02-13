<div id="modalrme_ranap_medis_pulang" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-2 col-md-12">

                        <div class="card profile-card"> <img class="card-img profile-img" src="<?= base_url(); ?>/assets/images/background/kamaroperasi.jpg" alt="Card image">
                            <div class="card-img-overlay card-inverse social-profile d-flex justify-content-center">
                                <?php
                                if ($pasiengender == 'L') {
                                    $gambar = '../assets/images/users/pasienlaki.jpg';
                                } else {
                                    $gambar = '../assets/images/users/pasienperempuan.jpg';
                                }

                                ?>
                                <div class="align-self-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='55'>"; ?>
                                    <h5 class="card-title"><?= $pasienname; ?></h5>
                                    <h6 class="card-title"><?= $pasienid; ?></h6>
                                    <p class="text-white"><?= $pasienaddress; ?> <?= $pasiensubareaname; ?></p>
                                    <p class="text-white"><?= $paymentmethodname; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                            <div class="dropdown">
                                    <button type="button" class="btn btn-info btn-block mb-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Laporan Operasi
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="LaporanOperasiGeneral('<?= $referencenumber ?>')">Isi Laporan Operasi General</a>
                                        <a class="dropdown-item" href="#" onclick="LaporanOperasiKatarak('<?= $referencenumber ?>')">Isi Laporan Operasi Katarak</a>
                                        <?php if (check_lap_ibs($referencenumber) == 'ADA') : ?>
                                            <button type="button" class="dropdown-item" onclick="EditLaporanOperasiGeneral('<?= $referencenumber ?>')">Edit Laporan Operasi General</button>
                                        <?php endif ?>
                                        <?php if (check_lap_katarak($referencenumber) == 'ADA') : ?>
                                            <button type="button" class="dropdown-item" onclick="EditLaporanOperasiKatarak('<?= $referencenumber ?>')">Edit Laporan Operasi Katarak</button>
                                        <?php endif ?>
                                        <button id="print" class="dropdown-item btnprintOperasiGeneral" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span> Laporan Operasi General.pdf</button>
                                        <button id="print" class="dropdown-item btnprintOperasiKatarak" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span> Laporan Operasi Katarak.pdf</button>
                                    </div>
                                </div>
                            <div class="dropdown mb-2">
                            <button type="button" class="btn btn-secondary dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Histori Pasien
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                <a class="dropdown-item" href="#"  onclick="readCPPT('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-laptop"></i></span>Histori CPPT Terintegrasi</a>
                                <a class="dropdown-item" href="#"  onclick="cek_histori('<?= $pasienid ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Histori CPPT Rawat Jalan</a>
                                <a class="dropdown-item" href="#"  onclick="histori_pelayanan('<?= $pasienid ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Histori Pelayanan Pasien</a>
                                </div>
                            </div>
                            <div class="dropdown mb-2">
                            <button type="button" class="btn btn-dark dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi Lain
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                <a class="dropdown-item" href="#"  onclick="verifikasi_cppt('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-angle-double-right"></i></span>Verifikasi CPPT Perawat</a><a class="dropdown-item" href="#"  onclick="edukasi_prabedah('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-share"></i></span>Formulir Persetujuan Tindakan Medik</a>
                                </div>
                            </div>
                                <div class="dropdown mb-2">
                                    <button type="button" class="btn btn-danger dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Surat Medis
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="suratKontrol('<?= $referencenumber ?>')">Surat Kontrol BPJS</a>
                                        <a class="dropdown-item" href="#" onclick="suratKontrolTunai('<?= $referencenumber ?>')">Surat Kontrol Tunai</a>
                                        <a class="dropdown-item" href="#" onclick="suratRujukan('<?= $referencenumber ?>')">Surat Rujukan</a>
                                        <a class="dropdown-item" href="#" onclick="suratSakit('<?= $referencenumber ?>')">Surat Sakit</a>
                                        <a class="dropdown-item" href="#" onclick="SuratKeterangan('<?= $referencenumber ?>')">Surat Keterangan Sehat</a>
                                    </div>
                                </div>
                                <button class="btn btn-warning btn-block" onclick="tambahCPPT('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-plus"></i></span>CPPT</button>
                                <button id="print" class="btn btn-success btn-block btnprintResumeMedis" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span> Resume Medis</button>
                                <?php if (check_resume_ranap($referencenumber) == 'ADA') : ?>
                                    <button type="button"class="btn btn-success btn-block" onclick="update_asesmen_pulang('<?= $referencenumber ?>')"> <span class="mr-1"><i class="fas fa-history"></i></span>Update Resume Medis Pasien</button>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-12">
                        <?php if (check_resume_ranap($referencenumber) == 'TIDAK ADA') : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Data resume medis belum diisi !!!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif ?>
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Asesmen Pulang Pasien</a></li>
                                <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cppt" role="tab">Hasil Asesmen Pulang Pasien</a></li> -->

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body viewdataasesmenpulang"></div>
                                </div>
                                <div class="tab-pane" id="cppt" role="tabpanel">
                                    <div class="card-body viewdatacppt"></div>
                                </div>

                                <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                <input type="hidden" id="namapoli" name="namapoli" class="form-control" value="<?= $roomname; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="viewmodalmedis" style="display:none;"></div>

<script>
    function asesmenMedis() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenPulangMedisRanap') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataasesmenpulang').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        asesmenMedis();

    });
</script>


<script>
    function dataCPPT() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/CPPTMedis') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatacppt').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataCPPT();

    });
</script>

<script>
    function cek_histori(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/riwayatCPPT'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalresume_cppt').modal('show');
                }
            }
        });
    }
</script>


<script>
    function histori_pelayanan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/riwayatPelayananMedis'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalriwayatpelayananmedis').modal('show');
                }
            }
        });
    }
</script>


<script>
    function verifikasi_cppt(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/riwayatCPPTPerawatVerifikasi'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalresume_cppt_perawat_verifikasi').modal('show');
                }
            }
        });
    }
</script>


<script>
    function verifikasi_transfer(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeTransferVerifikasi'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalresume_transfer_verifikasi').modal('show');
                }
            }
        });
    }
</script>



<script>
    function dataResumeMedis() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/ResumeMedisIGD') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataResumeMedis').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataResumeMedis();

    });
</script>


<script>
    function readCPPT(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeCPPTRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalresume_cppt_ranap').modal('show');
                }
            }
        });
    }

    function tambahCPPT(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/tambahCPPTRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalcreate_cppt_ranap').modal('show');
                }
            }
        });
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintResumeMedis').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printResumeMedisRanap') ?>?page=" + id, "_blank");
        })
    });
</script>



<script>
    function edukasi_prabedah(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/EdukasiPraBedahRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_edukasi_pra_bedah_ranap').modal('show');
                }
            }
        });
    }
</script>

<script>
    function update_asesmen_pulang(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/editAsesmenPulangRanap'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_update_asesmen_pulang_ranap').modal('show');
                }
            }
        });
    }
</script>
<script>
function LaporanOperasiKatarak(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/LOKatarak'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalcreate_lo_katarak').modal('show');
                }
            }
        });
    }

    function LaporanOperasiGeneral(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/LOGeneral'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalcreate_lo_general').modal('show');
                }
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintOperasiKatarak').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printLaporanOperasiKatarak') ?>?page=" + id, "_blank");
        })

        $('.btnprintOperasiGeneral').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printLaporanOperasiGeneral') ?>?page=" + id, "_blank");
        })
    });

    function EditLaporanOperasiGeneral(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/EditLOGeneral'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalcreate_lo_general').modal('show');
                }
            }
        });
    }

    function EditLaporanOperasiKatarak(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/EditLOKatarak'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalupdate_lo_katarak').modal('show');
                }
            }
        });
    }
</script>