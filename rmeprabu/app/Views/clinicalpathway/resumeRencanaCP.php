<table id="dataHasilCP" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>Rencana</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $noF = 0;
            foreach ($rencana_cp as $rencana) :
                $noF++; ?>
                <tr>
                    <td style="width: 5%;">
                        <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="hapus_rencana('<?= $rencana['id'] ?>')"> <i class="fa fa-trash"></i></button>
                    </td>
                    <td style="width: 5%;"><?= $noF ?></td>
                    <td><?= $rencana['rencana'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function hapus_rencana(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data Rencana ini ?",
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
                    url: "<?php echo base_url('ClinicalPathway/hapusRencanaCP'); ?>",
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
                            datarencana();
                        }
                    }
                });
            }
        })
    }
</script>