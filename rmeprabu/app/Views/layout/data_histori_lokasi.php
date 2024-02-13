<table id="datahistori" class="tablesaw table-bordered table-hover table no-wrap" width="100%">
    <thead class="text-white bg-success">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Email</th>
                <th>Kode Lokasi</th>
                <th>Nama Lokasi</th>
                <th>Tanggal Tambah Lokasi</th>
                <th>Ditambah Oleh</th>
            </tr>
        </thead>
    <tbody>
        <?php $no = 0;
        foreach ($kunjungan as $row) :
            $no++; ?>
            <tr>
                <td><button type="button" class="btn btn-danger btn-rounded btn-sm" onclick="hapus('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                <td><?= $no ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['locationcode'] ?></td>
                <td><?= $row['locationname'] ?></td>
                <td><?= $row['created_at']  ?></td>
                <td><?= $row['createdby']  ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>



<script>
    $(document).ready(function() {
        $('#datahistori').DataTable({
            responsive: true,
            paging: false,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>

<script>
    function hapus(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data Lokasi Untuk Akun ini ?",
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
                    url: "<?php echo base_url('UsersAkun/hapusLokasi'); ?>",
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
                            datalokasiuser();

                        }
                    }

                });


            }
        })

    }
</script>