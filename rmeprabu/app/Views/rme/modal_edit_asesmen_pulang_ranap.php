<div id="modal_update_asesmen_pulang_ranap" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Update Asesmen Pulang Pasien Rawat Inap</h4>
            </div>
            <div class="modal-body">
                <?= form_open('PelayananRawatJalanRME/updateAsesmenPulangRanap', ['class' => 'formasesmeneditmedispulang']); ?>
                <?= csrf_field(); ?>
                    <input type="hidden" value="<?= $data['referencenumber'] ;?>" id="referencenumber" name="referencenumber">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label>Norm</label>
                            <input type="text" class="form-control" id="pasienid" name="pasienid" required value="<?= $data['pasienid']; ?>" readonly>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="pasienname" name="pasienname" required value="<?= $data['pasienname']; ?>" readonly>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Tanggal Lahir</label>
                            <input type="text" class="form-control" id="pasiendateofbirth" name="pasiendateofbirth" required value="<?= $data['pasiendateofbirth']; ?>" readonly>
                        </div>
                        <?php
                        $tanggallahir = $data['pasiendateofbirth'];
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
                            <input type="text" class="form-control" id="pasienage" name="pasienage" value="<?= $umur; ?>" readonly>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Diagnosis</label>
                            <input type="text" class="form-control" id="diagnosisMasuk" name="diagnosisMasuk" value="<?= $data['diagnosisMasuk']; ?>">">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Ruang Rawat Terakhir</label>
                            <input type="text" class="form-control" id="lastRoom" name="lastRoom" required value="<?= $data['lastRoom']; ?>">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>T.Masuk</label>
                            <input type="text" class="form-control" id="dateIn" name="dateIn" required value="<?= date('d/m/Y', strtotime($data['dateIn'])); ?>">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>T.Pulang</label>
                            <input type="text" class="form-control" id="dateOut" name="dateOut" required value="<?= date('d/m/Y', strtotime($data['dateOut'])); ?>">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Alasan Dirawat di Rumah Sakit</label>
                            <textarea id="alasanRawat" name="alasanRawat" class="form-control" rows="3"><?= $data['alasanRawat']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Ringkasan Riway Penyakit</label>
                            <textarea id="ringkasanRiwayatPenyakit" name="ringkasanRiwayatPenyakit" class="form-control" rows="3"><?= $data['ringkasanRiwayatPenyakit']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Hasil Pemeriksaan Fisik</label>
                            <textarea id="hasilPemeriksaanFisik" name="hasilPemeriksaanFisik" class="form-control" rows="3"><?= $data['hasilPemeriksaanFisik']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Pemeriksaan Penunjang/Diagnostik</label>
                            <textarea id="pemeriksaanPenunjang" name="pemeriksaanPenunjang" class="form-control" rows="3"><?= $data['pemeriksaanPenunjang']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Terapi/Pengobatan Selama di Rumah Sakit</label>
                            <textarea id="terapiSelamaRawat" name="terapiSelamaRawat" class="form-control" rows="3"><?= $data['terapiSelamaRawat']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Perkembangan Setelah Perawatan</label>
                            <textarea id="perkembanganSetelahPerawatan" name="perkembanganSetelahPerawatan" class="form-control" rows="3"><?= $data['perkembanganSetelahPerawatan']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Alergi(Reaksi Obat)</label>
                            <textarea id="alergiObat" name="alergiObat" class="form-control" rows="3"><?= $data['alergiObat']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Kondisi Waktu Keluar</label>
                            <textarea id="kondisiWaktuKeluar" name="kondisiWaktuKeluar" class="form-control" rows="3"><?= $data['kondisiWaktuKeluar']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Pengobatan Dilanjutkan</label>
                            <textarea id="pengobatanDilanjutkan" name="pengobatanDilanjutkan" class="form-control" rows="3"><?= $data['pengobatanDilanjutkan']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Tanggal Kontrol Poli</label>
                            <input type="text" class="form-control" id="datepicker-autoclose" name="tanggalKontrol" value="<?= date('d/m/Y', strtotime($data['tanggalKontrol'])); ?>">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label>Diagnosis Utama (ICD 10)</label>
                            <input type="text" class="form-control" id="diagnosisUtama" name="diagnosisUtama" value="<?= $data['diagnosisUtama']; ?>">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label>Diagnosis Sekunder (ICD 10)</label>
                            <input type="text" class="form-control" id="diagnosisSekunder" name="diagnosisSekunder" value="<?= $data['diagnosisSekunder']; ?>">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label>Tindakan/Prosedur (ICD 9)</label>
                            <input type="text" class="form-control" id="prosedur" name="prosedur" value="<?= $data['prosedur']; ?>">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['id']; ?>">
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-warning btnsimpan"><i class="fas fa-edit"></i> Update</button>
                        </div>
                    </div>
                    <?= form_close() ?>
            </div>

            <div class="modal-footer">
                <div class="col-md-6 mb-3 text-right">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    jQuery('#datepicker-autoclose').datepicker({
        dateFormat: "dd/mm/yy",
        autoclose: true,
        todayHighlight: true
    });
</script>


<script>
    $(document).ready(function() {

        $('.formasesmeneditmedispulang').submit(function(e) {
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
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.gagal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal',
                            text: response.pesan,
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
                        $('#modal_update_asesmen_pulang_ranap').modal('hide');


                    }
                }


            });
            return false;
        });
    });
</script>