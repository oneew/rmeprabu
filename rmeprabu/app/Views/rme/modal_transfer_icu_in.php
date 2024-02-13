<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    .hr37 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr37:after {
        background: #fff;
        content: 'INDIKASI MASUK ICU PRIORITAS';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr38 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr38:after {
        background: #fff;
        content: '&&';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr18 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr18:after {
        background: #fff;
        content: 'Hasil Pemeriksaan Penunjang & Prosedur Yang Dilakukan';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr19 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr19:after {
        background: #fff;
        content: 'Terapi Obat Yang Diberikan';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr20 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr20:after {
        background: #fff;
        content: 'Kondisi Pasien Saat Pindah';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr21 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr21:after {
        background: #fff;
        content: 'Asesmen Resiko';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr22 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr22:after {
        background: #fff;
        content: 'Penggunaan Alat';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr23 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr23:after {
        background: #fff;
        content: '$$';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr24 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr24:after {
        background: #fff;
        content: 'Kondisi Pasien Saat Tiba Di Ruangan Tujuan';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .hr25 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr25:after {
        background: #fff;
        content: 'Petugas';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>

<div id="modal_transfer_icu_in" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Dokumen Transfer/Masuk Ke ICU</h4>
            </div>
            <?= form_open('PelayananRawatJalanRME/simpanTransferIcuIn', ['class' => 'formtransfericu']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Tanggal Jam IGD</label>
                                <input type="text" class="form-control" id="transfer_admissionDateTime_transfer_icu" name="transfer_admissionDateTime_transfer_icu" required value="<?= $admissionDateTime; ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Tanggal Jam Pindah</label>
                                <input type="text" class="form-control" id="transfer_pindahDateTime_transfer_icu" name="transfer_pindahDateTime_transfer_icu" required value="<?= date('d-m-Y G:i:s'); ?>">
                                <input type="hidden" class="form-control" id="transfer_paramedicName_transfer_icu" name="transfer_paramedicName_transfer_icu" required value="<?= session()->get('firstname'); ?>">
                                <input type="hidden" class="form-control" id="transfer_createdBy_transfer_icu" name="transfer_createdBy_transfer_icu" required value="<?= session()->get('firstname'); ?>">
                                <input type="hidden" class="form-control" id="transfer_createddate_transfer_icu" name="transfer_createddate_transfer_icu" required value="<?= date('Y-m-d G:i:s'); ?>">

                                <input type="hidden" class="form-control" id="transfer_nomorreferensi_transfer_icu" name="transfer_nomorreferensi_transfer_icu" required value="<?= $nomorreferensi; ?>">
                                <input type="hidden" class="form-control" id="transfer_poliklinikname_transfer_icu" name="transfer_poliklinikname_transfer_icu" required value="<?= $poliklinikname; ?>">
                                <input type="hidden" class="form-control" id="transfer_pasienid_transfer_icu" name="transfer_pasienid_transfer_icu" required value="<?= $pasienid; ?>">
                                <input type="hidden" class="form-control" id="transfer_pasienname_transfer_icu" name="transfer_pasienname_transfer_icu" required value="<?= $pasienname; ?>">
                                <input type="hidden" class="form-control" id="transfer_paymentmethodname_transfer_icu" name="transfer_paymentmethodname_transfer_icu" required value="<?= $paymentmethodname; ?>">
                                <input type="hidden" class="form-control" id="transfer_admissionDate_transfer_icu" name="transfer_admissionDate_transfer_icu" required value="<?= $admissionDate; ?>">
                                <input type="hidden" class="form-control" id="transfer_doktername_transfer_icu" name="transfer_doktername_transfer_icu" required value="<?= $doktername; ?>">
                                <input type="hidden" class="form-control" id="transfer_admissionDate_transfer_icu" name="transfer_admissionDate_transfer_icu" required value="<?= $admissionDate; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Diagnosis</label>
                                <input type="text" class="form-control" id="transfer_diagnosis_transfer_icu" name="transfer_diagnosis_transfer_icu" required value="<?= $diagnosis; ?>">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Riwayat singkat dan hasil pemeriksaan yang mendukung</label>
                                <textarea id="mymce2" name="riwayatSingkat_transfer_icu" class="form-control" rows="4"><?= $riwayatPenyakitSekarang; ?></textarea>
                            </div>
                        </div>
                        <hr class="hr37">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="col-md-12 mb-3">
                                    <label></label>
                                    <div class="switch">
                                        <label class="d-flex flex-column flex-sm-row">
                                            Kondisi sakit kritis, GCS kurang dari sama dengan 8, Hemodinamik tidak stabil, Memerlukan alat ventilasi, Penurunan kesadaran, Gangguan elektrolit berat, Syok, Septik, Gagal Nafas, Syok Hipovolemik, DSS dll.<input name="kondisi1" id="kondisi1" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>DPJP</label>
                                    <input type="text" class="form-control" id="doktername_transfer_icu" name="doktername_transfer_icu" required value="<?= $doktername; ?>" readonly>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Perawat</label>
                                    <input type="text" class="form-control" id="paramedicName_transfer_icu" name="paramedicName_transfer_icu" required value="<?= session()->get('firstname'); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="col-md-12 mb-3">
                                    <label></label>
                                    <div class="switch">
                                        <label class="d-flex flex-column flex-sm-row">
                                            Perlu pemantauan ICU, DHF Grade III, Penyakit jantung yang perlu pengawasan intensif, Penyakit paru yang berat. Gagal Ginjal Akut. Operasi dengan komplikasi perdarahan.<input name="kondisi2" id="kondisi2" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="col-md-12 mb-3">
                                    <label></label>
                                    <div class="switch">
                                        <label class="d-flex flex-column flex-sm-row">
                                            Penyakit Primer yang berat/terminal. Komplikasi penyakit akut, Kritikal yang memerlukan pertolongan penyakit akutnya. Tidak Memerlukan Instubasi dan RJR<input name="kondisi3" id="kondisi3" value="1" type="checkbox"><span class="lever switch-col-blue"></span></label>
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3 text-left">
                                <button type="submit" class="btn btn-success btnsimpanTransferICU"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>

                    </div>


                </form>

            </div>
            <?= form_close() ?>

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


<script>
    $(document).ready(function() {
        $('.formtransfericu').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanTransferICU').attr('disable', 'disabled');
                    $('.btnsimpanTransferICU').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanTransferICU').removeAttr('disable');
                    $('.btnsimpanTransferICU').html('Simpan');
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
                        // dataTriage();

                    }
                }


            });
            return false;
        });
    });
</script>