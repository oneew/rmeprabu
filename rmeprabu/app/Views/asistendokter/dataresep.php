<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Pelayanan</th>
                <th>Dokter</th>
                <th>Norm</th>
                <th>Nama Pasien</th>
                <th>Kode</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DetailObat as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['groups']; ?></td>
                    <td><?= $row['doktername']; ?></td>
                    <td><?= $row['pasienid']; ?></td>
                    <td><?= $row['pasienname']; ?></td>
                    <td>[<?= $row['code']  ?>] <b><?= $row['name']  ?></b>
                        <br><?= $row['uom']  ?>
                    </td>
                    <td><?= ABS($row['qtypaket']) ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>