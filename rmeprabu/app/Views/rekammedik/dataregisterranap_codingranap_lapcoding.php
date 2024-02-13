<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>TglCoding</th>
            <th>Coder</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>TanggalLahir</th>
            <th>JenisKelamin</th>
            <th>MetodePembayaran</th>
            <th>RuanganTerkahir</th>
            <th>Dokter</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['created_at'] ?></td>
                <td><?= $row['createdby'] ?></td>
                <td><?= $row['pasienid'] ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['pasiendateofbirth'] ?></td>
                <td><?= $row['pasiengender'] ?></td>
                <td><?= $row['paymentmethodname'] ?></td>
                <td><?= $row['poliklinikname'] ?></td>
                <td><?= $row['doktername'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>