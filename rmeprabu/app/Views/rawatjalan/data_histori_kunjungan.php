<div class="table-responsive">
    <table id="datahistori" class="table color-table success-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kunjungan</th>
                <th>Tanggal</th>
                <th>Nomor Journal</th>
                <th>No.SEP</th>
                <th>Nomor Rekam Medik</th>
                <th>Cara Pembayaran</th>
                <th>Pelayanan</th>
                <th>Dokter</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($kunjungan as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['groups'] ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['bpjs_sep'] ?></td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['paymentmethodname']  ?></td>
                    <td><?= $row['poliklinikname']  ?></td>
                    <td><?= $row['doktername']  ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>