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

<div id="modal_edukasi_pra_bedah" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Formulir Persetujuan Tindakan Kedokteran</h4>
            </div>
            <?= form_open('PelayananRawatJalanRME/simpanEdukasiPraBedah', ['class' => 'formtransferedukasibedah']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Diagnosis</label>
                                <input type="text" class="form-control" id="diagnosis_edukasi" name="diagnosis_edukasi" required value="<?= $diagnosis; ?>">
                                <input type="hidden" class="form-control" id="paramedicName_edukasi" name="paramedicName_edukasi" required value="<?= session()->get('firstname'); ?>">
                                <input type="hidden" class="form-control" id="createdBy_edukasi" name="createdBy_edukasi" required value="<?= session()->get('firstname'); ?>">
                                <input type="hidden" class="form-control" id="createddate_edukasi" name="createddate_edukasi" required value="<?= date('Y-m-d G:i:s'); ?>">
                                <input type="hidden" class="form-control" id="nomorreferensi_edukasi" name="nomorreferensi_edukasi" required value="<?= $nomorreferensi; ?>">
                                <input type="hidden" class="form-control" id="poliklinikname_edukasi" name="poliklinikname_edukasi" required value="<?= $poliklinikname; ?>">
                                <input type="hidden" class="form-control" id="pasienid_edukasi" name="pasienid_edukasi" required value="<?= $pasienid; ?>">
                                <input type="hidden" class="form-control" id="pasienname_edukasi" name="pasienname_edukasi" required value="<?= $pasienname; ?>">
                                <input type="hidden" class="form-control" id="paymentmethodname_edukasi" name="paymentmethodname_edukasi" required value="<?= $paymentmethodname; ?>">
                                <input type="hidden" class="form-control" id="admissionDate_edukasi" name="admissionDate_edukasi" required value="<?= $admissionDate; ?>">
                                <input type="hidden" class="form-control" id="doktername_edukasi" name="doktername_edukasi" required value="<?= $doktername; ?>">
                                <input type="hidden" class="form-control" id="admissionDate_edukasi" name="admissionDate_edukasi" required value="<?= $admissionDate; ?>">
                                <input type="hidden" class="form-control" id="groups" name="groups" required value="<?= $groups; ?>">
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Dokter Pelaksana Tindakan</label>
                                    <input type="text" id="dokterOperator" name="dokterOperator" class="form-control" value="<?= $doktername; ?>">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <label class="control-label">Pemberi Informasi</label>
                                    <input type="text" id="pemberInformasi" name="pemberInformasi" value="<?= $doktername; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <label class="control-label">Penerima Infromasi</label>
                                    <input type="text" id="penerimaInformasi" name="penerimaInformasi" class="form-control">
                                </div>

                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <button class="button-mic"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label class="control-label">Kondisi Pasien</label>
                                    <textarea id="kondisiPasien" name="kondisiPasien" class="textarea_editor form-control" rows="3"></textarea>

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <button class="button-name"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label class="control-label">Tindakan Kedokteran Yang Diusulkan</label>
                                    <textarea id="tindakan" name="tindakan" class="textarea_editor form-control" rows="3"></textarea>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <button class="button-manfaattindakan"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label class="control-label">Manfaat Tindakan</label>
                                    <textarea id="manfaatTindakan" name="manfaatTindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <button class="button-tatacara"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label class="control-label">Tata cara Uraian singkat prosedur</label>
                                    <textarea id="uraianProsedur" name="uraianProsedur" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <button class="button-risikotindakan"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label class="control-label">Risiko Tindakan</label>
                                    <textarea id="risikoTindakan" name="risikoTindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <button class="button-komplikasitindakan"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label class="control-label">Komplikasi Tindakan</label>
                                    <textarea id="komplikasiTindakan" name="komplikasiTindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <button class="button-dampaktindakan"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label class="control-label">Dampak Tindakan</label>
                                    <textarea id="dampakTindakan" name="dampakTindakan" class="textarea_editor form-control" rows="3" placeholder="Enter text ..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <button class="button-prognosistindakan"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label class="control-label">Prognosis Tindakan</label>
                                    <textarea id="prognosisTindakan" name="prognosisTindakan" class="textarea_editor form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <button class="button-alternatif"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label class="control-label">Kemungkinan Alternatif Tindakan</label>
                                    <textarea id="alternatifTindakan" name="alternatifTindakan" class="textarea_editor form-control" rows="3" placeholder="enter text.."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group has-success">
                                    <button class="button-bilatidakditindak"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                                    <label class="control-label">Kemungkinan hasil bila tidak dilakukan tindakan</label>
                                    <textarea id="bilaTidakDitindak" name="bilaTidakDitindak" class="textarea_editor form-control" rows="3" placeholder="enter text.."></textarea>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3 text-left">
                                <button type="submit" class="btn btn-success btnsimpanEdukasiBedah"><i class="fas fa-save"></i> Simpan</button>
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
        $('.formtransferedukasibedah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanEdukasiBedah').attr('disable', 'disabled');
                    $('.btnsimpanEdukasiBedah').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanEdukasiBedah').removeAttr('disable');
                    $('.btnsimpanEdukasiBedah').html('Simpan');
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