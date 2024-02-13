<table id="datariwayatCPPT" class="table display <?= (count($tampildata) > 1) ? "table-striped" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black; width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Hasil Asesmen Pasien dan Tatalaksana</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?php
                    $tanggal = $row['TANGGAL'];
                    echo date('d F Y', strtotime($tanggal)); ?></td>
                <td class="align-top" style="white-space: normal;"><b>
                        <h6>Subyektif
                    </b></h6>
                    <br><?= $row['SUBYEKTIF']; ?>

                    </br>
                    <br><b>
                        <h6>Obyektif
                    </b></h6>
                    <br> <?= $row['OBYEKTIF']; ?>

                    <br>Asesmen : <?= $row['ASSESMENT']; ?>
                    </br>
                    <br><b>
                        <h6>Planning
                    </b></h6>
                    </br>
                    <?= $row['PLANNING']; ?>

                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>