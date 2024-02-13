<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    hr {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    hr:after {
        background: #fff;
        content: '§';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>

<div id="modalprintregisterigd" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Menu Cetak Pelayanan IGD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black">

                <div class="row">
                    <!-- Column -->
                    <?php
                    foreach ($pasienlama as $pasien) :
                    ?>
                        <div class="col-lg-3 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $tanggallahir = $pasien['pasiendateofbirth'];
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
                                    if (($pasien['pasiengender'] == 'L') and ($age_years <= 5)) {
                                        $gambar = './assets/images/users/anakkecillaki.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years <= 5)) {
                                        $gambar = './assets/images/users/anakkecilperempuan.jpeg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 6) and ($age_years <= 12)) {
                                        $gambar = './assets/images/users/remajapria.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 6) and ($age_years <= 12)) {

                                        $gambar = './assets/images/users/remajaperempuan.jpeg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 13) and ($age_years <= 59)) {
                                        $gambar = './assets/images/users/pasienlaki.jpg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 13) and ($age_years <= 59)) {

                                        $gambar = './assets/images/users/pasienperempuan.jpg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 60)) {

                                        $gambar = './assets/images/users/priatua.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 60)) {

                                        $gambar = './assets/images/users/wanitatua.jpeg';
                                    }
                                    ?>
                                    <div class="mt-4 text-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                        <h4 class="card-title mt-2"><?= $pasien['pasienname']; ?></h4>
                                        <h6 class="card-subtitle"><?= $pasien['poliklinikname']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['doktername']; ?></h6>
                                        <h4 class="card-subtitle"><?= $pasien['paymentmethodname']; ?></h4>
                                        <h4 class="card-subtitle"><span class="badge badge-info">No Sep :<?= $pasien['bpjs_sep']; ?></span></h4>
                                        <h4 class="card-subtitle"><span class="badge badge-danger">No SPRI :<?= $pasien['noSPRI']; ?></span></h4>

                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="card-body"> <small class="text-muted">Alamat </small>
                                    <h6><?= $pasien['pasienaddress']; ?></h6> <small class="text-muted pt-4 d-block">NIK</small>
                                    <h6><?= $pasien['pasienssn']; ?></h6> <small class="text-muted pt-4 d-block">No Asuransi</small>
                                    <h6><?= $pasien['paymentcardnumber']; ?></h6>
                                    <div class="map-box"></div>

                                    <small class="text-muted pt-4 d-block">Tanggal Lahir</small>

                                    <h6><?= $pasien['pasiendateofbirth']; ?> [<?= $umur; ?>]</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-12">
                            <div class="card">
                                <div class="modal-body">
                                    <div id="form-filter-bawah" style="display: block;">
                                        <div class="text-center">
                                            <input type="hidden" id="journalnumberhasil" name="journalnumberhasil" class="form-control">
                                            <button id="print" class="btn btn-info btn-outline btn btnprintstruk" type="button" data-id="<?= $pasien['id']; ?>"> <span><i class="fa fa-print"></i></span> STRUK </button>
                                            <button id="print" class="btn btn-success btn-outline btn btnprintsticker" type="button" data-id="<?= $pasien['id']; ?>"> <span><i class="fa fa-print"></i></span> STIKER </button>
                                            <button id="print" class="btn btn-warning btn-outline btn btnprintsjp" type="button" data-id="<?= $pasien['journalnumber']; ?>"> <span><i class="fa fa-print"></i></span> SJP </button>
                                            <?php if ($pasien['bpjs_sep'] != "") { ?>
                                                <button id="print" class="btn btn-danger btn-outline btn btnprintseprajal" type="button" data-id="<?= $pasien['journalnumber']; ?>"> <span><i class="fa fa-print"></i></span> SEP </button>
                                            <?php } ?>
                                            <button id="print" class="btn btn-dark btn-outline btn btnprintheader" type="button" data-id="<?= $pasien['id']; ?>"> <span><i class="fa fa-print"></i></span> Header Status </button>
                                            <button id="print" class="btn btn-info btn-outline btn btnprintgelang" type="button" data-id="<?= $pasien['id']; ?>"> <span><i class="fa fa-print"></i></span> Gelang Pasien </button>
                                            <?php if (($pasien['noSPRI'] != "") and ($pasien['noSPRI'] != "NONE")) { ?>
                                                <button id="print" class="btn btn-danger btn-outline btn btnprintspri" type="button" data-id="<?= $pasien['noSPRI']; ?>"> <span><i class="fa fa-print"></i></span> SPRI </button>
                                            <?php } ?>
                                            <?php if ($pasien['bpjs_sep'] != "") { ?>
                                                <button id="print" class="btn btn-success btn-outline btn btnprintseprajalkonvensional" type="button" data-id="<?= $pasien['journalnumber']; ?>"> <span><i class="fa fa-print"></i></span> SEP </button>
                                            <?php } ?>
                                            <!-- <button id="print" class="btn btn-info btn-outline btn btnprintstickerbarcode" type="button" data-id="?= $pasien['id']; ?>"> <span><i class="fa fa-print"></i></span> BARCODE </button> -->
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <?php $is_jkn = $pasien['paymentmethodname'];
                                    $cabar = (preg_match("/BPJS/i", $is_jkn));
                                    ?>
                                    <?php if ($cabar !== 0) { ?>
                                        <div class="text-center">
                                            <input type="hidden" id="journalnumberhasil" name="journalnumberhasil" class="form-control">
                                            <?php if (($pasien['bpjs_sep'] == "") or ($pasien['bpjs_sep'] == "NONE")) { ?>
                                                <button id="print" class="btn btn-info btn-outline btn btninputsep" type="button" onclick="buatkanSepugd('<?= $pasien['id'] ?>')"> <span><i class="fas fa-calendar-check"></i></span> INSERT SEP </button>
                                            <?php } ?>
                                            <?php if ($pasien['bpjs_sep'] != "") { ?>
                                                <button id="print" class="btn btn-danger btn-outline btn btnhapussep" type="button" onclick="hapusSepUgd('<?= $pasien['id'] ?>')"> <span><i class="fa fa-trash"></i></span> HAPUS SEP </button>
                                            <?php } ?>
                                            <?php if ($pasien['bpjs_sep'] != "") { ?>
                                                <button id="print" class="btn btn-dark btn-outline btn btncarisep" type="button" onclick="cariSepUgd('<?= $pasien['id'] ?>')"> <span><i class="far fa-edit"></i></span> CARI SEP</button>
                                            <?php } ?>
                                            <?php if ($pasien['bpjs_sep'] != "") { ?>
                                                <button id="print" class="btn btn-warning btn-outline btn btnupdatesep" type="button" onclick="updateSepugd('<?= $pasien['id'] ?>')"> <span><i class="fas fa-calendar-check"></i></span> UPDATE SEP </button>
                                                <button id="print" class="btn btn-danger btn-outline btn" type="button" onclick="updateSepPulang('<?= $pasien['id'] ?>')"> <span><i class="mdi mdi-wheelchair-accessibility"></i></span> UPDATE PULANG SEP !!</button>
                                            <?php } ?>
                                            <button type="button" class="btn btn-success btn-outline btn histori"><i class="fas fa-search"></i> Histori Pelayanan (Vclaim)</button>

                                            <input type="hidden" id="nomorSep" name="nomorSep" class="form-control" required value="<?= $pasien['bpjs_sep']; ?>">
                                            <input type="hidden" id="nomorKartu" name="nomorKartu" class="form-control" required value="<?= $pasien['paymentcardnumber']; ?>">
                                            <input type="hidden" id="nomorSuratPerintahRawat" name="nomorSuratPerintahRawat" class="form-control" required value="<?= $pasien['noSPRI']; ?>">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary">SPRI Vclaim</button>
                                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <?php if (($pasien['noSPRI'] == "") || ($pasien['noSPRI'] == "NONE")) { ?>
                                                        <a class="dropdown-item" href="#" onclick="buatkanSPRI('<?= $pasien['id'] ?>')">Insert SPRI</a>
                                                    <?php } ?>
                                                    <?php if (($pasien['noSPRI'] != "") || ($pasien['noSPRI'] != "NONE")) { ?>
                                                        <a class="dropdown-item" href="#" onclick="cariSPRI('<?= $pasien['id'] ?>')">Pencarian SPRI</a>
                                                        <a class="dropdown-item" href="#" onclick="updateSPRI('<?= $pasien['id'] ?>')">Update SPRI</a>
                                                        <a class="dropdown-item" href="#" onclick="hapusSPRI('<?= $pasien['id'] ?>')">Hapus SPRI</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php if (($pasien['bpjs_sep'] == "") and ($pasien['pengajuanPenjaminSEP'] == 0)) { ?>
                                                <button id="print" class="btn btn-warning btn-outline btn btnseppenjamin" type="button" onclick="SepPenjaminan('<?= $pasien['id'] ?>')"> <span><i class="fas fa-stopwatch"></i></span> PENGAJUAN PENJAMINAN SEP </button>
                                            <?php } ?>
                                            <?php if (($pasien['bpjs_sep'] == "") and ($pasien['pengajuanPenjaminSEP'] == 1)) { ?>
                                                <button id="print" class="btn btn-success btn-outline btn btnapprovalseppenjamin" type="button" onclick="AprovalSepPenjaminan('<?= $pasien['id'] ?>')"> <span><i class="fas fa-stopwatch"></i></span> APROVAL PENGAJUAN SEP </button>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="card">
                                <div class="modal-body">
                                    <div class="table-responsive mt-4">
                                        <h4 class="card-title-center">Histori Kunjungan</h4>
                                    </div>
                                    <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasien['pasienid']; ?>" readonly>
                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $pasien['journalnumber']; ?>" readonly>
                                    <div class="table-responsive viewkunjungan">

                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                    <!-- Column -->
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="viewmodalugd" style="display:none;"></div>

<script>
    function datakunjungan() {
        $.ajax({

            url: "<?php echo base_url('RawatJalan/HistoriKunjungan') ?>",
            data: {
                pasienid: $('#pasienid').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewkunjungan').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datakunjungan();


    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintstruk').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('IGD/printkarcis') ?>?page=" + id, "_blank");



        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintsjp').on('click', function() {

            let id = $(this).data('id');
            //window.open("<?php echo base_url('IGD/printsjp') ?>?page=" + id, "_blank");
            window.open("<?php echo base_url('IGD/printsjp') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=795, height=500px");



        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintseprajal').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('IGD/printsep') ?>?page=" + id, target = "_blank");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintsticker2').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('IGD/printsticker') ?>?page=" + id, "_blank");

        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintsticker').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('IGD/printsticker') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=795, height=500px");



        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintheader').on('click', function() {

            let id = $(this).data('id');
            //window.open("<?php echo base_url('IGD/printheader') ?>?page=" + id, "_blank");
            window.open("<?php echo base_url('IGD/printheader') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=795, height=500px");



        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintgelang').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('RawatJalan/printgelang') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=600, height=300px");



        })
    });
</script>

<script>
    function buatkanSepugd(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/CreateSep'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {

                    $('.viewmodalugd').html(response.suksesmodalsep).show();
                    $('#modalcreatesepugd').modal();


                }
            }

        });


    }

    function updateSepugd(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/UpdateSep'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {

                    $('.viewmodalugd').html(response.suksesmodalsep).show();
                    $('#modalupdatesepugd').modal();


                }
            }

        });


    }
