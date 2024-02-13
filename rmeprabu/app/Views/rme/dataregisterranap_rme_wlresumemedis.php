<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Rekam Medis</th>
            <th>Poliklinik</th>
            <th>Dokter</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $row['pasienid']; ?>
                    </br><?= $row['pasienname']; ?>
                    </br><?= $row['paymentmethodname']; ?>
                </td>
                <td><?= $row['poliklinikname']; ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['createddate'] ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>