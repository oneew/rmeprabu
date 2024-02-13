<link rel="stylesheet" href="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.css'); ?>" />
<div class="col-lg-12 col-md-12 px-0">
    <div class="modal-body px-0">
        <div class="form-body">
            <form action="<?= base_url('PelayananRawatJalanRME/simpanAsesmenPerawat'); ?>" method="POST" class="formasesmen">
                <?= csrf_field(); ?>
                <div class="form-row">
                    <div class="col-md-2 mb-3">
                        <label>BB</label>
                        <input type="text" class="form-control" id="bb" name="bb" required>
                        <small class="form-control-feedback">Kg</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>TB</label>
                        <input type="text" class="form-control" id="tb" name="tb" required>
                        <small class="form-control-feedback">Cm</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Frekuensi Nadi</label>
                        <input type="text" class="form-control" id="frekuensiNadi" name="frekuensiNadi" required>
                        <small class="form-control-feedback">x/menit</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>TD Sistolik</label>
                        <input type="text" class="form-control" id="tdSistolik" name="tdSistolik" required>
                        <small class="form-control-feedback">mmHg</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>TD Diastolik</label>
                        <input type="text" class="form-control" id="tdDiastolik" name="tdDiastolik" required>
                        <small class="form-control-feedback">mmHg</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Suhu</label>
                        <input type="text" class="form-control" id="suhu" name="suhu" required>
                        <small class="form-control-feedback">oC</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Frekuensi Nafas</label>
                        <input type="text" class="form-control" id="frekuensiNafas" name="frekuensiNafas" required>
                        <small class="form-control-feedback">x/menit</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Skala Nyeri</label>
                        <select name="skalaNyeri" id="skalaNyeri" class="select2" style="width: 100%">
                            <?php foreach ($skala_nyeri as $skala) : ?>
                                <option value="<?php echo $skala['code']; ?>"><?php echo $skala['name']; ?> [<?php echo $skala['code']; ?> ]</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Psikologis</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Tidak Ada kelainan
                                <input name="psikologisTak" id="psikologisTak" value="1" type="checkbox">
                                <span class="lever switch-col-blue"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Psikologis</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Takut<input name="psikologisTakut" id="psikologisTakut" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Psikologis</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Sedih<input name="psikologisSedih" id="psikologisSedih" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Psikologis</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Rendah Diri<input name="psikologisRendahDiri" id="psikologisRendahDiri" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Psikologis</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Marah<input name="psikologisMarah" id="psikologisMarah" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Psikologis</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Mudah Tersinggung<input name="psikologisMudahTersinggung" id="psikologisMudahTersinggung" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Sosiologis</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Tidak Ada Kelainan<input name="sosiologisTak" id="sosiologisTak" value="1" type="checkbox"><span class="lever switch-col-orange"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Sosiologis</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Isolasi Sosial<input name="sosiologisIsolasi" id="sosiologisIsolasi" value="1" type="checkbox"><span class="lever switch-col-orange"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Sosiologis</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Lain<input name="sosiologisLain" id="sosiologisLain" value="1" type="checkbox"><span class="lever switch-col-orange"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Spiritual</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Tidak Ada Kelainan<input name="spiritualTak" id="spiritualTak" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Spiritual</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Perlu Dibantu Ibadah<input name="spiritualPerluDibantu" id="spiritualPerluDibantu" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Spiritual</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Agama<input name="spiritualAgama" id="spiritualAgama" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Alergi</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                <input name="isialergi" id="isialergi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Uraian Alergi</label>
                        <input type="text" class="form-control" id="uraianAlergi" name="uraianAlergi" disabled>
                        <input type="hidden" class="form-control" id="alergi" name="alergi">
                        <small class="form-control-feedback">Ditulis Jika Ada Alergi</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Nutrisi</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Penurunan berat badan tanpa direncanakan<input name="nutrisiTurunBb" id="nutrisiTurunBb" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Nutrisi</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Tampak Kurus<input name="nutrisiKurus" id="nutrisiKurus" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                        <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nutrisi</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Nafsu makan berkurang atau anak muntah > 3 kali atau diare > 5 kali<input name="nutrisiMuntahDiare" id="nutrisiMuntahDiare" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Nutrisi</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Kondisi Khusus Pasien ?<input name="isinutrisiKondisiKhusus" id="isinutrisiKondisiKhusus" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Uraian Kondisi Khusus</label>
                        <input type="text" class="form-control" id="uraianKondisiKhusus" name="uraianKondisiKhusus" disabled>
                        <input type="hidden" class="form-control" id="nutrisiKondisiKhusus" name="nutrisiKondisiKhusus">
                        <small class="form-control-feedback">Ditulis Jika Kondisi Khusus</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Nutrisi</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Dirujuk Ke Ahli Gizi<input name="rujukAhliGizi" id="rujukAhliGizi" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Fungsional</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Perlu Alat Bantu<input name="isifungsionalAlatBantu" id="isifungsionalAlatBantu" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Uraian Alat Bantu</label>
                        <input type="text" class="form-control" id="fungsionalNamaAlatBantu" name="fungsionalNamaAlatBantu" disabled>
                        <input type="hidden" class="form-control" id="fungsionalAlatBantu" name="fungsionalAlatBantu">
                        <small class="form-control-feedback">Ditulis Jika Perlu ALat Bantu</small>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Fungsional</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Prothesis<input name="fungsionalProthesis" id="fungsionalProthesis" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Fungsional</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Cacat Tubuh<input name="fungsionalCacatTubuh" id="fungsionalCacatTubuh" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>ADL</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Dibantu ?<input name="fungsionalAdl" id="fungsionalAdl" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="paramedicName" name="paramedicName" required value="<?= session()->get('firstname'); ?>">
                    <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                    <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                    <div class="col-md-3 mb-3">
                        <label>Riwayat Jatuh</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Riwayat Jatuh Dalam 3 Bulan terkahir<input name="fungsionalRiwayatJatuh" id="fungsionalRiwayatJatuh" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Cara Berjalan</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Sempoyongan ?<input name="caraBerjalan" id="caraBerjalan" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Posisi Duduk</label>
                        <div class="switch">
                            <label class="d-flex flex-column flex-sm-row">
                                Menopang Saat Duduk ?<input name="dudukMenopang" id="dudukMenopang" value="1" type="checkbox"><span class="lever switch-col-red"></span></label>
                        </div>
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
                    <div class="col-md-2 mb-3">
                        <label>Kesadaran</label>
                        <select name="kesadaran" id="kesadaran" class="select2" style="width: 100%">
                            <?php foreach ($kesadaran as $kes) : ?>
                                <option value="<?php echo $kes['name']; ?>"><?php echo $kes['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" class="form-control" id="nomorreferensi" name="nomorreferensi" required value="<?= $nomorreferensi; ?>">
                    <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $poliklinikname; ?>">
                    <input type="hidden" class="form-control" id="pasienid" name="pasienid" required value="<?= $pasienid; ?>">
                    <input type="hidden" class="form-control" id="pasienname" name="pasienname" required value="<?= $pasienname; ?>">
                    <input type="hidden" class="form-control" id="paymentmethodname" name="paymentmethodname" required value="<?= $paymentmethodname; ?>">
                    <input type="hidden" class="form-control" id="admissionDate" name="admissionDate" required value="<?= $admissionDate; ?>">
                    <input type="hidden" class="form-control" id="doktername" name="doktername" required value="<?= $doktername; ?>">

                    <div class="col-md-4 mb-3">
                        <label> <strong>Keluhan Utama</strong></label>
                        <input type="text" class="form-control" id="keluhanUtama" name="keluhanUtama" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label><strong>Diagnosa Kebidanan</strong></label>
                        <input type="text" class="form-control" id="Diagnosakebidanan" name="Diagnosakebidanan" value="-" required>
                        <small class="form-control-feedback text-danger">Jika Pasien Kebidanan</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Diagnosa Keperawatan</label>
                        <div class="input-group">
                            <select name="DiagnosaAskep" id="DiagnosaAskep" class="select2" style="width: 100%">
                                <?php foreach ($diagnosa_perawat as $diagnosa) : ?>
                                    <option value="<?php echo $diagnosa['diagnosa']; ?>"><?php echo $diagnosa['diagnosa']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-8 mb-3">
                        <div class="input-group-append">
                            <button class="btn btn-info" id="cariaskep1" type="button"><i class="fas fa-search"></i> Lihat Rencana Keperawatan</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Rencana Keperawatan</label>
                        <textarea id="mymce2" name="uraianAskep" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Sasaran Rencana Asuhan</label>
                        <textarea id="mymce3" name="sasaranRencana" class="form-control" rows="2"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <button type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Simpan</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
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
                    if (response.error) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal',
                            text: response.error,
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
    $('#cariaskep1').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariAskep1'); ?>",

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