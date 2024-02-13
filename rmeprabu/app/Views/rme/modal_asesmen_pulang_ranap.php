<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<style>
    hr {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }
</style>

<div class="modal fade" id="modal_asesmen_pulang_ranap" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modal_asesmen_pulang_ranapLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_asesmen_pulang_ranapLabel">Asesmen Pulang Pasien Rawat Inap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?= form_open('PelayananRawatJalanRME/simpanAsesmenMedisRanapPulang', ['class' => 'formasesmenmedispulang']); ?>
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3 mb-2">
                                    <label>Norm</label>
                                    <input type="text" class="form-control" id="pasienid" name="pasienid" required value="<?= $pasienid; ?>" readonly>
                                    <input type="hidden" class="form-control" id="nomorreferensi" name="nomorreferensi" required value="<?= $nomorreferensi; ?>">
                                    <input type="hidden" class="form-control" id="paymentmethodname" name="paymentmethodname" required value="<?= $paymentmethodname; ?>">
                                    <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $poliklinikname; ?>">
                                    <input type="hidden" class="form-control" id="admissionDate" name="admissionDate" required value="<?= $admissionDate; ?>">
                                    <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                                    <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                                </div>
                                <input type="hidden" class="form-control" id="doktername" name="doktername" required value="<?= $doktername ?>">
                                <div class="col-md-3 mb-2">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="pasienname" name="pasienname" required value="<?= $pasienname; ?>" readonly>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="pasiendateofbirth" name="pasiendateofbirth" required value="<?= $pasiendateofbirth; ?>" readonly>
                                </div>
                                <?php
                                $tanggallahir = $pasiendateofbirth;
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

                                $umur = $age_years . " tahun ";
                                ?>
                                <div class="col-md-3 mb-2">
                                    <label>Umur</label>
                                    <input type="text" class="form-control" id="pasienage" name="pasienage" value="<?= $umur; ?>">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Diagnosis</label>
                                    <input type="text" class="form-control" id="diagnosisMasuk" name="diagnosisMasuk" value="<?= $diagnosisMasuk; ?>">
                                    <input type="hidden" class="form-control" id="namaPjb" name="namaPjb" value="<?= $namaPjb; ?>">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>Ruang Rawat Terakhir</label>
                                    <input type="text" class="form-control" id="lastRoom" name="lastRoom" required value="<?= $lastRoomName; ?>">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>T.Masuk</label>
                                    <input type="text" class="form-control" id="dateIn" name="dateIn" required value="<?= $tanggalMasuk; ?>">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label>T.Pulang</label>
                                    <input type="text" class="form-control" id="dateOut" name="dateOut" required value="<?= $tanggalPulang; ?>">
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label>Alasan Dirawat di Rumah Sakit</label>
                                    <textarea id="alasanRawat" name="alasanRawat" class="form-control" rows="3"><?= $alasanRawat; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Ringkasan Riway Penyakit</label>
                                    <textarea id="ringkasanRiwayatPenyakit" name="ringkasanRiwayatPenyakit" class="form-control" rows="3"><?= $ringkasanRiwayatPenyakit; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Hasil Pemeriksaan Fisik</label>
                                    <textarea id="hasilPemeriksaanFisik" name="hasilPemeriksaanFisik" class="form-control" rows="3"><?= $hasilPemeriksaanFisik; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Pemeriksaan Penunjang/Diagnostik</label>
                                    <textarea id="pemeriksaanPenunjang" name="pemeriksaanPenunjang" class="form-control" rows="3"><?= $pemeriksaanPenunjang; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Terapi/Pengobatan Selama di Rumah Sakit</label>
                                    <textarea id="terapiSelamaRawat" name="terapiSelamaRawat" class="form-control" rows="3"><?= $terapiSelamaRawat; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Perkembangan Setelah Perawatan</label>
                                    <textarea id="perkembanganSetelahPerawatan" name="perkembanganSetelahPerawatan" class="form-control" rows="3"><?= $perkembanganSetelahPerawatan; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Alergi(Reaksi Obat)</label>
                                    <textarea id="alergiObat" name="alergiObat" class="form-control" rows="3"><?= $alergiObat; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Kondisi Waktu Keluar</label>
                                    <textarea id="kondisiWaktuKeluar" name="kondisiWaktuKeluar" class="form-control" rows="3"><?= $kondisiWaktuKeluar; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Pengobatan Dilanjutkan</label>
                                    <textarea id="pengobatanDilanjutkan" name="pengobatanDilanjutkan" class="form-control" rows="3"><?= $pengobatanDilanjutkan; ?></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Tanggal Kontrol Poli</label>
                                    <input type="text" class="form-control" id="datepicker-autoclose" name="tanggalKontrol" value="<?= $tanggalKontrol; ?>">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Diagnosis Utama (ICD 10)</label>
                                    <textarea type="text" class="form-control" rows="3" id="diagnosisUtama" name="diagnosisUtama" value="<?= $diagnosisUtama; ?>"></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Diagnosis Sekunder (ICD 10)</label>
                                    <textarea type="text" class="form-control" rows="3" id="diagnosisSekunder" name="diagnosisSekunder" value="<?= $diagnosisSekunder; ?>"></textarea>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Tindakan/Prosedur (ICD 9)</label>
                                    <textarea type="text" class="form-control" rows="3" id="prosedur" name="prosedur" value="<?= $prosedur; ?>"></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Simpan</button>
                                    <button class="btn btn-info" type="button" onclick="eResep('<?= $nomorreferensi ?>')">Terapi Pulang</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="view-modal"></div>

<script>
    $(function() {
        // For select 2
        $(".select2").select2();

    });
</script>


<script>
    jQuery('#datepicker-autoclose').datepicker({
        dateFormat: "dd/mm/yy",
        autoclose: true,
        todayHighlight: true
    });
</script>


<script>
    $(document).ready(function() {

        $('.formasesmenmedispulang').submit(function(e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function() {
                    $('.btnsimpan').attr('disabled', true);
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disabled');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal',
                            text: Object.values(response.error),
                        })

                    } else if (response.error) {
                        if (response.error.doktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        } else {
                            $('#doktername').removeClass('form-control-danger');
                            $('.erroroktername').html('');
                        }

                        if (response.error.name) {
                            $('#name').addClass('form-control-danger');
                            $('.errorname').html(response.error.name);
                        } else {
                            $('#name').removeClass('form-control-danger');
                            $('.errorname').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })
                        dataCPPT();
                        $('#modal_asesmen_pulang_ranap').modal('hide');


                    }
                }


            });
            return false;
        });
    });

    function eResep(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderEresepPulang'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.view-modal').html(response.sukses).show();
                    $('#modalinputereseppulang_rme').modal('show');
                }
            }
        });
    }
</script>