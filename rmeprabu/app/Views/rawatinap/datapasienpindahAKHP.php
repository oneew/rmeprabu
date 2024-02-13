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
                    <button type="button" class="btn waves-effect waves-light btn-rounded  btn-outline-success btn-sm btn-card" onclick="CDPAKHP('<?= $row['journalnumber'] ?>')"> <i class="fas fa-bed"></i></button>

                </td>
                <td><?= $row['validation'] ?></td>
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

    function CDPAKHP(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PasienRanapAKHP/entriDactAKHPPINDAH'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalpindahakhp').html(response.sukses).show();
                    $('#modaldactranapakhp').modal('show');

                }
            }

        });


    }
</script>