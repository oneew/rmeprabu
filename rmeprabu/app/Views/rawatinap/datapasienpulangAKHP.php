<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>StatusValidasiKasir</th>
            <th>CaraPulang</th>
            <th>No</th>
            <th>TglMasuk</th>
            <th>TglKeluar</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>JenisKelamin</th>
            <th>Ruangan</th>
            <th>MetodePembayaran</th>
            <th>AsalMasuk</th>
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
                    <?php if ($row['validation'] == "BELUM") { ?>
                        <button type="button" class="btn btn-success btn-sm btn-rounded" onclick="CatatDactAKHPPasienPulang('<?= $row['id'] ?>')"> <i class="fas fa-bed"></i></button>
                    <?php } ?>

                </td>
                <td><span class="<?php if ($row['validation'] == "BELUM") {
                                        echo "badge badge-danger";
                                    } else {
                                        echo "badge badge-success";
                                    }  ?>"><?= $row['validation'] ?></span></td>
                <td><?= $row['statuspasien'] ?></td>
                <td><?= $no ?></td>
                <td><?= $row['datetimein'] ?></td>
                <td><?= $row['datetimeout'] ?></td>
                <td><?= $row['pasienid'] ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['pasiengender'] ?></td>
                <td><?= $row['roomname'] ?> [<?= $row['bednumber']; ?>] [<?= $row['classroomname']; ?>]</td>
                <td><?= $row['paymentmethodname'] ?></td>
                <td><?= $row['poliklinikname'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['pasienaddress'] ?> <?php ?></td>

            </tr>

        <?php endforeach; ?>

    </tbody>
</table>




<script>
    $(document).ready(function() {
        $('#dataregisterranap').DataTable({
            responsive: true
        });
    });

    function CatatDactAKHPPasienPulang(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PasienRanapAKHP/entriDactAKHPPasienPulang'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalpasienpulang').html(response.sukses).show();
                    $('#modaldactranapakhppulang').modal('show');
                }
            }
        });
    }
</script>