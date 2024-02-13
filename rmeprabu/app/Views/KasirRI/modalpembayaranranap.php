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

<div id="modalpembayaranranap" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Menu Validasi Pembayaran Rawat Inap</h4>
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
                                        <h6 class="card-subtitle"><?= $pasien['roomname']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['doktername']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['paymentmethodname']; ?></h6>
                                        <h6 class="card-subtitle">No.Pendaftaran : <?= $pasien['referencenumber']; ?></h6>
                                        <h6 class="card-subtitle">Cara Pulang : <?= $pasien['statuspasien']; ?></h6>
                                        <input type="hidden" id="journalnumberhasil" name="journalnumberhasil" class="form-control">
                                        <input type="hidden" id="rekammedis" name="rekammeedis" class="form-control" value="<?= $pasien['pasienid']; ?>">
                                        <button id="print" class="btn btn-danger btn-outline btn piutang" type="button" data-id="<?= $pasien['journalnumber']; ?>"> <span><i class="fa fa-search"></i></span> Cek Piutang </button>
                                        <br>
                                        <br>
                                        <span class="<?php if ($pasien['pasienclassroomchange'] == 1) {
                                                            echo "badge badge-danger";
                                                            $apakahnaik = "Pasien Naik Kelas";
                                                        } else {
                                                            echo "badge badge-success";
                                                            $apakahnaik = "Pasien Sesuai Hak Kelas";
                                                        }  ?>"><?= $apakahnaik; ?></span>

                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="card-body"> <small class="text-muted">Alamat </small>
                                    <h6><?= $pasien['pasienaddress']; ?></h6> <small class="text-muted pt-4 d-block">NIK</small>
                                    <h6><?= $pasien['ssn']; ?></h6> <small class="text-muted pt-4 d-block">No Asuransi</small>
                                    <h6><?= $pasien['paymentcardnumber']; ?></h6>
                                    <div class="map-box"></div>
                                    <small class="text-muted pt-4 d-block">Tanggal Lahir</small>
                                    <h6><?= $pasien['pasiendateofbirth']; ?> [<?= $umur; ?>]</h6>
                                    <div class="form-group">
                                        <label>
                                            <h6>Rincian</h6>
                                        </label>
                                        <select name="rincian" id="rincian" class="form-control-select2 filter-input" style="width: 100%">
                                            <option value="">Pilih Jenis Rincian</option>
                                            <?php foreach ($merge as $merge) { ?>
                                                <option data-id="<?= $merge['paymentmethodname']; ?>" class="select-rincian"><?= $merge['paymentmethodname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <h6>Split Koinsiden</h6>
                                        </label>
                                        <select name="koinsiden" id="koinsiden" class="form-control-select2 filter-koinsiden" style="width: 100%">
                                            <option value="">Pilih</option>
                                            <option value="0" class="select-rincian">Tidak</option>
                                            <option value="1" class="select-rincian">Ya</option>
                                        </select>
                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-lg-9 col-md-12">
                            <div class="card">
                                <div class="modal-body">
                                    <div class="col-lg-12 col-md-12">
                                        <ul class="nav nav-tabs profile-tab" role="tablist">
                                            <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Resume</a></li>

                                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#pelayanan_asal" role="tab">Rincian Pelayanan Asal Masuk Pasien</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="profile3" role="tabpanel">
                                                <div class="card-body">
                                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $pasien['referencenumber']; ?>" readonly>
                                                    <?= form_open('KasirRanap/validasipembayaran', ['class' => 'formvalidasibayar']); ?>
                                                    <?= csrf_field(); ?>
                                                    <p class="mt-4 viewdataresume"></p>
                                                    <?= form_close() ?>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="home" role="tabpanel">
                                                <div class="card-body">
                                                    <hr>
                                                    <div class="btn-list">
                                                        <!-- Standard  modal -->
                                                        <button type="button" class="btn btn-success" onclick="TNO('<?= $pasien['id'] ?>')"> <i class="fa fa-plus"></i> Tindakan Medis & Keperawatan</button>
                                                    </div>
                                                    <hr>
                                                    <div class="mt-4 viewTNO"></div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="profile2" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="btn-list">
                                                        <!-- Standard  modal -->
                                                        <button type="button" class="btn btn-danger" onclick="ASKEP('<?= $pasien['id'] ?>')"> <i class="fa fa-tags"></i> Asuhan Keperawatan / Kebidanan / Farmasi Klinik / Visite Kamar Operasi</button>
                                                    </div>
                                                    <hr>
                                                    <div class="mt-4 viewASKEP"></div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="OP" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="mt-4 viewOperasi"></div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="pelayanan_asal" role="tabpanel">
                                                <div class="card-body">
                                                    <div class="mt-4 viewpelayanan_asal"></div>
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
    function dataresume() {

        $.ajax({

            url: "<?php echo base_url('KasirRanap/resumeGabung') ?>",
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

<script>
    function dataresumeasal() {

        $.ajax({

            url: "<?php echo base_url('KasirRanap/resumeGabung_RincianIGD') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewpelayanan_asal').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresumeasal();


    });
</script>


<script>
    $('.filter-input').on('change', function() {
        let rincian = $('#rincian').val();
        let referencenumber = $('#referencenumber').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRanap/resumeGabungPilihan') ?>",
            dataType: "json",
            data: {
                pilihancabar: rincian,
                referencenumber: referencenumber

            },
            success: function(response) {
                $('.viewdataresume').html(response.data);

            }
        });
    });
</script>

<script>
    $('.filter-koinsiden').on('change', function() {
        let koinsiden = $('#koinsiden').val();
        let rincian = $('#rincian').val();
        let referencenumber = $('#referencenumber').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRanap/resumeGabungPilihanKoinsiden') ?>",
            dataType: "json",
            data: {
                koinsiden: koinsiden,
                pilihancabar: rincian,
                referencenumber: referencenumber

            },
            success: function(response) {
                $('.viewdataresume').html(response.data);

            }
        });
    });
</script>