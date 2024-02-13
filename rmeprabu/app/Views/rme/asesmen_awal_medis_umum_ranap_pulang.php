<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<style>
    .remove-btn::-webkit-file-upload-button {
        visibility: hidden;
    }

    /* hidden arrow in input number */
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
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
        content: 'Kodifikasi Diagnosa & Tatalaksana Terapi Pulang';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    textarea {
        border: none;
        padding: 10px;
        margin: 0;
        box-sizing: border-box;
        resize: none;
    }

    /* Container styles */
    .textarea-container {
        width: 80%;
        margin: 0 auto;
    }

    /* Justify the text within the textarea */
    #justified-textarea {
        text-align: justify;
        white-space: normal;
    }
</style>


<style type="text/css">
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
        content: 'Subjektif';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>


<style type="text/css">
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
        content: 'Objektif';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>


<style type="text/css">
    .hr4 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr4:after {
        background: #fff;
        content: 'Asesmen';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>



<style type="text/css">
    .hr5 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr5:after {
        background: #fff;
        content: 'Perencanaan';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>


<style type="text/css">
    .hr6 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr6:after {
        background: #fff;
        content: 'Permasalahan Keperawatan';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>


<style type="text/css">
    .hr7 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr7:after {
        background: #fff;
        content: 'Riwayat Penggunaan Obat';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 20px;
    }
</style>


<style type="text/css">
    .hr8 {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    .hr8:after {
        background: #fff;
        content: 'Rencana Asuhan dan Terapi';
        padding: 0 4px;
        position: relative;
        top: -13px;
        font-size: 15px;
    }
</style>



<?= form_open('PelayananRawatJalanRME/simpanAsesmenMedisRanapPulang', ['class' => 'formasesmenmedis']); ?>
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
                        <input type="text" class="form-control" id="pasienage" name="pasienage" value="<?= $umur; ?>"readonly>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Diagnosis</label>
                        <input type="text" class="form-control" id="diagnosisMasuk" name="diagnosisMasuk">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label>Ruang Rawat Terakhir</label>
                        <input type="text" class="form-control" id="lastRoom" name="lastRoom" required value="<?= $lastRoomName; ?>"readonly>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label>Tanggal Masuk</label>
                        <input type="text" class="form-control" id="dateIn" name="dateIn" required value="<?= $tanggalMasuk; ?>" readonly>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label>Tanggal Pulang</label>
                        <input type="text" class="form-control" id="dateOut" name="dateOut" required value="<?= $tanggalPulang; ?>">
                    </div>
                    <div class="col-md-2 mb-2">
                        <label>P. Jawab Jaminan </label>
                        <input type="text" class="form-control" id="namaPjb" name="namaPjb" value="<?= $namaPjb; ?>">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Alasan Dirawat di Rumah Sakit</label>
                        <textarea id="alasanRawat" name="alasanRawat" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Ringkasan Riway Penyakit</label>
                        <textarea id="ringkasanRiwayatPenyakit" name="ringkasanRiwayatPenyakit" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Hasil Pemeriksaan Fisik</label>
                        <textarea id="hasilPemeriksaanFisik" name="hasilPemeriksaanFisik" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Pemeriksaan Penunjang/Diagnostik</label>
                        <textarea id="pemeriksaanPenunjang" name="pemeriksaanPenunjang" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Terapi/Pengobatan Selama di Rumah Sakit</label>
                        <textarea id="terapiSelamaRawat" name="terapiSelamaRawat" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Perkembangan Setelah Perawatan</label>
                        <textarea id="perkembanganSetelahPerawatan" name="perkembanganSetelahPerawatan" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Alergi(Reaksi Obat)</label>
                        <textarea id="alergiObat" name="alergiObat" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Kondisi Waktu Keluar</label>
                        <textarea id="kondisiWaktuKeluar" name="kondisiWaktuKeluar" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Pengobatan Dilanjutkan</label>
                        <textarea id="pengobatanDilanjutkan" name="pengobatanDilanjutkan" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Tanggal Kontrol Poli</label>
                        <input type="text" class="form-control" id="datepicker-autoclose" name="tanggalKontrol">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Diagnosis Utama (ICD 10)</label>
                        <textarea id="diagnosisUtama" name="diagnosisUtama" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Diagnosis Sekunder (ICD 10)</label>
                        <textarea id="diagnosisSekunder" name="diagnosisSekunder" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Tindakan/Prosedur (ICD 9)</label>
                        <textarea id="prosedur" name="prosedur" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Simpan</button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-2 mb-1">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle mb-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tata Laksana
                            </button>
                            <div class="dropdown-menu animated flipInY">
                                <a class="dropdown-item" href="#" onclick="RiwayatResep('<?= $pasienid ?>')">Riwayat Resep</a>
                                <a class="dropdown-item" href="#" onclick="eResep('<?= $nomorreferensi ?>')">Terapi Pulang</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-1">
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-warning">
                                Kodifikasi Diagnosa
                            </button>
                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only"></span>
                            </button>
                            <div class="dropdown-menu">
                                <!-- Dropdown menu links -->
                                <a class="dropdown-item" href="#" onclick="codingDiagnosa('<?= $nomorreferensi ?>')">Catat Diagnosa</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>


<script src="<?= base_url('assets/plugins/audio-js/app.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/audio-js/recorder.js'); ?>"></script>


<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

<script>
    $(function() {

        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
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




<script>
    $('#caridiagnosa').click(function(e) {
        e.preventDefault();
        let referencenumber = $('#nomorreferensi').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariTemplateRMERanap'); ?>",

            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalpilihtemplaterme').modal('show');

                }
            }

        })


    })
</script>

<script>
    function pesanRAD(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderRADRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalorderRADrme_rajal').modal('show');
                }
            }
        });
    }

    function pesanLPK(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderLPKRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalorderLPKrme_rajal').modal('show');
                }
            }
        });
    }

    function pesanLPA(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderLPARajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalorderLPArme_rajal').modal('show');
                }
            }
        });
    }

    function pesanRHM(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderRHMRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalorderRHMrme_rajal').modal('show');
                }
            }
        });
    }

    function resumeOrder(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeOrderPenunjangRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalresumeorder_rajal').modal('show');
                }
            }
        });
    }

    function TNORajal(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/orderTNOIGD'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalinputTNOigd_rme').modal('show');
                }
            }
        });
    }

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
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalinputereseppulang_rme').modal('show');
                }
            }
        });
    }

    function codingDiagnosa(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/KodifikasiDiagnosaIGD'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalinputDiagnosa_rme').modal('show');
                }
            }
        });
    }
</script>

<script>
    function RiwayatResep(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/riwayatPelayananResep'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalriwayatpelayananresep').modal('show');
                }
            }
        });
    }
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
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalpilihaskep').modal('show');

                }
            }
        })
    })
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
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalpilihaskep_implementasi').modal('show');

                }
            }
        })
    })
</script>
<script>
    $('#kondisiPasien').on('change', function() {
        $.ajax({
            'type': "POST",
            'url': "<?php echo base_url('PelayananRawatJalanRME/fill_ats') ?>",
            'data': {
                key: $('#kondisiPasien option:selected').data('id')
            },
            'success': function(response) {
                let data = JSON.parse(response);
                $('#kondisiPasien').val(data.id);
                $('#ats').val(data.nilai);

            }
        })
    })
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

        $('.formasesmenmedis').submit(function(e) {
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


                    }
                }


            });
            return false;
        });
    });
</script>