<link href="../css/colors/default-dark.css" id="theme" rel="stylesheet">
<link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<?php helper('form') ?>
<?= form_open('PelayananRawatJalan/simpanpemeriksaan', ['class' => 'formsimpanbanyak']); ?>
<?= csrf_field(); ?>
<div class="modal fade" id="modalvalidasipoli_kasirRJ" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Validasi pemeriksaan Poliklinik</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="floating-labels mt-1">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="button-mic"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                            <textarea class="form-control" rows="4" id="anamnesa" name="anamnesa" readonly><?= $anamnesa; ?></textarea>
                            <label for="anamnesa">Anamnesa</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="button-hasil"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                            <textarea class="form-control" rows="4" id="hasilperiksa" name="hasilperiksa" readonly><?= $hasilperiksa; ?></textarea>
                            <label for="hasilperiksa">Hasil Pemeriksaan</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <select name="advicedokter" id="advicedokter" class="select2" style="width: 100%;">
                                <?php foreach ($pasienstatus as $pjb) : ?>
                                    <option value="<?php echo $pjb['name']; ?>" <?php if ($pjb['name'] == $advicedokter) { ?> selected="selected" <?php } ?>><?php echo $pjb['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="button-indikasi"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                            <textarea class="form-control" rows="4" id="indikasi" name="indikasi" readonly><?= $indikasirawat; ?></textarea>
                            <label for="indikasi">Indikasi Rawat</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group has-success">

                            <input type="hidden" id="signature" name="signature" class="form-control tandatangan">
                            <input type="hidden" id="signature_awal" name="signature_awal" class="form-control" value="<?= $signature; ?>">
                            <input type="hidden" id="id" name="id" class="form-control" value="<?= $id; ?>">
                            <input type="hidden" id="validasipemeriksaan" name="validasipemeriksaan" class="form-control" value="1">
                            <div class="js-signature" style="display: none;" data-width="350" data-height="100" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="false"></div>

                            <div id="signature">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img src="<?= $signature ?>" />

                                </div>
                                <div class="el-card-content">
                                    <h5 class="mb-0"><?= $doktername; ?></h5> <small><?= $poliklinikname; ?></small>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>

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
                                $('#modalvalidasipoli').modal('hide');
                                //dataresume();


                            }
                        });


                    }
                }
            });
            return false;
        })
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

        $('.button-mic').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#anamnesa').html(finalTranscripts);
                    $('#anamnesa').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#anamnesa').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })
</script>

<script type="text/javascript">
    $(document).ready(function() {


        $('.button-hasil').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#hasilperiksa').html(finalTranscripts);
                    $('#hasilperiksa').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#hasilperiksa').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.button-indikasi').on('click', function(e) {
            e.preventDefault();

            if ('webkitSpeechRecognition' in window) {
                var speechRecognizer = new webkitSpeechRecognition();
                speechRecognizer.continuous = true;
                speechRecognizer.interimResults = true;
                speechRecognizer.lang = 'id';
                speechRecognizer.start();

                var finalTranscripts = '';

                speechRecognizer.onresult = function(event) {
                    var interimTranscripts = '';
                    for (var i = event.resultIndex; i < event.results.length; i++) {
                        var transcript = event.results[i][0].transcript;
                        transcript.replace("\n", "<br>");
                        if (event.results[i].isFinal) {
                            finalTranscripts += transcript;
                        } else {
                            interimTranscripts += transcript;
                        }
                    }
                    // var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
                    $('#indikasi').html(finalTranscripts);
                    $('#indikasi').val(finalTranscripts);
                };
                speechRecognizer.onerror = function(event) {

                };
            } else {
                $('#indikasi').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
            }
        })

    })
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


<script src="../assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
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