<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">RESUME DISABILITAS MCU</h4>
                <form action="" method="post" class="form-save">
                    <?= csrf_field() ;?>   
                    <input type="hidden" name="id_disabilitas" value="<?= $disabilitas == null ? null : $disabilitas['id'] ;?>">
                    <input type="hidden" name="pasienid" value="<?= $disabilitas == null ? $pasienid : $disabilitas['pasienid'] ;?>">
                    <input type="hidden" name="referencenumber" id="referencenumber" value="<?= $disabilitas == null ? $referencenumber : $disabilitas['referencenumber'] ;?>">
                    <div class="mb-3">
                        <label>Amputasi</label>
                        <select name="amputasi" id="amputasi" class="select2" style="width: 100%">
                            <option value="">Pilih Jenis Amputasi</option>
                            <option value="Tangan" <?= is_null($disabilitas) ? null : (($disabilitas['amputasi'] == 'Tangan') ? 'selected' : null) ;?>>Tangan</option>
                            <option value="Kaki" <?= is_null($disabilitas) ? null : (($disabilitas['amputasi'] == 'Kaki') ? 'selected' : null) ;?>>Kaki</option>
                            <option value="Tangan Kaki" <?= is_null($disabilitas) ? null : (($disabilitas['amputasi'] == 'Tangan Kaki') ? 'selected' : null) ;?>>Tangan & Kaki</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Lumpuh layuh atau kaku</label>
                        <select name="lumpuh" id="lumpuh" class="select2" style="width: 100%">
                            <option value="">Pilih Jenis Lumpuh</option>
                            <option value="Tangan" <?= is_null($disabilitas) ? null : (($disabilitas['lumpuh'] == 'Tangan') ? 'selected' : null) ;?>>Tangan</option>
                            <option value="Kaki" <?= is_null($disabilitas) ? null : (($disabilitas['lumpuh'] == 'Kaki') ? 'selected' : null) ;?>>Kaki</option>
                            <option value="Tangan Kaki" <?= is_null($disabilitas) ? null : (($disabilitas['lumpuh'] == 'Tangan Kaki') ? 'selected' : null) ;?>>Tangan & Kaki</option>
                        </select>
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="paraplegi" name="paraplegi" <?= is_null($disabilitas) ? null : (($disabilitas['paraplegi'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label" for="paraplegi">Paraplegi(anggotatubuhbagianbawah yang meliputikeduatungkai danorganpanggul)</label>
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="deformitas" name="deformitas" <?= is_null($disabilitas) ? null : (($disabilitas['deformitas'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label" for="deformitas">Deformitas Kaki dan perbedaan panjang tungkai bawah</label>
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="buta_total" name="buta_total" <?= is_null($disabilitas) ? null : (($disabilitas['buta_total'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label" for="buta_total">Buta Total</label>
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="persepsi_cahaya" name="persepsi_cahaya" <?= is_null($disabilitas) ? null : (($disabilitas['persepsi_cahaya'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label" for="persepsi_cahaya">PersepsiCahaya / Low Vision</label>
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="rungu" name="rungu" <?= is_null($disabilitas) ? null : (($disabilitas['rungu'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label text-capitalize" for="rungu">Rungu</label>
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="wicara" name="wicara" <?= is_null($disabilitas) ? null : (($disabilitas['wicara'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label text-capitalize" for="wicara">wicara</label>
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="disabilitas_grahita" name="disabilitas_grahita" <?= is_null($disabilitas) ? null : (($disabilitas['disabilitas_grahita'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label text-capitalize" for="disabilitas_grahita">disabilitas grahita</label>
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="down_syndrome" name="down_syndrome" <?= is_null($disabilitas) ? null : (($disabilitas['down_syndrome'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label text-capitalize" for="down_syndrome">down syndrome</label>
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="psikososial" name="psikososial" <?= is_null($disabilitas) ? null : (($disabilitas['psikososial'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label text-capitalize" for="psikososial">Psikososial (Skizofrenia, Bipolar, Depresi, Anxietas, dan Gangguan Kepribadian)</label>
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="disabilitas_perkembangan" name="disabilitas_perkembangan" <?= is_null($disabilitas) ? null : (($disabilitas['disabilitas_perkembangan'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label text-capitalize" for="disabilitas_perkembangan">Disabilitas perkembangan ( Autis /Hiperaktif )</label>
                    </div>
                    <div class="form-group mt-3">
                        <label for="derajat_disabilitas" class="text-capitalize">derajat disabilitas</label>
                        <input type="text" class="form-control" id="derajat_disabilitas" name="derajat_disabilitas" value="<?= is_null($disabilitas) ? null : $disabilitas['derajat_disabilitas']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="penyebab" class="text-capitalize">penyebab</label>
                        <input type="text" class="form-control" id="penyebab" name="penyebab" value="<?= is_null($disabilitas) ? null : $disabilitas['penyebab']; ?>">
                    </div>
                    <div class="form-check p-0 mt-3">
                        <input type="checkbox" value="1" class="form-check-input" id="alat_bantu" name="alat_bantu" <?= is_null($disabilitas) ? null : (($disabilitas['alat_bantu'] == '1') ? 'checked' : null) ;?>>
                        <label class="form-check-label text-capitalize" for="alat_bantu">alat bantu</label>
                    </div>
                    <div class="form-group mt-3">
                        <label for="keperluan" class="text-capitalize">keperluan</label>
                        <input type="text" class="form-control" id="keperluan" name="keperluan" value="<?= is_null($disabilitas) ? null : $disabilitas['keperluan']; ?>">
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

        var availableTags = [
            "Sejak Lahir",
            "Kecelakaan dalam Pekerjaan",
            "KcelakaanLalu Lintas",
            "Penyakit",
            "AkibatStroke",
            "AkibatKusta",
        ];
        $( "#penyebab" ).autocomplete({
            source: availableTags
        });

        $('.form-save').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: '<?= base_url('PelayananRawatJalanRME/simpanResumeDisabilitasMcu');?>',
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
                        disabilitasResume()
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
            window.open("<?php echo base_url('PelayananRawatJalanRME/printResumeDisabilitasMcu') ?>?page=" + $('#referencenumber').val(), "_blank");
        });
    })
</script>