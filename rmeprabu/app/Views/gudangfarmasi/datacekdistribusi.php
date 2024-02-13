<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Distribusi</th>
            <th>Penerima</th>
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
                    </td>
                    <td><?= $row['referencelocationname']; ?>
                        <br> No. Distribusi : <?= $row['journalnumber']; ?>
                        <br> No. Permintaan : <?= $row['referencenumber']; ?>
                    </td>
                    <td><?= $row['code']; ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= ABS($row['qty']) ?></td>
                    <td><?= $row['uom'] ?></td>
                    <td><?= $row['batchnumber'] ?></td>
                    <td><?= $row['createdby'] ?></td>
                    <td><?= $row['createddate'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>