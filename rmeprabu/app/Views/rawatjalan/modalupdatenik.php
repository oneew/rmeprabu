<div id="modalupdatenik" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-warning">
                <h4 class="modal-title text-white" id="warning-header-modalLabel">Update NIK
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="validation-wizard wizard-circle updatedatanik" id="form-update-nik" method="post" action="<?= base_url(); ?>/RawatJalan/updateNikPasien">
                    <div class="form-body">
                        <?php
                        foreach ($pasienlama as $row) :
                        ?>
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Norm</label>
                                        <input type="text" id="normpasien" name="normpasien" class="form-control" value="<?= $row['code']; ?>">
                                        <input type="hidden" id="idpasien" name="idpasien" class="form-control" value="<?= $row['id']; ?>">
                                        <input type="hidden" id="incorrectNik" name="incorrectNik" class="form-control" value="1">
                                        <input type="hidden" id="modifiedby" name="modifiedby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>

                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nama</label>
                                        <input type="text" id="namepasien" name="namepasien" class="form-control" value="<?= $row['name']; ?>">

                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Lahir</label>
                                        <input type="text" id="tgllahirpasien" name="tgllahirpasien" class="form-control" value="<?= $row['dateofbirth']; ?>">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Nik</label>
                                        <input type="text" id="noindukpasien" name="noindukpasien" class="form-control form-control-danger" value="<?= $row['ssn']; ?>" required onkeypress="return hanyaAngka(event)">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success btnupdatenikbaru"> <i class="fa fa-check"></i>
                            Save</button>
                        <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $(document).ready(function() {
        $('.updatedatanik').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnupdatenikbaru').attr('disable', 'disabled');
                    $('.btnupdatenikbaru').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnupdatenikbaru').removeAttr('disable');
                    $('.btnupdatenikbaru').html('Simpan');
                },
                success: function(response) {
                    if (response.gagal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.gagal,

                        })

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modalupdatenik').modal('hide');

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
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>