<div id="modalinputdistribusibaru" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Amprah : No Surat Amprah #[<?= $noamprah; ?>]</h4>
                <input type="hidden" class="form-control" id="journalnumber_permintaan_kegudang" name="journalnumber_permintaan_kegudang" value="<?= $noamprah; ?>" readonly required>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="ribbon-wrapper card">
                    <div class="ribbon ribbon-bookmark ribbon-warning">Input Detail Distribusi Barang</div>
                    <?= form_open('DistribusiAmprahFarmasiGC/simpandatadistribusi_detail_baru', ['class' => 'formdistribusi_detail']); ?>
                    <?= csrf_field(); ?>
                    <from class="form-horizontal form-material" id="form-filter-deetail" method="post">
                        <div class="form-body">
                            <div class="row pt-1">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">No Register Distribusi</label>
                                        <input type="text" id="journalnumberbaru" autocomplete="off" name="journalnumberbaru" class="form-control" value="<?= $journalnumber; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">No Surat Pesanan</label>
                                        <input type="text" id="referencenumber_detail" autocomplete="off" name="referencenumber_detail" class="form-control" readonly value="<?= $referencenumber; ?>">
                                        <input type="hidden" id="documentdate_detail" autocomplete="off" name="documentdate_detail" class="form-control" readonly value="<?= $documentdate; ?>">
                                        <input type="hidden" id="createddate_detail" autocomplete="off" name="createddate_detail" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                                        <input type="hidden" id="createdby_detail" name="createdby_detail" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Sumber</label>
                                        <input type="hidden" id="locationcode_detail" autocomplete="off" name="locationcode_detail" class="form-control" readonly value="GASCENTRAL">
                                        <input type="text" id="locationname_detail" autocomplete="off" name="locationname_detail" class="form-control" readonly value="GUDANG GAS CENTRAL">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tujuan</label>
                                        <input type="hidden" id="referencelocationcode_detail" name="referencelocationcode_detail" class="form-control" readonly value="<?= $referencelocationcode; ?>">
                                        <input type="text" id="referencelocationname_detail" name="referencelocationname_detail" class="form-control" readonly value="<?= $referencelocationname; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Kode Obat</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="code" name="code" readonly required value="<?= $codeobatdistribusi; ?>">
                                            <div class="input-group-append">
                                                <button class="btn btn-info btncode" id="btn-card" type="button">Cari!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nama Obat</label>
                                        <input type="text" id="name" autocomplete="off" name="name" class="form-control" readonly required value="<?= $namaobatdistribusi; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Satuan</label>
                                        <input type="text" id="uom" autocomplete="off" name="uom" class="form-control" readonly required value="<?= $satuanobatdistribusi; ?>">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label class="control-label">Stok <?php echo $referencelocationname; ?></label>
                                        <input type="text" id="stokpenerima" autocomplete="off" name="stokpenerima" class="form-control" readonly required value="<?= $stockterkini; ?>">
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
                                        <input type="text" id="qtyrequest" autocomplete="off" name="qtyrequest" class="form-control" value="<?= $jumlahamprah; ?>">
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
                                        <input type="text" id="price" autocomplete="off" name="price" class="form-control" style="text-align: right;" value="<?= $hargaobat; ?>">
                                        <input type="hidden" id="subtotal" autocomplete="off" name="subtotal" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button id="button" class="btn btn-info btnsimpandistribusi" type="submit"><i class="fas fa-notes-medical"></i> Simpan Detail Obat</button>
                            </div>
                        </div>
                    </from>
                    <?= form_close() ?>
                </div>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<div class="viewmodalinputbatch" style="display:none;"></div>

<script>
    function detailpermintaankegidang() {
        $.ajax({
            url: "<?php echo base_url('DistribusiAmprahFarmasi/resumeDetailPermintaan') ?>",
            data: {
                journalnumber: $('#journalnumber_permintaan_kegudang').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataamparahkegudang').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        detailpermintaankegidang();
    });
</script>


<script>
    $(document).ready(function() {
        $('.btnbatchnumber').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('DistribusiAmprahFarmasiGC/Search_BacthNumber_baru') ?>",
                data: {
                    code: $('#code').val(),
                    locationcode: $('#locationcode_detail').val()
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodalinputbatch').html(response.data).show();
                    $('#modalcaribatchnumber_distribusi_baru').modal('show');

                }
            });

        });
    });
</script>



<script>
    $(document).ready(function() {
        $('.formdistribusi_detail').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpandistribusi').attr('disable', 'disabled');
                    $('.btnsimpandistribusi').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpandistribusi').removeAttr('disable');
                    $('.btnsimpandistribusi').html('Simpan');
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
                        // $('#name').val('');
                        // $('#code').val('');
                        // $('#uom').val('');
                        // $('#qtystock').val('0');
                        // $('#qty').val('0');
                        detailpermintaan();
                        $('#modalinputdistribusibaru').modal('hide');
                        detail();

                        //detailpermintaan_baru();
                        //detailpermintaan();

                    }
                }


            });
            return false;
        });
    });
</script>