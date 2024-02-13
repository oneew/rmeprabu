<div class="table-responsive">
    <table id="dataperawat" class="table color-table purple-table">
        <thead>
            <tr>


                <th>No</th>
                <th>Tanggal</th>
                <th>JournalNumber</th>
                <th>Cara Bayar</th>
                <th>SMF</th>
                <th>DPJP</th>
                <th>Dokter Operator</th>
                <th>Dokter Anestesi</th>
                <th>Diagnosa</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>

                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['paymentmethod']  ?></td>
                    <td><?= $row['smfname'] ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?= $row['ibsdoktername'] ?></td>
                    <td><?= $row['ibsanestesiname'] ?></td>
                    <td><?= $row['icdxname'] ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>