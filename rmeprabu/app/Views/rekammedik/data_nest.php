<table id="radiologi" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>jenis</th>
            <th>id</th>
            <th>Nama</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($data as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['namemakanan'] ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['pasienid'] ?></td>
                <td>
                    <table style="border-collapse: collapse; width: 100%; height: 36px;" border="1">
                        <tbody>
                            <tr style="height: 18px;">
                                <td style="width: 25%; text-align: center; height: 18px;">No</td>
                                <td style="width: 25%; text-align: center; height: 18px;">Pemeriksaan</td>
                                <td style="width: 25%; text-align: center; height: 18px;">Jumlah</td>
                                <td style="width: 25%; text-align: center; height: 18px;">Harga</td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 25%; height: 18px;">&nbsp;</td>
                                <td style="width: 25%; height: 18px;">&nbsp;</td>
                                <td style="width: 25%; height: 18px;">&nbsp;</td>
                                <td style="width: 25%; height: 18px;">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>
</table>
</div>