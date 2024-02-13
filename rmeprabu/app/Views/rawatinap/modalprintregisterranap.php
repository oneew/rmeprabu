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

<div id="modalprintregisterranap" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Menu Cetak Pelayanan</h4>
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
                                        <h6 class="card-subtitle"><?= $pasien['smfname']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['roomname']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['doktername']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['paymentmethodname']; ?></h6>

                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="card-body"> <small class="text-muted">Alamat </small>
                                    <h6><?= $pasien['pasienaddress']; ?></h6>
                                    <h6></h6> <small class="text-muted pt-4 d-block">No Asuransi</small>
                                    <h6><?= $pasien['paymentcardnumber']; ?></h6>
                                    <div class="map-box"></div>
                                    <small class="text-muted pt-4 d-block">Tanggal Lahir</small>
                                    <h6><?= $pasien['pasiendateofbirth']; ?> [<?= $umur; ?>]</h6>
                                    <div class="map-box"></div>
                                    <small class="text-muted pt-4 d-block"><b>Token Billing</b></small>
                                    <h6><b><?= $pasien['token_ranap']; ?></b></h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-9 col-md-12">
                            <div class="card">
                                <div class="modal-body">
                                    <div id="form-filter-bawah" style="display: block;">
                                        <div class="text-center">
                                            <?php $is_jkn = $pasien['paymentmethodname'];
                                            $cabarheader = (preg_match("/BPJS/i", $is_jkn));
                                            ?>
                                            <input type="hidden" id="journalnumberhasil" name="journalnumberhasil" class="form-control">
                                            <button id="print" class="btn btn-info btn-outline btn btnprintstruk" type="button" data-id="<?= $pasien['id']; ?>"> <span><i class="fa fa-print"></i></span> STRUK </button>
                                            <button id="print" class="btn btn-success btn-outline btn btnprintsticker" type="button" data-id="<?= $pasien['id']; ?>"> <span><i class="fa fa-print"></i></span> STIKER </button>
                                            <button id="print" class="btn btn-warning btn-outline btn btnprintsjp" type="button" data-id="<?= $pasien['journalnumber']; ?>"> <span><i class="fa fa-print"></i></span> SJP </button>
                                            <?php if (($cabarheader !== 0) and ($pasien['bpjs_sep'] !== "") or ($pasien['bpjs_sep'] == "-") or ($pasien['bpjs_sep'] !== "NONE")) { ?>
                                                <button id="print" class="btn btn-danger btn-outline btn btnprintsepranap" type="button" data-id="<?= $pasien['referencenumber']; ?>"> <span><i class="fa fa-print"></i></span> SEP </button>
                                            <?php } ?>
                                            <button id="print" class="btn btn-dark btn-outline btn btnprintheader" type="button" data-id="<?= $pasien['id']; ?>"> <span><i class="fa fa-print"></i></span> Header Status </button>
                                            <button id="print" class="btn btn-info btn-outline btn btnprintgelang" type="button" data-id="<?= $pasien['id']; ?>"> <span><i class="fa fa-print"></i></span> Gelang Pasien </button>
                                            <button id="print" class="btn btn-success btn-outline btn btnprintrmk" type="button" data-id="<?= $pasien['journalnumber']; ?>"> <span><i class="fa fa-print"></i></span> Rincian Masuk Keluar </button>
                                            <p>
                                            </p>
                                            <p>
                                                <button id="print" class="btn btn-danger btn-outline btn btnprintpersetujuan" type="button" data-id="<?= $pasien['journalnumber']; ?>"> <span><i class="fa fa-print"></i></span> Persetujuan Kelas Perawatan </button>
                                                <?php if (($cabarheader !== 0) and ($pasien['noSuratKontrol'] !== "") and ($pasien['noSuratKontrol'] !== "NONE")) { ?>
                                                    <button id="print" class="btn btn-success btn-outline btn btnprintsuratkontrol" type="button" data-id="<?= $pasien['referencenumber']; ?>"> <span><i class="fa fa-print"></i></span> Surat Kontrol</button>
                                                <?php } ?>
                                                <button id="print" class="btn btn-success btn-outline btn btnprintseprajalkonvensional" type="button" data-id="<?= $pasien['referencenumber']; ?>"> <span><i class="fa fa-print"></i></span> SEP </button>

                                            </p>
                                        </div>
                                        <br>
                                        <div class="text-center">
                                            <button id="print" class="btn btn-info btn-outline btn btnprintstickerbarcode" type="button" data-id="<?= $pasien['id']; ?>"> <span><i class="fa fa-print"></i></span> BARCODE </button>
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
                                            <input type="hidden" id="nomorSuratPerintahRawat" name="nomorSuratPerintahRawat" class="form-control" value="<?= $noSPRI; ?>">
                                            <button class="btn btn-warning btn-outline cekspri" type="button" onclick="cariSPRI('<?= $noSPRI ?>')"> <i class="fas fa-search"></i> SPRI</button>
                                            <?php if (($pasien['bpjs_sep'] == "") or ($pasien['bpjs_sep'] == "-") or ($pasien['bpjs_sep'] == "NONE")) { ?>
                                                <button id="print" class="btn btn-info btn-outline btn btninputsep" type="button" onclick="buatkanSepranap('<?= $pasien['id'] ?>')"> <span><i class="fas fa-calendar-check"></i></span> INSERT SEP </button>
                                            <?php } ?>
                                            <?php if (($cabarheader !== 0) and ($pasien['bpjs_sep'] !== "") or ($pasien['bpjs_sep'] == "-") or ($pasien['bpjs_sep'] !== "NONE")) { ?>
                                                <button id="print" class="btn btn-danger btn-outline btn btnhapussep" type="button" onclick="hapusSep('<?= $pasien['id'] ?>')"> <span><i class="fa fa-trash"></i></span> HAPUS SEP </button>
                                                <button id="print" class="btn btn-dark btn-outline btn btncarisep" type="button" onclick="cariSep('<?= $pasien['id'] ?>')"> <span><i class="far fa-edit"></i></span> CARI SEP</button>
                                                <p></p>
                                                <p>
                                                    <button id="print" class="btn btn-warning btn-outline btn btnupdatesep" type="button" onclick="updateSepranap('<?= $pasien['id'] ?>')"> <span><i class="fas fa-calendar-check"></i></span> UPDATE SEP </button>
                                                    <button id="print" class="btn btn-danger btn-outline btn" type="button" onclick="updateSepPulang('<?= $pasien['id'] ?>')"> <span><i class="mdi mdi-wheelchair-accessibility"></i></span> UPDATE PULANG SEP !!</button>
                                                </p>
                                            <?php } ?>
                                            <button type="button" class="btn btn-success btn-outline btn histori"><i class="fas fa-search"></i> Histori Pelayanan (Vclaim)</button>
                                        </div>
                                    <?php } ?>

                                    <?php if ($pasien['statusrawatinap'] !== "PULANG") { ?>
                                        <hr>
                                        <div class="text-center">
                                            <button id="print" class="btn btn-success btn-outline btn btnjadwaldokterkontrol" type="button" onclick="jadwaldokterKontrol('<?= $pasien['id'] ?>')"> <span><i class="fas fa-search"></i></span> JADWAL DOKTER KONTROL </button>
                                            <?php if (($pasien['noSuratKontrol'] == "NONE") || ($pasien['noSuratKontrol'] == "") || ($pasien['noSuratKontrol'] == null)) { ?>
                                                <button id="print" class="btn btn-info btn-outline btn btninputkontrol" type="button" onclick="buatkanrencanaKontrol('<?= $pasien['id'] ?>')"> <span><i class="fas fa-calendar-check"></i></span> INSERT RENCANA KONTROL </button>
                                            <?php } ?>
                                            <?php if (($cabarheader !== 0) and ($pasien['noSuratKontrol'] !== null)) { ?>

                                                <button id="print" class="btn btn-dark btn-outline btn btncarirencanakontrol" type="button" onclick="carirencanaKontrol('<?= $pasien['id'] ?>')"> <span><i class="far fa-edit"></i></span> CARI SURAT KONTROL</button>
                                                <button id="print" class="btn btn-danger btn-outline btn btnhapusrencanakontrol" type="button" onclick="hapusrencanaKontrol('<?= $pasien['id'] ?>')"> <span><i class="fa fa-trash"></i></span> HAPUS RENCANA KONTROL </button>
                                                <button id="print" class="btn btn-warning btn-outline btn" type="button" onclick="updaterencanaKontrol('<?= $pasien['id'] ?>')"> <span><i class="mdi mdi-wheelchair-accessibility"></i></span> UPDATE RENCANA KONTROL</button>
                                            <?php } ?>
                                            </br>
                                            </br>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary">RUJUKAN Vclaim</button>
                                                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <?php if (($cabarheader !== 0) and ($pasien['noSuratRujukan'] == "") || ($pasien['noSuratRujukan'] == "NONE")) { ?>
                                                        <a class="dropdown-item" href="#" onclick="buatkanRUJUKAN('<?= $pasien['id'] ?>')">Insert Rujukan</a>
                                                    <?php } ?>
                                                    <?php if (($cabarheader !== 0) and ($pasien['noSuratRujukan'] !== "") and ($pasien['noSuratRujukan'] !== "NONE")) { ?>
                                                        <a class="dropdown-item btncetakrujukan" href="#" onclick="cetakRUJUKAN('<?= $pasien['id'] ?>')">Cetak Rujukan</a>
                                                        <a class="dropdown-item" href="#" onclick="updateRUJUKAN('<?= $pasien['id'] ?>')">Update Rujukan</a>
                                                        <a class="dropdown-item" href="#" onclick="hapusRUJUKAN('<?= $pasien['id'] ?>')">Hapus Rujukan</a>
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
                                        <h4 class="card-title-center">Histori Kunjungan Ruangan Rawat Inap</h4>
                                    </div>
                                    <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasien['pasienid']; ?>" readonly>
                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $pasien['journalnumber']; ?>" readonly>
                                    <input type="hidden" id="nomorSep" name="nomorSep" class="form-control" required value="<?= $pasien['bpjs_sep']; ?>">
                                    <input type="hidden" id="noSuratKontrol" name="noSuratKontrol" class="form-control" required value="<?= $pasien['noSuratKontrol']; ?>">
                                    <input type="hidden" id="nomorKartu" name="nomorKartu" class="form-control" required value="<?= $pasien['paymentcardnumber']; ?>">
                                    <input type="hidden" id="noSuratRujukan" name="noSuratRujukan" class="form-control" required value="<?= $pasien['noSuratRujukan']; ?>">
                                    <input type="hidden" id="pengajuanPenjaminSEP" name="pengajuanPenjaminSEP" class="form-control" required value="<?= $pasien['pengajuanPenjaminSEP']; ?>">
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

<div class="viewmodalranap" style="display:none;"></div>

<script>
    function datakunjungan() {
        $.ajax({

            url: "<?php echo base_url('DPMRI/HistoriKunjungan') ?>",
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
            window.open("<?php echo base_url('DPMRI/printkarcis') ?>?page=" + id, "_blank");



        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintsjp').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('DPMRI/printsjp') ?>?page=" + id, "_blank");



        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintsepranap').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('DPMRI/printsep') ?>?page=" + id, target = "_blank");
        })
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintheader').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('DPMRI/printheader') ?>?page=" + id, "_blank");



        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintsticker').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('DPMRI/printsticker') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=300, height=300px");



        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintgelang').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('DPMRI/printgelang') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=600, height=300px");



        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintrmk').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('DPMRI/printRMK') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=600, height=300px");



        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintpersetujuan').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('DPMRI/printPersetujuanKelas') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=600, height=300px");



        })
    });
