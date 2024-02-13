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

<div id="modalpembayaranrajal_validasi" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Menu Update Validasi Pembayaran Rawat Jalan</h4>
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
                                        <button id="print" class="btn btn-info btn-outline btn piutang" type="button" data-id="<?= $pasien['journalnumber']; ?>"> <span><i class="fa fa-search"></i></span> Cek Piutang </button>
                                        <p></p>
                                        <button id="print" class="btn btn-danger btn-outline btn btnbatalvalidasi" type="button" onclick="BatalValidasi('<?= $pasien['journalnumber'] ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Batalkan Pembayaran ?</button>

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

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="profile3" role="tabpanel">
                                                <div class="card-body">
                                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $pasien['journalnumber']; ?>" readonly>
                                                    <input type="hidden" id="deletedby" name="deletedby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                    <?= form_open('KasirRJ/update_validasipembayaran', ['class' => 'formvalidasibayar']); ?>
                                                    <?= csrf_field(); ?>
                                                    <p class="mt-4 viewdataresume"></p>
                                                    <?= form_close() ?>
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

            url: "<?php echo base_url('KasirRJ/resumeGabungValidasi') ?>",
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

            url: "<?php echo base_url('PelayananRawatJalan/resumeTNO') ?>",
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


<script>
    function BatalValidasi(journalnumber) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan membatalkan validasi pembayaran pasien ini ?",
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
                    url: "<?php echo base_url('KasirRJ/BatalValidasi'); ?>",
                    data: {
                        journalnumber: journalnumber,
                        deletedby: $('#deletedby').val()
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
                                    berangkat();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>

<script type="text/javascript">
    function berangkat() {
        window.location.href = "<?php echo base_url('KasirRJ/AfterValidasi'); ?>";
    }
</script>