<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>


            <th>#</th>
            <th>StatusValidasi</th>
            <th>No</th>
            <th>TglMasuk</th>
            <th>TglKeluar</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>RuanganAsal</th>
            <th>RuanganTujuan</th>
            <th>MetodePembayaran</th>
            <th>Dokter</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;


        ?>
            <tr>

                <td>
                    <?php
                    if ($row['pasiengender'] == "L") {
                        $gambar = base_url() . '/assets/images/users/avatarlaki.jpeg';
                    } else {
                        $gambar = base_url() . '/assets/images/users/avatarperempuan.jpeg';
                    }
                    echo "<img src='" . $gambar . "' class='rounded-circle' width='30'>";
                    ?>
                    <button type="button" class="btn waves-effect waves-light btn-rounded  btn-outline-success btn-sm btn-card" onclick="CDP('<?= $row['journalnumber'] ?>')"> <i class="fas fa-bed"></i></button>
                    <?php if ($row['validation'] == "BELUM") { ?>
                        <button type="button" class="btn waves-effect waves-light btn-rounded  btn-outline-danger btn-sm" onclick="hapusPindah('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                    <?php } ?>
                </td>
                <td><?php echo $row['validation'] ?>
                    </br>

                    <?php $kata = $row['validationnumber'];
                    $jurus = substr($kata, 4, 20);
                    echo  $jurus; ?>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['datetimein'] ?></td>
                <td><?= $row['datetimeout'] ?></td>
                <td><?= $row['pasienid'] ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['roomname'] ?> [<?= $row['bednumber']; ?>] [<?= $row['classroomname']; ?>]</td>
                <td><?= $row['transferroomname'] ?> [<?= $row['transferbednumber']; ?>] [<?= $row['transferclassroom']; ?>]</td>
                <td><?= $row['paymentmethodname'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['pasienaddress'] ?> <?php ?></td>

            </tr>

        <?php endforeach; ?>

    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();
    });

    function CDP(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/DactPindah'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.suksespindah) {
                    $('.viewmodalpindah').html(response.suksespindah).show();
                    $('#mdrp').modal('show');

                }
            }

        });


    }
</script>


<script>
    function hapusPindah(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan membatalkan pindah kamar ?",
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
                    url: "<?php echo base_url('PelayananRanap/hapusPindahKamar'); ?>",
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
                            dataRegisterPoli();
                        }
                    }

                });


            }
        })

    }
</script>