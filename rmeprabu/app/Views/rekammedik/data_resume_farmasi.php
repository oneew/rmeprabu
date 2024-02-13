<div class="table-responsive">
    <table id="datafarmasi" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Obat</th>
                <th>Dokter</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($FARMASI as $FAR) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $FAR['documentdate'] ?></td>
                    <td><?= $FAR['name'] ?> </td>
                    <td><?= $FAR['doktername'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>