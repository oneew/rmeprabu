<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>#</th>
            <th>Status Varifikasi Mobdan</th>
            <th>Catatan Verifikasi</th>
            <th>Status Kodifikasi</th>
            <th>Status Validasi Kasir</th>
            <th>Nomor Rekam Medis</th>
            <th>Ruangan Terakhir</th>
            <th>Dokter</th>
            <th>Alamat</th>
            <th>Total Biaya</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tampildata as $no => $row) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td> <button type="button" class="btn btn-success btn-sm btn-rounded" onclick="LihatRMERanap('<?= $row['id'] ?>')"> <i class="fas fa-file-medical"></i></button></td>
                <td><span class="<?php if ($row['verifikasimobdan'] == 0) {
                                        echo "badge badge-danger";
                                        $periksa = "Belum";
                                    } else {
                                        echo "badge badge-success";
                                        $periksa = "Sudah";
                                    }  ?>"><?= $periksa; ?></span>
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

                <td><span class="<?php if ($row['verifikasidiagnosa'] == 0) {
                                        echo "badge badge-danger";
                                        $periksa = "Belum";
                                    } else {
                                        echo "badge badge-success";
                                        $periksa = "Sudah";
                                    }  ?>"><?= $periksa; ?></span>
                                     </br>
                    <?php if ($row['verifikasidiagnosa'] == 0) {
                        $stat = "Belum Verifikasi";
                    }
                    if ($row['verifikasidiagnosa'] == 1) {
                        $stat = "Sudah Verifikasi";
                    }
                    echo $stat; ?>
                </td>
        
                <td><span class="<?php if ($row['validation'] == "BELUM") {
                                        echo "badge badge-danger";
                                        $periksa = "Belum";
                                    } else {
                                        echo "badge badge-success";
                                        $periksa = "Sudah";
                                    }  ?>"><?= $periksa; ?></span></td>
                <td>
                    <img src="<?= $row['pasiengender'] == 'L' ? base_url('assets/images/users/avatarlaki.jpeg') : base_url('assets/images/users/avatarperempuan.jpeg') ;?>" class="rounded-circle" width="30" alt="avatar">
                    <?= $row['pasienid'] ?>
                    <br><?= $row['pasienname']; ?>
                    <br><?= $row['paymentmethodname']; ?>

                </td>



                <td><?= $row['roomname']; ?>
                    <b>  <br><b>Tanggal Jam Masuk : </b><?= $row['datetimein'] ?></b>
                    <b>  <br><b>Tanggal Jam Keluar : </b><?= $row['datetimeout'] ?></b>
                    <b>  <br><b>Resume : </b>
                    <span class="badge badge-<?= check_resume_ranap($row['referencenumber']) == 'ADA' ? 'success' : 'danger' ;?>">
                            <?= check_resume_ranap($row['referencenumber']) ?>
                    </span>
                    </b>
                </td>

                <td><?= $row['doktername'] ?>

                </td>
                <td><?= $row['pasienaddress'] ?> <?php ?></td>
                <td>
                    <span class="badge badge-<?= hitung_biaya_ranap($row['referencenumber']) == 'Belum Validasi Kasir' ? 'danger' : 'success' ;?>">
                        <?= hitung_biaya_ranap($row['referencenumber'])  ;?>
                    </span>
                </td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();
    });

    function LihatRMERanap(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/entriRMEMobilisasiDanaRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalrmeranap_mobilisasi_dana').modal('show');

                }
            }

        });


    }
</script>