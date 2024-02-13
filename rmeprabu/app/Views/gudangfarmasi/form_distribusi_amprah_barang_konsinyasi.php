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
                        <a class="dropdown-item" href="<?= base_url(); ?>/DistribusiAmprahFarmasi/DDA">Data Distribusi Permintaan Barang (Amprah)</a>
                        <a class="dropdown-item" href="<?= base_url(); ?>/MasterObat/">Data Obat</a>
                        <a class="dropdown-item" href="#">Data Supplier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="form-filter-atas">
        <div class="ribbon-wrapper card">
            <div class="ribbon ribbon-bookmark  ribbon-default">Form Distribusi Permintaan Barang (Amprah) Barang Konsinyasi</div>
            <?= form_open('DistribusiAmprahFarmasiKonsinyasi/simpandatadistribusi', ['class' => 'formterimapbf']); ?>
            <?= csrf_field(); ?>
            <from class="form-horizontal form-material" id="form-filter" method="post">
                <div class="form-body">
                    <div class="row pt-1">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>No. Permintaan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="referencenumber" name="referencenumber" readonly required>
                                    <div class="input-group-append">
                                        <button class="btn btn-info btnSP" id="btn-card" type="button">Cari!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal</label>
                                <input type="text" id="documentdate" autocomplete="off" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                <input type="hidden" id="documentyear" autocomplete="off" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Kode Lokasi Sumber</label>
                                <input type="text" id="locationcode_header" name="locationcode_eheader" class="form-control" readonly>
                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="KONSINYASI" readonly>
                                <input type="hidden" id="groups" name="groups" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Lokasi Sumber</label>
                                <input type="text" id="locationname" name="locationname" class="form-control" value="GUDANG KONSINYASI" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Dibuat Oleh</label>
                                <input type="text" id="referenceuserid" name="referenceuserid" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Kode Lokasi Permintaan</label>
                                <input type="text" id="referencelocationcode" name="referencelocationcode" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Lokasi Peminta</label>
                                <input type="text" id="referencelocationname" name="referencelocationname" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Waktu Permintaan</label>
                                <input type="hidden" id="referencedate" name="referencedate" class="form-control" readonly>
                                <input type="text" id="referencedatetime" name="referencedatetime" class="form-control" readonly>
                                <input type="hidden" id="createddate" autocomplete="off" name="createddate" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                                <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                <div class="form-control-feedback errorpaymentamount">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button id="button" class="btn btn-info btnvalidasi" type="submit"><i class="fas fa-notes-medical"></i> Simpan Distribusi</button>
                    </div>
                </div>
            </from>
            <?= form_close() ?>
        </div>
    </div>
    <div id="form-filter-permintaan" style="display: none;">
        <div class="ribbon-wrapper card">
            <div class="ribbon ribbon-bookmark  ribbon-info">Detail Permintaan</div>
            <input type="hidden" class="form-control" id="journalnumber_permintaan" name="journalnumber_permintaan" readonly required>
            <p class="mt-4 viewpermintaan">
        </div>
    </div>
    <div id="form-filter-bawah" style="display: none;">
        <div class="ribbon-wrapper card">
            <div class="ribbon ribbon-bookmark  ribbon-warning">Input Detail Distribusi Barang</div>
            <?= form_open('DistribusiAmprahFarmasiKonsinyasi/simpandatadistribusi_detail', ['class' => 'formterimapbf_detail']); ?>
            <?= csrf_field(); ?>
            <from class="form-horizontal form-material" id="form-filter-deetail" method="post">
                <div class="form-body">
                    <div class="row pt-1">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">No Register Distribusi</label>
                                <input type="text" id="journalnumber" autocomplete="off" name="journalnumber" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">No Surat Pesanan</label>
                                <input type="text" id="referencenumber_detail" autocomplete="off" name="referencenumber_detail" class="form-control" readonly>
                                <input type="hidden" id="documentdate_detail" autocomplete="off" name="documentdate_detail" class="form-control" readonly>
                                <input type="hidden" id="createddate_detail" autocomplete="off" name="createddate_detail" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                                <input type="hidden" id="createdby_detail" name="createdby_detail" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Sumber</label>
                                <input type="hidden" id="locationcode_detail" autocomplete="off" name="locationcode_detail" class="form-control" readonly>
                                <input type="text" id="locationname_detail" autocomplete="off" name="locationname_detail" class="form-control" readonly>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tujuan</label>
                                <input type="hidden" id="referencelocationcode_detail" name="referencelocationcode_detail" class="form-control" readonly>
                                <input type="text" id="referencelocationname_detail" name="referencelocationname_detail" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-1">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nama Obat</label>
                                <input type="text" id="name" autocomplete="off" name="name" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                                <label class="control-label">Expired Date</label>
                                <input type="text" id="expireddate" autocomplete="off" name="expireddate" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="row pt-1">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Posisi Stok</label>
                                <input type="text" id="qtystock" autocomplete="off" name="qtystock" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Jumlah Permintaan</label>
                                <input type="text" id="qtyrequest" autocomplete="off" name="qtyrequest" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Jumlah Dikirim</label>
                                <input type="text" id="qty" autocomplete="off" name="qty" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Harga</label>
                                <input type="text" id="price" autocomplete="off" name="price" class="form-control" style="text-align: right;">
                                <input type="hidden" id="subtotal" autocomplete="off" name="subtotal" class="form-control">
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


    </div>
    <div id="form-filter-bawah_miring" style="display: none;">
        <div class="ribbon-wrapper card">
            <div class="ribbon ribbon-bookmark  ribbon-info">Detail Barang Distribusi</div>
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
                            $('#referencenumber').addClass('form-control-danger');
                            $('.errorreferencenumber').html(response.error.referencenumber);
                        } else {
                            $('#referencenumber').removeClass('form-control-danger');
                            $('.errorreferencenumber').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        $('#form-filter-atas').css('display', 'none');
                        //$('#form-filter-bawah').css('display', 'block');
                        $('#form-filter-permintaan').css('display', 'block');
                        $('#form-filter-bawah_miring').css('display', 'block');
                        $('#journalnumber').val(response.journalnumber);
                        $('#journalnumber_permintaan').val(response.referencenumber);
                        $('#referencenumber_detail').val(response.referencenumber);
                        $('#locationcode_detail').val(response.locationcode);
                        $('#locationname_detail').val(response.locationname);
                        $('#documentdate_detail').val(response.documentdate);
                        $('#referencelocationcode_detail').val(response.referencelocationcode);
                        $('#referencelocationname_detail').val(response.referencelocationname);
                        detailpermintaan();

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
                        if (response.error.doktername) {
                            $('#name').addClass('form-control-danger');
                            $('.errorname').html(response.error.name);
                        } else {
                            $('#name').removeClass('form-control-danger');
                            $('.errorname').html('');
                        }
                    } else if (response.gagal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.pesan,

                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })
                        $('#name').val('');
                        $('#code').val('');
                        $('#uom').val('');
                        $('#qtystock').val('0');
                        $('#qty').val('0');
                        detail();
                        detailpermintaan();

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

                url: "<?php echo base_url('DistribusiAmprahFarmasi/Search_Obat_Amprah') ?>",
                data: {
                    locationcode: $('#locationcode_detail').val()
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalcariobat').modal('show');

                }
            });

        });

        $('.btnSP').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('DistribusiAmprahFarmasiKonsinyasi/Search_SP') ?>",
                data: {
                    locationcode: $('#locationcode').val()
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalcariSPKonsinyasi').modal('show');

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
    function detailpermintaan() {
        $.ajax({
            url: "<?php echo base_url('DistribusiAmprahFarmasiKonsinyasi/resumeDetailPermintaan') ?>",
            data: {
                journalnumber: $('#journalnumber_permintaan').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewpermintaan').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        detailpermintaan();
    });
</script>

<script>
    function detail() {
        $.ajax({
            url: "<?php echo base_url('DistribusiAmprahFarmasi/resumeDistribusi') ?>",
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

                url: "<?php echo base_url('DistribusiAmprahFarmasiKonsinyasi/Search_BacthNumber_konsinyasi') ?>",
                data: {
                    code: $('#code').val(),
                    locationcode: $('#locationcode').val()
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalcaribatchnumber_distribusi_konsinyasi').modal('show');

                }
            });

        });
    });
</script>


<script type="text/javascript">
    function total() {
        var hargabeli = document.getElementById('purchaseprice').value;
        var margin = document.getElementById('margin').value;
        var pajak = parseInt(hargabeli) * (11 / 100);

        var hna_pajak = pajak + parseInt(hargabeli);
        //var hja = hna_pajak * (33 / 100);

        //var hja = hna_pajak - ((hna_pajak / margin) * 100);
        var hja = hna_pajak * margin;
        // var total_hja = hna_pajak + hja;
        var total_hja = hja;

        document.getElementById('taxprice').value = hna_pajak;
        document.getElementById('salesprice').value = total_hja;

        document.getElementById('taxprice').value = hna_pajak;
        document.getElementById('salesprice').value = total_hja;
    }
</script>


<?= $this->endSection(); ?>