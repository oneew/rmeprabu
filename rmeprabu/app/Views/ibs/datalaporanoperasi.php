<div class="table-responsive">
    <table id="dataoperasi" class="table color-table purple-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Mulai Operasi</th>
                <th>Selesai Operasi</th>
                <th>Durasi</th>
                <th>Diagnosa Pasca Bedah</th>
                <th>Dokter Operator</th>
                <th>Dokter Anestesi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="hapuslaporanoperasi('<?= $row['id'] ?>')"> <i class="fa fa-trash"></i></button></td>
                    <td><?= $row['mulaioperasi'] ?></td>
                    <td><?= $row['selesai'] ?></td>
                    <td><?= $row['durasi'] ?></td>
                    <td><?= $row['diagnosapascabedah'] ?></td>
                    <td><?= $row['ibsdoktername'] ?></td>
                    <td><?= $row['ibsanestesiname'] ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function hapuslaporanoperasi(id) {

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
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PascaBedah/hapuslaporanoperasi'); ?>",
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
                            datalaporanoperasi();
                        }
                    }

                });


            }
        })

    }
</script>