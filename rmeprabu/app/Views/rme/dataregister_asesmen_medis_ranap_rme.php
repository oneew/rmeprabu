<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Asesmen Medis</th>
            <th>Nomor Rekam Medis</th>
            <th>Ruangan</th>
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
                <td><?= $no; ?></td>
                <td> <button type="button" class="btn btn-success btn-sm btn-rounded" onclick="RME('<?= $row['id'] ?>')"> <i class="fas fa-file-medical"></i></button></td>
                <td>
                    <span class="badge badge-<?= check_asesmen_medis_ranap($row['referencenumber']) == 'SUDAH DIISI' ? 'success' : 'danger' ?>"><?= check_asesmen_medis_ranap($row['referencenumber']) ?></span>
                </td>
                <td>
                    <?php
                    if ($row['pasiengender'] == "L") {
                        $gambar = '../assets/images/users/avatarlaki.jpeg';
                    } else {
                        $gambar = '../assets/images/users/avatarperempuan.jpeg';
                    }
                    echo "<img src='" . $gambar . "' class='rounded-circle' width='30'>";
                    ?>
                    <?= $row['pasienid'] ?>
                    <br><?= $row['pasienname']; ?>
                    <br><?= $row['paymentmethodname']; ?>

                </td>
                <td><?= $row['roomname']; ?>
                    <br><?= $row['datetimein'] ?>
                </td>
                <td><?= $row['doktername'] ?> </td>
                <td><?= $row['pasienaddress'] ?> <?php ?></td>

            </tr>

        <?php endforeach; ?>

    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#registerranap').DataTable();
    });

    function RME(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/entriRMEMedisRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalrme_ranap_medis').modal('show');

                }
            }

        });


    }
</script>