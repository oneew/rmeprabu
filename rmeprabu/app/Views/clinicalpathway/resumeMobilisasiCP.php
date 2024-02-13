<table id="dataMobilisasiCP" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>Mobilisasi</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $noD = 0;
            foreach ($mobilisasi_cp as $mobilisasi) :
                $noD++; ?>
                <tr>
                    <td style="width: 5%;">
                        <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="hapus_mobilisasi('<?= $mobilisasi['id'] ?>')"> <i class="fa fa-trash"></i></button>
                    </td>
                    <td style="width: 5%;"><?= $noD ?></td>
                    <td><?= $mobilisasi['mobilisasi'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function hapus_mobilisasi(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data Mobilisasi ini ?",
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
                    url: "<?php echo base_url('ClinicalPathway/hapusMobilCP'); ?>",
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
                            datamobilisasi();
                        }
                    }
                });
            }
        })
    }
</script>