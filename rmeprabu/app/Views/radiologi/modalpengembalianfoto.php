<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<div class="modal fade" id="modalpengembalianfoto" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Pengembalian Foto Expertise</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="form-filter-bawah" style="display: block;">
                    <div class="text-center">
                        <?= form_open('PelayananRadiologi/simpandataKembali', ['class' => 'formperawat']); ?>
                        <?= csrf_field(); ?>
                        <form action="#">
                            <?php
                            foreach ($pinjam as $row) :
                            ?>
                                <div class="form-body">
                                    <div class="row pt-3">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">No Expertise/ Foto</label>
                                                <input type="text" autocomplete="off" id="expertisepinjam" name="expertisepinjam" class="form-control" value="<?= $row['expertiseid']; ?>" required readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Tanggal Kembali</label>
                                                <input type="text" autocomplete="off" id="datepicker-autoclose3" name="kembalidate" class="form-control" required value="<?= date('d/m/Y'); ?>">
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-3">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Nama Pengembali</label>
                                                <input type="text" id="peminjamname" name="peminjamname" class="form-control" required onkeyup="this.value = this.value.toUpperCase()">
                                                <input type="hidden" id="statuspinjam" name="statuspinjam" class="form-control" value="1">
                                                <input type="hidden" id="idpinjam" name="idpinjam" class="form-control" value="<?= $row['id']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">Status</label>
                                            <select name="statuspinjam" id="statuspinjam" class="form-control">
                                                <option value="1" <?php if ($row['statuspinjam'] == 1) echo "selected"; ?>>Dikembalikan</option>
                                                <option value="0" <?php if ($row['statuspinjam'] == 0) echo "selected"; ?>>Dipinjam</option>

                                            </select>
                                            <input type="hidden" id="updatedby" name="updatedby" class="form-control" value="<?= session()->get('email'); ?>" readonly>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="form-actions text-right">
                                <button type="submit" class="btn btn-success btnsimpankembali"> <i class="fa fa-check"></i>
                                    Simpan</button>
                                <button type="button" class="btn btn-inverse">Batal</button>
                            </div>
                            <?= form_close() ?>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    jQuery('#datepicker-autoclose3').datepicker({
        dateFormat: "dd/mm/yy",
        autoclose: true,
        todayHighlight: true
    });

    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {


            days: 6
        }
    });
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
                    $('.btnsimpankembali').attr('disable', 'disabled');
                    $('.btnsimpankembali').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpankembali').removeAttr('disable');
                    $('.btnsimpankembali').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.peminjamname) {
                            $('#pengembaliname').addClass('form-control-danger');
                            $('.pengembaliname').html(response.error.pengembaliname);
                        } else {
                            $('#pengembaliname').removeClass('form-control-danger');
                            $('.errorpengembaliname').html('');
                        }



                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modalpengembalianfoto').modal('hide');
                                datakunjungan();
                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>