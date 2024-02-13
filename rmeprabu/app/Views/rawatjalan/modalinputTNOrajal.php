<div id="modalinputTNOrajal" class="modal fade" id="bs-example-modal-lg" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tindakan Medis</h4>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="form-filter-atas">
                    <?= form_open('PelayananRawatJalan/simpanTNOheader', ['class' => 'formperawatheader']); ?>
                    <?= csrf_field(); ?>
                    <form method="post" id="form-filter">
                        <div class="form-body">
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Pelayanan</label>
                                        <input type="hidden" id="referencenumber_TH" name="referencenumber_TH" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                        <input type="hidden" id="poliklinik_TH" name="poliklinik_TH" class="form-control" value="<?= $poliklinik; ?>" readonly>
                                        <input type="date" id="documentdate_TH" name="documentdate_TH" class="form-control" value="<?= date('Y-m-d'); ?>">

                                        <input type="hidden" id="documentyear_TH" name="documentyear_TH" class="form-control" value="<?= date('Y'); ?>" readonly>
                                        <input type="hidden" id="documentmonth_TH" name="documentmonth_TH" class="form-control" value="<?= date('m'); ?>" readonly>

                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Advice Dokter</label>
                                        <select name="doktername_TH" id="doktername_TH" class="select2" style="width: 100%">
                                            <option></option>
                                            <?php foreach ($list as $do) {
                                                $selected = ($do['name'] == $doktername) ? 'selected' : '';
                                            ?>
                                                <option data-id="<?= $do['id']; ?>" <?= $selected; ?> class="select-dokter"><?= $do['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" id="dokter_TH" name="dokter_TH" class="form-control" value="<?= $dokter; ?>" readonly>
                                        <input type="hidden" id="bpjs_sep_TH" name="bpjs_sep_TH" class="form-control" value="<?= $bpjs_sep; ?>" readonly>
                                        <input type="hidden" id="noantrian_TH" name="noantrian_TH" class="form-control" value="<?= $noantrian; ?>" readonly>
                                        <input type="hidden" id="poliklinik_TH" name="poliklinik_TH" class="form-control" value="<?= $poliklinik; ?>" readonly>
                                        <input type="hidden" id="poliklinikname_TH" name="poliklinikname_TH" class="form-control" value="<?= $poliklinikname; ?>" readonly>
                                        <input type="hidden" id="groups_TH" name="groups_TH" class="form-control" value="IRJ" readonly>
                                        <input type="hidden" id="journalnumber_TH" name="journalnumber_TH" class="form-control" readonly>

                                        <input type="hidden" id="registernumber_TH" name="registernumber_TH" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                        <input type="hidden" id="referencenumber_TH" name="referencenumber_TH" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                        <input type="hidden" id="pasienid_TH" name="pasienid_TH" class="form-control" value="<?= $pasienid; ?>" readonly>
                                        <input type="hidden" id="oldcode_TH" name="oldcode_TH" class="form-control" value="<?= $oldcode; ?>" readonly>
                                        <input type="hidden" id="pasienname_TH" name="pasienname_TH" class="form-control" value="<?= $pasienname; ?>" readonly>
                                        <input type="hidden" id="pasiengender_TH" name="pasiengender_TH" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                        <input type="hidden" id="pasienage_TH" name="pasienage_TH" class="form-control" value="<?= $pasienage; ?>" readonly>
                                        <input type="hidden" id="pasiendateofbirth_TH" name="pasiendateofbirth_TH" class="form-control" value="<?= $pasiendateofbirth; ?>" readonly>
                                        <input type="hidden" id="pasienaddress_TH" name="pasienaddress_TH" class="form-control" value="<?= $pasienaddress; ?>" readonly>
                                        <input type="hidden" id="pasienarea_TH" name="pasienarea_TH" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                        <input type="hidden" id="pasiensubarea_TH" name="pasiensubarea_TH" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                        <input type="hidden" id="pasiensubareaname_TH" name="pasiensubareaname_TH" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                        <input type="hidden" id="paymentmethod_TH" name="paymentmethod_TH" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                        <input type="hidden" id="paymentmethodname_TH" name="paymentmethodname_TH" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                                        <input type="hidden" id="paymentcardnumber_TH" name="paymentcardnumber_TH" class="form-control" value="<?= $paymentcardnumber; ?>" readonly>
                                        <input type="hidden" id="smfname_TH" name="smfname_TH" class="form-control" value="<?= $smfname; ?>" readonly>
                                        <input type="hidden" id="smf_TH" name="smf_TH" class="form-control" value="<?= $smf; ?>" readonly>
                                        <input type="hidden" id="classroom_TH" name="classroom_TH" class="form-control" value="<?= $classroom; ?>" readonly>
                                        <input type="hidden" id="classroomname_TH" name="classroomname_TH" class="form-control" value="<?= $classroomname; ?>" readonly>
                                        <input type="hidden" id="room_TH" name="room_TH" class="form-control" value="<?= $roomfisik; ?>" readonly>
                                        <input type="hidden" id="roomname_TH" name="roomname_TH" class="form-control" value="<?= $roomfisikname; ?>" readonly>
                                        <input type="hidden" id="locationcode_TH" name="locationcode_TH" class="form-control" value="PORTIR-RJ" readonly>
                                        <input type="hidden" id="locationname_TH" name="locationname_TH" class="form-control" value="PENDAFTARAN RAWAT JALAN" readonly>
                                        <input type="hidden" id="referencenumberparent_TH" name="referencenumberparent_TH" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="parentid_TH" name="parentid_TH" class="form-control" value="NONRM" readonly>
                                        <input type="hidden" id="parentname_TH" name="parentname_TH" class="form-control" value="" readonly>
                                        <input type="hidden" id="createddate_TH" name="createddate_TH" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                        <input type="hidden" id="createdby_TH" name="createdby_TH" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i> Tambah</button>
                            <button type="button" class="btn btn-inverse" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                    <?= form_close() ?>
                </div>


                <div id="form-filter-bawah" style="display: none;">
                    <?= form_open('PelayananRawatJalan/simpanTNODetail', ['class' => 'formTNO']); ?>
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
                                <!--/span-->
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
                                        <input type="hidden" id="journalnumber" name="journalnumber" class="form-control">
                                        <input type="hidden" id="documentdate" name="documentdate" class="form-control" readonly>
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
                                        <input type="hidden" id="dokter" name="dokter" class="form-control" readonly>
                                        <input type="hidden" id="doktername" name="doktername" class="form-control" readonly>
                                        <input type="hidden" id="employee" name="employee" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="employeename" name="employeename" class="form-control" value="" readonly>
                                        <input type="hidden" id="registernumber" name="registernumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                        <input type="hidden" id="referencenumberparent" name="referencenumberparent" class="form-control" value="NONE" readonly>
                                        <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
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
                                <div class="col-md-4">
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label">Qty</label>
                                        <input type="text" id="qty" name="qty" class="form-control" value="1.00">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Tarif</label>
                                        <input type="text" id="price" name="price" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">BHP</label>
                                        <input type="text" id="bhp" name="bhp" class="form-control" value="0.00">
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
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
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


<script type="text/javascript">
    $(document).ready(function() {

        $('#doktername_TH').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#doktername_TH option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#doktername_TH').val(data.name);
                    $('#dokter_TH').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })
    });
</script>

<script>
    $(document).ready(function() {
        $('.formperawatheader').submit(function(e) {
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
                            $('.erroroktername').html('');
                        }

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

                        $('#form-filter-atas').css('display', 'none');
                        $('#form-filter-bawah').css('display', 'block');
                        $('#journalnumber').val(response.JN);
                        $('#kode').val(response.JN);
                        $('#dokter').val(response.dokter);
                        $('#doktername').val(response.doktername);
                        $('#documentdate').val(response.tanggalpelayanan);

                    }
                }


            });
            return false;
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
                        // Swal.fire({
                        //     icon: 'success',
                        //     title: 'Berhasil',
                        //     text: response.sukses,

                        // })

                        //$('#modaltambah').modal('hide');

                        resumeTNO();
                        $('#name').val('');
                        $('#price').val('');
                        dataresume();

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