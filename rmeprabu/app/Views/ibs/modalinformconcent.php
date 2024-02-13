<link href="<?= base_url(); ?>/assets/plugins/summernote/dist/summernote-bs4.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">

<div id="slimtest4">
    <div id="modalinformconcent" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Form Persetujuan Tindakan/Prosedur Operasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <?= form_open('EdukasiBedah/simpaninformconcent', ['class' => 'formperawat']); ?>

                <?= csrf_field(); ?>

                <div class="modal-body">
                    <from class="form-horizontal form-material" method="post">
                        <div class="form-body">

                            <?php
                            foreach ($edukasi as $row) :
                            ?>
                                <div class="row mt-1">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Norm</label>
                                            <input type="hidden" id="id" name="id" class="form-control" value="<?= $row['id']; ?>" readonly>
                                            <input type="text" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                                            <input type="hidden" id="date_informconcent" name="date_informconcent" class="form-control" value="<?php
                                                                                                                                                if ($row['date_informconcent'] == '1990-01-01') {
                                                                                                                                                    echo date('Y-m-d');
                                                                                                                                                } else {
                                                                                                                                                    echo $row['date_informconcent'];
                                                                                                                                                } ?>" readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Nama Pasien</label>
                                            <input type="text" id="pasienname" name="pasienname" class="form-control" value="<?= $pasienname; ?>" readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label">Tanggal Lahir</label>
                                            <input type="text" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasiendateofbirth; ?>" readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="control-label">Jenkel</label>
                                            <input type="text" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>" readonly>

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

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Wilayah</label>
                                            <input type="text" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                            <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label"><code>Penerima Informasi</code></label>
                                            <input type="text" id="namapjb" name="namapjb" class="form-control" value="<?= $namapjb; ?>" required>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="control-label"><code>Tgl Lahir Penerima Informasi</code></label>
                                            <input type="text" id="mdate" autocomplete="off" name="pjbdateofbirth" class="form-control" value="<?= $row['pjbdateofbirth']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label class="control-label">Jenkel PJB</label>
                                            <div class="switch">
                                                <label>Lelaki
                                                    <input type="checkbox" value="1" name="pjbgender" id="pjbgender"><span class="lever"></span>Perempuan</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Alamat Penanggung Jawab</label>
                                            <input type="text" id="alamatpjb" name="alamatpjb" class="form-control" value="<?= $alamatpjb; ?>">

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">SMF</label>
                                            <input type="text" id="smfname" name="smfname" class="form-control" value="<?= $smfname; ?>" readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Dokter Penangung Jawab</label>
                                            <input type="text" id="doktername" name="doktername" class="form-control" value="<?= $doktername; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Dokter Bedah</label>
                                            <input type="text" id="ibsdoktername" name="ibsdoktername" class="form-control" value="<?= $ibsdoktername; ?>" readonly>
                                            <div class="form-control-feedback erroribsdoktername">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Dokter Anestesi</label>
                                            <input type="text" id="ibsanestesiname" name="ibsanestesiname" class="form-control" value="<?= $ibsanestesiname; ?>" readonly>
                                            <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="<?= $locationcode; ?>" readonly>
                                            <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                                            <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= $documentdate; ?>" readonly>
                                            <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                            <input type="hidden" id="registernumber" name="registernumber" class="form-control" value="<?= $registernumber; ?>" readonly>
                                            <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                            <input type="hidden" id="classroom" name="classroom" class="form-control" value="<?= $classroom; ?>" readonly>
                                            <input type="hidden" id="smf" name="smf" class="form-control" value="<?= $smf; ?>" readonly>
                                            <input type="hidden" id="room" name="room" class="form-control" value="<?= $room; ?>" readonly>
                                            <input type="hidden" id="signature" name="signature" class="form-control tandatangan">
                                            <input type="hidden" id="signaturepaham" name="signaturepaham" class="form-control paham">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><code>Diagnosis Dan Dasar Diagnosis</code></label>
                                            <input type="text" id="diagnosis" name="diagnosis" class="form-control" value="<?= $row['diagnosis']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><code>Kondisi Pasien</code></label>
                                            <textarea id="kondisipasien" name="kondisipasien" class="textarea_editor form-control" rows="3"><?= $row['kondisipasien']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><code>Tindakan Kedokteran Diusulkan</code></label>
                                            <input type="text" id="name" name="name" class="form-control" value="<?= $row['name']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><code>Tata Cara Dan Tujuan Tindakan</code></label>
                                            <textarea id="tatacara" name="tatacara" class="textarea_editor form-control" rows="3"><?= $row['tatacara']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><code>Manfaat Tindakan</code></label>
                                            <textarea id="manfaattindakan" name="manfaattindakan" class="textarea_editor form-control" rows="3"><?= $row['manfaattindakan']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><code>Risiko Tindakan</code></label>
                                            <textarea id="risikotindakan" name="risikotindakan" class="textarea_editor form-control" rows="3"><?= $row['risikotindakan']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><code>Kemungkinan Alternatif Tindakan</code></label>
                                            <textarea id="alternatif" name="alternatif" class="textarea_editor form-control" rows="3"><?= $row['alternatif']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><code>Prognosis Dari Tindakan</code></label>
                                            <textarea id="prognosistindakan" name="prognosistindakan" class="textarea_editor form-control" rows="3"><?= $row['prognosistindakan']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><code>Kemungkinan Hasil Tidak terduga</code></label>
                                            <textarea id="hasiltidakterduga" name="hasiltidakterduga" class="textarea_editor form-control" rows="3"><?= $row['hasiltidakterduga']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><code>Kemungkinan Hasil Bila Tidak Dilakukan Tindakan</code></label>
                                            <textarea id="bilatidakditindak" name="bilatidakditindak" class="textarea_editor form-control" rows="3"><?= $row['bilatidakditindak']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <p><b>Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara benar dan jelas dan memberikan kesempatan untuk bertanya dan/atau berdiskusi :</b></p>

                                            <div class="js-signatureDiskusi" data-width="350" data-height="100" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="false"></div>
                                            <p><button id="clearBtnDiskusi" class="btn btn-default">Clear Canvas</button></p>
                                            <div id="signature">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group has-success">
                                            <p><b>Dengan ini menyatakan bahwa saya telah menerima informasi dari dokter dan telah memahaminya :</b></p>

                                            <div class="js-signaturePaham" data-width="350" data-height="100" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="false"></div>
                                            <p><button id="HapusPaham" class="btn btn-default">Clear Canvas</button></p>
                                            <div id="signaturePaham">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if ($row['signature_diskusi'] <> 'NONE') { ?>
                                        <div class="col-md-6">
                                            <div class="form-group has-success">
                                                <p>Sign Pemberi Informasi :</p>
                                                <div class="el-card-item">
                                                    <div class="el-card-avatar el-overlay-1"> <img src="<?= $row['signature_diskusi'] ?>" alt="user" />
                                                        <div class="el-overlay">
                                                            <ul class="el-info">

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($row['signature_informasi'] <> 'NONE') { ?>
                                        <div class="col-md-6">
                                            <div class="form-group has-success">
                                                <p>Sign Penerima Informasi :</p>
                                                <div class="el-card-item">
                                                    <div class="el-card-avatar el-overlay-1"> <img src="<?= $row['signature_informasi'] ?>" alt="user" />
                                                        <div class="el-overlay">
                                                            <ul class="el-info">

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>


                            <?php endforeach; ?>

                        </div>
                    </from>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnsimpanPersetujuan"><i class="fa fa-check"></i> Simpan Persetujuan</button>
                    <button id="print" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Inform Consent</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-home"></i> Kembali</button>
                </div>

                <?= form_close() ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

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
                    $('.btnsimpanPersetujuan').attr('disable', 'disabled');
                    $('.btnsimpanPersetujuan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanPersetujuan').removeAttr('disable');
                    $('.btnsimpanPersetujuan').html('Update');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.doktername) {
                            $('#ibsdoktername').addClass('is-invalid');
                            $('.erroribsoktername').html(response.error.doktername);
                        } else {
                            $('#ibsdoktername').removeClass('is-invalid');
                            $('.erroribsdoktername').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        //$('#modaledit').modal('hide');
                        dataperawat();

                    }
                }


            });
            return false;
        });
    });
