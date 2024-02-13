<div class="table-responsive">
    <table id="dataAsupanGizi" class="table color-table purple-table">
        <thead>
            <tr>
                <th></th>
                <th>No</th>
                <th>Tanggal</th>
                <th>JournalNumber</th>
                <th>Pelayanan</th>
                <th>Tarif</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusAPG('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['name']  ?></td>
                    <td><?= number_format($row['subtotal'], 2, ",", ".") ?></td>

                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
    function hapusAPG(id) {

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
                    url: "<?php echo base_url('PelayananRawatJalan/hapusAPG'); ?>",
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
                            resumeGizi();
                            resumeTNO();

                        }
                    }

                });


            }
        })

    }
</script>