<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>#</th>
            <th>Status Periksa</th>
            <th>Asesmen Medis</th>
            <th>Nomor Rekam Medis</th>
            <th>Poliklinik</th>
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
                <td><span class="<?php if ($row['validasipemeriksaan'] == 0) {
                                        echo "badge badge-danger";
                                        $periksa = "Belum";
                                    } else {
                                        echo "badge badge-success";
                                        $periksa = "Sudah";
                                    }  ?>"><?= $periksa; ?></span></td>
                <td>
                    <span class="badge badge-<?= check_resume_igd($row['journalnumber']) == 'ADA' ? 'success' : 'danger' ?>"><?= check_resume_igd($row['journalnumber']) ?></span>
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
                <td><?= $row['poliklinikname']; ?>
                    <br><?= $row['documentdate'] ?>
                </td>
                <td><?= $row['doktername'] ?>
                    <h6>Resume&cppt: <span class="badge badge-<?= check_resume_rj($row['journalnumber']) == 'ADA' ? 'success' : 'danger'  ?>"><?= check_resume_rj($row['journalnumber']) ?></span></h6>
                <td><?= $row['pasienaddress']; ?></td>

            </tr>

        <?php endforeach; ?>

    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();
    });

    function RME(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/entriRMEMedisIGD'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalrmerajal_poliklinik_medis_igd').modal('show');

                }
            }

        });


    }
</script>