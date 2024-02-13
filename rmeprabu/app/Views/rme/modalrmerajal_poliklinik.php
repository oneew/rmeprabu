<div id="modalrmerajal_poliklinik" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
                </h4>
            </div>
            <div class="modal-body"><br>
                <div class="row">
                    <div class="col-lg-2 col-md-12">

                        <div class="card profile-card"> <img class="card-img profile-img" src="<?= base_url(); ?>/assets/images/background/kamaroperasi.jpg" alt="Card image">
                            <div class="card-img-overlay card-inverse social-profile d-flex justify-content-center">
                                <?php
                                if ($pasiengender == 'L') {
                                    $gambar = './assets/images/users/pasienlaki.jpg';
                                } else {
                                    $gambar = './assets/images/users/pasienperempuan.jpg';
                                }

                                ?>
                                <div class="align-self-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='55'>"; ?>
                                    <h5 class="card-title"><?= $pasienname; ?></h5>
                                    <h6 class="card-title"><?= $pasienid; ?> ( <?= $pasiengender; ?> ) </h6>
                                    <p class="text-white"><?= $pasienage; ?></p>
                                    <p class="text-white"><?= $roomfisikname; ?> / <?= $paymentmethodname; ?></p>
                                    <p class="text-white"><?= $pasienaddress; ?> <?= $pasiensubareaname; ?></p>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <button class="btn btn-outline-secondary" type="button" onclick="eresep('<?= $id ?>')"><span class="mr-1"><i class="fas fa-parachute-box"></i></span>e-Resep</button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Order Penunjang
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
                                </br>
                                <div class="text-center">
                                    <button class="btn btn-warning btn-block mb-2" type="button" onclick="cek_histori('<?= $pasienid ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Histori CPPT</button>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-info btn-block mb-2" type="button" onclick="histori_pelayanan('<?= $pasienid ?>')">
                                        <span class="mr-1"><i class="fas fa-history"></i></span> Histori Pelayanan
                                    </button>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-info btn-block mb-2" type="button" onclick="buatkanrencanaKontrol('<?= $pasienid ?>')">
                                        <span><i class="fas fa-calendar-check"></i></span> Insert Rencana Kontrol
                                    </button>
                                </div>

                                </br>
                                </br>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-12">
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Asesmen Awal Keperawatan</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile4" role="tab">Hasil Asesmen Awal Keperawatan</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cppt" role="tab">CPPT Perawat</a></li>
                                <?php if ($roomname == 'HEMODIALISA') : ?>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cppthd" role="tab">CPPT Perawat HD</a></li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile5" role="tab">Tindakan keperawatan HD</a></li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile6" role="tab">Data Tindakan keperawatan HD</a></li>
                                <?php endif ?>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile3" role="tabpanel">
                                    <div class="card-body viewdataaskep"></div>
                                </div>
                                <div class="tab-pane" id="profile4" role="tabpanel">
                                    <div class="card-body viewdatahasilasesmenperawat"></div>
                                </div>
                                <div class="tab-pane" id="cppt" role="tabpanel">
                                    <div class="card-body viewdatacppt"></div>
                                </div>
                                <div class="tab-pane" id="cppthd" role="tabpanel">
                                    <div class="card-body viewdatacppthd"></div>
                                </div>
                                <div class="tab-pane" id="profile5" role="tabpanel">
                                    <div class="card-body viewdatamonitoringhd"></div>
                                </div>
                                <div class="tab-pane" id="profile6" role="tabpanel">
                                    <div class="card-body viewhasilmonitoringhd"></div>
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
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalPerawat') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataaskep').html(response.data);
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
            url: "<?php echo base_url('PelayananRawatJalanRME/HasilAsesmenAwalPerawat') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatahasilasesmenperawat').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresumeAsesmenPerawat();

    });
</script>
<script>
    function datamonitoring() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalPerawatHDMonitoring') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatamonitoringhd').html(response.data);
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
            url: "<?php echo base_url('PelayananRawatJalanRME/AsesmenAwalPerawatHDHasilMonitoring') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewhasilmonitoringhd').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datahasilmonitoring();

    });
</script>

<script>
    function dataCPPT() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/CPPTPerawat') ?>",
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
    function dataCPPTHD() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/CPPTPerawatHD') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatacppthd').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataCPPTHD();

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

    function buatkanrencanaKontrol(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RawatJalan/InsertRencanaKontrol'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodalrajal').html(response.suksesmodalsep).show();
                    $('#modalinsertrencanakontrol').modal();
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

    function TNORajal(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderTNORajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalinputTNOrajal_rme').modal('show');
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