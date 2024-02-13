<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<div id="modaleditFRS" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Edit Data Dasar Pasien Forensik => Token Bill Forensik (<?= $token_radiologi; ?>)</h4>
            </div>

            <?= form_open('PelayananFRS/updatedata', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>

            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-body">

                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Norm</label>
                                    <input type="text" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                                    <input type="hidden" id="id" name="id" class="form-control" value="<?= $id; ?>" readonly>
                                    <input type="hidden" id="statuspasien" name="statuspasien" class="form-control" value="DIRAWAT" readonly>
                                    <input type="hidden" id="statusrawatinap" name="statusrawatinap" class="form-control" value="RAWAT" readonly>

                                    <?php
                                    helper('text');
                                    $token = random_string('alnum', 8);
                                    ?>
                                    <input type="hidden" id="token_ranap" name="token_ranap" class="form-control" value="<?= $token; ?>">
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
                                    <input type="text" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>">

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->


                        <div class="row pt-1">

                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Daftar</label>
                                    <input type="text" id="datetimein" name="datetimein" class="form-control" value="<?= $datetimein; ?>">

                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kelas Perawatan</label>
                                    <input type="text" id="classroom" name="classroom" class="form-control" value="<?= $classroom; ?>" readonly>
                                    <input type="hidden" id="classroomname" name="classroomname" class="form-control" value="<?= $classroomname; ?>">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Ruang Perawatan</label>
                                    <input type="text" id="roomname" name="roomname" class="form-control" value="<?= $roomname; ?>" readonly>
                                    <input type="hidden" id="room" name="room" class="form-control" value="<?= $room; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Cara Bayar</label>
                                    <input type="text" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                </div>
                            </div>


                            <!--/span-->
                        </div>

                        <!--/row-->


                        <div class="row pt-1">

                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">No. Asuransi/Jaminan</label>
                                    <input type="text" id="paymentcardnumber" name="paymentcardnumber" class="form-control" value="<?= $paymentcardnumber; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">SMF</label>
                                    <input type="text" id="smfname" name="smfname" class="form-control" value="<?= $smfname; ?>" readonly>
                                    <input type="hidden" id="smf" name="smf" class="form-control" value="<?= $smf; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Dokter Pemohon</label>
                                    <select name="ibsdoktername" id="ibsdoktername" class="select2" style="width: 100%">
                                        <option></option>
                                        <?php foreach ($list as $dpjp) { ?>
                                            <option data-id="<?= $dpjp['id']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $doktername) { ?> selected="selected" <?php } ?>><?php echo $dpjp['name']; ?></option>

                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="ibsdokter" id="ibsdokter" value="<?= $dokter; ?>">
                                    <div class="form-control-feedback erroribsdoktername">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Diagnosa</label>
                                    <input type="text" id="icdxname" name="icdxname" class="form-control" value="<?= $icdxname; ?>">
                                </div>
                            </div>

                            <!--/span-->
                        </div>

                        <!--/row-->

                        <!--/row-->
                        <div class="row pt-1">



                            <?php

                            $datedari = $tglspr;
                            $DateAwal = date("m/d/Y", strtotime($datedari));

                            ?>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Permohonan</label>
                                    <input type="text" id="datepicker-autoclose" value="<?= $DateAwal; ?>" autocomplete="off" name="tglspr" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Memo</label>
                                    <input type="text" id="memo" name="memo" class="form-control" value="<?= $memo; ?>">
                                    <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                    <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>" readonly>
                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                                    <input type="hidden" id="validation" name="validation" class="form-control" value="SUDAH" readonly>
                                    <input type="hidden" id="statuspasien" name="statuspasien" class="form-control" value="RAWAT" readonly>
                                    <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control" value="" readonly>
                                    <input type="hidden" id="datein" name="datein" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                    <input type="hidden" id="timein" name="timein" class="form-control" value="<?= date('H:i:s'); ?>" readonly>
                                    <input type="hidden" id="datetimein" name="datetimein" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                    <input type="hidden" id="statusrawatinap" name="statusrawatinap" class="form-control" value="RAWAT" readonly>
                                    <input type="hidden" id="validationdate" name="validationdate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                    <input type="hidden" id="validationby" name="validationby" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                                    <input type="hidden" id="validation" name="validation" class="form-control" value="SUDAH" readonly>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select name="status" id="status" class="select2" style="width: 100%">
                                        <option value="ORDER" <?php if ($status == 'ORDER') echo "selected"; ?>>ORDER</option>
                                        <option value="APPROVED" <?php if ($status == 'APPROVED') echo "selected"; ?>>APPROVED</option>
                                        <option value="REJECTED" <?php if ($status == 'REJECTED') echo "selected"; ?>>REJECTED</option>
                                        <option value="REGULER" <?php if ($status == 'REGULER') echo "selected"; ?>>REGULER</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Dokter Pemeriksa</label>
                                    <select name="doktername" id="doktername" class="select2" style="width: 100%">
                                        <option value="">Pilih Dokter Pemeriksa</option>
                                        <?php foreach ($listdokter as $dpjp) { ?>
                                            <option data-id="<?= $dpjp['id']; ?>" class="select-dokter" <?php if ($dpjp['name'] == $employeename) { ?> selected="selected" <?php } ?>><?php echo $dpjp['name']; ?></option>

                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="dokter" id="dokter" value="<?= $employee; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Simpan</button>
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
        var page = document.getElementById("token_ranap").value;

        window.location.href = "<?php echo base_url('rawatinap/inputdetailibs'); ?>?page=" + page;
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



                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modaleditFRS').modal('hide');
                                dataperawat();

                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>

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

        $('#classroom').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_kelas') ?>",
                'data': {
                    key: $('#classroom option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#classroomname').val(data.name);
                    $('#classroom').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })


        $('#roomname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_room') ?>",
                'data': {
                    key: $('#roomname option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#roomname').val(data.roomname);
                    $('#room').val(data.room);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#doktername').on('change', function() {
            $.ajax({
                'type': "POST",
                'url': "<?php echo base_url('autocomplete/fill_dokter_penunjang') ?>",
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

    });
</script>