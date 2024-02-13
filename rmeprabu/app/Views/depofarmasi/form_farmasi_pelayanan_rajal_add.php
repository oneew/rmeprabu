<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="button-group">
        <div class="card">
            <div class="card-body">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu Pintas
                    </button>
                    <div class="dropdown-menu animated flipInX">
                        <a class="dropdown-item" href="<?= base_url(); ?>/FarmasiPelayananRajal">Input Pelayanan Farmasi Rawat Jalan</a>
                        <a class="dropdown-item" href="<?= base_url(); ?>/FarmasiPelayananRajal/DFPR">Data Pelayanan Farmasi Rawat Jalan</a>
                        <a class="dropdown-item" href="<?= base_url(); ?>/MasterObat/">Data Obat</a>
                        <a class="dropdown-item" href="#">Data Supplier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="form-filter-bawah">
        <div class="ribbon-wrapper card">
            <div class="ribbon ribbon-bookmark  ribbon-warning">Input Detail Obat</div>
            <?= form_open('FarmasiPelayananRajal/simpandataresep_detail', ['class' => 'formterimapbf_detail']); ?>
            <?= csrf_field(); ?>
            <from id="form-filter-deetail" method="post">
                <div class="form-body">
                    <div class="row pt-1">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Norm</label>

                                <input type="hidden" id="journalnumber" autocomplete="off" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                                <input type="text" id="relation" autocomplete="off" name="relation" class="form-control" readonly value="<?= $pasienid; ?>">
                                <input type="hidden" id="referencenumber_detail" autocomplete="off" name="referencenumber_detail" class="form-control" readonly>
                                <input type="hidden" id="documentdate_detail" autocomplete="off" name="documentdate_detail" class="form-control" readonly value="<?= $documentdate; ?>">
                                <input type="hidden" id="createddate_detail" autocomplete="off" name="createddate_detail" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                                <input type="hidden" id="createdby_detail" name="createdby_detail" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                <input type="hidden" id="karyawan_detail" autocomplete="off" name="karyawan_detail" class="form-control" value="<?= $karyawan; ?>">
                                <input type="hidden" id="dispensasi_detail" autocomplete="off" name="dispensasi_detail" class="form-control" value="<?= $dispensasi; ?>">
                                <input type="hidden" id="poliklinikclass_detail" name="poliklinikclass_detail" class="form-control" readonly value="<?= $poliklinikclass; ?>">
                                <input type="hidden" id="employee_detail" name="employee_detail" class="form-control" readonly value="<?= $employee; ?>">
                                <input type="hidden" id="employeename_detail" name="employeename_detail" class="form-control" readonly value="<?= $employeename; ?>">
                                <input type="hidden" id="locationcode_detail" name="locationcode_detail" class="form-control" value="DEPORAJAL" readonly>
                                <input type="hidden" id="locationname_detail" name="locationname_detail" class="form-control" value="DEPO RAWAT JALAN" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien</label>
                                <input type="text" id="relationname" autocomplete="off" name="relationname" class="form-control" readonly value="<?= $pasienname; ?>">
                                <input type="hidden" id="dokter_detail" name="dokter_detail" class="form-control" readonly value="<?= $namadokter; ?>">
                                <input type="hidden" id="doktername_detail" name="doktername_detail" class="form-control" readonly value="<?= $doktername; ?>">
                                <input type="hidden" id="poliklinikname_detail" autocomplete="off" name="poliklinikname_detail" class="form-control" readonly value="<?= $poliklinikname; ?>">
                                <input type="hidden" id="poliklinik_detail" autocomplete="off" name="poliklinik_detail" class="form-control" readonly value="<?= $poliklinik; ?>">
                                <input type="hidden" id="paymentmethodname_detail" autocomplete="off" name="paymentmethodname_detail" class="form-control" readonly value="<?= $paymentmethodname; ?>">
                                <input type="hidden" id="paymentmethod_detail" autocomplete="off" name="paymentmethod_detail" class="form-control" readonly value="<?= $paymentmethod; ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Keterangan</label>
                            <select name="racikan" id="racikan" class="select2" style="width: 100%">
                                <?php foreach ($racikan as $SP) : ?>
                                    <option data-id="<?= $SP['id']; ?>" data-name="<?= $SP['name']; ?>" class="select-statuspulang"><?= $SP['name']; ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Racikan Ke</label>
                            <select name="koderacikan" id="koderacikan" class="select2" style="width: 100%">
                                <?php foreach ($itemracikan as $APS) : ?>

                                    <option data-id="<?= $APS['id']; ?>" data-room="<?= $APS['name']; ?>" class="select-koderacikan"><?= $APS['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Jml Racikan</label>
                                <input type="number" id="jumlahracikan" autocomplete="off" name="jumlahracikan" class="form-control" value="0">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Kode Obat</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="code" name="code" readonly required>
                                    <div class="input-group-append">
                                        <button class="btn btn-info btncode" id="btn-card" type="button">Cari!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-1">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Nama Obat</label>
                                <input type="text" id="name" autocomplete="off" name="name" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Komposisi</label>
                                <input type="text" id="composition" autocomplete="off" name="composisition" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Satuan</label>
                                <input type="text" id="uom" autocomplete="off" name="uom" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Nomor Batch</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="batchnumber" name="batchnumber" readonly required>
                                    <div class="input-group-append">
                                        <button class="btn btn-info btnbatchnumber" id="btn-batchnumber" type="button">Cari!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">ExpDate</label>
                                <input type="text" id="expireddate" autocomplete="off" name="expireddate" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">PosisiStok</label>
                                <input type="text" id="qtystock" autocomplete="off" name="qtystock" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-1">
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Aturan Signa</label>
                                <input type="text" id="signa1" autocomplete="off" name="signa1" class="form-control" value="1">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <label class="control-label">x</label>
                            <div class="form-group">
                                <input type="text" id="signa2" autocomplete="off" name="signa2" class="form-control" value="1">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Resep Dokter</label>
                                <input type="text" id="qtyresep" autocomplete="off" name="qtyresep" class="form-control" value="1">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Dilayani</label>
                                <input type="text" id="qty" autocomplete="off" name="qty" class="form-control" value="1">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">INA-CBG</label>
                                <input type="text" id="qtypaket" autocomplete="off" name="qtypaket" class="form-control" value="0">
                                <small class="form-control-feedback text-danger">*Paket CBG</small>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Kronis</label>
                                <input type="text" id="qtyluarpaket" autocomplete="off" name="qtyluarpaket" class="form-control" value="0">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Tanggal Obat Habis</label>
                                <input type="date" id="emptydate" autocomplete="off" name="emptydate" class="form-control" value="<?= date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Harga Satuan</label>
                                <input type="text" id="price" autocomplete="off" name="price" class="form-control" style="text-align: right;" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Aturan Pakai</label>
                                <select name="aturanpakai" id="aturanpakai" class="select2" style="width: 100%">
                                    <option value="-">-</option>
                                    <?php foreach ($aturanpakai as $ap) : ?>
                                        <option value="<?= $ap['name']; ?>"><?= $ap['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Cara Pakai</label>
                                <select name="carapakai" id="carapakai" class="select2" style="width: 100%">
                                    <option value="-">-</option>
                                    <?php foreach ($carapakai as $cara) : ?>
                                        <option value="<?= $cara['name']; ?>"><?= $cara['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Petunjuk</label>
                                <select name="carapetunjuk" id="carapetunjuk" class="select2" style="width: 100%">
                                    <option value="-">-</option>
                                    <?php foreach ($carapetunjuk as $capet) : ?>
                                        <option value="<?= $capet['name']; ?>"><?= $capet['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button id="button" class="btn btn-info btnvalidasiobat" type="submit"><i class="fas fa-notes-medical"></i> Simpan Detail Obat</button>
                    </div>
                </div>
            </from>
            <?= form_close() ?>
        </div>
        <div class="ribbon-wrapper card">
            <div class="ribbon ribbon-bookmark  ribbon-info">Detail Obat</div>
            <p class="mt-4 viewdetail">
        </div>
    </div>
</div>


<div class="viewmodal" style="display:none;"></div>

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

<script type="text/javascript">
    $(document).ready(function() {
        $('#destinationname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_lokasi') ?>",
                'data': {
                    key: $('#destinationname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#destinationname').val(data.name);
                    $('#destinationcode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })


    });
</script>



<script>
    $(document).ready(function() {
        $('.formterimapbf').submit(function(e) {
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

                        })

                        $('#form-filter-atas').css('display', 'none');
                        $('#form-filter-bawah').css('display', 'block');

                        $('#journalnumber').val(response.journalnumber);
                        $('#referencenumber_detail').val(response.referencenumber);
                        $('#locationcode_detail').val(response.locationcode);
                        $('#locationname_detail').val(response.locationname);
                        $('#documentdate_detail').val(response.documentdate);
                        $('#karyawan_detail').val(response.karyawan);
                        $('#dispensasi_detail').val(response.dispensasi);
                        $('#relation').val(response.relation);
                        $('#relationname').val(response.relationname);
                        $('#paymentmethod_detail').val(response.paymentmethod);
                        $('#paymentmethodname_detail').val(response.paymentmethodname);
                        $('#poliklinik_detail').val(response.poliklinik);
                        $('#poliklinikname_detail').val(response.poliklinikname);
                        $('#poliklinikclass_detail').val(response.poliklinikclass);
                        $('#dokter_detail').val(response.dokter);
                        $('#doktername_detail').val(response.doktername);
                        $('#employee_detail').val(response.employee);
                        $('#employeename_detail').val(response.employeename);
                        $('#referencenumber_detail').val(response.referencenumber);

                    }
                }


            });
            return false;
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.formterimapbf_detail').submit(function(e) {
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
                        $('#name').val('');
                        $('#code').val('');
                        $('#uom').val('');
                        $('#batchnumber').val('');
                        $('#qty').val('0');
                        detail();

                    }
                }


            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#suppliercode").autocomplete({
            source: "<?php echo base_url('ObatMasukGudang/ajax_supplier'); ?>",
            select: function(event, ui) {
                $('#suppliercode').val(ui.item.value);
                $('#supplier').val(ui.item.code);
                $('#suppliername').val(ui.item.supplier);
                $('#supplieraddress').val(ui.item.address);

            }
        });
    });
