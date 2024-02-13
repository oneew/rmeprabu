<table id="dataperawat" class="table display table-bordered table-striped no-wrap">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>JournalNumber</th>
            <th>PasienID</th>
            <th>Nama Pasien</th>
            <th>Cara Bayar</th>
            <th>KelasPerawatan</th>
            <th>Ruangan</th>
            <th>BedNumber</th>
            <th>Dokter</th>
            <th>Memo</th>
            <th>Memo</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>

                <td><?= $no ?></td>
                <td><button type="button" class="btn btn-warning btn-sm" onclick="validasipasienpindah('<?= $row['id'] ?>')"> <i class="fas fa-bed"></i></button></td>
                <td><?= $row['datetimein'] ?></td>
                <td><?= $row['journalnumber']?></td>
                <td><?= $row['pasienid']  ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['paymentmethodname'] ?></td>
                <td><?= $row['classroom'] ?></td>
                <td><?= $row['roomname'] ?></td>
                <td><?= $row['bednumber'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['memo'] ?></td>
                <td><?= $row['referencenumber'] ?></td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable({
            scrollX : true,
        });



    });

    function validasipasienpindah(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ValidasiDaftarRanap/validasipasienpindah'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalvalidasipasienmasukranappindah').modal('show');

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