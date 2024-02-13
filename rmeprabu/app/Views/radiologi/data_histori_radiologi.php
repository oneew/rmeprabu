<div class="table-responsive">
    <table id="datahistoriradiologi" class="table color-table success-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Type</th>
                <th>Tanggal</th>
                <th>JournalNumber</th>
                <th>Pelayanan</th>
                <th>Tarif</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($Radiologi as $row) :
                $no++; ?>
                <tr>

                    <td><?= $no ?></td>
                    <td><?= $row['types'] ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['name']  ?></td>
                    <td><?= number_format($row['totaltarif'], 2, ",", ".");
                        ?></td>

                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>