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

<div id="modalklaimrajal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Menu Klaim Rincian Pasien Rawat Jalan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

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
                                        $gambar = base_url() . '/assets/images/users/anakkecillaki.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecilperempuan.jpeg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 6) and ($age_years <= 12)) {
                                        $gambar = base_url() . '/assets/images/users/remajapria.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 6) and ($age_years <= 12)) {

                                        $gambar = base_url() . '/assets/images/users/remajaperempuan.jpeg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 13) and ($age_years <= 59)) {
                                        $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 13) and ($age_years <= 59)) {

                                        $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                                    } else if (($pasien['pasiengender'] == 'L') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/priatua.jpeg';
                                    } else if (($pasien['pasiengender'] == 'P') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/wanitatua.jpeg';
                                    }
                                    ?>
                                    <div class="mt-4 text-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                        <h4 class="card-title mt-2"><?= $pasien['pasienname']; ?></h4>
                                        <h6 class="card-subtitle"><?= $pasien['poliklinikname']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['doktername']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['paymentmethodname']; ?></h6>
                                        <h6 class="card-subtitle">Advice Dokter : <?= $pasien['advicedokter']; ?></h6>
                                        <input type="hidden" id="journalnumberhasil" name="journalnumberhasil" class="form-control">
                                        <input type="hidden" id="rekammedis" name="rekammeedis" class="form-control" value="<?= $pasien['pasienid']; ?>">
                                        <button id="print" class="btn btn-danger btn-outline btn piutang" type="button" data-id="<?= $pasien['journalnumber']; ?>"> <span><i class="fa fa-search"></i></span> Cek Piutang </button>

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
                                    <div class="col-lg-12 col-md-12">
                                        <ul class="nav nav-tabs profile-tab" role="tablist">
                                            <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Resume</a></li>
                                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">Posting Klaim</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="profile3" role="tabpanel">
                                                <div class="card-body">
                                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $pasien['journalnumber']; ?>" readonly>
                                                    <?= form_open('KasirRJ/validasipembayaran', ['class' => 'formvalidasibayar']); ?>
                                                    <?= csrf_field(); ?>
                                                    <p class="mt-4 viewdataresume"></p>
                                                    <?= form_close() ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="home" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="card card-outline-info">
                                                                <div class="card-header">
                                                                    <h4 class="mb-0 text-white">Keterangan Admisi & Klaisifikasi Biaya</h4>
                                                                </div>
                                                                <div class="card-body">
                                                                    <form action="#">
                                                                        <div class="form-body">
                                                                            <hr>
                                                                            <div class="row pt-2">
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">Jaminan/Cara Bayar</label>
                                                                                        <input type="text" id="carabayar" name="carabayar" class="form-control" value="<?= $pasien['paymentmethodname']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <!--/span-->
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">No.Kartu</label>
                                                                                        <input type="text" id="nokartu" name="nokartu" class="form-control" value="<?= $pasien['paymentcardnumber']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">No.SEP</label>
                                                                                        <input type="text" id="noSep" name="noSep" class="form-control" value="<?= $pasien['bpjs_sep']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Jenis Rawat</label>
                                                                                        <input type="text" id="jenisrawat" name="jenisrawat" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Hak Kelas</label>
                                                                                        <input type="text" id="kelasHak" name="kelasHak" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row pt-0">
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">Tanggal Periksa</label>
                                                                                        <input type="text" id="tanggalrawat" name="tanggalrawat" class="form-control" value="<?= $pasien['documentdate']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <!--/span-->
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Tanggal Pulang</label>
                                                                                        <input type="text" id="tanggalPulang" name="tanggalPulang" class="form-control" value="<?= $pasien['documentdate']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Dokter</label>
                                                                                        <input type="text" id="dpjp" name="dpjp" class="form-control" value="<?= $pasien['doktername']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Cara Pulang</label>
                                                                                        <input type="text" id="carapulang" name="carapulang" class="form-control" value="<?= $pasien['advicedokter']; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Jenis Tarif</label>
                                                                                        <input type="text" id="jenisTarif" name="jenisTarif" class="form-control" value="TARIF RS KELAS B PEMERINTAH">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="row pt-0">
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label class="control-label">Prosedur Non Bedah</label>
                                                                                        <input type="text" id="prosedurNonBedah" name="prosedurNonBedah" class="form-control text-center" value="0">
                                                                                    </div>
                                                                                </div>
                                                                                <!--/span-->
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Prosedur Bedah</label>
                                                                                        <input type="text" id="prosedurbedah" name="prosedurbedah" class="form-control text-center" value="0">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Konsultasi</label>
                                                                                        <input type="text" id="konsultasi" name="konsultasi" class="form-control text-center" value="<?php echo number_format($tarifkonsul, 0, ",", "."); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Tenaga Ahli</label>
                                                                                        <input type="text" id="tenagaAhli" name="tenagaAhli" class="form-control text-center" value="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row pt-0">
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Keperawatan</label>
                                                                                        <input type="text" id="keperawatan" name="keperawatan" class="form-control text-center" value="<?php echo number_format($keperawatan, 0, ",", "."); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <!--/span-->
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Penunjang</label>
                                                                                        <input type="text" id="penunjang" name="penunjang" class="form-control text-center" value="0">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Radiologi</label>
                                                                                        <input type="text" id="radiologi" name="radiologi" class="form-control text-center" value="<?php echo number_format($radiologi, 0, ",", "."); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Laboratorium</label>
                                                                                        <input type="text" id="laboratorium" name="laboratorium" class="form-control text-center" value="<?php echo number_format($laboratorium, 0, ",", "."); ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row pt-0">
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Pelayanan Darah</label>
                                                                                        <input type="text" id="pelayananDarah" name="pelayananDarah" class="form-control text-center" value="<?php echo number_format($bankdarah, 0, ",", "."); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <!--/span-->
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Rehabilitasi</label>
                                                                                        <input type="text" id="rehabilitasi" name="rehabilitasi" class="form-control text-center" value="<?php echo number_format($rehabmedik, 0, ",", "."); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Kamar/Akomodasi</label>
                                                                                        <input type="text" id="akomodasi" name="akomodasi" class="form-control text-center" value="0">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Rawat Intensif</label>
                                                                                        <input type="text" id="intensif" name="intensif" class="form-control text-center" value="0">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row pt-0">
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Obat</label>
                                                                                        <input type="text" id="obat" name="obat" class="form-control text-center" value="<?php echo number_format($obatnonkronis, 0, ",", "."); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <!--/span-->
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Obat Kronis</label>
                                                                                        <input type="text" id="obatkronis" name="obatkronis" class="form-control text-center" value="<?php echo number_format($obatkronis, 0, ",", "."); ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Obat Kemoterapi</label>
                                                                                        <input type="text" id="obatkemoterapi" name="obatkemoterapi" class="form-control text-center" value="0">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Alkes</label>
                                                                                        <input type="text" id="alkes" name="alkes" class="form-control text-center" value="0">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">BMHP</label>
                                                                                        <input type="text" id="bmhp" name="bmhp" class="form-control text-center" value="0">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="form-group has-danger">
                                                                                        <label class="control-label">Sewa Alat</label>
                                                                                        <input type="text" id="sewaalat" name="sewaalat" class="form-control text-center" value="0">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="form-actions">
                                                                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                                                                    Posting</button>
                                                                                <button type="button" class="btn btn-inverse">Cancel</button>
                                                                            </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

