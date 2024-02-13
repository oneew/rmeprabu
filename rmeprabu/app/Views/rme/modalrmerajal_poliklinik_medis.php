<div id="modalrmerajal_poliklinik_medis" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
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
                                    <p class="text-white"><?= $pasienage; ?>
                                        <br class="text-white"><?= $pasienaddress; ?> <?= $pasiensubareaname; ?>
                                        <br class="text-white"><?= $paymentmethodname; ?>
                                    </p>

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
                                <div class="dropdown">
                                    <button type="button" class="btn btn-info btn-block mb-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Histori Pasien
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="cek_histori('<?= $pasienid ?>')">Histori CPPT Pasien</a>
                                        <a class="dropdown-item" href="#" onclick="cek_histori_ranap('<?= $pasienid ?>')">Histori CPPT Ranap</a>
                                        <a class="dropdown-item" href="#" onclick="cek_historikonsul('<?= $pasienid ?>')">Histori Konsultasi</a>
                                        <a class="dropdown-item" href="#" onclick="histori_pelayanan('<?= $pasienid ?>')">Histori Pelayanan</a>
                                        <a class="dropdown-item" href="#" onclick="historiGos('<?= $pasienid ?>')">Histori CPPT SIMGOS</a>

                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-block mb-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi Lain
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="verifikasi_cppt('<?= $referencenumber ?>')">Verifikasi CPPT Perawat</a>
                                        <a class="dropdown-item" href="#" onclick="edukasi_prabedah('<?= $referencenumber ?>')">Form Persetujuan Tindakan Medik</a>
                                        <a class="dropdown-item" href="#" onclick="jawabKonsul('<?= $referencenumber ?>')">Jawab Konsul</a>

                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-block mb-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Dokumen RME
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="uploadFile('<?= $referencenumber ?>')">Upload File</a>
                                        <a class="dropdown-item" href="#" onclick="historyFile('<?= $referencenumber ?>')">History File</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-danger btn-block mb-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Surat Medis Pasien
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="suratKontrol('<?= $referencenumber ?>')">Surat Kontrol BPJS</a>
                                        <a class="dropdown-item" href="#" onclick="suratKontrolTunai('<?= $referencenumber ?>')">Surat Kontrol Tunai</a>
                                        <a class="dropdown-item" href="#" onclick="suratRujukan('<?= $referencenumber ?>')">Surat Rujukan</a>
                                        <a class="dropdown-item" href="#" onclick="suratSakit('<?= $referencenumber ?>')">Surat Sakit</a>
                                        <a class="dropdown-item" href="#" onclick="SuratKeterangan('<?= $referencenumber ?>')">Surat Keterangan Sehat</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-12">
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Asesmen Medis</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cppt" role="tab">CPPT</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#resumeMedis" role="tab">Resume Medis</a></li>
                                <?php if ($roomname == 'MCU REGULER') : ?>
                                    <li class="nav-item"> <a class="nav-link btn-disabilitas" data-toggle="tab" href="#suratDisabilitas" role="tab">Resume Disabilitas MCU</a></li>
                                    <li class="nav-item"> <a class="nav-link btn-skd" data-toggle="tab" href="#skd" role="tab">Resume SKD MCU</a></li>
                                    <li class="nav-item"> <a class="nav-link btn-sk" data-toggle="tab" href="#skd" role="tab">Resume SK MCU</a></li>
                                <?php endif ?>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body viewdatacatatanmedis"></div>
                                </div>
                                <div class="tab-pane" id="cppt" role="tabpanel">
                                    <div class="card-body viewdatacppt"></div>
                                </div>
                                <div class="tab-pane" id="resumeMedis" role="tabpanel">
                                    <div class="card-body viewdataresumeMedis"></div>
                                </div>
                                <?php if ($roomname == 'MCU REGULER') : ?>
                                    <div class="tab-pane" id="suratDisabilitas" role="tabpanel">
                                        <div class="card-body viewSuratDisabilitas"></div>
                                    </div>
                                    <div class="tab-pane" id="skd" role="tabpanel">
                                        <div class="card-body viewSkd"></div>
                                    </div>
                                    <div class="tab-pane" id="sk" role="tabpanel">
                                        <div class="card-body viewSk"></div>
                                    </div>
                                <?php endif ?>
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
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalMedis') ?>",
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

    function uploadFile(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/uploadFile'); ?>",
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

    function historyFile(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/historyFile'); ?>",
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
    function historiGos(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/riwayatCPPTGOS'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_cppt_gos').modal('show');
                }
            }
        });
    }

    function jawabKonsul(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/jawabKonsulRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalcreate_jawabkonsul_rajal').modal('show');
                }
            }
        });
    }
</script>



<script>
    function dataResumeMedis() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/ResumeMedisRajal') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataresumeMedis').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataResumeMedis();

    });
</script>


<script>
    function edukasi_prabedah(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/EdukasiPraBedah'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_edukasi_pra_bedah').modal('show');
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

    function cek_historikonsul(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/riwayatCPPTkonsul'); ?>",
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
</script>

<script>
    function disabilitasResume() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeDisabilitasMcu') ?>",
            data: {
                referencenumber: $('#referencenumber').val(),
                pasienid: '<?= $pasienid; ?>'
            },
            dataType: "json",
            success: function(response) {
                $('.viewSuratDisabilitas').html(response.data);
            }
        });
    }

    function resumeSkd() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeSkdMcu') ?>",
            data: {
                referencenumber: $('#referencenumber').val(),
                pasienid: '<?= $pasienid; ?>'
            },
            dataType: "json",
            success: function(response) {
                $('.viewSkd').html(response.data);
            }
        });
    }

    function resumeSk() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeSkMcu') ?>",
            data: {
                referencenumber: $('#referencenumber').val(),
                pasienid: '<?= $pasienid; ?>'
            },
            dataType: "json",
            success: function(response) {
                $('.viewSkd').html(response.data);
            }
        });
    }

    $('.btn-disabilitas').on('click', function(event) {
        disabilitasResume()
    })
    $('.btn-skd').on('click', function(event) {
        resumeSkd()
    })
    $('.btn-sk').on('click', function(event) {
        resumeSk()
    })

    function cek_histori_ranap(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/historyCpptRanap'); ?>",
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