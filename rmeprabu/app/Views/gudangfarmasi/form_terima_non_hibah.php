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
                        <a class="dropdown-item" href="<?= base_url(); ?>/ObatMasukGudang/DTHibah">Data Penerimaan Hibah</a>
                        <a class="dropdown-item" href="<?= base_url(); ?>/MasterObat/">Data Obat</a>
                        <a class="dropdown-item" href="#">Data Supplier</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="form-filter-atas">
        <div class="ribbon-wrapper card">
            <div class="ribbon ribbon-bookmark  ribbon-default">Form Barang Masuk Penerimaan Hibah</div>
            <?= form_open('ObatMasukGudang/simpandataterima_nonpbf', ['class' => 'formterimapbf']); ?>
            <?= csrf_field(); ?>
            <from class="" id="form-filter" method="post">
                <div class="form-body">
                    <div class="row pt-1">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Kelompok</label>
                                <select name="groups" id="groups" class="select2" style="width: 100%">
                                    <option>Pilih Kelompok</option>
                                    <?php foreach ($kelompok as $kl) : ?>
                                        <option value="<?= $kl['name']; ?>"><?= $kl['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal</label>
                                <input type="text" id="documentdate" autocomplete="off" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Supplier</label>
                                <div class="input-group" data-placement="bottom" data-align="top" data-autoclose="true">
                                    <input type="text" id="suppliercode" name="suppliercode" class="form-control" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Alamat Supplier</label>
                                <input type="text" id="supplieraddress" name="supplieraddress" class="form-control" readonly required>
                                <input type="hidden" id="suppliername" name="suppliername" class="form-control" readonly>
                                <input type="hidden" id="supplier" name="supplier" class="form-control" readonly>
                                <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">No Faktur</label>
                                <input type="text" id="invoicenumber" name="invoicenumber" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Faktur</label>
                                <input type="text" id="datepicker-autoclose2" autocomplete="off" name="invoicedate" class="form-control" value="<?= date('m/d/Y'); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Terima</label>
                                <input type="text" id="datepicker-autoclose" autocomplete="off" name="receiptdate" class="form-control" value="<?= date('m/d/Y'); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Harga Faktur</label>
                                <input type="text" id="totalinvoiceamount" name="totalinvoiceamount" class="form-control">
                                <div class="form-control-feedback errorpaymentamount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">No Pesanan</label>
                                <input type="text" id="ordernumber" name="ordernumber" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Pesanan</label>
                                <input type="text" id="datepicker-autoclose3" autocomplete="off" name="orderdate" class="form-control" value="<?= date('m/d/Y'); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">No Dupada</label>
                                <input type="text" id="requestnumber" name="requestnumber" class="form-control">
                                <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="VITUAL" readonly>
                                <input type="hidden" id="locationname" name="locationname" class="form-control" value="GUDANG VIRTUAL" readonly>
                                <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Dupada</label>
                                <input type="text" id="datepicker-autoclose4" autocomplete="off" name="requestdate" class="form-control" value="<?= date('m/d/Y'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button id="button" class="btn btn-info btnvalidasi" type="submit"><i class="fas fa-notes-medical"></i> Simpan Faktur</button>
                    </div>
                </div>
            </from>
            <?= form_close() ?>
        </div>
    </div>
    <div id="form-filter-bawah" style="display: none;">
        <div class="ribbon-wrapper card">
            <div class="ribbon ribbon-bookmark  ribbon-warning">Input Detail Barang</div>
            <?= form_open('ObatMasukGudang/simpandataterima_nonpbf_detail', ['class' => 'formterimapbf_detail']); ?>
            <?= csrf_field(); ?>
            <from class="" id="form-filter-deetail" method="post">
                <div class="form-body">
                    <div class="row pt-1">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Lokasi</label>
                                <input type="hidden" id="documentdate_detail" autocomplete="off" name="documentdate_detail" class="form-control" readonly>
                                <input type="text" id="locationcode_detail" autocomplete="off" name="locationcode_detail" class="form-control">
                                <input type="hidden" id="createdby_detail" name="createdby_detail" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                <input type="hidden" id="createddate_detail" autocomplete="off" name="createddate_detail" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">No Faktur</label>
                                <input type="text" id="referencenumber" autocomplete="off" name="referencenumber" class="form-control">
                                <input type="hidden" id="journalnumber" autocomplete="off" name="journalnumber" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Kode Supplier</label>
                                <input type="text" id="relation" autocomplete="off" name="relation" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Supplier</label>
                                <input type="text" id="relationname" autocomplete="off" name="relationname" class="form-control">
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
                                <label class="control-label">Jml Kemasan(Box)</label>
                                <input type="text" id="qtybox" autocomplete="off" name="qtybox" class="form-control" onkeypress="return hanyaAngka(event)" value="0" style="text-align: right;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Isi Kemasan(Box)</label>
                                <input type="text" id="volume" autocomplete="off" name="volume" class="form-control" onkeypress="return hanyaAngka(event)" value="0">
                                <input type="hidden" id="qty" autocomplete="off" name="qty" class="form-control" onkeypress="return hanyaAngka(event)" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="row pt-1">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Nomor Batch</label>
                                <input type="text" id="batchnumber" autocomplete="off" name="batchnumber" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Expired Date</label>
                                <input type="date" id="expireddate" autocomplete="off" name="expireddate" class="form-control" value="<?= date('d/m/Y'); ?>">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Potongan %</label>
                                <input type="text" id="disc" autocomplete="off" name="disc" class="form-control" value="0" onkeypress="return hanyaAngka(event)" style="text-align: right;">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Pajak %</label>
                                <input type="text" id="tax" autocomplete="off" name="tax" class="form-control" value="0" onkeypress="return hanyaAngka(event)" style="text-align: right;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Harga Kemasan(Box)</label>
                                <input type="text" id="price" name="price" class="form-control" onkeypress="return hanyaAngka(event)" value="0" style="text-align: right;">
                                <div class="form-control-feedback errorpaymentamount">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="text" id="purchaseprice" name="purchaseprice" class="form-control" onkeypress="return hanyaAngka(event)" value="0" style="text-align: right;">
                                <div class="form-control-feedback errorpaymentamount">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Harga Sebelumnya</label>
                                <input type="text" id="purchasepricebefore" autocomplete="off" name="purchasepricebefore" class="form-control">
                                <input type="hidden" id="subtotal" autocomplete="off" name="subtotal" class="form-control" value="0" onkeypress="return hanyaAngka(event)" style="text-align: right;" required>
                                <input type="hidden" id="totaldiscount" autocomplete="off" name="totaldiscount" class="form-control" value="0" onkeypress="return hanyaAngka(event)" style="text-align: right;" readonly>
                                <input type="hidden" id="beforetax" autocomplete="off" name="beforetax" class="form-control" value="0" onkeypress="return hanyaAngka(event)" style="text-align: right;" readonly>
                                <input type="hidden" id="aftertax" name="aftertax" class="form-control" value="0" onkeypress="return hanyaAngka(event)" style="text-align: right;" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="text-right">
                        <button id="button" class="btn btn-info btnvalidasiobat" type="submit"><i class="fas fa-notes-medical"></i> Simpan Obat</button>
                    </div>
                </div>
            </from>
            <?= form_close() ?>
        </div>
        <div class="ribbon-wrapper card">
            <div class="ribbon ribbon-bookmark  ribbon-info">Detail Barang</div>
            <p class="mt-4 viewdetail">
        </div>
    </div>
</div>

<div class="viewmodal" style="display:none;"></div>



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

                let data = JSON.parse(response);
                $('#platnomor').val(data.platnomor);
                $('#codemobil').val(data.code);
            }
        })
    })
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
                            $('#invoicenumber').addClass('form-control-danger');
                            $('.errorinvoicenumber').html(response.error.invoicenumber);
                        } else {
                            $('#invoicenumber').removeClass('form-control-danger');
                            $('.errorinvoicenumber').html('');
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
                        $('#form-filter-atas').css('display', 'none');
                        $('#form-filter-bawah').css('display', 'block');
                        $('#journalnumber').val(response.journalnumber);
                        $('#locationcode_detail').val(response.lc);
                        $('#relation').val(response.relation);
                        $('#relationname').val(response.relationname);
                        $('#referencenumber').val(response.referencenumber);
                        $('#documentdate_detail').val(response.documentdate);

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
                            $('#batchnumber').addClass('form-control-danger');
                            $('.errorbatchnumber').html(response.error.batchnumber);
                        } else {
                            $('#batchnumber').removeClass('form-control-danger');
                            $('.errorbatchnumber').html('');
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
                        $('#qtybox').val('0');
                        $('#disc').val('0');
                        $('#volume').val('0');
                        $('#batchnumber').val('');
                        $('#price').val('0');
                        $('#purchaseprice').val('0');
                        $('#purchasepricebefore').val('0');
                        detail_nonpbf();
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
    var rupiah = document.getElementById('totalinvoiceamount2');
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

                url: "<?php echo base_url('ObatMasukGudang/Search_Obat_opik') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalcariobatvitual').modal('show');

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
    function detail_nonpbf() {
        $.ajax({
            url: "<?php echo base_url('ObatMasukGudang/resumeDetail_nonpbf') ?>",
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
        detail_nonpbf();
    });
</script>

<?= $this->endSection(); ?>