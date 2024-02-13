<div class="table-responsive">
    <table id="dataoperasi" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kelompok Operasi</th>
                <th>Nama Prosedur</th>
                <th>Kategori Operasi</th>
                <th>Dokter Operator</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($RANAP as $K) :
                $no++;
            ?>
                <tr>
                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm" onclick="laporanoperasi('<?= $K['id'] ?>')"> <i class="fas fa-download"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $K['documentdate'] ?></td>
                    <td><?= $K['types'] ?> </td>
                    <td><?= $K['name'] ?> </td>
                    <td><?= $K['operationgroup'] ?> </td>
                    <td><?= $K['doktername'] ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>