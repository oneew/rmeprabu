<div id="modalupload_file" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Upload File</h4>
            </div>

            <div class="modal-body">
                <form action="<?= base_url('PelayananRawatJalanRME/simpanFile') ;?>" method="post" id="formsimpanfile">
                    <?= csrf_field() ;?>
                    <input type="hidden" name="referencenumber" id="referencenumber" value="<?= $referencenumber ;?>">
                    <div class="form-group">
                        <label for="jenis File">Pilih Jenis</label>
                        <select name="jenis_file" id="jenis_file" class="form-control">
                            <option value="EKG">EKG</option>
                            <option value="barcodeHD">barcodeHD</option>
                        </select>
                    </div>
                    <div class="form-check pl-0">
                        <input class="form-check-input" type="radio" name="checkFile" id="checkFile" value="option1">
                        <label class="form-check-label" for="checkFile">
                            Pilih Dari Berkas
                        </label>
                    </div>
                    <div class="form-check pl-0">
                        <input class="form-check-input" type="radio" name="checkFile" id="checkCamera" value="option2">
                        <label class="form-check-label" for="checkCamera">
                            Buka Kamera
                        </label>
                    </div>
                    <input type="file" name="nama_file" id="nama_file" class="form-control-file d-none">
                    <input type="file" name="camera_file" id="camera_file" class="form-control-file d-none" capture>
                    <button type="submit" class="btn btn-success mt-3" id="btnsimpanfile">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $('input[type="radio"]').click(function(){
        if ($('#checkFile').is(':checked')) {
            $("#camera_file").val(null);
            $('#nama_file').removeClass('d-none');
            $('#nama_file').addClass('d-block');
            $('#camera_file').addClass('d-none');
            $('#camera_file').removeClass('d-block');
        }

        if ($('#checkCamera').is(':checked')) {
            $("#nama_file").val(null);
            $('#camera_file').removeClass('d-none');
            $('#camera_file').addClass('d-block');
            $('#nama_file').addClass('d-none');
            $('#nama_file').removeClass('d-block');
        }
    })

    $('#formsimpanfile').submit(function(e) {
        e.preventDefault();
        var form_data = new FormData(this);
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: form_data,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "JSON",
            beforeSend: function() {
                $('#btnsimpanfile').attr('disable', 'disabled');
                $('#btnsimpanfile').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('#btnsimpanfile').removeAttr('disable');
                $('#btnsimpanfile').html('Simpan');
            },
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `${response.sukses}`,
                    }).then((result) => {
                        $('.formsimpan')[0].reset()
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
</script>