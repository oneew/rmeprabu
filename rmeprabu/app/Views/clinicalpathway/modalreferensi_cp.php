<link href="<?= base_url(); ?>/assets/plugins/c3-master/c3.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/footable/css/footable.bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="<?= base_url(); ?>/assets/plugins/wizard/steps.css" rel="stylesheet" type="text/css">
<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<div id="modalreferensi_cp" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Referensi Clinical Pathway</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="mb-0 text-white"><?= $diagnosa; ?> [<?= $icd; ?>]</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Penunjang</span></a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Tindakan</span></a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ti-pencil-alt"></i></span> <span class="hidden-xs-down">Obat</span></a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#nutrisi" role="tab"><span class="hidden-sm-up"><i class="ti-pie-chart"></i></span> <span class="hidden-xs-down">Nutrisi</span></a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#mobilisasi" role="tab"><span class="hidden-sm-up"><i class="ti-agenda"></i></span> <span class="hidden-xs-down">Mobilisasi</span></a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#hasil" role="tab"><span class="hidden-sm-up"><i class="ti-target"></i></span> <span class="hidden-xs-down">Hasil (Outcome)</span></a> </li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#rencana" role="tab"><span class="hidden-sm-up"><i class="ti-desktop"></i></span> <span class="hidden-xs-down">Pendidikan/Rencana Pemulangan</span></a> </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <input type="hidden" id="diagnosacp" name="diagnosacp" class="form-control" value="<?= $diagnosacp; ?>" readonly>
                                            <input type="hidden" id="loscp" name="loscp" class="form-control" value="<?= $los_cp; ?>" readonly>
                                            <div class="tab-content tabcontent-border">
                                                <div class="tab-pane active" id="home" role="tabpanel">
                                                    <div class="mt-2"> <button type="button" class="btn btn-info inputpenunjang"><i class="fa fa-plus-circle"></i> Tambah Pemeriksaan Penunjang</button></div>
                                                    <div class="p-3 viewdatapenunjang"></div>
                                                </div>
                                                <div class="tab-pane" id="profile" role="tabpanel">
                                                    <div class="mt-2"> <button type="button" class="btn btn-info inputtindakan"><i class="fa fa-plus-circle"></i> Tambah Tindakan</button></div>
                                                    <div class="p-3 viewdatatindakan"></div>
                                                </div>
                                                <div class="tab-pane" id="messages" role="tabpanel">
                                                    <div class="mt-2"> <button type="button" class="btn btn-info inputobat"><i class="fa fa-plus-circle"></i> Tambah Obat</button></div>
                                                    <div class="p-3 viewdataobat"></div>
                                                </div>
                                                <div class="tab-pane" id="nutrisi" role="tabpanel">
                                                    <div class="mt-2"> <button type="button" class="btn btn-info inputnutrisi"><i class="fa fa-plus-circle"></i> Tambah Nutrisi</button></div>
                                                    <div class="p-3 viewdatanutrisi"></div>
                                                </div>
                                                <div class="tab-pane" id="mobilisasi" role="tabpanel">
                                                    <div class="mt-2"> <button type="button" class="btn btn-info inputmobilisasi"><i class="fa fa-plus-circle"></i> Tambah Mobilisasi</button></div>
                                                    <div class="p-3 viewdatamobilisasi"></div>
                                                </div>
                                                <div class="tab-pane p-3" id="hasil" role="tabpanel">
                                                    <div class="mt-2"> <button type="button" class="btn btn-info inputhasil"><i class="fa fa-plus-circle"></i> Tambah Hasil(Outcome)</button></div>
                                                    <div class="p-3 viewdatahasil"></div>
                                                </div>
                                                <div class="tab-pane" id="rencana" role="tabpanel">
                                                    <div class="mt-2"> <button type="button" class="btn btn-info inputrencana"><i class="fa fa-plus-circle"></i> Tambah Pendidikan/Rencana Pemulangan</button></div>
                                                    <div class="p-3 viewdatarencana"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="viewmodalcp" style="display:none;"></div>


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


