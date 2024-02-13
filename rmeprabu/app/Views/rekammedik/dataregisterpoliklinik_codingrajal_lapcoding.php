<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>TglCoding</th>

            <th>NomorRekamMedis</th>
            <th>Poliklinik</th>

        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['created_at'] ?>
                    <br><?= $row['createdby'] ?>
                </td>

                <td><?= $row['pasienid'] ?>
                    <br><?= $row['pasienname'] ?>[<?= $row['pasiengender'] ?>]
                    <br><?= $row['pasiendateofbirth'] ?>
                </td>
                <td><?= $row['paymentmethodname'] ?>
                    <br><?= $row['poliklinikname'] ?>
                    <br><?= $row['doktername'] ?>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>