</script>



<script>
    function hapusSepUgd(id) {
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data ini ?",
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
                    url: "<?php echo base_url('RawatJalan/HapusSep'); ?>",
                    data: {
                        id: id,
                        nomorSep: $('#nomorSep').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                //title: 'Hapus Berhasil',
                                //text: response.pesan,
                                html: 'Pesan: ' + response.pesan,

                            });
                            datakunjungan();

                        }
                    }

                });


            }
        })

    }

    function buatkanSPRI(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/CreateSPRI'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalspri) {

                    $('.viewmodalugd').html(response.suksesmodalspri).show();
                    $('#modalcreateSPRIigd').modal();


                }
            }

        });
    }

    function SepPenjaminan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RawatJalan/CreateSepPenjamin'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodalugd').html(response.suksesmodalsep).show();
                    $('#modalcreateseprajalpenjamin').modal();
                }
            }
        });
    }

    function AprovalSepPenjaminan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RawatJalan/AprovalSepPenjamin'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodalugd').html(response.suksesmodalsep).show();
                    $('#modalaprovalseprajalpenjamin').modal();
                }
            }
        });
    }
</script>


<script>
    function cariSepUgd(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/CariSep'); ?>",
            data: {
                id: id,
                nomorSep: $('#nomorSep').val()
            },
            dataType: "json",
            success: function(response) {
                //let parseResponse = JSON.parse(response);
                if (response.metaData.code == 200) {

                    Swal.fire({
                        html: 'Nama: ' + response.response.peserta.nama + '<br>No.Kartu: ' + response.response.peserta.noKartu + '<br>No.Sep: ' + response.response.noSep +
                            '<br>Tanggal Sep: ' + response.response.tglSep + '<br>Jenis Pelayanan: ' + response.response.jnsPelayanan + '<br>Diagnosa: ' + response.response.diagnosa +
                            '<br>No.Rujukan: ' + response.response.noRujukan + '<br>Poli: ' + response.response.poli + '<br>Dokter: ' + response.response.dpjp.kdDPJP +
                            '<br>Status Kecelakaan: ' + response.response.nmstatusKecelakaan,
                        icon: 'success',
                        text: response.metaData.message
                    });


                } else {
                    Swal.fire({
                        icon: 'error',
                        //title: 'Error',
                        text: response.metaData.message

                    });
                }
            }

        });
    }
