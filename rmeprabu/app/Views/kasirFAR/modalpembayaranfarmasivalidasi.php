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

<div id="modalpembayaranfarmasivalidasi" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Menu Update Validasi Pembayaran Farmasi Apotek</h4>
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
                                    $tanggallahir = $pasien['dateofbirth'];
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
                                        <h6 class="card-subtitle"><?= $pasien['poliklinik']; ?>|<?= $pasien['poliklinikname']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['doktername']; ?></h6>
                                        <h6 class="card-subtitle"><?= $pasien['paymentmethodname']; ?></h6>
                                        <h6 class="card-subtitle">No.Pendaftaran : <?= $pasien['journalnumber']; ?></h6>

                                        <input type="hidden" id="journalnumberhasil" name="journalnumberhasil" class="form-control">
                                        <input type="hidden" id="rekammedis" name="rekammeedis" class="form-control" value="<?= $pasien['pasienid']; ?>">
                                        <br>
                                        <?php if ($pasien['locationcode'] == 'DEPORAJAL') {
                                            $pelayanan = 'Depo Rawat Jalan';
                                        } else {
                                            if ($pasien['locationcode'] == 'DEPOIGD') {
                                                $pelayanan = 'Depo IGD';
                                            } else {
                                                if ($pasien['locationcode'] == 'DEPORINAP') {
                                                    $pelayanan = 'Depo Rawat Inap';
                                                } else {
                                                    if ($pasien['locationcode'] == 'DEPOOK') {
                                                        $pelayanan = 'Depo OK';
                                                    } else {
                                                        if ($pasien['locationcode'] == 'DEPOJIWA') {
                                                            $pelayanan = 'Depo Jiwa';
                                                        } else {
                                                            $pelayanan = '';
                                                        }
                                                    }
                                                }
                                            }
                                        }   ?>
                                        <h4 class="card-title mt-2"><?= strtoupper($pelayanan); ?></h4>
                                        <br>
                                        <button id="print" class="btn btn-danger btn-outline btn btnbatalvalidasi" type="button" onclick="BatalValidasi('<?= $pasien['journalnumber'] ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Batalkan Validasi ?</button>
                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="card-body"> <small class="text-muted">Alamat </small>
                                    <h6><?= $pasien['pasienaddress']; ?></h6> <small class="text-muted pt-4 d-block"></small>
                                    <h6><?= $pasien['paymentcardnumber']; ?></h6>
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
                                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $pasien['referencenumber']; ?>" readonly>
                                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $pasien['journalnumber']; ?>" readonly>
                                                    <?= form_open('KasirFAR/update_validasipembayaranFAR', ['class' => 'formvalidasibayar']); ?>
                                                    <?= csrf_field(); ?>
                                                    <p class="mt-4 viewdataresume"></p>
                                                    <?= form_close() ?>
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



<script>
    function dataresume() {
        $.ajax({
            url: "<?php echo base_url('KasirFAR/resumeGabungValidasiApotek') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
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
    function BatalValidasi(journalnumber) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan membatalkan validasi pembayaran Resep Obat ini ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KasirFAR/BatalValidasi'); ?>",
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
        window.location.href = "<?php echo base_url('KasirFAR/AfterValidasi'); ?>";
    }
</script>