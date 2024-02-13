<div id="modalrme_ranap_medis_pasca_bedah" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
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
                                </br>
                                <div class="text-center">
                                    <button class="btn btn-warning" type="button" onclick="cek_histori('<?= $pasienid ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Histori CPPT</button>
                                </div>
                                </br>
                                <div class="text-center">
                                    <button class="btn btn-info" type="button" onclick="histori_pelayanan('<?= $pasienid ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Histori Pelayanan</button>
                                </div>
                                </br>
                                <div class="text-center">
                                    <button class="btn btn-dark" type="button" onclick="verifikasi_cppt('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-angle-double-right"></i></span>Verifikasi CPPT Perawat</button>
                                </div>
                                </br>
                                <div class="text-center">
                                    <button class="btn btn-warning" type="button" onclick="tambahCPPT('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-plus"></i></span>CPPT</button>
                                </div>
                                </br>
                                <div class="text-center">
                                    <button class="btn btn-success" type="button" onclick="readCPPT('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-laptop"></i></span>CPPT</button>
                                </div>
                                </br>
                                <div class="text-center">
                                    <button class="btn btn-info" type="button" onclick="LaporanOperasiKatarak('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-plus"></i></span>LO Katarak</button>
                                </div>
                                </br>
                                <div class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                </div>
                                </br>
                                <div class="text-center">
                                    <button id="print" class="btn btn-info btnprintOperasiKatarak" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span> LO Katarak</button>
                                </div>
                                </br>
                                <div class="text-center">
                                    <button id="print" class="btn btn-danger btnprintOperasiGeneral" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span> Laporan Operasi</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-12">
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Formulir Persetujuan Tindakan</a></li>

                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#hasilasesmen" role="tab">Site Marking</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#resumeMedis" role="tab">SSC</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body viewdataedukasi"></div>
                                </div>
                                <div class="tab-pane" id="cppt" role="tabpanel">
                                    <div class="card-body viewdatapersetujuan"></div>
                                </div>
                                <div class="tab-pane" id="hasilasesmen" role="tabpanel">
                                    <div class="card-body viewdatasitemarking"></div>
                                </div>
                                <div class="tab-pane" id="resumeMedis" role="tabpanel">
                                    <div class="card-body viewdatassc"></div>
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

