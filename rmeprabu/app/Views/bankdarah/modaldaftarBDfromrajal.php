<div id="modaldaftarBDfromrajal" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Form Pendafaran Radiologi(Pasien Rawat Jalan & IGD)</h4>
            </div>

            <?= form_open('RegBD/simpandatafromrajal', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>

            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-body">

                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Norm</label>
                                    <input type="text" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>

                                    <?php
                                    helper('text');
                                    $token = random_string('alnum', 8);
                                    ?>
                                    <input type="hidden" id="token_radiologi" name="token_radiologi" class="form-control" value="<?= $token; ?>">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nama Pasien</label>
                                    <input type="text" id="pasienname" name="pasienname" class="form-control" value="<?= $pasienname; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Lahir</label>
                                    <input type="text" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasiendateofbirth; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>" readonly>

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->


                        <div class="row pt-1">

                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Pelayanan</label>
                                    <input type="text" id="datetimein" name="datetimein" class="form-control" value="<?= $documentdate; ?>" readonly>

                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Poliklinik</label>
                                    <input type="text" id="roomname" name="roomname" value="<?= $poliklinikname; ?>" class="form-control" readonly>

                                    <?php

                                    if ($groups == "IGD") {
                                        $kelas = "IGD";
                                        $jeniskelas = "INSTALASI GAWAT DARURAT";
                                    } else {
                                        if ($groups == "IRJ") {
                                            $kelas = "IRJ";
                                            $jeniskelas = "INSTALASI RAWAT JALAN";
                                        }
                                    }

                                    ?>
                                    <input type="hidden" id="classroom" value="<?= $kelas; ?>" name="classroom" class="form-control" readonly>
                                    <input type="hidden" id="classroomname" value="<?= $jeniskelas; ?>" name="classroomname" class="form-control" readonly>


                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Dokter Pemeriksa</label>
                                    <input type="hidden" id="room" name="room" value="<?= $poliklinik; ?>" class="form-control" readonly>
                                    <input type="hidden" id="dokterpoli" name="dokterpoli" class="form-control" value="<?= $dokter; ?>" readonly>
                                    <input type="text" id="dokterpoliname" name="dokterpoliname" class="form-control" value="<?= $doktername; ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Cara Bayar</label>
                                    <input type="hidden" id="bednumber" name="bednumber" class="form-control" readonly>
                                    <input type="text" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $paymentmethodname; ?>" readonly>


                                </div>
                            </div>
                            <!--/span-->
                        </div>

                        <!--/row-->


                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">No.Kartu Jaminan</label>
                                    <input type="text" id="paymentcardnumber" name="paymentcardnumber" class="form-control" value="<?= $paymentcardnumber; ?>" readonly>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Dokter Pemohon</label>
                                    <select name="ibsdoktername" id="ibsdoktername" class="select2" style="width: 100%">
                                        <option></option>
                                        <?php foreach ($list as $dpjp) { ?>
                                            <option data-id="<?= $dpjp['id']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $doktername) { ?> selected="selected" <?php } ?>><?= $dpjp['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="ibsdokter" id="ibsdokter" value="<?= $dokter; ?>">
                                    <div class="form-control-feedback erroribsdoktername">
                                    </div>

                                </div>
                            </div>
                            <!--/span-->

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Permohonan</label>
                                    <input type="hidden" id="smfname" name="smfname" class="form-control" value="<?= $smfname; ?>" readonly>
                                    <input type="hidden" id="smf" name="smf" class="form-control" value="<?= $smf; ?>" readonly>
                                    <input type="date" id="tgl_order" autocomplete="off" name="tgl_order" class="form-control" value="<?= date('Y-m-d'); ?>">
                                    <input type="hidden" id="icdxname" name="icdxname" class="form-control" value="<?= $icdxname; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Memo</label>
                                    <input type="text" id="memo" name="memo" class="form-control">
                                    <input type="hidden" id="note" name="note" value="REGULER" class="form-control">
                                    <input type="hidden" id="status" name="status" value="REGULER" class="form-control">

                                    <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" readonly>
                                    <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                    <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>" readonly>
                                    <input type="hidden" id="oldcode" name="oldcode" class="form-control" value="<?= $oldcode; ?>" readonly>
                                    <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                    <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $pasienage; ?>" readonly>
                                    <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                                    <input type="hidden" id="validation" name="validation" class="form-control" value="BELUM" readonly>
                                    <input type="hidden" id="cash" name="cash" class="form-control" value="0.00" readonly>
                                    <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                    <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                    <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                    <input type="hidden" id="registernumber" name="registernumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                    <input type="hidden" id="registernumber_rawatjalan" name="registernumber_rawatjalan" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                    <input type="hidden" id="registernumber_rawatinap" name="registernumber_rawatinap" class="form-control" readonly>
                                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="DARAH" readonly>
                                    <input type="hidden" id="locationname" name="locationname" class="form-control" value="BANK DARAH" readonly>
                                    <input type="hidden" id="employee" name="employee" class="form-control" value="BD_00001" readonly>
                                    <input type="hidden" id="employeename" name="employeename" class="form-control" value="IIS RUSTINIH, DR" readonly>
                                    <input type="hidden" id="paymentmethodnameori" name="paymentmethodnameori" class="form-control" value="<?= $paymentmethodnameori; ?>" readonly>
                                    <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                    <input type="hidden" id="paymentmethodori" name="paymentmethodori" class="form-control" value="<?= $paymentmethodori; ?>" readonly>
                                    <input type="hidden" id="paymentmethod_payment" name="paymentmethod_payment" class="form-control" value="<?= $paymentmethod_payment; ?>" readonly>
                                    <input type="hidden" id="paymentmethodname_payment" name="paymentmethodname_payment" class="form-control" value="<?= $paymentmethodname_payment; ?>" readonly>
                                    <input type="hidden" id="reasoncode" name="reasoncode" class="form-control" value="<?= $reasoncode; ?>" readonly>
                                    <input type="hidden" id="statuspasien" name="statuspasien" class="form-control" value="REGISTRASI" readonly>
                                    <input type="hidden" id="lokasilakalantas" name="lokasilakalantas" class="form-control" value="<?= $lokasilakalantas; ?>" readonly>
                                    <input type="hidden" id="dokter" name="dokter" class="form-control" value="<?= $dokter; ?>" readonly>
                                    <input type="hidden" id="doktername" name="doktername" class="form-control" value="<?= $doktername; ?>" readonly>
                                    <input type="hidden" id="icdx" name="icdx" class="form-control" value="<?= $icdx; ?>" readonly>
                                    <input type="hidden" id="groups" name="groups" class="form-control" value="BD" readonly>
                                    <input type="hidden" id="types" name="types" class="form-control" value="RM" readonly>
                                    <input type="hidden" id="visited" name="visited" class="form-control" value="K1" readonly>
                                    <input type="hidden" id="parentjournalnumber" name="parentjournalnumber" class="form-control" value="NONE" readonly>
                                    <input type="hidden" id="transferjournalnumber" name="transferjournalnumber" class="form-control" value="NONE" readonly>
                                    <input type="hidden" id="bpjs_sep_poli" name="bpjs_sep_poli" class="form-control" value="<?= $bpjs_sep; ?>" readonly>
                                    <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control" value="" readonly>
                                    <input type="hidden" id="noantrian" name="noantrian" class="form-control" value="" readonly>
                                    <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $poliklinik; ?>" readonly>
                                    <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $poliklinikname; ?>" readonly>
                                    <input type="hidden" id="faskes" name="faskes" class="form-control" value="<?= $faskes; ?>" readonly>
                                    <input type="hidden" id="faskesname" name="faskesname" class="form-control" value="<?= $faskesname; ?>" readonly>

                                    <input type="hidden" id="datein" name="datein" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                    <input type="hidden" id="timein" name="timein" class="form-control" value="<?= date('H:i:s'); ?>" readonly>
                                    <input type="hidden" id="datetimein" name="datetimein" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                    <input type="hidden" id="parentid" name="parentid" class="form-control" value="NONRM" readonly>
                                    <input type="hidden" id="statusrawatinap" name="statusrawatinap" class="form-control" value="REGISTER" readonly>


                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Golongan Darah</label>
                                <input type="text" id="goldar" name="goldar" class="form-control">
                            </div>
                        </div>
                        <!--/row-->
                        <!--/row-->

                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Daftarkan</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    function berangkat() {
        var page = document.getElementById("token_radiologi").value;

        window.location.href = "<?php echo base_url('PelayananBD/inputdetailBD'); ?>?page=" + page;
    }
</script>

<script>
    $(document).ready(function() {
        $('.formperawat').submit(function(e) {
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
                        if (response.error.ibsdoktername) {
                            $('#ibsdoktername').addClass('form-control-danger');
                            $('.erroribsdoktername').html(response.error.ibsdoktername);
                        } else {
                            $('#ibsdoktername').removeClass('form-control-danger');
                            $('.erroribsdoktername').html('');
                        }

                        if (response.error.ibsanestesiname) {
                            $('#ibsanestesiname').addClass('form-control-danger');
                            $('.erroribsanestesiname').html(response.error.ibsanestesiname);
                        } else {
                            $('#ibsanestesiname').removeClass('form-control-danger');
                            $('.errorKelompok').html('');
                        }

                        if (response.error.email) {
                            $('#email').addClass('form-control-danger');
                            $('.errorEmail').html(response.error.email);
                        } else {
                            $('#email').removeClass('form-control-danger');
                            $('.errorEmail').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modaldaftarBDfromrajal').modal('hide');
                                berangkat();
                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
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



<!-- <script type="text/javascript" src="../js/jquery.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {

        $('#ibsdoktername').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#ibsdoktername option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#ibsdoktername').val(data.name);
                    $('#ibsdokter').val(data.code);

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