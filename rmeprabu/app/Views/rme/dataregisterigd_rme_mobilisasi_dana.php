<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>#</th>
            <th>Status Verifikasi Mobdan</th>
            <th>Catatan Verifikasi</th>
            <th>Status Kodifikasi</th>
            <th>Status Periksa</th>
            <th>Nomor Rekam Medis</th>
            <th>Poliklinik</th>
            <th>Dokter</th>
            <th>Alamat</th>
            <th>Total Biaya</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tampildata as $no => $row) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td> <button type="button" class="btn btn-success btn-sm btn-rounded" onclick="LihatRME('<?= $row['id'] ?>')"> <i class="fas fa-file-medical"></i></button></td>
                <td>
                    <span class="badge badge-<?= $row['verifikasimobdan'] == 0 ? 'danger' : 'success' ;?>"><?= $row['verifikasimobdan'] == 0 ? 'Belum' : 'Sudah' ;?></span>
                    </br>
                    <?php if ($row['verifikasimobdan'] == 0) {
                        $stat = "Belum Verifikasi";
                    }
                    if ($row['verifikasimobdan'] == 1) {
                        $stat = "Sudah Verifikasi";
                    }
                    if ($row['verifikasimobdan'] == 2) {
                        $stat = "Revisi";
                    }
                    if ($row['verifikasimobdan'] == 3) {
                        $stat = "Verifikasi Dengan Catatan";
                    }
                    echo $stat; ?>

                </td>
                <td><b><?= $row['catatanVerifikasiMobdan']; ?></b></td>
                <td>
                    <span class="badge badge-<?= $row['verifikasidiagnosarajal'] == 0 ? 'danger' : 'success' ;?>"><?= $row['verifikasidiagnosarajal'] == 0 ? 'Belum' : 'Sudah' ;?></span>
                    </br>
                    <?= $row['verifikasidiagnosarajal'] == 0 ? 'Belum Verifikasi' : 'Sudah Verifikasi' ;?>
                </td>
                <td>
                    <span class="badge badge-<?= $row['validasipemeriksaan'] == 0 ? 'danger' : 'success' ;?>"><?= $row['validasipemeriksaan'] == 0 ? 'Belum' : 'Sudah' ;?></span>
                </td>
                <td>
                    <img src="<?= $row['pasiengender'] == 'L' ? base_url('assets/images/users/avatarlaki.jpeg') :  base_url('assets/images/users/avatarperempuan.jpeg') ;?>" class="rounded-circle" width="30" alt="avatar">
                    <?= $row['pasienid'] ?>
                    <br><?= $row['pasienname']; ?>
                    <br><?= $row['paymentmethodname']; ?>

                </td>



                <td><?= $row['poliklinikname']; ?>
                    <br><?= date('d-m-Y', strtotime($row['documentdate'])) ?>
                    <br>
                    <h6><?= $row['statuspasien']; ?></h6>
                    <h6>Resume: <span class="badge badge-<?= check_resume_rj($row['journalnumber']) == 'ADA' ? 'success' : 'danger'  ?>"><?= check_resume_rj($row['journalnumber']) ?></span></h6>
                </td>

                <td><?= $row['doktername'] ?>

                </td>
                <td><?= $row['pasienaddress'] ?> <?php ?></td>
                <td>
                    <span class="badge badge-<?= hitung_biaya_rajal($row['journalnumber']) == 'Belum Validasi Kasir' ? 'danger' : 'success' ;?>"><?= hitung_biaya_rajal($row['journalnumber']) ;?></span>
                </td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();
    });

    function LihatRME(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/entriRMEMobilisasiDanaIGD'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalrmerajal_igd_mobilisasi_dana').modal('show');

                }
            }

        });


    }
</script>