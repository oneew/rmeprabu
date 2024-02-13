<div id="modaltambah" class="modal fade in" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Tambah Data Perawat Penata</h4>
            </div>

            <?= form_open('perawat/simpandata', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>

            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-group">
                        <div class="col-md-12 mb-3">
                            <input type="text" class="form-control" placeholder="nama" id="nama" name="nama">
                            <div class="invalid-feedback errorNama">

                            </div>
                        </div>
                        <!-- <div class="col-md-12 mb-3">
                            <select name="jabatan" id="jabatan" class="form-control">
                                <option value="">-Pilih Jabatan-</option>
                                <option value="AK">AK</option>
                                <option value="CCM">CCM</option>
                                <option value="MK">MK</option>
                                <option value="PJ">PJ</option>
                                <option value="PK">PK</option>
                                <option value="A">A</option>
                            </select>
                        </div> -->
                        <div class="col-md-12 mb-3">
                            <select name="jabatan" id="jabatan" class="form-control">
                                <option value="">-Pilih Jabatan-</option>
                                <?php
                                foreach ($jabatan as $key) {
                                    echo "<option value='$key->jabatan'";
                                    echo ">$key->jabatan</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">

                            <select name="kelompok" id="kelompok" class="form-control">
                                <option value="">-Pilih Kelompok-</option>
                                <option value="ANESTESI">ANESTESI</option>
                                <option value="PERAWAT">PERAWAT</option>

                            </select>
                            <div class="invalid-feedback errorKelompok">

                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="date" class="form-control" placeholder="tanggal lahir" id="tanggal_lahir" name="tanggal_lahir">
                        </div>

                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-plus"></i>Save</button>
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
                        if (response.error.nama) {
                            $('#nama').addClass('is-invalid');
                            $('.errorNama').html(response.error.nama);
                        } else {
                            $('#nama').removeClass('is-invalid');
                            $('.errorNama').html('');
                        }

                        if (response.error.kelompok) {
                            $('#kelompok').addClass('is-invalid');
                            $('.errorKelompok').html(response.error.kelompok);
                        } else {
                            $('#kelompok').removeClass('is-invalid');
                            $('.errorKelompok').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        $('#modaltambah').modal('hide');
                        dataperawat();

                    }
                }


            });
            return false;
        });
    });
</script>