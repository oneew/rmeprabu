<table id="dataTindakanCP" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $noA = 0;
            foreach ($tindakan_cp as $tindakan) :
                $noA++; ?>
                <tr>
                    <td style="width: 5%;">
                        <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="hapus_tindakan('<?= $tindakan['id'] ?>')"> <i class="fa fa-trash"></i></button>
                    </td>
                    <td style="width: 5%;"><?= $noA ?></td>
                    <td><?= $tindakan['tindakan'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>



<script>
    function hapus_tindakan(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data Tindakan ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('ClinicalPathway/hapusTindakanCP'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            datatindakan();
                        }
                    }
                });
            }
        })
    }
</script>