<div class="viewmodalkasir" style="display:none;"></div>


<script>
    function hapusSep(id) {
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
                                text: response.pesan,
                            });
                            datakunjungan();

                        }
                    }

                });


            }
        })

    }
</script>



<script>
    function dataresume() {

        $.ajax({

            url: "<?php echo base_url('KlaimRawatJalan/resumeGabungKlaim') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataresume').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresume();


    });
</script>

<script>
    function resumeTNO() {

        $.ajax({

            url: "<?php echo base_url('PelayananRawatJalan/resumeTNO_verifikasi') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewTNO').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeTNO();


    });
</script>






<script>
    function resumeOperasi() {

        $.ajax({

            url: "<?php echo base_url('PelayananRanap/resumeOperasi') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewOperasi').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeOperasi();


    });
</script>


<script>
    function resumeGizi() {

        $.ajax({

            url: "<?php echo base_url('PelayananRawatJalan/resumeGizi') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewAsupanGizi').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeGizi();


    });
</script>



<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();
    });

    function TNO(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRJ/TNO'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalkasir').html(response.sukses).show();
                    $('#modalinputTNOrajal').modal('show');
                }
            }
        });
    }
</script>

<script>
    $('.piutang').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('Pendaftaranranap/historipiutang') ?>",
            data: {
                pasienid: $('#rekammedis').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewmodalkasir').html(response.suksespiutang).show();
                $('#modalhistoripiutang').modal('show');

            }
        });

    });
</script>