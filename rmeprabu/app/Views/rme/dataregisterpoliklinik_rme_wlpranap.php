<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Periksa</th>
            <th>Waktu Pengkajian</th>
            <th>Nomor Rekam Medis</th>
            <th>Ruangan</th>
            <th>Dokter</th>
            <th>Perawat</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $row['admissionDate']; ?></td>
                <td><?= $row['createddate']; ?></td>
                <td><?= $row['pasienid']; ?>
                    </br><?= $row['pasienname']; ?></td>
                <td><?= $row['poliklinikname']; ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['paramedicName'] ?> <?php ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>