</script>

<script>
    $('.histori').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('DPMRI/historipelayananSep') ?>",
            data: {
                noKartu: $('#nomorKartu').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewmodalugd').html(response.data).show();
                $('#modalhistoripelayananSep').modal('show');

            }
        });

    });
</script>

<script>
    function cariSPRI(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/CariSPRI'); ?>",
            data: {
                id: id,
                nomorSuratPerintahRawat: $('#nomorSuratPerintahRawat').val()
            },
            dataType: "json",
            success: function(response) {
                //let parseResponse = JSON.parse(response);
                if (response.metaData.code == 200) {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan + '<br>No.SPRI: ' + response.response.noSuratKontrol + '<br>Tanggal Rencana Rawat: ' + response.response.tglRencanaKontrol +
                            '<br>Dokter: ' + response.response.namaDokter + '<br>Tanggal terbir SPRI: ' + response.response.tglTerbit +
                            '<br>No Sep: ' + response.response.sep.noSep,
                        icon: 'success',
                        //text: response.metaData.message
                    });


                } else {
                    Swal.fire({
                        icon: 'error',
                        text: response.metaData.message

                    });
                }
            }

        });
    }

    function hapusSPRI(id) {
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus Surat Perintah Rawat ini ?",
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
                    url: "<?php echo base_url('IGD/HapusSPRI'); ?>",
                    data: {
                        id: id,
                        nomorSuratPerintahRawat: $('#nomorSuratPerintahRawat').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                // icon: 'success',
                                // title: 'Berhasil',
                                text: response.pesan,
                                timer: 1500

                            });
                            datakunjungan();
                        } else {
                            Swal.fire({
                                // icon: 'error',
                                // title: 'Gagal',
                                text: response.pesan,
                                timer: 1500

                            });

                        }
                    }

                });


            }
        })

    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintspri').on('click', function() {
            let id = $('#nomorSuratPerintahRawat').val();
            window.open("<?php echo base_url('IGD/printSPRI') ?>?page=" + id, target = "_blank");
        })
    });
</script>
<script>
    function updateSPRI(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/UpdateSPRI'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalspri) {
                    $('.viewmodalugd').html(response.suksesmodalspri).show();
                    $('#modalupdateSPRIIgd').modal();
                }
            }
        });
    }

    function updateSepPulang(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/UpdateSepPulang'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodalugd').html(response.suksesmodalsep).show();
                    $('#modalupdatepulangSepIgd').modal();
                }
            }

        });

    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintseprajalkonvensional2').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('IGD/printsepKonvesional') ?>?page=" + id, target = "_blank");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintseprajalkonvensional').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('IGD/printsepKonvesional') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=1000, height=1000px");
        })
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintstickerbarcode').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('IGD/printstickerbarcode') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=500, height=350");
        })
    });
</script>