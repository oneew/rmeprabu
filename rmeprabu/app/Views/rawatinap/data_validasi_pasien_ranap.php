<table id="dataperawat" class="table display table-bordered table-striped no-wrap">
    <thead>
        <tr>

            <th>#</th>
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
                <td>
                    <button id="print" class="btn btn-danger btn-outline btn btnbatalperiksa" type="button" onclick="BatalPeriksa('<?= $row['id'] ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Batal Ranap?</button>
                </td>
                <td><button type="button" class="btn btn-success btn-sm" onclick="validasipasienmasuk('<?= $row['id'] ?>')"> <i class="fas fa-bed"></i></button></td>
                <td><?= $row['datetimein'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
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
        $('#dataperawat').DataTable();


    });

    function validasipasienmasuk(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ValidasiDaftarRanap/validasipasienmasuk'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalvalidasipasienmasukranap').modal('show');

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
<script>
    function BatalPeriksa(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan membatalkan pendaftaran pasien ini ?",
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
                    url: "<?php echo base_url('ValidasiDaftarRanap/BatalPeriksa'); ?>",
                    data: {
                        id: id,
                        modifiedby: $('#createdby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    // berangkat();
                                    location.reload();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>