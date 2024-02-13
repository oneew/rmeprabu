<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>StatusKlaim</th>
            <th>StatusValidasiKasir</th>
            <th>StatusVerifikasi</th>
            <th>TglKeluar</th>
            <th>NomorRekamMedis</th>
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

                    <button type="button" class="btn waves-effect waves-light btn-rounded  btn-outline-success btn-sm btn-card" onclick="Klaim('<?= $row['journalnumber'] ?>')"> <i class="fas fa-bed"></i></button>
                </td>

                <td><?= $no ?></td>
                <td><span class="<?php if ($row['klaim'] == 0) {
                                        echo "badge badge-danger";
                                        $periksa = "Belum Posting Klaim";
                                    } else {
                                        echo "badge badge-success";
                                        $periksa = "Sudah Posting Klaim";
                                    }  ?>"><?= $periksa; ?></span>
                    <br><span class="badge badge-info"><?= $row['petugasklaim']; ?></span>
                    <br><span class="badge badge-warning"><?= $row['tanggalklaim']; ?></span>
                </td>
                <td><span class="badge badge-danger"><?= $row['validation'] ?></span>

                </td>
                <td><span class="<?php if ($row['verifikasi'] == 0) {
                                        echo "badge badge-danger";
                                        $periksa = "Belum Verifikasi";
                                    } else {
                                        echo "badge badge-success";
                                        $periksa = "Sudah Verifikasi";
                                    }  ?>"><?= $periksa; ?></span></td>
                <td><?= $row['poliklinikname']; ?>
                    <br><?= $row['documentdate'] ?>
                </td>
                <td><?= $row['pasienid'] ?>
                    <br><?= $row['pasienname']; ?>
                    <br><?= $row['paymentmethodname']; ?>
                </td>
                <td><?= $row['doktername'] ?>

                </td>
                <td><?= $row['pasienaddress'] ?> <?php ?></td>

            </tr>

        <?php endforeach; ?>

    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();
    });

    function Klaim(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KlaimRawatJalan/lihatklaimrajal'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesverif) {
                    $('.viewmodalpindah').html(response.suksesverif).show();
                    $('#modalklaimrajal').modal('show');

                }
            }

        });


    }
</script>