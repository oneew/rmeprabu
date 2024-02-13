<style type="text/css">
    .swal-container {
        z-index: 999999999;
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
        content: '§';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }
</style>
<div id="modaleresep_rajal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">e-Resep</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div id="form-filter-atas">
                <div class="ribbon-wrapper card">
                    <div class="ribbon ribbon-bookmark  ribbon-default">e-Resep Pasien Poliklinik</div>
                    <?= form_open('FarmasiPelayananRajal/simpandata_ereseprajal', ['class' => 'formterimapbf']); ?>
                    <?= csrf_field(); ?>
                    <from id="form-filter" method="post">
                        <div class="form-body">
                            <div class="row pt-1">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal</label>
                                        <input type="date" id="documentdate" autocomplete="off" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>">
                                        <input type="hidden" id="documentyear" autocomplete="off" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                        <input type="hidden" id="documentmonth" autocomplete="off" name="documentmonth" class="form-control" value="<?= date('m'); ?>" readonly>
                                        <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="DEPORINAP" readonly>
                                        <input type="hidden" id="locationname" name="locationname" class="form-control" value="DEPO RAWAT JALAN" readonly>
                                        <input type="hidden" id="createddate" autocomplete="off" name="createddate" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                                        <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                        <input type="hidden" class="form-control" id="groups" name="groups" readonly required value="IRJ">
                                        <input type="hidden" class="form-control" id="sumber" name="sumber" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>No. Rekam medis</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="pasienid" name="pasienid" value="<?= $pasienid; ?>" readonly required>
                                            <input type="hidden" class="form-control" id="oldcode" name="oldcode" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nama Pasien</label>
                                        <input type="text" class="form-control" id="pasienname" name="pasienname" readonly required value="<?= $pasienname; ?>">
                                        <input type="hidden" id="dateofbirth" name="dateofbirth" class="form-control" readonly required value="<?= $pasiendateofbirth; ?>">
                                        <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" readonly value="<?= $pasiengender; ?>">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Cara Bayar</label>
                                        <input type="text" id="paymentmethod" name="paymentmethod" class="form-control" readonly value="<?= $paymentmethodname; ?>">
                                        <input type="hidden" id="paymentmethodname" name="paymentmethodname" class="form-control" readonly value="<?= $paymentmethodname; ?>">
                                        <input type="hidden" id="paymentmethodori" name="paymentmethodori" class="form-control" readonly value="<?= $paymentmethodname; ?>">
                                        <input type="hidden" id="paymentmethodnameori" name="paymentmethodnameori" class="form-control" readonly value="<?= $paymentmethodname; ?>">
                                        <input type="hidden" id="smf" name="smf" class="form-control" readonly value="<?= $smf; ?>">
                                        <input type="hidden" id="smfname" name="smfname" class="form-control" readonly value="<?= $smfname; ?>">

                                        <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" readonly value="<?= $poliklinik; ?>">
                                        <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" readonly value="<?= $poliklinikname; ?>">
                                        <input type="hidden" id="poliklinikclass" name="poliklinikclass" class="form-control" readonly value="NONE">
                                        <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" readonly value="<?= $journalnumber; ?>">


                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">No Kartu</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="paymentcardnumber" name="paymentcardnumber" value="<?= $paymentcardnumber; ?>">
                                            <input type="hidden" class="form-control" id="paymentcardnumberori" name="paymentcardnumberori" value="<?= $paymentcardnumber; ?>">
                                            <input type="hidden" class="form-control" id="registerdate" name="registerdate" value="<?= date('Y-m-d'); ?>">
                                            <input type="hidden" id="noreg" name="noreg" class="form-control" readonly value="<?= $journalnumber; ?>">

                                            <input type="hidden" id="poliklinikclassname" name="poliklinikclassname" class="form-control" readonly>
                                            <div class="input-group-append">
                                                <button class="btn btn-info btncardbpjs" id="btn-card" type="button">Cek!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Dokter</label>
                                        <select name="doktername" id="doktername" class="select2" style="width: 100%">
                                            <option value="">Pilih Pemberi Resep</option>
                                            <?php foreach ($dokter as $dpjp) { ?>
                                                <option data-id="<?= $dpjp['id']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $doktername) { ?> selected="selected" <?php } ?>><?= $dpjp['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="dokter" id="dokter" value="<?= $kodedokter; ?>">
                                        <div class="form-control-feedback errordoktername">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Penelaah Resep</label>
                                        <select name="employeename" id="employeename" class="select2" style="width: 100%">
                                            <option>Pilih Petugas</option>
                                            <?php foreach ($petugas as $p) { ?>
                                                <option data-id="<?= $p['id']; ?>" class="select-employee"><?= $p['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="employee" id="employee">
                                        <div class="form-control-feedback erroremployeename">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Dispensasi ? </label>
                                        <div class="switch">
                                            <label>Tidak
                                                <input type="checkbox" value="1" name="dispensasi" id="dispensasi"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Karyawan ? </label>
                                        <div class="switch">
                                            <label>Bkn
                                                <input type="checkbox" value="1" name="karyawan" id="karyawan"><span class="lever"></span>Ya</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Pejabat Pemberi Dispensasi <span class="text-danger">*</span></label>
                                        <input type="text" id="pejabatdispensasi" name="pejabatdispensasi" class="form-control" value="-">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Alasan Dispensasi <span class="text-danger">*</span></label>
                                        <input type="text" id="alasandispensasi" name="alasandispensasi" class="form-control" value="-">
                                        <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control">
                                        <input type="hidden" id="pasienarea" name="pasienarea" class="form-control">
                                        <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control">
                                        <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control">
                                        <input type="hidden" id="bednumber" name="bednumber" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button id="button" class="btn btn-info btnvalidasi" type="submit"><i class="fas fa-notes-medical"></i> Simpan Dokumen Resep</button>
                            </div>
                        </div>
                    </from>
                    <?= form_close() ?>
                </div>
            </div>
            <div id="form-filter-bawah" style="display: none;">
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
                                        <input type="hidden" id="journalnumber" autocomplete="off" name="journalnumber" class="form-control">
                                        <input type="text" id="relation" autocomplete="off" name="relation" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Nama Pasien</label>
                                        <input type="hidden" id="referencenumber_detail" autocomplete="off" name="referencenumber_detail" class="form-control" readonly>
                                        <input type="hidden" id="documentdate_detail" autocomplete="off" name="documentdate_detail" class="form-control" readonly>
                                        <input type="hidden" id="createddate_detail" autocomplete="off" name="createddate_detail" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                                        <input type="hidden" id="createdby_detail" name="createdby_detail" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                        <input type="hidden" id="karyawan_detail" autocomplete="off" name="karyawan_detail" class="form-control">
                                        <input type="hidden" id="dispensasi_detail" autocomplete="off" name="dispensasi_detail" class="form-control">
                                        <input type="hidden" id="poliklinikclass_detail" name="poliklinikclass_detail" class="form-control" readonly>
                                        <input type="hidden" id="employee_detail" name="employee_detail" class="form-control" readonly>
                                        <input type="hidden" id="employeename_detail" name="employeename_detail" class="form-control" readonly>
                                        <input type="hidden" id="locationcode_detail" name="locationcode_detail" class="form-control" value="DEPORINAP" readonly>
                                        <input type="hidden" id="locationname_detail" name="locationname_detail" class="form-control" value="DEPO RAWAT INAP" readonly>
                                        <input type="text" id="relationname" autocomplete="off" name="relationname" class="form-control" readonly>
                                        <input type="hidden" id="poliklinikname_detail" autocomplete="off" name="poliklinikname_detail" class="form-control" readonly>
                                        <input type="hidden" id="poliklinik_detail" autocomplete="off" name="poliklinik_detail" class="form-control" readonly>
                                        <input type="hidden" id="paymentmethodname_detail" autocomplete="off" name="paymentmethodname_detail" class="form-control" readonly>
                                        <input type="hidden" id="paymentmethod_detail" autocomplete="off" name="paymentmethod_detail" class="form-control" readonly>
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
                                        <option value="-">-</option>
                                        <?php foreach ($itemracikan as $APS) : ?>
                                            <option data-id="<?= $APS['id']; ?>" data-room="<?= $APS['name']; ?>" class="select-koderacikan"><?= $APS['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Jml Racikan</label>
                                        <input type="text" id="jumlahracikan" autocomplete="off" name="jumlahracikan" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Kode Obat</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="code" name="code" readonly required>
                                            <div class="input-group-append">
                                                <button class="btn btn-info btncodeeresep" id="btn-card3" type="button">Cari!</button>
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
                                        <label class="control-label">Expire Date</label>
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
                                        <small class="form-control-feedback text-danger">Pakai titik(.)jika decimal</small>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <label class="control-label">x</label>
                                    <div class="form-group">
                                        <input type="text" id="signa2" autocomplete="off" name="signa2" class="form-control" value="1">
                                        <small class="form-control-feedback text-danger">Pakai titik(.)jika decimal</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Resep Dokter</label>
                                        <input type="text" id="qtyresep" autocomplete="off" name="qtyresep" class="form-control" value="1">
                                        <small class="form-control-feedback text-danger">Pakai titik(.)jika decimal</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Dilayani</label>
                                        <input type="text" id="qty" autocomplete="off" name="qty" class="form-control" value="1">
                                        <small class="form-control-feedback text-danger">Pakai titik(.)jika decimal</small>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<div class="viewmodalobateresep" style="display:none;"></div>


<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
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


<!-- <script type="text/javascript" src="<?= base_url(); ?>/js/jquery.js"></script> -->
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
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#doktername').val(data.name);
                    $('#dokter').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })


        $('#ibsanestesiname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#ibsanestesiname option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#ibsanestesiname').val(data.name);
                    $('#ibsanestesi').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#smfname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_smf') ?>",
                'data': {
                    key: $('#smfname option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#smfname').val(data.name);
                    $('#smf').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

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
                        $('#batchnumber').val('');
                        $('#qty').val('1');
                        detail();

                    }
                }


            });
            return false;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.btncodeeresep').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('FarmasiPelayananRajal/Search_Obat_Pelayanan_eresep') ?>",
                data: {
                    locationcode: $('#locationcode_detail').val()
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodalobateresep').html(response.data).show();
                    $('#modalcariobatpelayanan_eresep').modal('show');

                }
            });

        });
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
                    locationcode: $('#locationcode').val()
                },
                dataType: "json",
                success: function(response) {
                    $('.viewmodalobateresep').html(response.data).show();
                    $('#modalcaribatchnumber_pelayanan').modal('show');

                }
            });

        });
    });
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