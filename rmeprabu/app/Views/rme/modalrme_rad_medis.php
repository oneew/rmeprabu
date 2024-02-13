<div id="modalrme_rad_medis" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
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
                                    <h6 class="card-title"><?= $pasienid; ?> <br><?= $pasienage; ?></h6>
                                    <p class="text-white"><?= $pasienaddress; ?> <?= $pasiensubareaname; ?>
                                     <br><?= $paymentmethodname; ?></p>
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
                                <div class="text-center mb-2">
                                    <button class="btn btn-success" type="button" onclick="tambahCPPT('<?= $referencenumber ?>','<?= $asal; ?>')"><span class="mr-1"><i class="fas fa-plus"></i></span>CPPT</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-12">
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Pemeriksaan</a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cppt" role="tab">CPPT</a></li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body viewdatapemeriksaan"></div>
                                </div>
                                <div class="tab-pane" id="cppt" role="tabpanel">
                                    <div class="card-body viewdatacppt"></div>
                                </div>
                                <input type="hidden" id="asal" name="asal" class="form-control" value="<?= $asal; ?>" readonly>
                                <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
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
            url: "<?php echo base_url('PelayananRawatJalanRME/pemeriksaanRad') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatapemeriksaan').html(response.data);
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
            url: "<?php echo base_url('PelayananRawatJalanRME/CPPTMedisGabungan') ?>",
            data: {
                referencenumber: $('#referencenumber').val(),
                asal: $('#asal').val()
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

    function tambahCPPT(id, asal) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/tambahCPPTRadRajal'); ?>",
            data: {
                id: id,
                asal: asal
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalcreate_cppt_rajal').modal('show');
                }
            }
        });
    }
</script>