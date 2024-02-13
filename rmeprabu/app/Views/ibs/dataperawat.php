<table id="dataperawat" class="table display table-bordered table-striped no-wrap">
    <thead>
        <tr>

            <th>No</th>
            <th>Nama</th>
            <th>Area</th>
            <th>Lokasi</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>

                <td><?= $no ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['area'] ?></td>
                <td><?= $row['locationname']  ?></td>
                <td><?= $row['address'] ?></td>
                <td> <?php if (session()->get('level') == 0) { ?>
                        <button type="button" class="btn btn-info btn-rounded btn-sm" onclick="editparamedis('<?= $row['id'] ?>')"> <i class="fa fa-tags"></i></button>
                        <button type="button" class="btn btn-danger btn-rounded btn-sm" onclick="hapus('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                    <?php } ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });

    function editparamedis(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('perawat/formedit'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');

                }
            }

        });


    }

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
                    url: "<?php echo base_url('perawat/hapus'); ?>",
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

                        }
                    }

                });


            }
        })

    }
</script>