<script>
    function datapenunjang() {

        $.ajax({

            url: "<?php echo base_url('ClinicalPathway/PenunjangCP') ?>",
            data: {
                diagnosa_cp: $('#diagnosacp').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatapenunjang').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datapenunjang();

    });
</script>


<script>
    function datatindakan() {

        $.ajax({

            url: "<?php echo base_url('ClinicalPathway/TindakanCP') ?>",
            data: {
                diagnosa_cp: $('#diagnosacp').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatatindakan').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datatindakan();

    });
</script>


<script>
    function dataobat() {

        $.ajax({

            url: "<?php echo base_url('ClinicalPathway/ObatCP') ?>",
            data: {
                diagnosa_cp: $('#diagnosacp').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataobat').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataobat();

    });
</script>


<script>
    function datanutrisi() {

        $.ajax({

            url: "<?php echo base_url('ClinicalPathway/NutrisiCP') ?>",
            data: {
                diagnosa_cp: $('#diagnosacp').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatanutrisi').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datanutrisi();

    });
</script>


<script>
    function datamobilisasi() {

        $.ajax({

            url: "<?php echo base_url('ClinicalPathway/MobilisasiCP') ?>",
            data: {
                diagnosa_cp: $('#diagnosacp').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatamobilisasi').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datamobilisasi();

    });
</script>



<script>
    function datahasil() {

        $.ajax({

            url: "<?php echo base_url('ClinicalPathway/HasilCP') ?>",
            data: {
                diagnosa_cp: $('#diagnosacp').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatahasil').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datahasil();

    });
</script>



<script>
    function datarencana() {

        $.ajax({

            url: "<?php echo base_url('ClinicalPathway/RencanaCP') ?>",
            data: {
                diagnosa_cp: $('#diagnosacp').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdatarencana').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datarencana();

    });
</script>


<script>
    $(document).ready(function() {
        dataReferensiCP();
        let diagnosa = $('#diagnosacp').val();
        let los = $('#loscp').val();
        $('.inputpenunjang').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('ClinicalPathway/CreatePenunjangCP') ?>",
                dataType: "json",
                data: {
                    diagnosa: diagnosa,
                    los: los

                },
                success: function(response) {
                    $('.viewmodalcp').html(response.data).show();
                    $('#modalcreate_penunjang_cp').modal('show');

                }
            });

        });
    });
</script>


<script>
    $(document).ready(function() {
        dataReferensiCP();
        let diagnosa = $('#diagnosacp').val();
        let los = $('#loscp').val();
        $('.inputtindakan').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('ClinicalPathway/CreateTindakanCP') ?>",
                dataType: "json",
                data: {
                    diagnosa: diagnosa,
                    los: los

                },
                success: function(response) {
                    $('.viewmodalcp').html(response.data).show();
                    $('#modalcreate_tindakan_cp').modal('show');

                }
            });

        });

        $('.inputobat').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('ClinicalPathway/CreateObatCP') ?>",
                dataType: "json",
                data: {
                    diagnosa: diagnosa,
                    los: los

                },
                success: function(response) {
                    $('.viewmodalcp').html(response.data).show();
                    $('#modalcreate_obat_cp').modal('show');

                }
            });

        });
        $('.inputnutrisi').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('ClinicalPathway/CreateNutrisiCP') ?>",
                dataType: "json",
                data: {
                    diagnosa: diagnosa,
                    los: los

                },
                success: function(response) {
                    $('.viewmodalcp').html(response.data).show();
                    $('#modalcreate_nutrisi_cp').modal('show');

                }
            });

        });
        $('.inputmobilisasi').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('ClinicalPathway/CreateMobilisasiCP') ?>",
                dataType: "json",
                data: {
                    diagnosa: diagnosa,
                    los: los

                },
                success: function(response) {
                    $('.viewmodalcp').html(response.data).show();
                    $('#modalcreate_mobilisasi_cp').modal('show');

                }
            });

        });
        $('.inputhasil').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('ClinicalPathway/CreateHasilCP') ?>",
                dataType: "json",
                data: {
                    diagnosa: diagnosa,
                    los: los

                },
                success: function(response) {
                    $('.viewmodalcp').html(response.data).show();
                    $('#modalcreate_hasil_cp').modal('show');

                }
            });

        });
        $('.inputrencana').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('ClinicalPathway/CreateRencanaCP') ?>",
                dataType: "json",
                data: {
                    diagnosa: diagnosa,
                    los: los

                },
                success: function(response) {
                    $('.viewmodalcp').html(response.data).show();
                    $('#modalcreate_rencana_cp').modal('show');

                }
            });

        });
    });
</script>