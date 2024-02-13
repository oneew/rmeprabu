<div id="modalinputlokasi" class="modal fade" id="bs-example-modal-lg" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Pengaturan Lokasi Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="form-filter-bawah">
                    <?= form_open('UsersAkun/simpanlokasibaru', ['class' => 'formTNO']); ?>
                    <?= csrf_field(); ?>
                    <form method="post" id="form-filter">
                        <div class="form-body">
                            <div class="row pt-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Nama Pengguna</label>
                                        <input type="text" id="firstname" name="firstname" class="form-control" autocomplete="off" value="<?= $firstname; ?>" readonly>
                                        <input type="hidden" id="id" name="id" class="form-control" autocomplete="off" value="<?= $id; ?>">
                                        <input type="hidden" id="email" name="email" class="form-control" autocomplete="off" value="<?= $email; ?>">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Lokasi Saat Ini</label>
                                        <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="<?= $locationcode; ?>" readonly>
                                        <input type="text" id="locationname" name="locationname" class="form-control" value="<?= $locationname; ?>" readonly>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Tambah Lokasi</label>
                                        <select name="locationname_baru" id="locationname_baru" class="select2" style="width: 100%" required>
                                            <option value="">Pilih Lokasi</option>
                                            <?php foreach ($lokasi as $l) : ?>
                                                <option data-id="<?= $l['id']; ?>" class="select-smf"><?php echo $l['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" id="locationcode_baru" name="locationcode_baru" class="form-control" readonly>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success btnsimpanTNO"> <i class="fa fa-check"></i> Simpan</button>
                            <button type="button" class="btn btn-inverse" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                    <?= form_close() ?>
                </div>
                <div class="table-responsive viewlokasi"></div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




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

                        if (response.error.locationcode) {
                            $('#locationcode_baru').addClass('form-control-danger');
                            $('.errolocationcode').html(response.errorlocationcode);
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        //$('#modalinputlokasi').modal('hide');
                        datalokasiuser();
                        datausers();
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
            }, // let our custom formatter work
            minimumInputLength: 1,

        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#locationname_baru').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_lokasi') ?>",
                'data': {
                    key: $('#locationname_baru option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#locationname_baru').val(data.name);
                    $('#locationcode_baru').val(data.code);
                    $('#autocomplete-dokter').html('');
                }
            })
        })


    });
</script>



<script>
    function datalokasiuser() {
        $.ajax({

            url: "<?php echo base_url('UsersAkun/HistoriLokasi') ?>",
            data: {
                email: $('#email').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewlokasi').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datalokasiuser();


    });
</script>