</script>

<script>
    function buatkanSepranap(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/CreateSep'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {

                    $('.viewmodalranap').html(response.suksesmodalsep).show();
                    $('#modalcreatesepranap').modal();


                }
            }

        });
    }

    function updateSepranap(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/UpdateSepRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {

                    $('.viewmodalranap').html(response.suksesmodalsep).show();
                    $('#modalupdatesepranap').modal();
                }
            }
        });
    }

    function updateSepPulang(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/UpdateSepPulang'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodalranap').html(response.suksesmodalsep).show();
                    $('#modalupdatepulangSep').modal();
                }
            }

        });

    }

    function buatkanrencanaKontrol(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/InsertRencanaKontrol'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodalranap').html(response.suksesmodalsep).show();
                    $('#modalinsertrencanakontrol').modal();
                }
            }

        });

    }

    function updaterencanaKontrol(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/UpdateRencanaKontrol'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodalranap').html(response.suksesmodalsep).show();
                    $('#modalupdaterencanakontrol').modal();
                }
            }

        });

    }

    function jadwaldokterKontrol(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/JadwalDokter'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesjadwal) {
                    $('.viewmodalranap').html(response.suksesjadwal).show();
                    $('#modaldaftarjadwaldokterkontrol').modal();
                }
            }

        });

    }

    function buatkanRUJUKAN(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/InsertRencanaRujukan'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodalranap').html(response.suksesmodalsep).show();
                    $('#modalinsertrujukan').modal();
                }
            }

        });

    }

    function SepPenjaminan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/CreateSepPenjamin'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {

                    $('.viewmodalranap').html(response.suksesmodalsep).show();
                    $('#modalcreatesepranappenjamin').modal();


                }
            }

        });
    }

    function AprovalSepPenjaminan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/AprovalSepPenjamin'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {

                    $('.viewmodalranap').html(response.suksesmodalsep).show();
                    $('#modalaprovalsepranappenjamin').modal();


                }
            }

        });
    }