</script>
<script>
    var rupiah = document.getElementById('totalinvoiceamount');
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value);

    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);


        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>



<script>
    $(document).ready(function() {
        $('.btncode').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('FarmasiPelayananRanap/Search_Obat_Pelayanan') ?>",
                data: {
                    locationcode: $('#locationcode_detail').val()
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalcariobatpelayanan').modal('show');

                }
            });

        });

        $('.btnSP').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('FarmasiPelayananRanap/Search_PasienRanap') ?>",
                data: {
                    locationcode: $('#locationcode').val()
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalcaripasienranap').modal('show');

                }
            });

        });
    });
</script>
<script>
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>



<script>
    function detail() {
        $.ajax({
            url: "<?php echo base_url('FarmasiPelayananRajal/resumePelayanan') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdetail').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        detail();
    });
</script>

<script>
    $(document).ready(function() {
        $('.btnbatchnumber').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('FarmasiPelayananRanap/Search_BacthNumber') ?>",
                data: {
                    code: $('#code').val(),
                    locationcode: $('#locationcode_detail').val()
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalcaribatchnumber_pelayanan').modal('show');

                }
            });

        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#doktername').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#doktername option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#doktername').val(data.name);
                    $('#dokter').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })


        $('#employeename').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_petugas_resep') ?>",
                'data': {
                    key: $('#employeename option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#employeename').val(data.name);
                    $('#employee').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })


        $('.btncardbpjs').on('click', function() {

            if ($('#paymentcardnumber').val() == '' || $('#registerdate').val == '') {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'No Asuransi Tidak Boleh Kosong'

                })
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('Bpjs/check_card') ?>",
                    data: {
                        card: $('#paymentcardnumber').val(),
                        date: $('#documentdate').val()
                    },
                    success: function(response) {
                        let parseResponse = JSON.parse(response);
                        if (parseResponse.metaData.code == 200) {

                            Swal.fire({
                                html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                    '<br>Hak Kelas: ' + parseResponse.response.peserta.pisa + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
                                    '<br>Kode Faskes 1: ' + parseResponse.response.peserta.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.peserta.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.peserta.tglTMT,

                                icon: 'success',
                                text: parseResponse.metaData.message,
                            });
                            //$('#faskesname').val(parseResponse.response.peserta.provUmum.nmProvider);
                            //$('#faskes').val(parseResponse.response.peserta.provUmum.kdProvider);
                            $('#hakkelaspasien').val(parseResponse.response.peserta.pisa);
                        } else {
                            Swal.fire({
                                icon: 'error',

                                text: parseResponse.metaData.message

                            });
                        }
                    }
                })
            }

        })


    });
</script>

<script type="text/javascript">
    $('#racikan').on('change', function() {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('PendaftaranRanap/ajax_racikan') ?>",
            data: {
                keterangan: $(this).val()
            },
            success: function(response) {
                let data = JSON.parse(response);
                $('#koderacikan').empty();

                if (data[0] == null) {

                    $('#koderacikan').append("<option>Pilihan kosong</option>");
                    $('#koderacikan').attr('disabled', 'disabled');

                } else {

                    data.forEach(appendRoomName);

                    function appendRoomName(item) {
                        $('#koderacikan').append("<option value='" + item.name + "' data-room='" + item.name + "'>" + item.name + "</option>");
                    }
                    $('#koderacikan').removeAttr('disabled');
                }

                $('#racikan').val($('#racikan option:selected').data('name'));

            }
        })
    });
</script>

<?= $this->endSection(); ?>