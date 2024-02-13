<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>#</th>
            <th>Status Periksa</th>
            <th>Asesmen Perawat</th>
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
                <td>
                    <button type="button" class="btn btn-success btn-sm btn-rounded" onclick="RME('<?= $row['id']; ?>')"> <i class="fas fa-file-medical"></i></button>
                </td>
                <td>
                    <span class="badge badge-<?= $row['validasipemeriksaan'] == 0 ? 'danger' : 'success' ;?>"><?= $row['validasipemeriksaan'] == 0 ? 'Belum' : 'Sudah' ;?></span>
                </td>
                <td>
                    <span class="badge badge-<?= check_asesmen_perawat_rj($row['journalnumber']) == 'SUDAH DIISI' ? 'success' : 'danger'?>"><?= check_asesmen_perawat_rj($row['journalnumber']) ?></span>
                </td>
                <td>
                    <img src="<?= $row['pasiengender'] == 'L' ? base_url('assets/images/users/avatarlaki.jpeg') : base_url('assets/images/users/avatarperempuan.jpeg') ;?>" class="rounded-circle" width="30" alt="avatar">
                    <?= $row['pasienid']; ?>
                    <br><?= $row['pasienname']; ?>
                    <br><?= $row['paymentmethodname']; ?>
                </td>
                <td>
                    <?= $row['poliklinikname']; ?>
                    <br>
                    <?= $row['documentdate']; ?>
                </td>
                <td>
                    <?= $row['doktername']; ?>
                </td>
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
            url: "<?php echo base_url('PelayananRawatJalanRME/entriRME'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalrmerajal_poliklinik').modal('show');

                }
            }

        });


    }
</script>