</script>


<script>
    function cariSep(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/CariSep'); ?>",
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
                            '<br>No.Rujukan: ' + response.response.noRujukan + '<br>COB: ' + response.response.cob + '<br>Katarak: ' + response.response.katarak,
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


    function carirencanaKontrol(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/CariSuratKontrol'); ?>",
            data: {
                id: id,
                noSuratKontrol: $('#noSuratKontrol').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.metaData.code == 200) {
                    Swal.fire({
                        html: 'Nama: ' + response.response.sep.peserta.nama + '<br>No.Kartu: ' + response.response.sep.peserta.noKartu + '<br>No.SuratKontrol: ' + response.response.noSuratKontrol +
                            '<br>Tanggal Kontrol: ' + response.response.tglRencanaKontrol + '<br>Pelayanan: ' + response.response.namaPoliTujuan + '<br>Dokter: ' + response.response.namaDokter +
                            '<br>No.Sep Asal: ' + response.response.sep.noSep,
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
    function hapusSep(id) {
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus Data Sep ini ?",
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
                    url: "<?php echo base_url('DPMRI/HapusSep'); ?>",
                    data: {
                        id: id,
                        nomorSep: $('#nomorSep').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                // icon: 'success',
                                // title: 'Berhasil',
                                text: response.pesan,
                                html: 'Pesan: ' + response.pesantambahan

                            });
                            datakunjungan();

                        }
                    }

                });


            }
        })

    }

    function hapusrencanaKontrol(id) {
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus Surat Rencana Kontrol data ini ?",
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
                    url: "<?php echo base_url('DPMRI/HapusSuratKontrol'); ?>",
                    data: {
                        id: id,
                        noSuratKontrol: $('#noSuratKontrol').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                //icon: 'success',
                                // title: 'Berhasil',
                                text: response.pesan,

                            });
                            datakunjungan();
                        } else {
                            Swal.fire({
                                //icon: 'error',
                                // title: 'Berhasil',
                                text: response.pesan,

                            });
                        }
                    }

                });


            }
        })

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
                $('.viewmodalranap').html(response.data).show();
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
                            '<br>Dokter: ' + response.response.namaDokter + '<br>Tanggal terbit SPRI: ' + response.response.tglTerbit +
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
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintsuratkontrol').on('click', function() {
            let id = $('#noSuratKontrol').val();
            window.open("<?php echo base_url('DPMRI/printSuratKontrol') ?>?page=" + id, target = "_blank");
        })
    });
