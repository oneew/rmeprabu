<div id="modalorderRHMrme_rajal" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Order Pemeriksaan Rehabilitasi Medik</h4>
            </div>
            <?php helper('form') ?>
            <?= form_open('PelayananRawatJalanRME/simpanpemeriksaanPaket', ['class' => 'formsimpanbanyak']); ?>
            <div class="modal-body">
                <div id="form-filter-bawah" style="display: block;">
                    <from class="form-horizontal form-material" id="form-filter1" method="post" action="IGD/simpandataregisterpasienbaru">
                        <input type="hidden" id="classroom2" name="classroom2" class="form-control" value="KLS2">
                        <input type="hidden" id="idpasien" name="idpasien" class="form-control" value="<?= $journalnumber; ?>">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kelompok Paket</label>
                                    <div class="input-group">
                                        <select name="asalLab" id="asalLab" class="select2 filter-input" style="width: 100%">
                                            <option value="1">Radiologi Sentral</option>
                                            <option value="2">Radiologi IGD</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" id="filterItem" placeholder="cari di sini...">
                                </div>
                            </div>
                        </div>
                    </from>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="viewdatapaket"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="form-filter-bawah-simpan-pemeriksaan" style="display: block;">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnsimpanbanyak">Simpan Order</button>
                    </div>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


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
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>

<script>
    $('#modalorderRHMrme_rajal').on('shown.bs.modal', function (event) {
        let classroom = $('#classroom2').val();
        let id = $('#idpasien').val();
        let asal_lab = $('#asalLab').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/tampil_seluruh_rhm') ?>",
            dataType: "json",
            data: {
                classroom: classroom,
                id: id,
                asal_lab: asal_lab
            },
            success: function(response) {
                $('.viewdatapaket').html(response.data);

            }
        });
    });
</script>


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
                                dataresume();
                                historiradiologi();
                                resumeexpertise();
                                resumePenunjang();
                                $('#name').val('');
                                $('#price').val('');
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            html: `${response.gagal}`,

                        })
                    }
                }
            });
            return false;
        });
    });
</script>