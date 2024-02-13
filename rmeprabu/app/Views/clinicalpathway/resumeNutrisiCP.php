<table id="dataNutrisiCP" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>Nutrisi</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $noC = 0;
            foreach ($nutrisi_cp as $nutrisi) :
                $noC++; ?>
                <tr>
                    <td style="width: 5%;">
                        <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="hapus_nutrisi('<?= $nutrisi['id'] ?>')"> <i class="fa fa-trash"></i></button>
                    </td>
                    <td style="width: 5%;"><?= $noC ?></td>
                    <td><?= $nutrisi['nutrisi'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function hapus_nutrisi(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data Nutrisi ini ?",
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
                    url: "<?php echo base_url('ClinicalPathway/hapusNutrisiCP'); ?>",
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
                            datanutrisi();
                        }
                    }
                });
            }
        })
    }
</script>