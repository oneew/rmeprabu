<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<!-- Dropzone css -->
<link href="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />

<div id="modalsuratkematian" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Sertifikat Medis Penyebab Kematian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <?= form_open('PelayananFRS/update_suratkematian', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <?php
                foreach ($forensik as $row) :
                ?>
                    <?php
                    // $dasar_rm = $row['dasar_rm'] == 1 ? 'checked' : '';
                    // $dasar_pemeriksaan_luar = $row['dasar_pemeriksaan_luar'] == 1 ? 'checked' : '';
                    // $dasar_autopsi_forensik = $row['dasar_autopsi_forensik'] == 1 ? 'checked' : '';
                    // $dasar_autopsi_medis = $row['dasar_autopsi_medis'] == 1 ? 'checked' : '';
                    // $dasar_autopsi_verbal = $row['dasar_autopsi_verbal'] == 1 ? 'checked' : '';
                    // $dasar_lain = $row['dasar_lain'] == 1 ? 'checked' : '';
                    // $status_jenazah = $row['status_jenazah'] == 1 ? 'checked' : '';
                    ?>
                    <h6>Data Pasien</h6>
                    <div class="row">
                        <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                            <br>
                            <p class="text-muted"><?= $relation; ?> | <?= $documentdate; ?> | <?= $paymentmethod; ?> </p>
                        </div>
                        <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                            <br>
                            <p class="text-muted"><?= $relationname; ?> | <?= $roomname; ?> | <?= $journalnumber; ?> </p>
                        </div>
                        <div class="col-md-3 col-xs-6 border-right"> <strong>Alamat</strong>
                            <br>
                            <p class="text-muted"><?= $pasienaddress; ?></p>
                        </div>
                        <div class="col-md-3 col-xs-6"> <strong>NIK</strong>
                            <br>
                            <p class="text-muted"><b><?= $nik; ?> (<?= $pasiengender; ?>)</b></p>
                        </div>
                    </div>
                    <hr>

                    <from id="form-filter" method="post">
                        <div class="form-body">

                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tempat Lahir</label>
                                        <input type="text" id="placeofbirth" name="placeofbirth" value="<?= $placeofbirth; ?>" class="form-control">
                                        <input type="hidden" id="referencenumber" name="referencenumber" value="<?= $row['referencenumber']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Lahir</label>
                                        <input type="text" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasiendateofbirth; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Umur</label>
                                        <input type="text" id="umur" name="umur" class="form-control" value="<?= $umur; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Agama</label>
                                        <input type="text" id="agama" name="agama" class="form-control" value="<?= $agama; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Alamat</label>
                                        <input type="text" id="alamat" name="alamat" value="<?= $pasienaddress; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Kelurahan</label>
                                        <input type="text" id="kelurahan" name="kelurahan" value="<?= $kelurahan; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Kecamatan</label>
                                        <input type="text" id="kecamatan" name="kecamatan" value="<?= $kecamatan; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Kabupaten Kota</label>
                                        <input type="text" id="kabupatenkota" name="kabupatenkota" value="<?= $kabupatenkota; ?>" class="form-control">
                                        <input type="hidden" id="propinsi" name="propinsi" value="<?= $propinsi; ?>" class="form-control">
                                        <input type="hidden" id="wna" name="wna" value="<?= $citizenship; ?>" class="form-control">
                                        <input type="hidden" id="nik" name="nik" value="<?= $nik; ?>" class="form-control">
                                        <input type="hidden" id="documentdate" name="documentdate" value="<?= date('Y-m-d'); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="couplename">Hub dngn Kepala Rumah Tangga</label>
                                        <select name="hubungan_dengan_pjb" id="hubungan_dengan_pjb" class="select2" style="width: 100%;">
                                            <?php foreach ($HPJB as $pjb) : ?>
                                                <option value="<?= $pjb['hubunganpjb']; ?>" class="select-inisial"><?= $pjb['hubunganpjb']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php

                                $datemeninggal = $row['datedie'];
                                $datedie = date("m/d/Y", strtotime($datemeninggal));
                                $dateperiksa = $row['date_periksa'];
                                $date_periksa = date("m/d/Y", strtotime($dateperiksa));

                                ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Meninggal</label>
                                        <input type="text" id="datepicker-autoclose" value="<?= $datedie; ?>" autocomplete="off" name="datedie" class="form-control" value="<?= date('m/d/Y'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Jam Meninggal</label>
                                        <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                            <input type="text" name="timedie" class="form-control" value="<?= $row['timedie']; ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="far fa-clock"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tempat Meninggal</label>
                                        <input type="text" id="locationdie" name="locationdie" value="<?= $row['locationdie']; ?>" class="form-control">
                                        <input type="hidden" id="updatedby" name="updatedby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h6>Keterangan Khusus Kematian Di Rumah Atau Lainnya</h6>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Status Jenazah</label>
                                        <div class="switch">
                                            <label>Belum Dimakamkan
                                                <input type="checkbox" <?= $status_jenazah; ?> value="1" name="status_jenazah" id="status_jenazah"><span class="lever"></span>Sudah Dimakamkan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Pemeriksa Jenazah</label>
                                        <select name="dokter_forensik" id="dokter_forensik" class="select2" style="width: 100%">
                                            <option>Pilih Dokter Forensik</option>
                                            <?php foreach ($dokterforensik as $dokter) { ?>
                                                <option data-id="<?= $dokter['id']; ?>" class="select-dokterpoli" <?php if ($dokter['name'] == $row['dokter_forensik']) { ?> selected="selected" <?php } ?>><?= $dokter['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">No Induk</label>
                                        <input type="text" id="nip_dokter_forensik" name="nip_dokter_forensik" class="form-control" value="<?= $row['nip_dokter_forensik']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Waktu Pemeriksaan</label>
                                        <input type="text" id="datepicker-autoclose2" value="<?= $date_periksa; ?>" autocomplete="off" name="date_periksa" class="form-control" value="<?= date('m/d/Y'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Jam</label>
                                        <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                            <input type="text" name="time_periksa" class="form-control" value="<?= $row['time_periksa']; ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="far fa-clock"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <h6>Penyebab Kematian</h6>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Rekam Medis</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $dasar_rm; ?> value="1" name="dasar_rm" id="dasar_rm"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Pemeriksaan Luar Jenazah</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $dasar_pemeriksaan_luar; ?> value="1" name="dasar_pemeriksaan_luar" id="dasar_pemeriksaan_luar"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Autopsi Forensik</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $dasar_autopsi_forensik; ?> value="1" name="dasar_autopsi_forensik" id="dasar_autopsi_forensik"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Autopsi Medis</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $dasar_autopsi_medis; ?> value="1" name="dasar_autopsi_medis" id="dasar_autopsi_medis"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Autopsi verbal</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $dasar_autopsi_verbal; ?> value="1" name="dasar_autopsi_verbal" id="dasar_autopsi_verbal"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Surat Keterangan Lainnya</label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" <?= $dasar_lain; ?> value="1" name="dasar_lain" id="dasar_lain"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="couplename">Penyebab Kematian</label>
                                        <select name="penyebab_kematian" id="penyebab_kematian" class="select2" style="width: 100%;">
                                            <?php foreach ($sebabmati as $sebab) : ?>
                                                <option value="<?= $sebab['name']; ?>" class="select-inisial" <?php if ($sebab['name'] == $row['penyebab_kematian']) { ?> selected="selected" <?php } ?>><?= $sebab['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group has-success">

                                        <label class="control-label">Sign Below: Dokter Forensik</label>
                                        <input type="hidden" id="signature" name="signature" class="form-control tandatangan">
                                        <input type="hidden" id="id" name="id" class="form-control" value="<?= $row['id']; ?>">
                                        <div class="js-signature" data-width="350" data-height="100" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="false"></div>
                                        <p><button id="clearBtn" class="btn btn-default">Clear Canvas</button></p>
                                        <div id="signature">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </from>
                <?php endforeach; ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Simpan</button>
                <button id="print" class="btn btn-success btnprintSK" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>

            </div>
            <?= form_close() ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script src="<?= base_url(); ?>/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.js"></script>
<script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();
        $('.textarea_editor_pakaian').wysihtml5();
        $('.textarea_editor_cirikhusus').wysihtml5();
        $('.textarea_editor_leher').wysihtml5();
        $('.textarea_editor_bahu').wysihtml5();
        $('.textarea_editor_dada').wysihtml5();
        $('.textarea_editor_punggung').wysihtml5();
        $('.textarea_editor_perut').wysihtml5();
        $('.textarea_editor_pinggang').wysihtml5();
        $('.textarea_editor_bokong').wysihtml5();
        $('.textarea_editor_dubur').wysihtml5();
        $('.textarea_editor_alatkelamin').wysihtml5();
        $('.textarea_editor_anggota_gerak_atas').wysihtml5();
        $('.textarea_editor_anggota_gerak_bawah').wysihtml5();
        $('.textarea_editor_kesimpulan').wysihtml5();
        $('.textarea_editor_ringkasan').wysihtml5();


    });
</script>

<script>
    $(document).ready(function() {
        if ($('.js-signature').length) {
            $('.js-signature').jqSignature();
        }

        $('#clearBtn').on('click', function(e) {
            e.preventDefault();
            $('.js-signature').eq(0).jqSignature('clearCanvas');
            $('#saveBtn').attr('disabled', true);
            //alert($('.js-signature').html());
        });

        $('#saveBtn').on('click', function() {
            let save = $('.js-signature').eq(0).jqSignature('getDataURL');
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('Signature/insert_sign') ?>",
                data: {
                    signature: save
                },
                success: function(response) {
                    $('.list-sign').append(response);
                }
            });
            // alert(save);
        });

        $('.js-signature').eq(0).on('jq.signature.changed', function() {
            $('.tandatangan').val($(this).jqSignature('getDataURL'));
            //$('#saveBtn').attr('disabled', false);
        });
    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/dff/dff.js" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url(); ?>/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script>
    $(function() {
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
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
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
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
    $('#dokter_forensik').on('change', function() {
        $.ajax({
            'type': "POST",

            'url': "<?php echo base_url('autocomplete/fill_dokter_forensik') ?>",
            'data': {
                key: $('#dokter_forensik option:selected').data('id')
            },
            'success': function(response) {
                //mengisi value input nama dan lainnya
                let data = JSON.parse(response);
                $('#dokter_forensik').val(data.name);
                $('#nip_dokter_forensik').val(data.nip);

                $('#autocomplete-dokter').html('');
            }
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('.formperawat').submit(function(e) {
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
                        if (response.error.ibsdoktername) {
                            $('#ibsdoktername').addClass('form-control-danger');
                            $('.erroribsdoktername').html(response.error.ibsdoktername);
                        } else {
                            $('#ibsdoktername').removeClass('form-control-danger');
                            $('.erroribsdoktername').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modalsuratkematian').modal('hide');
                                dataresume();
                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>

<script>
    // MAterial Date picker
    $('#mdate').bootstrapMaterialDatePicker({
        weekStart: 0,
        time: false
    });
    $('#timepicker').bootstrapMaterialDatePicker({
        format: 'HH:mm',
        time: true,
        date: false
    });
    $('#date-format').bootstrapMaterialDatePicker({
        format: 'dddd DD MMMM YYYY - HH:mm'
    });

    $('#min-date').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm',
        minDate: new Date()
    });
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-autoclose2').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {


            days: 6
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintSK').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('PelayananFRS/printbuktisuratkematian') ?>?page=" + id, "_blank");

        })
    });
</script>