<div id="modalrmerajal_poliklinik_medis_igd" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
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
                                <div class="align-self-center">
                                    <img src="<?= $pasiengender == 'L' ? base_url('assets/images/users/pasienlaki.jpg') : base_url('assets/images/users/pasienperempuan.jpg'); ?>" class="rounded-circle" width="55" alt="">
                                    <h5 class="card-title"><?= $pasienname; ?></h5>
                                    <h6 class="card-title"><?= $pasienid; ?></h6>
                                    <p class="text-white"><?= $pasienage; ?></p>
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
                                        <a class="dropdown-item" href="#" onclick="LaporanOperasiGeneralRajal('<?= $referencenumber ?>')">Isi Laporan Operasi General</a>
                                        <a class="dropdown-item" href="#" onclick="LaporanOperasiKatarakRajal('<?= $referencenumber ?>')">Isi Laporan Operasi Katarak</a>
                                        <?php if (check_lap_ibs($referencenumber) == 'ADA') : ?>
                                            <button type="button" class="dropdown-item" onclick="EditLaporanOperasiGeneralRajal('<?= $referencenumber ?>')">Edit Laporan Operasi General</button>
                                        <?php endif ?>
                                        <?php if (check_lap_katarak($referencenumber) == 'ADA') : ?>
                                            <button type="button" class="dropdown-item" onclick="EditLaporanOperasiKatarakRajal('<?= $referencenumber ?>')">Edit Laporan Operasi Katarak</button>
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
                                        <a class="dropdown-item" href="#" onclick="readCPPT('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-laptop"></i></span>Histori CPPT Terintegrasi</a>
                                        <a class="dropdown-item" href="#" onclick="cek_histori('<?= $pasienid ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Histori CPPT IGD / IRJ</a>
                                        <a class="dropdown-item" href="#" onclick="histori_pelayanan('<?= $pasienid ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Histori Pelayanan Pasien</a>
                                    </div>
                                </div>
                                <div class="dropdown mb-2">
                                    <button type="button" class="btn btn-primary dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi Lain
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="verifikasi_cppt('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-angle-double-right"></i></span>Verifikasi CPPT Perawat</a>
                                        <a class="dropdown-item" href="#" onclick="verifikasi_transfer('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-share"></i></span>Verifikasi Transfer Pasien</a>
                                        <a class="dropdown-item" href="#" onclick="edukasi_prabedah('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-share"></i></span>Formulir Persetujuan Tindakan Medik</a>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <div class="dropdown">
                                        <button type="button" class="btn-block btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                    <div class="dropdown mt-3">
                                        <button type="button" class="btn-block btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-file"></i> File RME
                                        </button>
                                        <div class="dropdown-menu animated flipInY">
                                            <a class="dropdown-item" href="#" onclick="uploadFileigd('<?= $referencenumber ?>')">Upload File</a>
                                            <a class="dropdown-item" href="#" onclick="historyFileigd('<?= $referencenumber ?>')">History File</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-12">
                        <?php if (check_triase_igd($referencenumber) == 'TIDAK ADA') : ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Triase IGD belum diisi !!!</strong>
                            </div>
                        <?php endif ?>
                        <?php if (check_asesmen_perawat_igd($referencenumber) == 'BELUM DIISI') : ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Asesmen Perawat IGD belum diisi !!!</strong>
                            </div>
                        <?php endif ?>
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Asesmen Medis IGD</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cppt" role="tab">CPPT</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#hasilasesmen" role="tab">Hasil Asesmen Medis IGD</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#resumeMedis" role="tab">Resume Medis</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#resumeResep" role="tab">Status E-Resep</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body viewdatacatatanmedis"></div>
                                </div>
                                <div class="tab-pane" id="cppt" role="tabpanel">
                                    <div class="card-body viewdatacppt"></div>
                                </div>
                                <div class="tab-pane" id="hasilasesmen" role="tabpanel">
                                    <div class="card-body viewdatahasilasesmen"></div>
                                </div>
                                <div class="tab-pane" id="resumeMedis" role="tabpanel">
                                    <div class="card-body viewdataResumeMedis"></div>
                                </div>
                                <div class="tab-pane" id="resumeResep" role="tabpanel">
                                    <div class="card-body viewdataResumeResep"></div>
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
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalMedisIGD') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatacatatanmedis').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        asesmenMedis();

    });
</script>

<script>
    function Hasilasesmen() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/HasilresumeMedis') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatahasilasesmen').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        Hasilasesmen();

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

    function uploadFileigd(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/uploadFileigd'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalupload_file').modal('show');
                }
            }
        });
    }

    function historyFileigd(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/historyFileigd'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalhistory_file').modal('show');
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
    function dataResumeResep() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/ResumeResepIGD') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataResumeResep').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataResumeResep();

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
    function LaporanOperasiGeneralRajal(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/LOGeneralRajal'); ?>",
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

    function EditLaporanOperasiGeneralRajal(id) {
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

    function LaporanOperasiKatarakRajal(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/LOKatarakRajal'); ?>",
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

    function EditLaporanOperasiKatarakRajal(id) {
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

    $(document).ready(function() {
        $('.btnprintOperasiKatarak').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printLaporanOperasiKatarakRajal') ?>?page=" + id, "_blank");
        })

        $('.btnprintOperasiGeneral').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printLaporanOperasiGeneralRajal') ?>?page=" + id, "_blank");
        })
    });

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
</script>