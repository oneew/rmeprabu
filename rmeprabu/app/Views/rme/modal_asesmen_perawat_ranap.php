<div id="modal_asesmen_perawat_ranap" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog modal-dialog-scrollable">
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
                                    <p class="text-white"><?= $pasienage; ?></p>
                                    <p class="text-white"><?= $pasienaddress; ?> <?= $pasiensubareaname; ?></p>
                                    <p class="text-white"><?= $paymentmethodname; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="btn-group btn-block">
                                        <button type="button" class="btn btn-danger dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Tata Laksana
                                        </button>
                                        <div class="dropdown-menu animated flipInY">
                                            <a class="dropdown-item" href="#" onclick="RiwayatResep('<?= $pasienid ?>')">Riwayat Resep</a>
                                            <a class="dropdown-item" href="#" onclick="eResepRanap('<?= $referencenumber ?>')">eResep</a>
                                            <a class="dropdown-item" href="#" onclick="TNORanap('<?= $referencenumber ?>')">Tindakan</a>
                                            <a class="dropdown-item" href="#" onclick="eResepPulang('<?= $referencenumber ?>')">Terapi Pulang</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="btn-group btn-block">
                                        <button type="button" class="btn btn-success dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Penunjang
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" onclick="pesanRAD('<?= $nomorreferensi ?>')">Radiologi</a>
                                            <a class="dropdown-item" href="#" onclick="pesanLPK('<?= $nomorreferensi ?>')">Patologi Klinik</a>
                                            <a class="dropdown-item" href="#" onclick="pesanLPA('<?= $nomorreferensi ?>')">Patologi Anatomi</a>
                                            <a class="dropdown-item" href="#" onclick="pesanRHM('<?= $nomorreferensi ?>')">Rehabilitasi Medik</a>
                                            <a class="dropdown-item" href="#" onclick="resumeOrder('<?= $nomorreferensi ?>')">Resume Order</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-block btn-info" type="button" onclick="histori_pelayanan('<?= $pasienid ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Histori Pelayanan</button>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-block btn-warning" type="button" onclick="tambahCPPT('<?= $nomorreferensi ?>')"><span class="mr-1"><i class="fas fa-plus"></i></span>CPPT</button>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-block btn-success" type="button" onclick="readCPPT('<?= $nomorreferensi ?>')"><span class="mr-1"><i class="fas fa-laptop"></i></span>CPPT</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-12">
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile7" role="tab">Dokumen Terima Pasien</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Asesmen Perawat Rawat Inap</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile4" role="tab">Hasil Asesmen Perawat Rawat Inap</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cppt" role="tab">CPPT</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile5" role="tab">Monitoring</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile6" role="tab">Data Monitoring</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#transfer" role="tab">Transfer Pindah Pasien</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Datatransfer" role="tab">Data Transfer Pasien</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile7" role="tabpanel">
                                    <div class="card-body viewdataterimaPasien"></div>
                                </div>
                                <div class="tab-pane" id="profile3" role="tabpanel">
                                    <div class="card-body viewdataasesmenperawatranap"></div>
                                </div>
                                <div class="tab-pane" id="profile4" role="tabpanel">
                                    <div class="card-body viewdatahasilasesmenperawatranap"></div>
                                </div>
                                <div class="tab-pane" id="cppt" role="tabpanel">
                                    <div class="card-body viewdatacpptranap"></div>
                                </div>
                                <div class="tab-pane" id="profile5" role="tabpanel">
                                    <div class="card-body viewdatamonitoringranap"></div>
                                </div>
                                <div class="tab-pane" id="profile6" role="tabpanel">
                                    <div class="card-body viewhasilmonitoringranap"></div>
                                </div>

                                <div class="tab-pane" id="transfer" role="tabpanel">
                                    <div class="card-body viewdatatransferRanap"></div>
                                </div>
                                <div class="tab-pane" id="Datatransfer" role="tabpanel">
                                    <div class="card-body viewhasiltransferRanap"></div>
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

<div class="viewmodalaskep" style="display:none;"></div>

<script>
    function dataresume() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalPerawatRanap') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataasesmenperawatranap').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresume();

    });
</script>

<script>
    function dataresumeAsesmenPerawat() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/HasilAsesmenAwalPerawatRanap') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatahasilasesmenperawatranap').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresumeAsesmenPerawat();

    });
</script>
<script>
    function dataTriage() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeTriage') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatahasiltriase').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataTriage();

    });
</script>


<script>
    function pesanRAD(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderRADRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalorderRADrme_rajal').modal('show');
                }
            }
        });
    }

    function pesanLPK(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderLPKRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
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
                    $('.viewmodalaskep').html(response.sukses).show();
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
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalorderRHMrme_rajal').modal('show');
                }
            }
        });
    }

    function resumeOrder(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeOrderPenunjangRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalresumeorder_rajal').modal('show');
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
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalinputTNOigd_rme').modal('show');
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
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalcreate_cppt_ranap').modal('show');
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
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalriwayatpelayananmedis').modal('show');
                }
            }
        });
    }
</script>


<script>
    function cek_histori(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/riwayatCPPTPerawat'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalresume_cppt_perawat').modal('show');
                }
            }
        });
    }
</script>


<!-- <script>
    function dataresumeAsesmenPerawatIGD() {
        $.ajax({
            url: "<php echo base_url('PelayananRawatJalanRME/HasilAsesmenAwalPerawatIGD') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatahasilasesmenperawatigd').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresumeAsesmenPerawatIGD();

    });
</script> -->


<script>
    function dataCPPT() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/CPPTPerawatRanap') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatacpptranap').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataCPPT();

    });
</script>

<script>
    function datamonitoring() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalPerawatRanapMonitoring') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatamonitoringranap').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datamonitoring();

    });
</script>


<script>
    function datahasilmonitoring() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalPerawatRanapHasilMonitoring') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewhasilmonitoringranap').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datahasilmonitoring();

    });
</script>

<script>
    function datatransfer() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalPerawatIGDTransfer') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatatransfer').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datatransfer();

    });
</script>


<script>
    function datatransferHasil() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalPerawatIGDTransferHasil') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewhasiltransfer').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datatransferHasil();

    });
</script>




<script>
    function dataterimatransfer() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalPerawatRanapTerimaTransfer') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataterimaPasien').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataterimatransfer();

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
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalresume_cppt_ranap').modal('show');
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
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalinputeresepranap_rme').modal('show');
                }
            }
        });
    }
</script>