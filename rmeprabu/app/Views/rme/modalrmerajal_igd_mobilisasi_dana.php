<div class="modal fade" id="modalrmerajal_igd_mobilisasi_dana" tabindex="-1" aria-labelledby="modalrmerajal_igd_mobilisasi_danaLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
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
                                <div class="text-center mb-2">
                                    <button class="btn-block btn btn-dark" type="button" onclick="codingDiagnosa('<?= $referencenumber ?>')"><span class="mr-1"><i class="fas fa-plus"></i></span>Kodifikasi Diagnosa</button>
                                </div>
                                <div class="text-center mb-2">
                                    <?php if ($verifikasidiagnosarajal == 0) { ?>
                                        <button id="print" class="btn btn-success btn-outline btn btnbatalperiksa" type="button" onclick="VerifikasiDiagnosaigd('<?= $id ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Simpan Diagnosa ?</button>
                                    <?php } ?>
                                    <?php if ($verifikasidiagnosarajal != 0) { ?>
                                        <button id="print" class="btn btn-danger btn-outline btn btnupdatesep" type="button" onclick="BatalDiagnosaigd('<?= $id ?>')"> <span><i class="fas fa-calendar-check"></i></span> Batal Diagnosa ? </button>
                                    <?php } ?>
                                </div>
                                <div class="text-center mb-2">
                                    <button class="btn-block btn btn-warning" type="button" onclick="cek_histori('<?= $pasienid ?>')"><span class="mr-1"><i class="fas fa-history"></i></span>Histori CPPT</button>
                                </div>
                                <div class="text-center mb-2">
                                    <div class="form-group">
                                        <label>
                                            <h6>keterangan Verifikasi</h6>
                                        </label>
                                        <select name="verifikasimobdan" id="verifikasimobdan" class="form-control-select2 filter-koinsiden" style="width: 100%">
                                            <option value="">Pilih</option>
                                            <option value="1" class="select-rincian">Sudah Verifikasi</option>
                                            <option value="2" class="select-rincian">Revisi</option>
                                            <option value="3" class="select-rincian">Verifikasi Dengan Catatan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center mb-2">
                                    <div class="col-md-12">
                                        <label>Catatan</label>
                                        <textarea id="catatanVerifikasi" name="catatanVerifikasi" class="form-control" rows="4"></textarea>
                                    </div>

                                </div>
                                <div class="text-center mb-2">
                                    <?php if ($verifikasimobdan == 0) { ?>
                                        <button id="print" class="btn btn-success btn-outline btn btnbatalperiksa" type="button" onclick="VerifikasiSelesai('<?= $id ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Simpan Verifikasi ?</button>
                                    <?php } ?>
                                    <?php if ($verifikasimobdan != 0) { ?>
                                        <button id="print" class="btn btn-danger btn-outline btn btnupdatesep" type="button" onclick="BatalVerifikasi('<?= $id ?>')"> <span><i class="fas fa-calendar-check"></i></span> Batal Verifikasi ? </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-12">
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Arsip Digital Pelayanan Tanggal <?= tgl_indo_helper($documentdate); ?> Ke <?= $roomname; ?> [<?= $doktername; ?>]</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile3" role="tabpanel">
                                    <div class="card-body viewdataarsip"></div>
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

    function dataresume() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/ArsipDigitalIGD') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataarsip').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresume();

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
    function VerifikasiSelesai(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin Verifikasi Rincian Ini Selesai ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRawatJalanRME/VerifikasiMobDan'); ?>",
                    data: {
                        id: id,
                        verifikasimobdan: $('#verifikasimobdan').val(),
                        catatanVerifikasi: $('#catatanVerifikasi').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    //berangkat();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>


<script>
    function BatalVerifikasi(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan membatalkan Verifikasi Sebelumnya ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRawatJalanRME/BatalVerifikasiMobDan'); ?>",
                    data: {
                        id: id,
                        catatanVerifikasi: $('#catatanVerifikasi').val()

                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    // berangkatrestore();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>

<script>
    function VerifikasiDiagnosaigd(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin Verifikasi Diagnosa Ini Selesai ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRawatJalanRME/VerifikasiDiagnosaigd'); ?>",
                    data: {
                        id: id,
                        verifikasidiagnosarajal: $('#verifikasidiagnosarajal').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    //berangkat();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>


<script>
    function BatalDiagnosaigd(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan membatalkan Verifikasi Sebelumnya ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRawatJalanRME/BatalDiagnosaigd'); ?>",
                    data: {
                        id: id,
                        verifikasidiagnosarajal: $('#verifikasidiagnosarajal').val()

                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    // berangkatrestore();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>