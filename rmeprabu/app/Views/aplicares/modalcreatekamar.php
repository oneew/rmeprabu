<div id="modalcreatekamar" class="modal fade in" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Create Kamar Aplicares</h4>
            </div>
            <?php helper('form'); ?>
            <?= form_open('Aplicares/create_kamar', ['class' => 'formkamar']); ?>
            <?= csrf_field(); ?>

            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <?php
                    foreach ($kamar as $row) :
                    ?>
                        <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kode Kamar</label>
                                    <input type="text" id="roomcode" class="form-control" name="roomcode" value="<?= $row['roomcode']; ?>" readonly>

                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <label class="control-label">Nama Kamar</label>
                                    <input type="text" id="namakamar" class="form-control" name="namakamar" value="<?= $row['roomname']; ?>" readonly>

                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Kelas</label>
                                    <input type="text" id="kelaskamar" class="form-control" name="kelaskamar" value="<?= $row['classroom']; ?>">

                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group has-danger">
                                    <label class="control-label">Kapasitas</label>
                                    <input type="text" id="kapasitaskamar" class="form-control" name="kapasitaskamar" value="<?= $row['jumlahbed']; ?>">

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </from>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-plus"></i> Simpan Ke Aplicares</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $(document).ready(function() {
        $('.formkamar').submit(function(e) {
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
                    let data = JSON.parse(response);
                    //alert(data.metadata.message);
                    if (data.metadata.message == "Data tersebut sudah ada.") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: data.metadata.message,

                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: data.metadata.message,

                        });
                    }
                }


            });
            return false;
        });
    });
</script>