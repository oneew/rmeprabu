<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">

<?php helper('form') ?>
<?= form_open('PelayananHemodialisa/simpanpemeriksaanPaket', ['class' => 'formsimpanbanyak']); ?>
<?= csrf_field(); ?>
<div class="modal fade" id="modalinputPaketHD" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Input Pemeriksaan Hemodialisa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Lokasi</label>
                            <div class="input-group">
                                <select name="asalLab" id="asalLab" class="select2 filter-input" style="width: 100%">
                                    <option value="1">Ruang Hemodialisa</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Kelompok Paket</label>
                            <div class="input-group">
                                <select name="kelompokLab" id="kelompokLab" class="select2 filter-input" style="width: 100%">
                                    <option>Pilih</option>
                                    <?php foreach ($kelompokLab as $kelompok) { ?>
                                        <option value="<?= $kelompok['name']; ?>" class="select-employeename"><?= $kelompok['name']; ?></option>
                                    <?php } ?>
                                </select>
                                <?php if ($classroom == 'IRJ') {
                                    $asal = $registernumber_rawatjalan;
                                    $kelas = "KLS2";
                                } else {
                                    if ($classroom == 'IGD') {
                                        $asal = $registernumber_rawatjalan;
                                        $kelas = "KLS2";
                                    } else {
                                        $asal = $registernumber_rawatinap;
                                        $kelas = $classroom;
                                    }
                                } ?>
                                <input type="hidden" id="classroom" name="classroom" class="form-control" value="<?= $kelas; ?>">
                                <input type="hidden" id="idpasien" name="idpasien" class="form-control" value="<?= $id ?>">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="table-responsive viewdatapaket"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnsimpanbanyak">Simpan</button>
            </div>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?= form_close(); ?>

<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
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
    $('.filter-input').on('change', function() {
        let kelompokLab = $('#kelompokLab').val();
        let classroom = $('#classroom').val();
        let id = $('#idpasien').val();
        let asal_lab = $('#asalLab').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananHemodialisa/caripaket') ?>",
            dataType: "json",
            data: {
                kelompokLab: kelompokLab,
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