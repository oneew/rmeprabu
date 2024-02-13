<table id="datariwayatCPPT" class="table display <?= (count($tampildata) > 1) ? "table-striped" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black; width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Perawat</th>
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
                    echo date('d F Y', strtotime($tanggal)); ?>
                    </br>
                    <h6><?= $row['groups']; ?></h6>
                </td>
                <td><?= $row['paramedicName']  ?></td>
                <td class="align-top" style="white-space: normal;"><b>
                        <h6>Subyektif
                    </b></h6>
                    <br>Keluhan Utama : <?= $row['keluhanUtama']; ?>

                    </br>
                    <br><b>
                        <h6>Obyektif
                    </b></h6>
                    <br>BB : <?= $row['tb']; ?>
                    <br>TB : <?= $row['bb']; ?>
                    <br>Sistolik : <?= $row['tdSistolik']; ?>
                    <br>Diastolik : <?= $row['tdDiastolik']; ?>
                    <br>Frekuensi Nadi : <?= $row['frekuensiNadi']; ?>
                    <br>Suhu : <?= $row['suhu']; ?>
                    <br>Frekuensi Nafas : <?= $row['frekuensiNafas']; ?>
                    <br>Skala Nyeri : <?= $row['skalaNyeri']; ?>
                    </br>
                    <br><b>
                        <h6>Asesmen
                    </b></h6>
                    <br>Diagnosa Keperawatan : <?= $row['DiagnosaAskep']; ?>
                    </br>
                    <br><b>
                        <h6>Planning
                    </b></h6>
                    <br>Kolaborasi dengan PPA/Medis
                    </br>
                    <?= $row['uraianAskep']; ?>

                </td>
                <td> Catatan :
                    <br> <?= $row['sasaranRencana']; ?>
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