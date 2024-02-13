<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
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
        content: '&&';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>

<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    .hr2 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr2:after {
        background: #fff;
        content: 'Pemeriksaan Fisik';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>


<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    .hr3 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr3:after {
        background: #fff;
        content: 'Diagnosa Keperawatan';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>
<div class="col-lg-12 col-md-12 px-0">
    <?= form_open('PelayananRawatJalanRME/simpanAsesmenPerawatIGD', ['class' => 'formasesmen']); ?>
    <?= csrf_field(); ?>
    <div class="modal-body px-0">
        <from class="form-horizontal form-material" id="form-filter" method="post">
            <div class="form-body">
                <form>
                    <hr>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Keluhan Utama</label>
                            <input type="text" class="form-control" id="keluhanUtama" name="keluhanUtama" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Eye</label>
                            <select name="eye" id="eye" class="select2" style="width: 100%" required onchange="total2()">
                                <option value="">Pilih</option>
                                <?php foreach ($eye as $eye) : ?>
                                    <option value="<?php echo $eye['nilai']; ?>"><?php echo $eye['name']; ?>[<b><?= $eye['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Verbal</label>
                            <select name="verbal" id="verbal" class="select2" style="width: 100%" required onchange="total2()">
                                <option value="">Pilih</option>
                                <?php foreach ($verbal as $verbal) : ?>
                                    <option value="<?php echo $verbal['nilai']; ?>"><?php echo $verbal['name']; ?>[<b><?= $verbal['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Motorik</label>
                            <select name="motorik" id="motorik" class="select2" style="width: 100%" required onchange="total2()">
                                <option value="">Pilih</option>
                                <?php foreach ($motorik as $motorik) : ?>
                                    <option value="<?php echo $motorik['nilai']; ?>"><?php echo $motorik['name']; ?>[<b><?= $motorik['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>Total GCS</b></label>
                            <input type="number" class="form-control" id="gcs" name="gcs" required readonly>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Kesadaran</label>
                            <select name="kesadaran" id="kesadaran" class="select2" style="width: 100%">
                                <?php foreach ($kesadaran as $kes) : ?>
                                    <option value="<?php echo $kes['name']; ?>"><?php echo $kes['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>BB</label>
                            <input type="number" class="form-control" id="bb" name="bb" required>
                            <small class="form-control-feedback">Kg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TB</label>
                            <input type="number" class="form-control" id="tb" name="tb" required>
                            <small class="form-control-feedback">Cm</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nadi</label>
                            <input type="number" class="form-control" id="frekuensiNadi" name="frekuensiNadi" required>
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Sistolik</label>
                            <input type="number" class="form-control" id="tdSistolik" name="tdSistolik" required>
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Diastolik</label>
                            <input type="number" class="form-control" id="tdDiastolik" name="tdDiastolik" required>
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Suhu</label>
                            <input type="text" class="form-control" id="suhu" name="suhu" required>
                            <small class="form-control-feedback">oC</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nafas</label>
                            <input type="number" class="form-control" id="frekuensiNafas" name="frekuensiNafas" required>
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>SpO2</label>
                            <input type="number" class="form-control" id="spo2" name="spo2">
                            <small class="form-control-feedback">%</small>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Rencana Tindakan</label>
                            <input type="text" class="form-control" id="rencanaTindakan" name="rencanaTindakan" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>SIO</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Tidak<input name="sio" id="sio" value="1" type="checkbox"><span class="lever switch-col-red"></span>Ya</label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Status Nutrisi</label>
                            <select name="statusNutrisi" id="statusNutrisi" class="select2" style="width: 100%" required>
                                <option value="">Pilih</option>
                                <?php foreach ($nutrisi as $nut) : ?>
                                    <option value="<?php echo $nut['name']; ?>"><?php echo $nut['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Konsul</label>
                            <select name="konsul" id="konsul" class="select2" style="width: 100%" required>
                                <option value="">Pilih</option>
                                <?php foreach ($konsul as $konsul) : ?>
                                    <option value="<?php echo $konsul['name']; ?>"><?php echo $konsul['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Persiapan Darah</label>
                            <select name="persiapanDarah" id="persiapanDarah" class="select2" style="width: 100%">
                                <option value="Tidak">Tidak</option>
                                <option value="Ada">Ada</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Jenis</label>
                            <input type="text" class="form-control" id="jenisPersiapanDarah" name="jenisPersiapanDarah" disabled>
                            <small class="form-control-feedback">Ditulis Jika Persiapan Darah</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Thorax</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="thorax" id="thorax" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>BNO</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="bno" id="bno" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>CT Scan</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="ctScan" id="ctScan" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Lab I</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="lab1" id="lab1" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Lab II</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="lab2" id="lab2" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Riwayat Therapy</label>
                            <select name="riwayatTherapy" id="riwayatTherapy" class="select2" style="width: 100%" required>
                                <option value="">Pilih</option>
                                <?php foreach ($riwayat as $riwayat) : ?>
                                    <option value="<?php echo $riwayat['name']; ?>"><?php echo $riwayat['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Riwayat Alergi</label>
                            <input type="text" class="form-control" id="riwayatAlergi" name="riwayatAlergi" required>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Skala Nyeri</label>
                            <select name="skalaNyeri" id="skalaNyeri" class="select2" style="width: 100%">
                                <?php foreach ($skala_nyeri as $skala) : ?>
                                    <option value="<?php echo $skala['code']; ?>"><?php echo $skala['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Asesmen Resiko Jatuh</label>
                            <select name="asesmenResikoJatuh" id="asesmenResikoJatuh" class="select2" style="width: 100%">
                                <?php foreach ($resiko as $resiko) : ?>
                                    <option value="<?php echo $resiko['name']; ?>"><?php echo $resiko['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Skoring Jatuh</label>
                            <div class="input-group">
                                <select name="skoringJatuh" id="skoringJatuh" class="select2" style="width: 100%">
                                    <option value="Tidak Beresiko">Tidak Beresiko</option>
                                    <option value="Resiko Rendah">Resiko Rendah</option>
                                    <option value="Resiko Tinggi">Resiko Tinggi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr class="hr2">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Kepala</label>
                            <input type="text" class="form-control" id="kepala" name="kepala">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>THT</label>
                            <input type="text" class="form-control" id="tht" name="tht">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Mata</label>
                            <input type="text" class="form-control" id="mata" name="mata">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Leher</label>
                            <input type="text" class="form-control" id="leher" name="leher">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Jantung</label>
                            <input type="text" class="form-control" id="jantung" name="jantung">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Dada/Paru</label>
                            <input type="text" class="form-control" id="dada" name="dada">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Abdomen</label>
                            <input type="text" class="form-control" id="abdomen" name="abdomen">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Punggung</label>
                            <input type="text" class="form-control" id="punggung" name="punggung">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Rektal</label>
                            <input type="text" class="form-control" id="rektal" name="rektal">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Genitalia</label>
                            <input type="text" class="form-control" id="genitalia" name="genitalia">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Ektremitas</label>
                            <input type="text" class="form-control" id="ektremitas" name="ektremitas">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Neurologis</label>
                            <input type="text" class="form-control" id="neurologis" name="neurologis">
                        </div>
                    </div>
                    <hr class="hr3">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label></label>
                            <div class="input-group-append">
                                <button class="btn btn-info" id="caridiagnosa" type="button"><i class="fas fa-search"></i>Diagnosa Keperawatan</button>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Diagnosa Keperawatan</label>
                            <textarea id="mymce2" name="uraianAskep" class="form-control" rows="8"></textarea>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Simpan</button>
                        </div>
                    </div>
            </div>

            </form>
    </div>
    </from>
</div>
<div class="modal-footer">

</div>
<?= form_close() ?>
</div>


<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();

        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {

                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,

        });
    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/tinymce/tinymce.min.js"></script>
<script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 100,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
</script>




<script type="text/javascript">
    $(document).ready(function() {
        var poliklinikname = document.getElementById("poliklinikname").value;
        $("#paramedicName").autocomplete({

            source: "<?php echo base_url('PelayananRawatJalanRME/ajax_paramedicName'); ?>?poliklinikname=" + poliklinikname,
            select: function(event, ui) {
                $('#paramedicName').val(ui.item.value);

            }
        });
    });
</script>


<script type="text/javascript">
    $('#isialergi').on('change', function() {
        if ($('#isialergi').val() == 1) {
            $('#uraianAlergi').removeAttr('disabled');
            $('#isialergi').val(0);
            $('#alergi').val(1);
        } else {
            $('#uraianAlergi').attr('disabled', 'disabled');
            $('#uraianAlergi').val('');
            $('#isialergi').val(1);
            $('#alergi').val(0);

        }

    })
</script>


<script type="text/javascript">
    $('#isinutrisiKondisiKhusus').on('change', function() {
        if ($('#isinutrisiKondisiKhusus').val() == 1) {
            $('#uraianKondisiKhusus').removeAttr('disabled');
            $('#isinutrisiKondisiKhusus').val(0);
            $('#nutrisiKondisiKhusus').val(1);
        } else {
            $('#uraianKondisiKhusus').attr('disabled', 'disabled');
            $('#uraianKondisiKhusus').val('');
            $('#isinutrisiKondisiKhusus').val(1);
            $('#nutrisiKondisiKhusus').val(0);

        }

    })
</script>


<script type="text/javascript">
    $('#isifungsionalAlatBantu').on('change', function() {
        if ($('#isifungsionalAlatBantu').val() == 1) {
            $('#fungsionalNamaAlatBantu').removeAttr('disabled');
            $('#isifungsionalAlatBantu').val(0);
            $('#fungsionalAlatBantu').val(1);
        } else {
            $('#fungsionalNamaAlatBantu').attr('disabled', 'disabled');
            $('#fungsionalNamaAlatBantu').val('');
            $('#isifungsionalAlatBantu').val(1);
            $('#fungsionalAlatBantu').val(0);

        }

    })
</script>


<script>
    $(document).ready(function() {
        $('.formasesmen').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
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

                        $('#form-filter-atas').css('display', 'none');
                        $('#form-filter-bawah').css('display', 'block');
                        $('#journalnumber').val(response.JN);
                        $('#kode').val(response.JN);
                        $('#dokter').val(response.dokter);
                        $('#doktername').val(response.doktername);
                        $('#documentdate').val(response.tanggalpelayanan);
                        dataCPPT();

                    }
                }


            });
            return false;
        });
    });
</script>


<script>
    $('#cariaskepigd').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariAskep'); ?>",

            data: {
                diagnosakeperawatan: diagnosakeperawatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalpilihaskep').modal('show');

                }
            }
        })
    })
</script>



<script type="text/javascript">
    $('#anamnesis').on('change', function() {
        if ($('#anamnesis').val() == "Allo Anamnesa") {
            $('#uraianAllo').removeAttr('disabled');
            $('#uraianAllo').val('');

        } else {
            $('#uraianAllo').attr('disabled', 'disabled');
            $('#uraianAllo').val('');
        }

    })
</script>



<script type="text/javascript">
    function total2() {
        var eye2 = document.getElementById('eye').value;
        var verbal2 = document.getElementById('verbal').value;
        var motorik2 = document.getElementById('motorik').value;
        //var totalpotongan = ((parseInt(hargaperbox) * jumlahkemasanbox)) * (potongan / 100);
        var nilai_eye2 = parseInt(eye2);
        var nilai_verbal2 = parseInt(verbal2);
        var nilai_motorik2 = parseInt(motorik2);
        var totalGCS2 = nilai_eye2 + nilai_verbal2 + nilai_motorik2;
        document.getElementById('gcs').value = totalGCS2;
    }
</script>





<script type="text/javascript">
    $('#edema').on('change', function() {
        if ($('#edema').val() == "Ada") {
            $('#uraianEdema').removeAttr('disabled');
            $('#uraianEdema').val('');

        } else {
            $('#uraianEdema').attr('disabled', 'disabled');
            $('#uraianEdema').val('');
        }

    })
</script>


<script type="text/javascript">
    $('#laserasi').on('change', function() {
        if ($('#laserasi').val() == "Ada") {
            $('#uraianLaserasi').removeAttr('disabled');
            $('#uraianLaserasi').val('');

        } else {
            $('#uraianLaserasi').attr('disabled', 'disabled');
            $('#uraianLaserasi').val('');
        }

    })
</script>

<script type="text/javascript">
    function totalnutrisi() {
        var penurunanBb = document.getElementById('penurunanBb').value;
        var asupanMakanan = document.getElementById('asupanMakanan').value;

        var nilai_penurunan = parseInt(penurunanBb);
        var nilai_asupanmakanan = parseInt(asupanMakanan);

        var totalNutrisi = nilai_penurunan + nilai_asupanmakanan;
        document.getElementById('skorNutrisi').value = totalNutrisi;
    }
</script>



<script type="text/javascript">
    function totalnutrisiAnak() {
        var nutrisiKurus = document.getElementById('nutrisiKurus').value;
        var turunBbAnak = document.getElementById('turunBbAnak').value;
        var nutrisiMuntahDiare = document.getElementById('nutrisiMuntahDiare').value;
        var penyakitMalnutrisi = document.getElementById('penyakitMalnutrisi').value;

        var nilai_nutrisiKurus = parseInt(nutrisiKurus);
        var nilai_turunBbAnak = parseInt(turunBbAnak);
        var nilai_nutrisiMuntahDiare = parseInt(nutrisiMuntahDiare);
        var nilai_malnutrisi = parseInt(penyakitMalnutrisi);

        var totalNutrisiAnak = nilai_nutrisiKurus + nilai_turunBbAnak + nilai_nutrisiMuntahDiare + nilai_malnutrisi;
        document.getElementById('skorNutrisiAnak').value = totalNutrisiAnak;
    }
</script>



<script>
    $('#cariimplementasiigd').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariImplementasi'); ?>",

            data: {
                diagnosakeperawatan: diagnosakeperawatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalpilihaskep_implementasi').modal('show');

                }
            }
        })
    })
</script>



<script type="text/javascript">
    $('#persiapanDarah').on('change', function() {
        if ($('#persiapanDarah').val() == "Ada") {
            $('#jenisPersiapanDarah').removeAttr('disabled');
            $('#jenisPersiapanDarah').val('');

        } else {
            $('#jenisPersiapanDarah').attr('disabled', 'disabled');
            $('#jenisPersiapanDarah').val('');
        }

    })
</script>




<script>
    $('#caridiagnosa').click(function(e) {
        e.preventDefault();
        let rektal = $('#rektal').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariDiagnosaAskep'); ?>",

            data: {
                rektal: rektal
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalpilihdiagnosaaskep').modal('show');

                }
            }
        })
    })
</script>