<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<div id="modalacreatebatch" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Tambah Batch Number</h4>
            </div>



            <div class="modal-body">
                <?= form_open('MasterObat/Simpanbatch', ['class' => 'formbatch']); ?>
                <?= csrf_field(); ?>
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-body">
                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nama Obat</label>
                                    <input type="text" id="namaobat" autocomplete="off" name="namaobat" class="form-control" required>
                                    <input type="hidden" id="name" autocomplete="off" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kode</label>
                                    <input type="text" id="code" autocomplete="off" name="code" class="form-control" readonly>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Satuan</label>
                                    <input type="text" id="uom" autocomplete="off" name="uom" class="form-control" readonly>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Expired Date</label>
                                    <input type="text" id="expireddate" autocomplete="off" name="expireddate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                    <input type="hidden" id="documentyear" autocomplete="off" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Lokasi Stok</label>
                                    <select name="locationname" id="locationname" class="select2" style="width: 100%" required>
                                        <option value="">Pilih Lokasi</option>
                                        <?php foreach ($lokasi as $l) : ?>
                                            <option data-id="<?= $l['id']; ?>" class="select-smf"><?php echo $l['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kode Lokasi</label>
                                    <input type="text" id="locationcode" name="locationcode" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kode Batch</label>
                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                    <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                    <input type="text" id="batchnumber" name="batchnumber" class="form-control" required>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Jumlah Stok</label>
                                    <input type="text" id="balance" name="balance" class="form-control" value="0">
                                </div>
                            </div>


                        </div>

                    </div>
                </from>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Simpan Data</button>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
                </div>
                <?= form_close() ?>

            </div>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<script>
    $(document).ready(function() {
        $('.formbatch').submit(function(e) {
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

                        }).then((result) => {
                            if (result.value) {
                                //$('#modaladdobat').modal('hide');
                                dataobat();

                            }
                        });

                    }
                }


            });
            return false;
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
        $('#manufacturename').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_pabrik') ?>",
                'data': {
                    key: $('#manufacturename option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#manufacturename').val(data.name);
                    $('#manufacturecode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#locationame').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_lokasi') ?>",
                'data': {
                    key: $('#locationame option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#locationame').val(data.name);
                    $('#locationcode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#pregnantriskname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_pregnan') ?>",
                'data': {
                    key: $('#pregnantriskname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#pregnantriskname').val(data.name);
                    $('#pregnantriskcode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#classteraphyname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_kelasterapi') ?>",
                'data': {
                    key: $('#classteraphyname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#classteraphyname').val(data.name);
                    $('#classteraphycode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#subclassteraphyname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_subkelasterapi') ?>",
                'data': {
                    key: $('#subclassteraphyname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#subclassteraphyname').val(data.name);
                    $('#subclassteraphycode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

    });
</script>

<script type="text/javascript">
    function total() {
        var hargabeli = document.getElementById('purchaseprice').value;
        var pajak = parseInt(hargabeli) * (10 / 100);

        var hna_pajak = pajak + parseInt(hargabeli);
        var hja = parseInt(hna_pajak) * (20 / 100);
        var total_hja = hna_pajak + hja;

        document.getElementById('taxprice').value = hna_pajak;
        document.getElementById('salesprice').value = total_hja;
    }
</script>

<script>
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#namaobat").autocomplete({
            source: "<?php echo base_url('MasterObat/ajax_nama_obat'); ?>",
            select: function(event, ui) {
                $('#namaobat').val(ui.item.value);
                $('#code').val(ui.item.code);
                $('#uom').val(ui.item.uom);
                $('#name').val(ui.item.name);

            }
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#locationname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_lokasi') ?>",
                'data': {
                    key: $('#locationname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#locationname').val(data.name);
                    $('#locationcode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })


    });
</script>