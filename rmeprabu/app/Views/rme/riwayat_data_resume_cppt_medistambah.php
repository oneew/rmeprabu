<div class="table-responsive d-block">
    <table id="datariwayatCPPTMedis" class="w-100 table display <?= (count($tampildata) > 1) ? "" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black;">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Perawat</th>
                <th>Hasil Asesmen Pasien dan Tatalaksana</th>
                <th>Intruksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tampildata as $no => $row) : ?>
                <tr>
                    <td><?= ++$no; ?></td>
                    <td>
                        <?php
                        $tanggal = $row['createddate'];
                        echo date('d F Y', strtotime($tanggal)); ?>
                        </br>
                        <?php
                        $tanggal = $row['createddate'];
                        $pisahJam = explode(" ", $tanggal);
                        $jam = $pisahJam[1];
                        echo $jam;
                        ?>
                    </td>
                    <td>
                        <h6><?= $row['doktername']  ?></h6>
                        <br><?= $row['poliklinikname']; ?>
                    </td>
                    <td class="align-top" style="white-space: normal;">
                        <h6><strong>Subyektif</strong></h6>
                        <br>Keluhan Utama : <?= $row['keluhanUtama']; ?>

                        </br>
                        <br>
                        <h6><strong>Obyektif</strong></h6>
                        <br>BB : <?= $row['bb']; ?>
                        <br>TB : <?= $row['tb']; ?>
                        <br>Sistolik : <?= $row['tdSistolik']; ?>
                        <br>Diastolik : <?= $row['tdDiastolik']; ?>
                        <br>Frekuensi Nadi : <?= $row['frekuensiNadi']; ?>
                        <br>Suhu : <?= $row['suhu']; ?>
                        <br>Frekuensi Nafas : <?= $row['pernapasan']; ?>
                        <br>
                        <strong><?= $row['objektive']; ?></strong>
                        </br>
                        <br>
                        <h6><strong>Asesmen</strong></h6>
                        <br>Diagnosa : <?= $row['diagnosis']; ?>
                        </br>
                        <br>
                        <h6><strong>Planning</strong></h6>
                        <br> <?= $row['planning']; ?>
                    </td>
                    <td> Catatan :
                        <br> <?= $row['tindakLanjut']; ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" onclick="gunakanRiwayat('<?= $row['id'] ?>')"> <i class="fas fa-download"></i> Gunakan Riwayat</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#datariwayatCPPTMedis').DataTable({
            responsive: true,
            // fixedHeader: {
            //     header: true,
            //     footer: true
            // },
            // scrollY: "200px",
            // scrollCollapse: true,
            // scrollX: true,
            // fixedHeader: true
        });
    });
</script>


<script>
    function gunakanRiwayat(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/detailCPPTtambah'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                // $('#objective').val(response.objektive);
                // $('#keluhanUtama').val(response.keluhanUtama);
                // $('#riwayatPenyakitSekarang').val(response.riwayatPenyakitSekarang);
                // $('#riwayatPenyakitKeluarga').val(response.riwayatPenyakitKeluarga);
                // $('#diagnosis').val(response.diagnosis);
                // $('#objective_medis').val(response.planning);
                // $('#objective').val(response.objektive);
                // $('#modalresume_cppttambah').modal('hide');

                $('#objective1').val(response.objektive);
                $('#subjective1').val(response.keluhanUtama);
                $('#asesmen1').val(response.diagnosis);
                $('#planning1').val(response.planning);
                $('#modalresume_cppttambah').modal('hide');
                
            }
        });
    }
</script>