<table id="datariwayatCPPT" class="table display <?= (count($tampildata) > 1) ? "table-striped" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black; width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Dokter</th>
            <th>Hasil Asesmen Pasien dan Tatalaksana</th>
            <th>Intruksi</th>
            <th>Validasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?php
                    $tanggal = $row['createddate'];
                    echo date('d F Y', strtotime($tanggal));
                    ?>
                    </br> <?php
                            $tanggal = $row['createddate'];
                            $pisahJam = explode(" ", $tanggal);
                            $jam = $pisahJam[1];
                            echo $jam;
                            ?> </td>
                <td><?= $row['doktername']  ?>
                    <br><?= $row['poliklinikname']; ?>
                </td>
                <td class="align-top" style="white-space: normal;"><b>
                        <h6>Subyektif
                    </b></h6>
                    <br>Keluhan Utama : <?= $row['keluhanUtama']; ?>

                    </br>
                    <br><b>
                        <h6>Obyektif
                    </b></h6>
                    <br>BB : <?= $row['bb']; ?>
                    <br>TB : <?= $row['tb']; ?>
                    <br>Sistolik : <?= $row['tdSistolik']; ?>
                    <br>Diastolik : <?= $row['tdDiastolik']; ?>
                    <br>Frekuensi Nadi : <?= $row['frekuensiNadi']; ?>
                    <br>Suhu : <?= $row['suhu']; ?>
                    <br>Frekuensi Nafas : <?= $row['pernapasan']; ?>
                    <br><b><?= $row['objektive']; ?></b>
                    </br>
                    <br><b>
                        <h6>Asesmen
                    </b></h6>
                    <br>Diagnosa : <?= $row['diagnosis']; ?></br>
                    <br>Diagnosa primer : <?= $row['diagnosisprimer']; ?></br>
                    <br>Diagnosa sekunder : <?= $row['diagnosisSekunder']; ?></br>
                
                    <br><b>
                        <h6>Planning
                    </b></h6>
                    <br> <?= $row['planning']; ?>


                </td>
                <td> Catatan :
                    <br> <?= $row['tindakLanjut']; ?>
                </td>
                <td></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>




<script>
    $(document).ready(function() {
        $('#dataresumepenunjang').DataTable({
            responsive: true,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>