</script>



<script>
    $(document).ready(function() {
        if ($('.js-signatureDiskusi').length) {
            $('.js-signatureDiskusi').jqSignature();
        }

        $('#clearBtnDiskusi').on('click', function(e) {
            e.preventDefault();
            $('.js-signatureDiskusi').eq(0).jqSignature('clearCanvas');
            $('#saveBtn').attr('disabled', true);

        });

        $('#saveBtn').on('click', function() {
            let save = $('.js-signatureDiskusi').eq(0).jqSignature('getDataURL');
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('Signature/insert_sign') ?>",
                data: {
                    signature: save
                },
                success: function(response) {
                    $('.list-sign').append(response);
                }
            });

        });

        $('.js-signatureDiskusi').eq(0).on('jq.signature.changed', function() {
            $('.tandatangan').val($(this).jqSignature('getDataURL'));

        });
    });
</script>

<script>
    $(document).ready(function() {
        if ($('.js-signaturePaham').length) {
            $('.js-signaturePaham').jqSignature();
        }

        $('#HapusPaham').on('click', function(e) {
            e.preventDefault();
            $('.js-signaturePaham').eq(0).jqSignature('clearCanvas');
            $('#saveBtn').attr('disabled', true);

        });

        $('#saveBtn').on('click', function() {
            let save = $('.js-signaturePaham').eq(0).jqSignature('getDataURL');
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('Signature/insert_sign') ?>",
                data: {
                    signature: save
                },
                success: function(response) {
                    $('.list-sign').append(response);
                }
            });

        });

        $('.js-signaturePaham').eq(0).on('jq.signature.changed', function() {
            $('.paham').val($(this).jqSignature('getDataURL'));

        });
    });
</script>

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




<script src="<?= base_url(); ?>/js/jquery.slimscroll.js"></script>
<script src="<?= base_url(); ?>/js/custom.min.js"></script>
<script type="text/javascript">
    $('#slimtest1').slimScroll({
        height: '250px'
    });
    $('#slimtest2').slimScroll({
        height: '250px'
    });
    $('#slimtest3').slimScroll({
        position: 'left',
        height: '250px',
        railVisible: true,
        alwaysVisible: true
    });
    $('#slimtest4').slimScroll({
        color: '#00f',
        size: '10px',
        height: '650px',
        alwaysVisible: true
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $('#journalnumber').val();
            window.open("<?php echo base_url('EdukasiBedah/printbuktiinformconcent') ?>?page=" + id, "_blank");

        })
    });
</script>