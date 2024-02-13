<table id="datariwayatCPPT" class="table display <?= (count($tampildata) > 1) ? "table-striped" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black; width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Dokter</th>
            <th>Hasil Asesmen Pasien dan Tatalaksana</th>
            <th>Intruksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td><?= $no; ?></td>
                <td>
                    <?= date('d F Y', strtotime($row['createddate'])) ;?>
                    <br><?= date('H:i:s', strtotime($row['createddate'])) ;?>
                </td>
                <td>
                    <?= $row['doktername']  ?>
                    <br><?= $row['poliklinikname']; ?>
                </td>
                <td class="align-top" style="white-space: normal;"><b>
                        <h6 class="mb-0"><strong>Subyektif</strong></h6>
                        Keluhan Utama : <?= $row['keluhanUtama']; ?>
                        
                        <h6 class="mt-3 mb-0"><strong>Obyektif</strong></h6>
                        BB : <?= $row['bb']; ?>
                        <br>TB : <?= $row['tb']; ?>
                        <br>Sistolik : <?= $row['tdSistolik']; ?>
                        <br>Diastolik : <?= $row['tdDiastolik']; ?>
                        <br>Frekuensi Nadi : <?= $row['frekuensiNadi']; ?>
                        <br>Suhu : <?= $row['suhu']; ?>
                        <br>Frekuensi Nafas : <?= $row['pernapasan']; ?>
                        <br><strong>Total GCS : <?= $row['totalGcs']; ?></strong>
                        <br><b><?= $row['objektive']; ?></b>
                        
                        <h6 class="mt-3 mb-0"><strong>Asesmen</strong></h6>
                        <br>Diagnosa : <?= $row['diagnosis']; ?>
                        <!-- <br>Diagnosa primer : ?= $row['diagnosisPrimer']; ?></br> -->
                        <br>Diagnosa sekunder : <?= $row['diagnosisSekunder']; ?>
                    
                        <h6 class="mt-3 mb-0"><strong>Planning</strong></h6>
                        <?= $row['planning']; ?>
                </td>
                <td> Catatan :
                    <br> <?= $row['tindakLanjut']; ?>
                </td>
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