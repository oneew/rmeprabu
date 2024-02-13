<div class="table-responsive">
    <table id="dataTNO" class="table color-table success-table">
        <thead>
            <tr>

                <th>No</th>
                <th>Tanggal</th>
                <th>JournalNumber</th>
                <th>Pelayanan</th>
                <th>Tarif</th>
                <th>Dokter</th>
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
                    <td><?= $row['name']  ?></td>
                    <td><?= number_format($row['totaltarif'], 2, ",", ".") ?></td>
                    <td><?= $row['doktername'] ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>