<div class="col-lg-12 col-md-12">
    <div class="ribbon-wrapper card">
        <div class="ribbon ribbon-bookmark  ribbon-default">Form Admission</div>

        <from class="form-horizontal form-material" id="form-filter" method="post">
            <div class="form-body">
                <?php
                foreach ($ambulance as $row) :
                ?>
                    <?php
                    $syringepump = $row['syringepump'] == 1 ? 'checked' : '';
                    $ventilatortransport = $row['ventilatortransport'] == 1 ? 'checked' : '';
                    $infusonpump = $row['infusonpump'] == 1 ? 'checked' : '';
                    $monitor = $row['monitor'] == 1 ? 'checked' : '';
                    ?>
                    <div class="row pt-1">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Norm</label>
                                <input type="text" id="pasienid" name="pasienid" class="form-control" value="<?= $row['pasienid']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien</label>
                                <input type="text" id="pasienname" name="pasienname" class="form-control" value="<?= $row['pasienname']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Lahir</label>
                                <input type="text" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $row['pasiendateofbirth']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Alamat</label>
                                <input type="text" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $alamatpasien; ?>" readonly>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Kegiatan</label>
                                <select name="kegiatanAmbulance" id="kegiatanAmbulance" class="select2" style="width: 100%">
                                    <?php foreach ($kegiatanambulance as $keg) : ?>
                                        <option data-id="<?= $keg['id']; ?>" class="select-smf" <?php if ($keg['name'] == $row['kegiatanAmbulance']) { ?> selected="selected" <?php } ?>><?= $keg['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Keberangkatan</label>
                                <input type="text" id="datepicker-autoclose" autocomplete="off" name="datego" class="form-control" value="<?= date('m/d/Y'); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Jam keberangkatan</label>
                                <div class="input-group clockpicker " data-placement="bottom" data-align="top" data-autoclose="true">
                                    <input type="text" name="datetimego" class="form-control" value="13:14">
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
                                <label class="control-label">Diagnosa</label>
                                <input type="text" id="diagnosa" name="diagnosa" class="form-control" value="<?= $row['diagnosa']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kondisi Pasien</label>
                                <input type="text" id="kondisipasien" autocomplete="off" name="kondisipasien" class="form-control" value="<?= $row['kondisipasien']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Kesadaran</label>
                                <input type="text" id="kesadaran" autocomplete="off" name="kesadaran" class="form-control" value="<?= $row['kesadaran']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanda Vital</label>
                                <input type="text" id="tandavital" autocomplete="off" name="tandavital" class="form-control" value="<?= $row['tandavital']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tekanan Darah(mmHg)</label>
                                <input type="text" id="tekanandarah" autocomplete="off" name="tekanandarah" class="form-control" value="<?= $row['tekanandarah']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nadi(x/menit)</label>
                                <input type="text" id="nadi" autocomplete="off" name="nadi" class="form-control" value="<?= $row['nadi']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Respirasi(x/menit)</label>
                                <input type="text" id="respirasi" autocomplete="off" name="respirasi" class="form-control" value="<?= $row['respirasi']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Saturasi O2</label>
                                <input type="text" id="saturasi" autocomplete="off" name="saturasi" class="form-control" value="<?= $row['saturasi']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Ruangan</label>
                                <input type="hidden" id="roomname" autocomplete="off" name="roomname" class="form-control" value="<?= $row['roomname']; ?>">
                                <input type="hidden" id="bednumber" autocomplete="off" name="bednumber" class="form-control" value="<?= $row['bednumber']; ?>">
                                <input type="text" id="ruangan" autocomplete="off" name="ruangan" class="form-control" value="<?= $row['roomname']; ?> | <?= $row['bednumber']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Wilayah</label>
                                <div class="input-group">
                                    <input type="text" id="wilayah" name="wilayah" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Kelurahan</label>
                                <input type="text" id="kelurahan" autocomplete="off" name="kelurahan" class="form-control" value="<?= $row['kelurahan']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">kecamatan</label>
                                <input type="text" id="kecamatan" autocomplete="off" name="kecamatan" class="form-control" value="<?= $row['kecamatan']; ?>">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Kabupaten Kota</label>
                                <input type="text" id="kabupatenkota" autocomplete="off" name="kabupatenkota" class="form-control" value="<?= $row['kabupatenkota']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Propinsi</label>
                                <input type="text" id="propinsi" autocomplete="off" name="propinsi" class="form-control" value="<?= $row['propinsi']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Alamat Tujaun</label>
                            <input type="text" id="alamattujuan" autocomplete="off" name="alamattujuan" class="form-control" value="<?= $row['alamattujuan'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="ribbon-wrapper card">
                                <div class="ribbon ribbon-bookmark  ribbon-warning"><i class="fas fa-notes-medical"></i> Alat dalam Ambulance</div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Syringe Pump </label>
                                            <div class="switch">
                                                <label>Tidak
                                                    <input type="checkbox" <?= $syringepump; ?> value="1" name="syringepump" id="syringepump"><span class="lever"></span>Ya</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Infusion Pump </label>
                                            <div class="switch">
                                                <label>Tidak
                                                    <input type="checkbox" <?= $infusonpump; ?> value="1" name="infusonpump" id="infusonpump"><span class="lever"></span>Ya</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Ventilator Transport</label>
                                            <div class="switch">
                                                <label>Tidak
                                                    <input type="checkbox" <?= $ventilatortransport; ?> value="1" name="ventilatortransport" id="ventilatortransport"><span class="lever"></span>Ya</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Monitor</label>
                                            <div class="switch">
                                                <label>Tidak
                                                    <input type="checkbox" <?= $monitor; ?> value="1" name="monitor" id="monitor"><span class="lever"></span>Ya</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Alat Lain</label>
                                            <textarea id="alatlain" name="alatlain" class="textarea_editor form-control" rows="3" placeholder="Tulis alat lain jika ada ..."><?= $row['alatlain']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Obat-obatan</label>
                                            <textarea id="obat" name="obat" class="textarea_editor form-control" rows="3" placeholder="Tulis obat-obatan jika ada ..."><?= $row['obat']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Mobil</label>
                                            <select name="mobil" id="mobil" class="select2" style="width: 100%">
                                                <option>Pilih Mobil</option>
                                                <?php foreach ($mobil as $mbl) : ?>
                                                    <option data-id="<?= $mbl['id']; ?>" class="select-smf" <?php if ($mbl['platnomor'] == $row['platnomor']) { ?> selected="selected" <?php } ?>><?= $mbl['platnomor']; ?> | <?= $mbl['jenismobil']; ?> | <?= $mbl['fungsi']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <input type="hidden" id="codemobil" name="codemobil" class="form-control" value="<?= $row['code']; ?>" readonly>
                                            <input type="hidden" id="platnomor" name="platnomor" class="form-control" value="<?= $row['platnomor']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Sopir Ambulance</label>
                                            <select name="supirambulance" id="supirambulance" class="select2" style="width: 100%">
                                                <?php foreach ($supir as $s) : ?>
                                                    <option data-id="<?= $s['id']; ?>" class="select-smf" <?php if ($s['supirambulance'] == $row['supirambulance']) { ?> selected="selected" <?php } ?>><?= $s['supirambulance']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Keluarga Pasien</label>
                                            <input type="text" id="namapjb" name="namapjb" class="form-control" value="<?= $row['namapjb']; ?>">
                                            <input type="hidden" id="id_admission" value="<?= $row['id']; ?>" name="id_admission" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Perawat Ruangan</label>
                                            <input type="text" id="perawatruangan" name="perawatruangan" class="form-control" value="<?= $row['perawatruangan']; ?>">
                                            <input type="hidden" id="updatedby" name="updatedby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                            <input type="hidden" id="refrencenumber" name="refrencenumber" class="form-control" value="<?= $row['referencenumber']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button id="button" class="btn btn-info btnvalidasi" type="submit"><i class="mdi mdi-ambulance"></i> Simpan</button>
                                            <button id="print" class="btn btn-success btnprintBP" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
        <?php endforeach; ?>
        </from>
    </div>
</div>

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

        $("#wilayah").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_wilayah'); ?>",
            select: function(event, ui) {
                $('#kecamatan').val(ui.item.kecamatan);
                $('#kelurahan').val(ui.item.kelurahan);
                $('#kabupatenkota').val(ui.item.kabupaten);
                $('#propinsi').val(ui.item.propinsi);
                $('#kodewilayah').val(ui.item.kodewilayah);
                $('#area').val(ui.item.kabupaten);
                $('#namasubarea').val(ui.item.namasubarea);
            }
        });
    });
    $('#mobil').on('change', function() {
        $.ajax({
            'type': "POST",

            'url': "<?php echo base_url('Autocomplete/fill_mobil') ?>",
            'data': {
                key: $('#mobil option:selected').data('id')
            },
            'success': function(response) {
                //mengisi value input nama dan lainnya
                let data = JSON.parse(response);
                $('#platnomor').val(data.platnomor);
                $('#codemobil').val(data.code);
            }
        })
    })
</script>
<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script>
    $(function() {

        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin

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
</script>

<script>
    $(document).ready(function() {
        $('.formvalidasiadmission').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnvalidasi').attr('disable', 'disabled');
                    $('.btnvalidasi').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnvalidasi').removeAttr('disable');
                    $('.btnvalidasi').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.doktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        } else {
                            $('#doktername').removeClass('form-control-danger');
                            $('.errordoktername').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                //dataresume();
                                dataadmission();

                            }

                        });

                    }
                }


            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintBP').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('PelayananABL/printbuktiambulance') ?>?page=" + id, "_blank");

        })
    });
</script>