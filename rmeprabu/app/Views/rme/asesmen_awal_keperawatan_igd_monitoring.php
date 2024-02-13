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
        content: 'Asesmen Primary';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>

<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    .hr10 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr10:after {
        background: #fff;
        content: 'Tanda Vital';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>

<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    .hr11 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr11:after {
        background: #fff;
        content: 'Intake';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr14 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr14:after {
        background: #fff;
        content: 'Output';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>

<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    .hr12 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr12:after {
        background: #fff;
        content: 'Observasi Kebidanan';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>


<div class="col-lg-12 col-md-12 px-0">
    <?= form_open('PelayananRawatJalanRME/simpanAsesmenPerawatIGDMonitoring', ['class' => 'formmonitoring']); ?>
    <?= csrf_field(); ?>
    <div class="modal-body px-0">
        <from class="form-horizontal form-material" id="form-filter" method="post">
            <div class="form-body">
                <form>
                    <hr class="hr10">
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>Tanggal Jam</label>
                            <input type="text" class="form-control" id="executionDateTime" name="executionDateTime" required value="<?= date('d-m-Y G:i:s'); ?>">
                            <input type="hidden" class="form-control" id="admissionDateTime" name="admissionDateTime" required value="<?= $admissionDateTime; ?>">
                            <input type="hidden" class="form-control" id="monitoring_paramedicName" name="monitoring_paramedicName" required value="<?= session()->get('firstname'); ?>">
                            <input type="hidden" class="form-control" id="monitoring_createdBy" name="monitoring_createdBy" required value="<?= session()->get('firstname'); ?>">
                            <input type="hidden" class="form-control" id="monitoring_createddate" name="monitoring_createddate" required value="<?= date('Y-m-d G:i:s'); ?>">

                            <input type="hidden" class="form-control" id="monitoring_nomorreferensi" name="monitoring_nomorreferensi" required value="<?= $nomorreferensi; ?>">
                            <input type="hidden" class="form-control" id="monitoring_poliklinikname" name="monitoring_poliklinikname" required value="<?= $poliklinikname; ?>">
                            <input type="hidden" class="form-control" id="monitoring_pasienid" name="monitoring_pasienid" required value="<?= $pasienid; ?>">
                            <input type="hidden" class="form-control" id="monitoring_pasienname" name="monitoring_pasienname" required value="<?= $pasienname; ?>">
                            <input type="hidden" class="form-control" id="monitoring_paymentmethodname" name="monitoring_paymentmethodname" required value="<?= $paymentmethodname; ?>">
                            <input type="hidden" class="form-control" id="monitoring_admissionDate" name="monitoring_admissionDate" required value="<?= $admissionDate; ?>">
                            <input type="hidden" class="form-control" id="monitoring_doktername" name="monitoring_doktername" required value="<?= $doktername; ?>">
                            <input type="hidden" class="form-control" id="monitoring_admissionDate" name="monitoring_admissionDate" required value="<?= $admissionDate; ?>">
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label for="nomorasuransi">Diagnosa</label>
                                <div class="input-group">
                                    <input type="text" class="form-control required" id="monitoring_diagnosa" name="monitoring_diagnosa" value="<?= $diagnosis; ?>">
                                    <div class="input-group-append">
                                        <button class="btn btn-info" id="btn-caridiagnosa" type="button">Cari</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Kesadaran</label>
                            <select name="monitoring_kesadaran" id="monitoring_kesadaran" class="select2" style="width: 100%">
                                <?php foreach ($kesadaran as $kes) : ?>
                                    <option value="<?php echo $kes['name']; ?>"><?php echo $kes['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>BB</label>
                            <input type="number" class="form-control" id="monitoring_bb" name="monitoring_bb" required value="<?= $bb; ?>">
                            <small class="form-control-feedback">Kg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TB</label>
                            <input type="number" class="form-control" id="monitoring_tb" name="monitoring_tb" required value="<?= $tb; ?>">
                            <small class="form-control-feedback">Cm</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nadi</label>
                            <input type="number" class="form-control" id="monitoring_frekuensiNadi" name="monitoring_frekuensiNadi" required value="<?= $frekuensiNadi; ?>">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Sistolik</label>
                            <input type="number" class="form-control" id="monitoring_tdSistolik" name="monitoring_tdSistolik" required value="<?= $tdSistolik; ?>">
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Diastolik</label>
                            <input type="number" class="form-control" id="monitoring_tdDiastolik" name="monitoring_tdDiastolik" required value="<?= $tdDiastolik; ?>">
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Suhu</label>
                            <input type="text" class="form-control" id="monitoring_suhu" name="monitoring_suhu" required value="<?= $suhu; ?>">
                            <small class="form-control-feedback">oC</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nafas</label>
                            <input type="number" class="form-control" id="monitoring_frekuensiNafas" name="monitoring_frekuensiNafas" required value="<?= $frekuensiNafas; ?>">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>SpO2</label>
                            <input type="number" class="form-control" id="monitoring_spo2" name="monitoring_spo2" required value="<?= $spo2; ?>">
                            <small class="form-control-feedback">%</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Eye</label>
                            <select name="monitoring_eye" id="monitoring_eye" class="select2" style="width: 100%" required onchange="total3()">
                                <option value="">Pilih</option>
                                <?php foreach ($eye as $eye) : ?>
                                    <option value="<?php echo $eye['nilai']; ?>" <?php if ($eye['nilai'] == $eye_triase) { ?> selected="selected" <?php } ?>><?php echo $eye['name']; ?>[<b><?= $eye['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Verbal</label>
                            <select name="monitoring_verbal" id="monitoring_verbal" class="select2" style="width: 100%" required onchange="total3()">
                                <option value="">Pilih</option>
                                <?php foreach ($verbal as $verbal) : ?>
                                    <option value="<?php echo $verbal['nilai']; ?>" <?php if ($verbal['nilai'] == $verbal_triase) { ?> selected="selected" <?php } ?>><?php echo $verbal['name']; ?>[<b><?= $verbal['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Motorik</label>
                            <select name="monitoring_motorik" id="monitoring_motorik" class="select2" style="width: 100%" required onchange="total3()">
                                <option value="">Pilih</option>
                                <?php foreach ($motorik as $motorik) : ?>
                                    <option value="<?php echo $motorik['nilai']; ?>" <?php if ($motorik['nilai'] == $motorik_triase) { ?> selected="selected" <?php } ?>><?php echo $motorik['name']; ?>[<b><?= $motorik['nilai']; ?></b>]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label><b>Total GCS</b></label>
                            <input type="number" class="form-control" id="monitoring_gcs" name="monitoring_gcs" required readonly value="<?= $totalGcs; ?>">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Skala Nyeri</label>
                            <select name="monitoring_skalaNyeri" id="monitoring_skalaNyeri" class="select2" style="width: 100%">
                                <?php foreach ($skala_nyeri as $skala) : ?>
                                    <option value="<?php echo $skala['code']; ?>"><?php echo $skala['name']; ?> [<?php echo $skala['code']; ?> ]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                    </div>
                    <hr class="hr11">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Pemberian Oral</label>
                            <input type="text" class="form-control" id="monitoring_pemberianOral" name="monitoring_pemberianOral">
                            <small class="form-control-feedback">cc</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Pemberian Parenteral</label>
                            <input type="text" class="form-control" id="monitoring_pemberianParental" name="monitoring_pemberianParental">
                            <small class="form-control-feedback">cc</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>NGT (Intake)</label>
                            <input type="text" class="form-control" id="monitoring_pemberianNgt" name="monitoring_pemberianNgt">
                            <small class="form-control-feedback">cc</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><b>Obat</b></label>
                            <input type="text" class="form-control" id="monitoring_pemberianNgt" name="monitoring_pemberianObat">
                            <small class="form-control-feedback">cc</small>
                        </div>
                    </div>
                    <hr class="hr14">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Muntah / NGT</label>
                            <input type="text" class="form-control" id="monitoring_muntah" name="monitoring_muntah" value="-">
                            <small class="form-control-feedback">cc</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Drain</label>
                            <input type="text" class="form-control" id="monitoring_drain" name="monitoring_drain" value="-">
                            <small class="form-control-feedback">cc</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>IWL</label>
                            <input type="text" class="form-control" id="monitoring_iwl" name="monitoring_iwl" value="-">
                            <small class="form-control-feedback">cc</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Perdarahan</label>
                            <input type="text" class="form-control" id="monitoring_perdarahan" name="monitoring_perdarahan" value="-">
                            <small class="form-control-feedback">cc</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Urin</label>
                            <input type="text" class="form-control" id="monitoring_urin" name="monitoring_urin" value="-">
                            <small class="form-control-feedback">cc</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Balance</label>
                            <input type="text" class="form-control" id="monitoring_balance" name="monitoring_balance" value="-">
                            <small class="form-control-feedback">cc</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Diuresis</label>
                            <input type="text" class="form-control" id="monitoring_diuresis" name="monitoring_diuresis" value="-">
                            <small class="form-control-feedback">cc/KgBb/Jam</small>
                        </div>
                    </div>
                    <hr class="hr12">
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>Kontraksi Uterus</label>
                            <input type="text" class="form-control" id="monitoring_kontraksiUterus" name="monitoring_kontraksiUterus" value="-">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Durasi</label>
                            <input type="text" class="form-control" id="monitoring_durasi" name="monitoring_durasi" value="-">
                            <small class="form-control-feedback">detik</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Intensitas</label>
                            <input type="text" class="form-control" id="monitoring_intensitas" name="monitoring_intensitas" value="-">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Periksa Dalam</label>
                            <input type="text" class="form-control" id="monitoring_periksaDalam" name="monitoring_periksaDalam" value="-">
                            <small class="form-control-feedback">cm</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Pengeluaran Pervaginam</label>
                            <input type="text" class="form-control" id="monitoring_pervaginam" name="monitoring_pervaginam" value="-">
                            <small class="form-control-feedback">cc</small>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label>Denyut Jantung Janin</label>
                            <input type="text" class="form-control" id="monitoring_janin" name="monitoring_janin" value="-">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Tinggi Fundus Uteri</label>
                            <input type="text" class="form-control" id="monitoring_tinggiPundusUteri" name="monitoring_tinggiPundusUteri" value="-">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-success btnsimpanmonitoringmonitoring"><i class="fas fa-plus"></i> Simpan</button>
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
        $('.formmonitoring').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanmonitoring').attr('disable', 'disabled');
                    $('.btnsimpanmonitoring').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanmonitoring').removeAttr('disable');
                    $('.btnsimpanmonitoring').html('Simpan');
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

                        // $('#form-filter-atas').css('display', 'none');
                        // $('#form-filter-bawah').css('display', 'block');
                        // $('#journalnumber').val(response.JN);
                        // $('#kode').val(response.JN);
                        // $('#dokter').val(response.dokter);
                        // $('#doktername').val(response.doktername);
                        // $('#documentdate').val(response.tanggalpelayanan);
                        // dataCPPT();
                        datahasilmonitoring();

                    }
                }


            });
            return false;
        });
    });
</script>


<script>
    $('#cariaskep').click(function(e) {
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
    function total3() {
        var eye3 = document.getElementById('monitoring_eye').value;
        var verbal3 = document.getElementById('monitoring_verbal').value;
        var motorik3 = document.getElementById('monitoring_motorik').value;
        //var totalpotongan = ((parseInt(hargaperbox) * jumlahkemasanbox)) * (potongan / 100);
        var nilai_eye3 = parseInt(eye3);
        var nilai_verbal3 = parseInt(verbal3);
        var nilai_motorik3 = parseInt(motorik3);
        var totalGCS3 = nilai_eye3 + nilai_verbal3 + nilai_motorik3;
        document.getElementById('monitoring_gcs').value = totalGCS3;
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
    $('#cariimplementasi').click(function(e) {
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
    $(document).ready(function() {

        $("#monitoring_diagnosa").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_diagnosa'); ?>",
            select: function(event, ui) {
                $('#monitoring_diagnosa').val(ui.item.value);
            }
        });
    });
</script>