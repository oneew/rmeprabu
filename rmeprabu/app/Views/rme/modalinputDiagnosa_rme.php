<div id="modalinputDiagnosa_rme" class="modal fade" id="bs-example-modal-lg" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Kodifikasi Diagnosa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="form-filter-bawah" style="display: block;">
                    <?= form_open('RekMedCodingRajal/simpanDiagnosaDetail', ['class' => 'formTNO']); ?>
                    <?= csrf_field(); ?>
                    <form method="post" id="form-filter">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">ICD X</label>
                                    <input type="text" id="name" name="name" class="form-control">

                                    <input type="hidden" id="codingicdx" codingicdx="name" class="form-control" value="ICDX">
                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber_header; ?>" readonly>
                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                    <input type="hidden" id="referencenumber_rawatinap" name="referencenumber_rawatinap" class="form-control" value="NONE" readonly>
                                    <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $poliklinik; ?>" readonly>
                                    <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $poliklinikname; ?>" readonly>
                                    <input type="hidden" id="groups" name="groups" class="form-control" value="<?= $groups; ?>" readonly>
                                    <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control" value="<?= $bpjs_sep; ?>" readonly>
                                    <input type="hidden" id="oldcode" name="oldcode" class="form-control" value="<?= $oldcode; ?>" readonly>
                                    <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                                    <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                    <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>" readonly>
                                    <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                    <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                    <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                    <input type="hidden" id="pasienname" name="pasienname" class="form-control" value="<?= $pasienname; ?>" readonly>
                                    <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                                    <input type="hidden" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $paymentmethodname; ?>" readonly>

                                    <input type="hidden" id="paymentcardnumber" name="paymentcardnumber" class="form-control" value="<?= $paymentcardnumber; ?>" readonly>
                                    <input type="hidden" id="pasienclassroom" name="pasienclassroom" class="form-control" value="<?= $pasienclassroom; ?>" readonly>
                                    <input type="hidden" id="classroom" name="classroom" class="form-control" value="<?= $classroom; ?>" readonly>
                                    <input type="hidden" id="classroomname" name="classroomname" class="form-control" value="<?= $classroomname; ?>" readonly>
                                    <input type="hidden" id="bednumber" name="bednumber" class="form-control" value="<?= $bednumber; ?>" readonly>
                                    <input type="hidden" id="smf" name="smf" class="form-control" value="<?= $smf; ?>" readonly>
                                    <input type="hidden" id="smfname" name="smfname" class="form-control" value="<?= $smfname; ?>" readonly>
                                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="RCM" readonly>
                                    <input type="hidden" id="locationname" name="locationname" class="form-control" value="REKAM MEDIS" readonly>
                                    <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>" readonly>
                                    <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $umur; ?>" readonly>
                                    <input type="hidden" id="age_years" name="age_years" class="form-control" value="<?= $age_years; ?>" readonly>
                                    <input type="hidden" id="age_months" name="age_months" class="form-control" value="<?= $age_months; ?>" readonly>
                                    <input type="hidden" id="age_days" name="age_days" class="form-control" value="<?= $age_days; ?>" readonly>
                                    <input type="hidden" id="date_pelayanan" name="date_pelayanan" class="form-control" value="<?= $documentdate; ?>" readonly>

                                    <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                    <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>" readonly>
                                    <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                    <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                    <input type="hidden" id="dokter_detail" name="dokter_detail" class="form-control" value="<?= $dokter; ?>" readonly>
                                    <input type="hidden" id="doktername_detail" name="doktername_detail" class="form-control" value="<?= $doktername; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Deskripsi</label>
                                    <input type="hidden" id="codeicdx" name="codeicdx" class="form-control">
                                    <input type="text" id="nameicdx" name="nameicdx" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Diagnosa Primer ? </label>
                                    <div class="switch">
                                        <label>Tidak
                                            <input type="checkbox" value="1" name="diagnosaprimer" id="diagnosaprimer"><span class="lever"></span>Ya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">ICD IX</label>
                                    <input type="text" id="namaicdix" name="namaicdix" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Deskripsi ICD IX</label>
                                    <input type="text" id="nameicdix" name="nameicdix" class="form-control">
                                    <input type="hidden" id="icdix" name="icdix" class="form-control">
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
                            <div class="col-md-12 viewdataresumediagnosa">

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

                        if (response.error.documentdate) {
                            $('#documentdate').addClass('form-control-danger');
                            $('.errordocumentdate').html(response.error.documentdate);
                        } else {
                            $('#documentdate').removeClass('form-control-danger');
                            $('.errordocumentdate').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        //$('#modaltambah').modal('hide');

                        //resumeTNO();
                        $('#name').val('');
                        $('#codeicdx').val('');
                        $('#nameicdx').val('');
                        $('#namaicdix').val('');
                        $('#icdix').val('');
                        $('#nameicdix').val('');
                        dataresumediagnosa();

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
            source: "<?php echo base_url('PelayananRawatJalan/ajax_pelayanan'); ?>?kelas=" + kelas,
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
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeTNOMedisRajal') ?>",
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



<script>
    function dataresumediagnosa() {

        $.ajax({

            url: "<?php echo base_url('RekMedCodingRajal/resumediagnosasekarang') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataresumediagnosa').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresumediagnosa();


    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $("#name").autocomplete({
            source: "<?php echo base_url('RekMedCodingRajal/ajax_icdx'); ?>",
            select: function(event, ui) {
                $('#name').val(ui.item.value);
                $('#codeicdx').val(ui.item.originalcode);
                $('#nameicdx').val(ui.item.nameicdx);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#namaicdix").autocomplete({
            source: "<?php echo base_url('RekMedCodingRajal/ajax_icdix'); ?>",
            select: function(event, ui) {
                $('#namaicdix').val(ui.item.value);
                $('#icdix').val(ui.item.originalcode);
                $('#nameicdix').val(ui.item.nameicdix);
            }
        });
    });
</script>