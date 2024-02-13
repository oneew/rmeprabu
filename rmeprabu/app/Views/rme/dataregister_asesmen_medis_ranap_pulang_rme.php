<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>#</th>
            <th>Nomor Rekam Medis</th>
            <th>Ruangan Terakhir</th>
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
                    <br><?= $row['datetimeout'] ?>
                </td>
                <td><?= $row['doktername'] ?>
                <b>  <br><b>Resume Medis: </b>
                    <span class="badge badge-<?= check_resume_ranap($row['referencenumber']) == 'ADA' ? 'success' : 'danger' ;?>">
                            <?= check_resume_ranap($row['referencenumber']) ?>
                    </span>
                    </b>
               </td>
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
            url: "<?php echo base_url('PelayananRawatJalanRME/entriRMEMedisRanapPulang'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalrme_ranap_medis_pulang').modal('show');

                }
            }

        });


    }
</script>