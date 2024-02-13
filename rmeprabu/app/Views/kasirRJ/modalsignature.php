<link href="../css/colors/default-dark.css" id="theme" rel="stylesheet">
<link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<?php helper('form') ?>
<?= form_open('KasirRJ/simpansignature', ['class' => 'formsimpanbanyak']); ?>
<?= csrf_field(); ?>
<div class="modal fade" id="modalsignature" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Tandatangan Digital Pembayaran Kasir Rawat Jalan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="floating-labels mt-1">

                    <div class="col-md-12">
                        <div class="form-group has-success">
                            <p>Sign Below: Kasir</p>
                            <input type="hidden" id="signature" name="signature" class="form-control tandatangan">
                            <input type="hidden" id="id" name="id" class="form-control" value="<?= $id; ?>">

                            <div class="js-signature" data-width="350" data-height="100" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="false"></div>
                            <p><button id="clearBtn" class="btn btn-default">Clear Canvas</button></p>
                            <div id="signature">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img src="<?= $signaturekasir ?>" />

                                </div>
                                <div class="el-card-content">
                                    <h5 class="mb-0"><?= $kasir; ?></h5> <small>Kasir Rawat Jalan</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group has-success">
                            <p>Sign Below: Pasien/ Keluarga Pasien</p>
                            <input type="hidden" id="signaturepasien" name="signaturepasien" class="form-control tandatanganpasien">
                            <div class="js-signaturepasien" data-width="350" data-height="100" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="false"></div>
                            <p><button id="clearBtnpasien" class="btn btn-default">Clear Canvas</button></p>
                            <div id="signaturepasien">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img src="<?= $signaturepasien ?>" />

                                </div>
                                <div class="el-card-content">
                                    <h5 class="mb-0"><?= $penyetor; ?></h5> <small>An. Pasien <?= $pasienname; ?></small>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnsimpanbanyak">Simpan</button>
            </div>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?= form_close(); ?>


<script>
    $(document).ready(function(e) {

        $('.formsimpanbanyak').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanbanyak').attr('disable', 'disabled');
                    $('.btnsimpanbanyak').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpanbanyak').removeAttr('disable');
                    $('.btnsimpanbanyak').html('Simpan');
                },
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `${response.sukses}`,

                        }).then((result) => {
                            if (result.value) {
                                $('#modalsiganture').modal('hide');
                                dataresume();


                            }
                        });


                    }
                }
            });
            return false;
        })
    });
</script>



<script>
    $(document).ready(function() {
        if ($('.js-signature').length) {
            $('.js-signature').jqSignature();
        }

        $('#clearBtn').on('click', function(e) {
            e.preventDefault();
            $('.js-signature').eq(0).jqSignature('clearCanvas');
            $('#saveBtn').attr('disabled', true);
            //alert($('.js-signature').html());
        });

        $('#saveBtn').on('click', function() {
            let save = $('.js-signature').eq(0).jqSignature('getDataURL');
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
            // alert(save);
        });

        $('.js-signature').eq(0).on('jq.signature.changed', function() {
            $('.tandatangan').val($(this).jqSignature('getDataURL'));
            //$('#saveBtn').attr('disabled', false);
        });
    });
</script>


<script>
    $(document).ready(function() {
        if ($('.js-signaturepasien').length) {
            $('.js-signaturepasien').jqSignature();
        }

        $('#clearBtnpasien').on('click', function(e) {
            e.preventDefault();
            $('.js-signaturepasien').eq(0).jqSignature('clearCanvas');
            $('#saveBtn').attr('disabled', true);
            //alert($('.js-signature').html());
        });

        $('#saveBtn').on('click', function() {
            let save = $('.js-signaturepasien').eq(0).jqSignature('getDataURL');
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
            // alert(save);
        });

        $('.js-signaturepasien').eq(0).on('jq.signature.changed', function() {
            $('.tandatanganpasien').val($(this).jqSignature('getDataURL'));
            //$('#saveBtn').attr('disabled', false);
        });
    });
</script>