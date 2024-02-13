<div id="modalhistory_file" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">History File</h4>
            </div>

            <div class="modal-body">
                <div class="table-responsive viewdatahistory">
                </div>
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
    function ambildataHitoryFile() {
        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/ambilHistoryFile'); ?>",
            data: {
                referencenumber: '<?= $ref ;?>'
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewdatahistory').html(response.sukses).show();
                }
            }
        });
    }
    $('#modalhistory_file').on('shown.bs.modal', function () {
        ambildataHitoryFile();
    })
</script>

<script>
    function hapusfilerme(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRawatjalanRME/hapusfile_rme'); ?>",
                    data: {
                        id : id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            ambildataHitoryFile();

                        }
                    }

                });
            }
        })

    }
</script>
