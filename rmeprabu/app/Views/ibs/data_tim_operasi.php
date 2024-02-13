<div class="table-responsive">
    <table id="dataperawat" class="table color-table success-table">
        <thead>
            <tr>

                <th>#</th>
                <th>No</th>
                <th>Tanggal operasi</th>
                <th>Pelaksana</th>
                <th>Peran</th>
                <th>Kategori</th>
                <th>Tindakan</th>
                <th>Kamar</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn btn-danger btn-rounded btn-sm" onclick="hapus('<?= $row['id'] ?>')"> <i class="fa fa-trash"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['dt_advice_op'] ?></td>
                    <td><?= $row['pelaksana'] ?></td>
                    <td><?= $row['peran'] ?></td>
                    <td><?= $row['cases'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['room'] ?></td>



                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
    function hapus(id) {

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
                    url: "<?php echo base_url('BedahTim/hapustim'); ?>",
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
                            dataperawat();
                            datajadwal();
                            datajadwalinputtim();
                            pelaksanaoperasiresume();

                        }
                    }

                });


            }
        })

    }
</script>