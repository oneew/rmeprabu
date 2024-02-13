<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Terima</th>
            <th>Pengirim</th>
            <th>Kode Obat</th>
            <th>Nama Obat</th>
            <th>Volume</th>
            <th>Satuan</th>
            <th>Nomor Batch</th>
            <th>Operator</th>
            <th>Tanggal Entri</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?>
                        <br><span class="badge badge-success"><?= $row['journalnumber']; ?></span>
                    </td>
                    <td><?= $row['relationname']; ?>
                        <br> No. Faktur : <?= $row['referencenumber']; ?>
                    </td>
                    <td><?= $row['code']; ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['qty'] ?></td>
                    <td><?= $row['uom'] ?></td>
                    <td><?= $row['batchnumber'] ?></td>
                    <td><?= $row['createdby'] ?></td>
                    <td><?= $row['createddate'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>