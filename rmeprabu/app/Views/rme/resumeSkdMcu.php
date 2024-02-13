<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">RESUME SKD</h4>
                <form action="" method="post" class="form-save">
                    <?= csrf_field() ;?>   
                    <input type="hidden" name="id_skd" value="<?= $skd == null ? null : $skd['id'] ;?>">
                    <input type="hidden" name="pasienid" value="<?= $skd == null ? $pasienid : $skd['pasienid'] ;?>">
                    <input type="hidden" name="referencenumber" id="referencenumber" value="<?= $skd == null ? $referencenumber : $skd['referencenumber'] ;?>">

                    <div class="row px-3">
                        <div class="col-md-4 px-1 mb-2">
                            <label>BB</label>
                            <input type="text" class="form-control" id="tb" name="tb" value="<?= is_null($data_asesmen) ? null : $data_asesmen['bb']; ?>" readonly>
                            <small class="form-control-feedback">Kg</small>
                        </div>
                        <div class="col-md-4 px-1 mb-2">
                            <label>TB</label>
                            <input type="text" class="form-control" id="tb" name="tb" value="<?= is_null($data_asesmen) ? null : $data_asesmen['tb']; ?>" readonly>
                            <small class="form-control-feedback">Cm</small>
                        </div>
                        <div class="col-md-4 px-1 mb-2">
                            <label>Nadi</label>
                            <input type="text" class="form-control" id="frekuensiNadi" name="frekuensiNadi" value="<?= is_null($data_asesmen) ? null : $data_asesmen['frekuensiNadi']; ?>" readonly>
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-4 px-1 mb-2">
                            <label>Sistolik</label>
                            <input type="text" class="form-control" id="tdSistolik" name="tdSistolik" value="<?= is_null($data_asesmen) ? null : $data_asesmen['tdSistolik']; ?>" readonly>
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-4 px-1 mb-2">
                            <label>Diastolik</label>
                            <input type="text" class="form-control" id="tdDiastolik" name="tdDiastolik" value="<?= is_null($data_asesmen) ? null : $data_asesmen['tdDiastolik']; ?>" readonly>
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-4 px-1 mb-2">
                            <label>Suhu</label>
                            <input type="text" class="form-control" id="suhu" name="suhu" value="<?= is_null($data_asesmen) ? null : $data_asesmen['suhu']; ?>" readonly>
                            <small class="form-control-feedback">oC</small>
                        </div>
                        <div class="col-md-4 px-1 mb-2">
                            <label>RR</label>
                            <input type="text" class="form-control" id="pernapasan" name="pernapasan" value="<?= is_null($data_asesmen) ? null : $data_asesmen['frekuensiNafas']; ?>" readonly>
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input class="form-control" id="nomor_surat" name="nomor_surat" value="<?= is_null($skd) ? null : $skd['nomor_surat'] ;?>">
                    </div>
                    <div class="form-group">
                        <label for="keperluan">Keperluan</label>
                        <textarea class="form-control" id="keperluan" name="keperluan" rows="3"><?= is_null($skd) ? null : $skd['keperluan'] ;?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Hasil Pemeriksaaa MCU</label>
                        <select name="hasil" id="hasil" class="select2" style="width: 100%">
                            <option value="">Pilih Hasil MCU</option>
                            <option value="Kesehatan Baik" <?= is_null($skd) ? null : (($skd['hasil'] == 'Kesehatan Baik') ? 'selected' : null) ;?>>Kesehatan Baik</option>
                            <option value="Kesehatan cukup baik dengan kelainan yang dapat dipulihkan" <?= is_null($skd) ? null : (($skd['hasil'] == 'Kesehatan cukup baik dengan kelainan yang dapat dipulihkan') ? 'selected' : null) ;?>>Kesehatan cukup baik dengan kelainan yang dapat dipulihkan</option>
                            <option value="Kemampuan fisik terbatas untuk pekerjaan tertantu" <?= is_null($skd) ? null : (($skd['hasil'] == 'Kemampuan fisik terbatas untuk pekerjaan tertantu') ? 'selected' : null) ;?>>Kemampuan fisik terbatas untuk pekerjaan tertantu</option>
                            <option value="Tidak sehat dan tidak aman untuk semua pekerjaan" <?= is_null($skd) ? null : (($skd['hasil'] == 'Tidak sehat dan tidak aman untuk semua pekerjaan') ? 'selected' : null) ;?>>Tidak sehat dan tidak aman untuk semua pekerjaan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary btn-save">Simpan</button>
                    <button type="button" class="btn btn-sm btn-success btn-print"><i class="fas fa-print"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        $('.select2').select2()

        $('.form-save').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '<?= base_url('PelayananRawatJalanRME/simpanResumeSkdMcu');?>',
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btn-save').attr('disable', 'disabled');
                    $('.btn-save').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btn-save').removeAttr('disable');
                    $('.btn-save').html('Simpan');
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: response.success,
                        })
                        resumeSkd()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error !!!',
                            html: response.error,
                        })
                    }
                }
            });
            return false;
        })

        $('.btn-print').click(()=>{
            window.open("<?php echo base_url('PelayananRawatJalanRME/printResumeSkdMcu') ?>?page=" + $('#referencenumber').val(), "_blank");
        });
    })
</script>