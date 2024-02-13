<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<div id="modalinputereseppulang_rme" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Resep Elektronik</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="form-filter-bawah" style="display: block;">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link tab-satuan active" data-toggle="tab" href="#satuan" role="tab">Satuan</a></li>
                                <li class="nav-item">
                                    <a class="nav-link tab-racikan" data-toggle="tab" href="#racikan" role="tab">Racikan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link templateEresep" data-toggle="tab" role="tab">Templet E Resep</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link historyEresep" data-toggle="tab" role="tab">Riwayat Pelayanan Resep</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="satuan" role="tabpanel">
                                    <?= form_open('PelayananRawatJalanRME/simpandataeresep_detail_sal', ['class' => 'formsimpanresepdetail']); ?>
                                    <?= csrf_field(); ?>
                                    <from id="form-filter-detail" method="post">

                                        <input type="hidden" id="journalnumber" autocomplete="off" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                                        <input type="hidden" id="relation" autocomplete="off" name="relation" class="form-control" readonly value="<?= $relation; ?>">
                                        <input type="hidden" id="referencenumber_detail" autocomplete="off" name="referencenumber_detail" class="form-control" readonly value="<?= $referencenumber; ?>">
                                        <input type="hidden" id="locationcode_detail" name="locationcode_detail" class="form-control" value="<?= $locationcode; ?>" readonly>
                                        <input type="hidden" id="locationname_detail" name="locationname_detail" class="form-control" value="<?= $locationname; ?>" readonly>
                                        <input type="hidden" id="relationname" autocomplete="off" name="relationname" class="form-control" readonly value="<?= $relationname; ?>">
                                        <input type="hidden" id="poliklinikname_detail" autocomplete="off" name="poliklinikname_detail" class="form-control" readonly value="<?= $poliklinikname; ?>">
                                        <input type="hidden" id="poliklinik_detail" autocomplete="off" name="poliklinik_detail" class="form-control" readonly value="<?= $poliklinik; ?>">
                                        <input type="hidden" id="paymentmethodname_detail" autocomplete="off" name="paymentmethodname_detail" class="form-control" readonly value="<?= $paymentmethodname; ?>">
                                        <input type="hidden" id="paymentmethod_detail" autocomplete="off" name="paymentmethod_detail" class="form-control" readonly value="<?= $paymentmethod; ?>">
                                        <input type="hidden" id="dokter_detail" name="dokter_detail" class="form-control" value="<?= $dokter ;?>" required>
                                        <input type="hidden" id="doktername_detail" name="doktername_detail" class="form-control" value="<?= $doktername ;?>" required>
                                        
                                        <div class="row align-items-end p-1 clone-form">
                                            <input type="hidden" class="price" id="price" autocomplete="off" name="price[]" required>
                                            <input type="hidden" class="qtystock" id="qtystock" autocomplete="off" name="qtystock[]" required>

                                            <div class="col-md-1">
                                                <label class="control-label">Keterangan</label>
                                                <select name="racikan[]" id="racikan2" class="form-control">
                                                    <?php foreach ($racikan as $SP) : ?>
                                                        <option value="<?= $SP['kode']; ?>" data-name="<?= $SP['name']; ?>" class="select-statuspulang"><?= $SP['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="control-label">Racikan Ke</label>
                                                <select name="koderacikan[]" id="koderacikan" class="form-control">
                                                    <option value="-">-</option>
                                                    <?php foreach ($itemracikan as $APS) : ?>
                                                        <option data-id="<?= $APS['id']; ?>" data-room="<?= $APS['name']; ?>" class="select-koderacikan"><?= $APS['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-0">
                                                    <label>Nama Obat</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control nama-obat" id="nama_obat" name="nama_obat[]" required>
                                                        <input type="hidden" class="kode_obat" name="kode_obat[]" id="kode_obat">
                                                        <input type="hidden" class="batchnumber" name="batchnumber[]" id="batchnumber_obat">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-0">
                                                    <label class="control-label">Jumlah Obat</label>
                                                    <input type="text" id="qtyresep" autocomplete="off" name="qtyresep[]" class="form-control" value="1">
                                                </div>
                                            </div>
                                            <input type="hidden" id="expireddate" autocomplete="off" name="expireddate[]" class="form-control">
                                            <div class="col-2">
                                                <div class="form-group mb-0">
                                                    <label class="control-label">Aturan Pakai (Dosis)</label>
                                                    <input type="text" id="signa1" autocomplete="off" name="signa1[]" class="form-control" value="1">
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-group mb-0">
                                                    <label class="control-label">Satuan</label>
                                                    <input type="text" id="uom" autocomplete="off" name="uom[]" class="form-control uom" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-0">
                                                    <label class="control-label">Cara Pakai</label>
                                                    <input type="text" name="carapakai[]" id="carapakai" class="form-control cara-pakai">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-warning px-2" id="rowAdder">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="newinput"></div>

                                        <div class="form-body">

                                            <div class="text-right">
                                                <button id="button" class="btn btn-info btn-store" type="submit"><i class="fas fa-notes-medical"></i> Simpan</button>
                                            </div>
                                        </div>
                                    </from>
                                    <?= form_close() ?>
                                </div>

                                <!-- racikan -->
                                <div class="tab-pane show-tab" id="racikan" role="tabpanel">

                                </div>
                                <!-- akhir racikan -->
                            </div>
                        </div>
                    </div>

                </div>
                <div id="form-filter-tno" style="display: block;">
                    <div class="form-body">
                        <div class="row pt-3">
                            <div class="col-md-12 vieweResep">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="viewmodaltemplet"></div>

<script>
    $("body").on("click", "#rowAdder", function () {
        newRowAdd =
        '<div class="row align-items-end p-1 clone-form" id="row">'+
            '<input type="hidden" class="price" id="price" autocomplete="off" name="price[]" required>'+
            '<input type="hidden" class="qtystock" id="qtystock" autocomplete="off" name="qtystock[]" required>'+
            '<div class="col-md-1">'+
                '<label class="control-label">Keterangan</label>'+
                '<select name="racikan[]" id="racikan2" class="form-control">'+
                    <?php foreach ($racikan as $SP) : ?>
                        '<option value="<?= $SP['kode']; ?>" data-name="<?= $SP['name']; ?>" class="select-statuspulang"><?= $SP['name']; ?></option>'+
                    <?php endforeach; ?>
                '</select>'+
            '</div>'+
            '<div class="col-md-1">'+
                '<label class="control-label">Racikan Ke</label>'+
                '<select name="koderacikan[]" id="koderacikan" class="form-control">'+
                    '<option value="-">-</option>'+
                    <?php foreach ($itemracikan as $APS) : ?>
                        '<option data-id="<?= $APS['id']; ?>" data-room="<?= $APS['name']; ?>" class="select-koderacikan"><?= $APS['name']; ?></option>'+
                    <?php endforeach; ?>
                '</select>'+
            '</div>'+
            '<div class="col-md-2">'+
                '<div class="form-group mb-0">'+
                    '<label>Nama Obat</label>'+
                    '<div class="input-group">'+
                        '<input type="text" class="form-control nama-obat" id="nama_obat" name="nama_obat[]" required>'+
                        '<input type="hidden" class="kode_obat" name="kode_obat[]" id="kode_obat">'+
                        '<input type="hidden" class="batchnumber" name="batchnumber[]" id="batchnumber_obat">'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2">'+
                '<div class="form-group mb-0">'+
                    '<label class="control-label">Jumlah Obat</label>'+
                    '<input type="text" id="qtyresep" autocomplete="off" name="qtyresep[]" class="form-control" value="1">'+
                '</div>'+
            '</div>'+
            '<input type="hidden" id="expireddate" autocomplete="off" name="expireddate[]" class="form-control">'+
            '<div class="col-2">'+
                '<div class="form-group mb-0">'+
                    '<label class="control-label">Aturan Pakai (Dosis)</label>'+
                    '<input type="text" id="signa1" autocomplete="off" name="signa1[]" class="form-control" value="1">'+
                '</div>'+
            '</div>'+
            '<div class="col-1">'+
                '<div class="form-group mb-0">'+
                    '<label class="control-label">Satuan</label>'+
                    '<input type="text" id="uom" autocomplete="off" name="uom[]" class="form-control uom" readonly>'+
                '</div>'+
            '</div>'+
            '<div class="col-md-2">'+
                '<div class="form-group mb-0">'+
                    '<label class="control-label">Cara Pakai</label>'+
                    '<input type="text" name="carapakai[]" id="carapakai" class="form-control cara-pakai">'+
                '</div>'+
            '</div>'+
            '<div class="col">'+
                '<div class="btn-group" role="group" aria-label="Basic example">'+
                    '<button type="button" class="btn btn-warning px-2" id="rowAdder">+</button>'+
                    '<button type="button" class="btn btn-danger px-2" id="deleteRow">-</button>'+
                '</div>'+
            '</div>'+
        '</div>';

        $('#newinput').append(newRowAdd);
    });

    $("body").on("click", "#deleteRow", function () {
        $(this).parents("#row").remove();
    });

    $("body").on("keyup", "#signa1", function() {
        $(this).val($(this).val().toUpperCase());
    });
    
    $("body").on("keyup", ".nama-obat", function() {
        var index = $(".nama-obat").index( this );

        $(this).autocomplete({
            source: "<?= base_url('PelayananRawatJalanRME/ajax_cari_obat'); ?>?locationcode=" + $('#locationcode_detail').val(),
            select: function(event, ui) {
                $('.kode_obat').eq(index).val(ui.item.code);
                $('.batchnumber').eq(index).val(ui.item.batchnumber);
                $('.uom').eq(index).val(ui.item.uom);
                $('.price').eq(index).val(ui.item.salesprice);
                $('.qtystock').eq(index).val(ui.item.balance);
            }
        });
    });

    var list_cara_pakat = [
        <?php foreach ($carapakai as $cara) : ?>
            "<?= $cara['name']; ?>",
        <?php endforeach; ?>
    ];

    $("body").on("keyup", ".cara-pakai", function() {
        $(this).autocomplete({
            source: list_cara_pakat
        });
    });

    function detaileResep() {
        $.ajax({
            url: "<?= base_url('PelayananRawatJalanRME/detaileResepRanap') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.vieweResep').html(response.data);
            }
        });
    }

    $('.templateEresep').click(function(){
        $.ajax({
            url: "<?= base_url('PelayananRawatJalanRME/templateEresep') ?>",
            data: {
                journalnumber: $('#journalnumber').val(),
                referencenumber_transaksi : $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewmodaltemplet').html(response.sukses).show();
                $('#modal_e_resep').modal({
                    show: true,
                    backdrop: false
                });
            }
        });
    });

    $('.historyEresep').click(function(){
        $.ajax({
            url: "<?= base_url('PelayananRawatJalanRME/historyEresep') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewmodaltemplet').html(response.sukses).show();
                $('#modal_history_e_resep').modal({
                    show: true,
                    backdrop: false
                });

                $('#modal_history_e_resep').on('shown.bs.modal', function (event) {
                    $.ajax({
                        url: "<?= base_url('PelayananRawatJalanRME/getDataHistoryEresep'); ?>",
                        data:{
                            pasienid: $('#relation').val(),
                            journalnumber: $('#journalnumber').val(),
                        },
                        dataType: "json",
                        success: function(response) {
                            $('.viewdatahistoryeresep').html(response.data);
                            $('#datatable').dataTable({
                                scrollX: true
                            });
                        }
                    });
                })
            }
        });
    });

    $('.formsimpanresepdetail').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btn-store').attr('disabled', true);
                $('.btn-store').html('<i class="fa fa-spin fa-spinner "></i>');
            },
            complete: function() {
                $('.btn-store').removeAttr('disabled');
                $('.btn-store').html('<i class="fas fa-notes-medical"></i> Simpan');
            },

            success: function(response) {
                if (response.error) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops !!',
                        text: response.error,
                    })

                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.success,
                    })
                    $('#row').each(function() {
                        $(this).remove();
                    });
                    $('#nama_obat').val(null);
                    $('#kode_obat').val(null);
                    $('#code').val(null);
                    $('#uom').val(null);
                    $('#batchnumber').val(null);
                    $('#qty').val('1');
                    $('#qtyresep').val('1');
                    detaileResep();

                }
            }
        });
        return false;
    });
    
    $(document).ready(function(){
        $(".select2").select2();

        detaileResep();
    })

    $('.tab-racikan').click(function(){
        $.ajax({
            method: "GET",
            url: "<?= base_url('PelayananRawatJalanRME/getObatRacikan'); ?>",
            data: {
                id: null
            },
            dataType: "json",
            success: function(response) {
                $('.show-tab').html(response.success);
                $('#satuan').removeClass('active');
            }
        });
    })

    $('.tab-satuan').click(function(){
        $('#satuan').addClass('active');
        $('#racikan').removeClass('active');
    })


</script>