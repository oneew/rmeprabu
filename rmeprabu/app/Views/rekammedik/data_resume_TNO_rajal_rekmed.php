<div class="table-responsive">
    <table id="dataTNO" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>JournalNumber</th>
                <th>Pelayanan</th>

                <th>Dokter</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($TNO as $row) :
                $no++; ?>
                <td><?= $no ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['name']  ?></td>
                <td><?= $row['doktername'] ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>