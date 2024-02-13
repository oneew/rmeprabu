<div class="table-responsive">
    <table id="datakamar" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th>No</th>
                <th>Kelompok</th>
                <th>Tanggal</th>
                <th>Pelayanan</th>
                <th>Dokter</th>
                <th>JenisDiagnosa</th>
                <th>ICDX</th>
                <th>Deskripsi ICDX</th>
                <th>ICDIX</th>
                <th>Deskripsi ICDIX</th>
                <th>Tanggal Coding</th>
                <th>Coder</th>


            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DIAGNOSA as $K) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $K['types'] ?></td>
                    <td><?= $K['documentdate'] ?></td>
                    <td><?= $K['poliklinikname'] ?> </td>
                    <td><?= $K['doktername'] ?> </td>
                    <td><span class="<?php if ($K['coding'] == "ICDIX") {
                                            echo "badge badge-danger";
                                        } else {
                                            echo "badge badge-success";
                                        }  ?>">
                            <?= $K['coding'] ?></span> </td>
                    <td><?= $K['codeicdx'] ?> </td>
                    <td><?= $K['nameicdx'] ?> </td>
                    <td><?= $K['codeicdix'] ?> </td>
                    <td><?= $K['nameicdix'] ?> </td>
                    <td><?= $K['createddate'] ?> </td>
                    <td><?= $K['createdby'] ?> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>