</script>


<script>
    function cariRUJUKAN(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/CariSuratRujukan'); ?>",
            data: {
                id: id,
                nomorSuratRujukan: $('#noSuratRujukan').val()
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

    function hapusRUJUKAN(id) {
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
                    url: "<?php echo base_url('DPMRI/HapusSuratRujukan'); ?>",
                    data: {
                        id: id,
                        noSuratRujukan: $('#noSuratRujukan').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                //icon: 'success',
                                //title: 'Berhasil',
                                text: response.pesan,

                            });
                            datakunjungan();
                        } else {
                            Swal.fire({
                                //icon: 'error',
                                //title: 'Gagal',
                                text: response.pesan,

                            });

                        }
                    }

                });


            }
        })

    }

    function updateRUJUKAN(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/UpdateRencanaRujukan'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodalranap').html(response.suksesmodalsep).show();
                    $('#modalupdaterujukan').modal();
                }
            }

        });

    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btncetakrujukan').on('click', function() {
            let id = $('#noSuratRujukan').val();
            window.open("<?php echo base_url('DPMRI/printSuratRujukan') ?>?page=" + id, target = "_blank");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintseprajalkonvensional').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('DPMRI/printsepKonvensional') ?>?page=" + id, target = "_blank");
        })
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintstickerbarcode').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('DPMRI/printstickerbarcode') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");



        })
    });
</script>