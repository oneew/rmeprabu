<table id="dataperawat" class="table display table-bordered table-striped no-wrap">
    <thead>
        <tr>


            <th>No</th>
            <th>Tanggal</th>
            <th>JournalNumber</th>
            <th>PasienID</th>
            <th>Nama Pasien</th>
            <th>Cara Bayar</th>
            <th>Dokter</th>
            <th>Status</th>


        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>

                <td><?= $no ?></td>

                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['pasienid']  ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['paymentmethod'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><span class="<?php if ($row['status'] == "ORDER") {
                                        echo "badge badge-warning";
                                    } else if ($row['status'] == "APPROVED") {
                                        echo "badge badge-success";
                                    } else {
                                        echo "badge badge-danger";
                                    }  ?>"><?= $row['status'] ?></span></td>


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
            url: "<?php echo base_url('OrderPendaftaranBD/order'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalorderdaftarbd').modal('show');

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