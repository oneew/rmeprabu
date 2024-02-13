<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<div id="modaleditsupplier" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Edit Data Supplier</h4>
            </div>

            <?= form_open('Supplier/updatedata', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>
            <?php
            foreach ($tampildata as $row) :
            ?>
                <div class="modal-body">
                    <from class="form-horizontal form-material" id="form-filter" method="post">
                        <div class="form-body">
                            <div class="row pt-1">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Kategori</label>
                                        <select name="types" id="types" class="select2" style="width: 100%">
                                            <?php foreach ($kelompok as $kl) : ?>
                                                <option data-id="<?= $kl['name']; ?>" class="select-smf" <?php if ($kl['name'] == $row['types']) { ?> selected="selected" <?php } ?>><?php echo $kl['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nama</label>
                                        <input type="text" id="name" name="name" class="form-control" value="<?= $row['name']; ?>" required onkeyup="this.value = this.value.toUpperCase()">
                                        <input type="hidden" id="id" name="id" class="form-control" value="<?= $row['id']; ?>" required onkeyup="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Alamat</label>
                                        <input type="text" id="address" name="address" class="form-control" value="<?= $row['address']; ?>" required onkeyup="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Telephone</label>
                                        <input type="text" id="telephone" name="telephone" value="<?= $row['telephone']; ?>" class="form-control" required>

                                    </div>
                                </div>
                            </div>

                            <div class="row pt-1">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">No Pajak</label>
                                        <input type="text" id="taxnumber" name="taxnumber" value="<?= $row['taxnumber']; ?>" class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nama Pajak</label>
                                        <input type="text" id="taxname" name="taxname" class="form-control" value="<?= $row['taxname']; ?>" onkeyup="this.value = this.value.toUpperCase()">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nama Kontak Person</label>
                                        <input type="text" id="contactname" name="contactname" value="<?= $row['contactname']; ?>" class="form-control" onkeyup="this.value = this.value.toUpperCase()">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Handphone</label>
                                        <input type="text" id="handphone" name="handphone" value="<?= $row['handphone']; ?>" class="form-control">

                                    </div>
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Bank</label>
                                        <select name="bankname" id="bankname" class="select2" style="width: 100%">
                                            <?php foreach ($daftarbank as $NSMF) : ?>
                                                <option data-id="<?= $NSMF['namabank']; ?>" class="select-smf" <?php if ($NSMF['namabank'] == $row['bankname']) { ?> selected="selected" <?php } ?>><?php echo $NSMF['namabank']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">No Rekening</label>
                                        <input type="text" id="bankaccount" name="bankaccount" value="<?= $row['bankaccount']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Nama Rekening</label>
                                        <input type="text" id="bankaccountname" name="bankaccountname" value="<?= $row['bankaccountname']; ?>" class="form-control" onkeyup="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label">Status Tidak Aktif ?</label>
                                        <select name="inactive" id="inactive" class="select2" style="width: 100%">
                                            <?php foreach ($aktif as $ak) : ?>
                                                <option data-id="<?= $ak['name']; ?>" class="select-smf" <?php if ($ak['name'] == $row['inactive']) { ?> selected="selected" <?php } ?>><?php echo $ak['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </from>
                </div>
            <?php endforeach; ?>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Perbaharui Data</button>
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
                                $('#modaleditsupplier').modal('hide');
                                datasupplier();

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