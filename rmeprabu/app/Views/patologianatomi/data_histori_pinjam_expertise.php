<div class="table-responsive">
    <table id="datahistori" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Pengembalian</th>
                <th>No</th>
                <th>Nomor Expertise</th>
                <th>Tanggal Pinjam</th>
                <th>Unit Peminjam</th>
                <th>Nama Peminjam</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($kunjungan as $row) :
                $no++; ?>
                <tr>
                    <td>
                        <?php if ($row['statuspinjam'] == 0) { ?>
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapuspinjam('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                        <?php } ?>
                        <?php if ($row['statuspinjam'] == 1) { ?>
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm"> <i class="fas fa-check-circle"></i></button>
                        <?php } ?>

                    </td>
                    <td>
                        <?php if ($row['statuspinjam'] == 0) { ?>
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" onclick="pengembalian('<?= $row['id']; ?>')"> <i class="fas fa-sign-in-alt"></i></button>
                        <?php } ?>
                        <?php if ($row['statuspinjam'] == 1) { ?>
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm"> <i class="fas fa-check-circle"></i></button>
                        <?php } ?>
                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['expertiseid'] ?></td>
                    <td><?= $row['pinjamdate'] ?></td>
                    <td><?= $row['asalpeminjam'] ?></td>
                    <td><?= $row['peminjamname'] ?></td>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function hapuspinjam(id) {

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
                    url: "<?php echo base_url('PelayananLPA/hapusPinjam'); ?>",
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
                            datakunjungan();

                        }
                    }

                });


            }
        })

    }
</script>

<script>
    function pengembalian(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('pelayananLPA/Pengembalian'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodal) {

                    $('.viewmodalbaru').html(response.suksesmodal).show();
                    $('#modalpengembalianfoto').modal();


                }
            }

        });


    }
</script>