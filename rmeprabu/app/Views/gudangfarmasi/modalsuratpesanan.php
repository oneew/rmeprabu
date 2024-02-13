<div id="modalsuratpesanan" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Pembuatan Surat Pesanan Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div id="form-filter-atas">
                            <div class="ribbon-wrapper card">
                                <div class="ribbon ribbon-bookmark  ribbon-default">Form Surat Pesanan Barang</div>
                                <?= form_open('AmprahFarmasi/simpanSuratPesanan', ['class' => 'formterimapbf']); ?>
                                <?= csrf_field(); ?>
                                <from class="form-horizontal form-material" id="form-filter" method="post">
                                    <div class="form-body">
                                        <div class="row pt-1">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Tanggal Surat Pesan</label>
                                                    <input type="text" id="documentdate" autocomplete="off" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                                    <input type="hidden" id="documentyear" autocomplete="off" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Kepada Penyedia</label>
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
                                                    <label class="control-label">Alamat Penyedia</label>
                                                    <input type="text" id="supplieraddress" name="supplieraddress" class="form-control" readonly required>
                                                    <input type="hidden" id="suppliername" name="suppliername" class="form-control" readonly>
                                                    <input type="hidden" id="supplier" name="supplier" class="form-control" readonly>
                                                    <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Dibuat Oleh</label>
                                                    <input type="text" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Lokasi Permintaan</label>
                                                <input type="text" id="locationname" name="locationname" class="form-control" value="<?= session()->get('locationname'); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Kode Lokasi Peminta</label>
                                                <input type="text" id="locationcode" name="locationcode" class="form-control" value="<?= session()->get('locationcode'); ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Waktu Permintaan</label>
                                                <input type="text" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                                <div class="form-control-feedback errorpaymentamount">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Keterangan</label>
                                                <input type="text" id="keterangan" name="keterangan" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button id="button" class="btn btn-info btnsimpan" type="submit"><i class="fas fa-notes-medical"></i> Simpan Surat Pesanan</button>
                                    </div>
                                </from>
                            </div>
                            <?= form_close() ?>
                        </div>
                        <div id="form-filter-bawah" style="display: none;">
                            <div class="ribbon-wrapper card">
                                <div class="ribbon ribbon-bookmark  ribbon-warning">Input Detail Pesanan Barang</div>
                                <?= form_open('AmprahFarmasi/simpandatasuratpesan_detail', ['class' => 'formterimapbf_detail']); ?>
                                <?= csrf_field(); ?>
                                <from class="form-horizontal form-material" id="form-filter-deetail" method="post">
                                    <div class="form-body">
                                        <div class="row pt-1">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">No Surat Pesanan</label>
                                                    <input type="text" id="journalnumber" autocomplete="off" name="journalnumber" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Penyedia</label>
                                                    <input type="text" id="destinationname_detail" autocomplete="off" name="destinationname_detail" class="form-control" readonly>
                                                    <input type="hidden" id="documentdate_detail" autocomplete="off" name="documentdate_detail" class="form-control" readonly>
                                                    <input type="hidden" id="destinationcode_detail" autocomplete="off" name="destinationcode_detail" class="form-control" readonly>
                                                    <input type="hidden" id="createddate_detail" autocomplete="off" name="createddate_detail" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Dibuat Oleh</label>
                                                    <input type="text" id="createdby_detail" name="createdby_detail" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Kode Lokasi Peminta</label>
                                                    <input type="text" id="locationcode_detail" autocomplete="off" name="locationcode_detail" class="form-control" readonly>
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
                                                    <label class="control-label">Posisi Stok Saat Ini</label>
                                                    <input type="text" id="qtystock" autocomplete="off" name="qtystock" class="form-control" onkeypress="return hanyaAngka(event)" style="text-align: right;">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Jumlah Yang Diminta</label>
                                                    <input type="text" id="qty" autocomplete="off" name="qty" class="form-control" onkeypress="return hanyaAngka(event)" value="0" style="text-align: right;">
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
                                <div class="ribbon ribbon-bookmark  ribbon-info">Detail Barang</div>
                                <p class="mt-4 viewdetail">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive viewdatapesanan"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="viewmodalbaru" style="display:none;"></div>

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
                            $('#destinationcode').addClass('form-control-danger');
                            $('.errordestinationcode').html(response.error.destinationcode);
                        } else {
                            $('#destinationcode').removeClass('form-control-danger');
                            $('.errordestinationcode').html('');
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
                        $('#locationcode_detail').val(response.lc);
                        $('#destinationcode_detail').val(response.destinationcode);
                        $('#destinationname_detail').val(response.destinationname);
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
        $('.btncode').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('AmprahFarmasi/Search_Obat_Pesan') ?>",
                data: {
                    locationcode: $('#locationcode_detail').val()
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodalbaru').html(response.data).show();
                    $('#modalcariobatpesan').modal('show');

                }
            });

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

                    }
                }


            });
            return false;
        });
    });
</script>

<script>
    function detail() {
        $.ajax({
            url: "<?php echo base_url('AmprahFarmasi/resumeDetailPesanan') ?>",
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