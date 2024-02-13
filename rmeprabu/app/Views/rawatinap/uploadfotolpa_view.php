<!-- Button trigger modal -->
<button type="button" class="d-none btn btn-primary" id="btn-modal-upload" data-toggle="modal" data-target="#exampleModal">

</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Foto Patologi Anantomi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 text-center">
                            <?php
                            $foto = !is_null($info['foto']) ? $info['foto'] : 'default.jpeg'; ?>
                            <img id="foto-<?= $info['code']; ?>" src="<?= base_url(); ?>/assets/images/fotopatologianatomi/<?= $foto; ?>" alt="dokter" height="1000" width="1000" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btn-close-modal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#btn-modal-upload').trigger('click');
        $('#btn-upload').on('click', function(e) {
            e.preventDefault();
            let data = new FormData();
            let file = $('#file-foto')[0].files[0];
            let code = $('#code').val();
            let foto = $('#foto').val();
            data.append('file', file);
            data.append('code', code);
            data.append('foto', foto);


            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('FotoLPA/do_upload') ?>",

                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    // menutup modal
                    $('#btn-close-modal').trigger('click');
                    let pesan = JSON.parse(response);
                    if (pesan.pesan) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Upload Foto Patologi Anatomi Berhasil',

                        })
                    }

                    if (pesan.pesangagal) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Pilih file foto yang akan diupload',

                        })
                    }

                    $('#foto-' + pesan.code).attr('src', pesan.url);

                }
            })
        })
    })
</script>