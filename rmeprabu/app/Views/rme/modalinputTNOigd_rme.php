<div id="modalinputTNOigd_rme" class="modal fade" id="bs-example-modal-lg" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tindakan Medis</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="form-filter-bawah" style="display: block;">
                    <?= form_open('PelayananRawatJalanRME/simpanTNOIGDDetail', ['class' => 'formTNO']); ?>
                    <?= csrf_field(); ?>
                    <form method="post" id="form-filter">
                        <div class="form-body">
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama Tindakan</label>
                                        <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                                        <input type="hidden" id="kode" name="kode" class="form-control" autocomplete="off">
                                        <input type="hidden" id="code" name="code" class="form-control" readonly>
                                        <input type="hidden" id="groups" name="groups" class="form-control" readonly>
                                        <input type="hidden" id="share1" name="share1" class="form-control" readonly>
                                        <input type="hidden" id="share2" name="share2" class="form-control" readonly>
                                        <input type="hidden" id="share21" name="share21" value="0.00" class="form-control">
                                        <input type="hidden" id="share22" name="share22" value="0.00" class="form-control">
                                        <input type="hidden" id="share1ori" name="share1ori" class="form-control">
                                        <input type="hidden" id="share2ori" name="share2ori" class="form-control">
                                        <input type="hidden" id="memo" name="memo" class="form-control" value="PELAYANAN DAN TINDAKAN" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Pelaksana</label>
                                        <div class="switch">
                                            <label>Dokter
                                                <input type="checkbox" value="1" name="pelaksana" id="pelaksana"><span class="lever"></span>Pelaksana</label>
                                        </div>
                                        <input type="hidden" id="pelaksana2" name="pelaksana2" class="form-control" readonly>
                                        <input type="hidden" id="groupname" name="groupname" class="form-control" readonly>
                                        <input type="hidden" id="category" name="category" class="form-control" readonly>
                                        <input type="hidden" id="categoryname" name="categoryname" class="form-control" readonly>
                                        <input type="hidden" id="types" name="types" class="form-control" readonly>
                                        <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                                        <input type="hidden" id="relation" name="relation" class="form-control" value="<?= $pasienid; ?>" readonly>
                                        <input type="hidden" id="relationname" name="relationname" class="form-control" value="<?= $pasienname; ?>" readonly>
                                        <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                        <input type="hidden" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                                        <input type="hidden" id="classroom" name="classroom" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="classroomname" name="classroomname" class="form-control" readonly>
                                        <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $poliklinik; ?>" readonly>
                                        <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $poliklinikname; ?>" readonly>
                                        <input type="hidden" id="smf" name="smf" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="smfname" name="smfname" class="form-control" value="<?= $poliklinikname; ?>" readonly>
                                        <input type="hidden" id="employee" name="employee" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="employeename" name="employeename" class="form-control" value="" readonly>
                                        <input type="hidden" id="registernumber" name="registernumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                        <input type="hidden" id="referencenumberparent" name="referencenumberparent" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                        <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="PORTIR-RJ" readonly>
                                        <input type="hidden" id="status" name="status" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="totaltarif" name="totaltarif" class="form-control">
                                        <input type="hidden" id="totalbhp" name="totalbhp" class="form-control">
                                        <input type="hidden" id="subtotal" name="subtotal" class="form-control">
                                        <input type="hidden" id="disc" name="disc" class="form-control" value="0.00" readonly>
                                        <input type="hidden" id="totaldiscount" name="totaldiscount" value="0.00" class="form-control">
                                        <input type="hidden" id="grandtotal" name="grandtotal" value="0.00" class="form-control">
                                        <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                        <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Paramedis</label>
                                        <select name="paramedicName" id="paramedicName" class="select2" style="width: 100%" disabled>
                                            <option>Pilih Paramedis</option>
                                            <?php foreach ($paramedic as $para) : ?>
                                                <option value="<?= $para['nama']; ?>" class="select-code"><?= $para['nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Jumlah</label>
                                        <input type="text" id="qty" name="qty" class="form-control" value="1">
                                        <input type="hidden" id="price" name="price" class="form-control" readonly>
                                        <input type="hidden" id="bhp" name="bhp" class="form-control" value="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="control-label">Dokter/Advisor</label>
                                        <select name="dokter" id="dokter" class="select2" style="width: 100%" required>
                                            <option value="">Pilih Dokter</option>
                                            <?php foreach ($list_dokter as $dokter) : ?>
                                                <option value="<?= $dokter['code'] . '|' . $dokter['name']; ?>" class="select-code" <?= $dokter['name'] == $doktername ? 'selected' : null; ?> ><?= $dokter['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Pelayanan</label>
                                        <input type="date" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success btnsimpanTNO"> <i class="fa fa-check"></i> Tambah</button>
                            <button type="button" class="btn btn-inverse" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                    <?= form_close() ?>
                </div>
                <div id="form-filter-tno" style="display: block;">
                    <div class="form-body">
                        <div class="row pt-3">
                            <div class="col-md-12 viewTnoMedis">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script src="<?= base_url(); ?>/assets/plugins/switchery/dist/switchery.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
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
                        q: params.term,
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
            },
            minimumInputLength: 1,

        });
    });
</script>




<script>
    $(document).ready(function() {
        $('.formTNO').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanTNO').attr('disable', 'disabled');
                    $('.btnsimpanTNO').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanTNO').removeAttr('disable');
                    $('.btnsimpanTNO').html('Simpan');
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

                        // resumeTNO();
                        $('#name').val('');
                        $('#price').val('');
                        //dataresume();
                        dataTNOMedis();

                    }
                }


            });
            return false;
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        var kelas = document.getElementById("classroom").value;
        $("#name").autocomplete({
            source: "<?php echo base_url('PelayananIGD/ajax_pelayanan'); ?>?kelas=" + kelas,
            select: function(event, ui) {
                $('#name').val(ui.item.value);
                $('#code').val(ui.item.code);
                $('#groupname').val(ui.item.groupname);
                $('#price').val(ui.item.price);

                $('#category').val(ui.item.category);
                $('#groups').val(ui.item.groups);
                $('#share1').val(ui.item.share1ori);
                $('#share2').val(ui.item.share2ori);
                $('#types').val(ui.item.types);

            }
        });
    });
</script>

<script type="text/javascript">
    $('#pelaksana').on('change', function() {
        if ($('#pelaksana').val() == 1) {
            $('#paramedicName').removeAttr('disabled');
            $('#pelaksana').val(0);
            $('#pelaksana2').val(1);

        } else {
            $('#paramedicName').attr('disabled', 'disabled');
            $('#pelaksana').val(1);
            $('#pelaksana2').val(0);
        }
    })
</script>


<script>
    function dataTNOMedis() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeTNOMedisIGD') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewTnoMedis').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataTNOMedis();

    });
</script>