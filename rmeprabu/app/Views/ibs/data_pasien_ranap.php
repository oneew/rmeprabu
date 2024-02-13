<table id="dataperawat" class="table display table-bordered table-striped no-wrap">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>PasienID</th>
            <th>Nama Pasien</th>
            <th>Cara Bayar</th>
            <th>SMF</th>
            <th>Dokter</th>
            <th>Kelas</th>
            <th>Ruangan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>

                <td><?= $no ?></td>
                <td><button type="button" class="btn btn-info btn-sm" onclick="edit('<?= $row['id'] ?>')"> <i class="fa fa-tags"></i></button></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['referencenumber'] ?>
                    <br><b><?= $row['statusrawatinap']; ?></b>
                </td>
                <td><?= $row['pasienid']  ?></td>
                <td><?= $row['pasienname'] ?>
                    <br><span class="<?php if ($row['covid'] == 1) {
                                            echo "badge badge-danger";
                                            $periksa = "Terkonfirmasi Covid";
                                        } else {
                                            echo "badge badge-success";
                                            $periksa = "Non Covid";
                                        }  ?>"><?= $periksa; ?></span>
                    <br><span class="<?php if ($row['koinsiden'] == 1) {
                                            echo "badge badge-warning";
                                            $koinsiden = "Pasien Koinsiden";
                                        } else {
                                            $koinsiden = '';
                                        } ?>"><?= $koinsiden; ?></span>
                </td>
                <td><?= $row['paymentmethodname'] ?></td>
                <td><?= $row['smfname'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['classroomname'] ?></td>
                <td><?= $row['roomname'] ?></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });

    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('rawatinap/formedit'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldaftaribs').modal('show');

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