<div id="modalrme_ranap_medis" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
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
                                    <p class="text-white"><?= $pasienage; ?>
                                    <br class="text-white"><?= $pasienaddress; ?> <?= $pasiensubareaname; ?>
                                    <br class="text-white"><?= $paymentmethodname; ?></p>
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
                                <button class="btn btn-warning btn-block mb-2" type="button" onclick="tambahCPPT('<?= $referencenumber ?>')"><i class="fas fa-plus mr-1"></i>ISI FORM CPPT</button>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-block mb-2 toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Histori Pasien
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="readCPPT('<?= $referencenumber ?>')">Histori CPPT Terintegrasi</a>
                                        <a class="dropdown-item" href="#"onclick="cek_histori('<?= $pasienid ?>')">Histori CPPT Rajal</a>
                                        <a class="dropdown-item" href="#" onclick="histori_pelayanan('<?= $pasienid ?>')">Histori Pelayanan</a>
                                    </div>
                                </div>                           
                                <div class="dropdown">
                                    <button type="button" class="btn btn-danger dropdown-toggle btn-block mb-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Order Penunjang
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="pesanRAD('<?= $referencenumber ?>')">Radiologi</a>
                                        <a class="dropdown-item" href="#" onclick="pesanLPK('<?= $referencenumber ?>')">Patologi Klinik</a>
                                        <a class="dropdown-item" href="#" onclick="pesanLPA('<?= $referencenumber ?>')">Patologi Anatomi</a>
                                        <a class="dropdown-item" href="#" onclick="pesanRHM('<?= $referencenumber ?>')">Rehabilitasi Medik</a>
                                        <a class="dropdown-item" href="#" onclick="resumeOrderRanap('<?= $referencenumber ?>')">Resume Order</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary btn-block mb-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tata Laksana Medis
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="eResepRanap('<?= $referencenumber ?>')">eResep</a>
                                        <a class="dropdown-item" href="#" onclick="TNORanap('<?= $referencenumber ?>')">Tindakan</a>
                                        <a class="dropdown-item" href="#" onclick="eResepPulang('<?= $referencenumber ?>')">Terapi Pulang</a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-secondary btn-block mb-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Resume Medis
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                    <?php if (check_resume_ranap($referencenumber) == 'TIDAK ADA') : ?>
                                        <a class="dropdown-item" href="#" onclick="asesmen_pulang('<?= $referencenumber ?>')">Isi Resume Medis Pasien</a>
                                    <?php endif ?>
                                    <?php if (check_resume_ranap($referencenumber) == 'ADA') : ?>
                                        <a class="dropdown-item" href="#" onclick="update_asesmen_pulang('<?= $referencenumber ?>')">Update Resume Medis Pasien</a>
                                        <button id="print" class="dropdown-item btnprintResumeMedis" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span>Dokumen Resume Medis.pdf</button>
                                    <?php endif ?>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-success btn-block mb-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                <div class="dropdown">
                                    <button type="button" class="btn btn-dark btn-block mb-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi Lain-Lain
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <button class="dropdown-item" type="button" onclick="codingDiagnosa('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-plus"></i></span>Kodifikasi Diagnosa</button>
                                        <button class="dropdown-item" type="button" onclick="edukasi_prabedah('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-share"></i></span>Formulir Persetujuan Tindakan Medik</button>
                                        <button class="dropdown-item" type="button" onclick="verifikasi_cppt('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-angle-double-right"></i></span>Verifikasi CPPT Perawat</button>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-success btn-block mb-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-file"></i> File RME
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="#" onclick="uploadFile('<?= $referencenumber ?>')">Upload File</a>
                                        <a class="dropdown-item" href="#" onclick="historyFile('<?= $referencenumber ?>')">History File</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-12">
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Asesmen Medis Rawat Inap</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cppt" role="tab">CPPT</a></li>
                                <!-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#hasilasesmen" role="tab">Hasil Asesmen Medis Rawat Inap</a></li> -->

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
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalMedisRanap') ?>",
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
    function asesmen_pulang(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/asesmenPulangRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_asesmen_pulang_ranap').modal('show');
                }
            }
        });
    }
</script>



<script>
    function pesanRAD(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderRADRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalorderRADrme_rajal').modal('show');
                }
            }
        });
    }

    function pesanLPK(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderLPKRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalorderLPKrme_rajal').modal('show');
                }
            }
        });
    }

    function pesanLPA(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderLPARajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalorderLPArme_rajal').modal('show');
                }
            }
        });
    }

    function pesanRHM(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderRHMRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalorderRHMrme_rajal').modal('show');
                }
            }
        });
    }

    function resumeOrderRanap(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeOrderPenunjangRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalresumeorder_ranap').modal('show');
                }
            }
        });
    }

    function TNORajal(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderTNOIGD'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalinputTNOigd_rme').modal('show');
                }
            }
        });
    }

    function eResepPulang(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderEresepPulang'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalinputereseppulang_rme').modal('show');
                }
            }
        });
    }

    function codingDiagnosa(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/KodifikasiDiagnosaIGD'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalinputDiagnosa_rme').modal('show');
                }
            }
        });
    }

    function eResepRanap(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderEresepRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalinputeresepranap_rme').modal('show');
                }
            }
        });
    }

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
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintOperasiGeneral').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printLaporanOperasiGeneral') ?>?page=" + id, "_blank");
        })
    });
</script>

<script>
   function uploadFileranap(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/uploadFileranap'); ?>",
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

    function historyFileranap(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/historyFileranap'); ?>",
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
    function RiwayatResepAll(id, referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/riwayatPelayananResepAll'); ?>",
            data: {
                id: id,
                nomorKunjungan: referencenumber

            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalriwayatpelayananresepAll').modal('show');
                }
            }
        });
    }
</script>

<script>
    function uploadFile(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/uploadFile'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
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

    function TNORanap(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderTNORanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalinputTNOigd_rme').modal('show');
                }
            }
        });
    }
</script>