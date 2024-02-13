<div class="table-responsive">
    <table id="datarajal" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Poliklinik</th>
                <th>Cara Bayar</th>
                <th>No Jaminan</th>
                <th>Dokter</th>
                <th>Sebab Masuk</th>
                <th>Diagnosa Masuk</th>
                <th>Deskripsi</th>
                <th>Cara Pulang</th>


            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($POLI as $K) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $K['documentdate'] ?></td>
                    <td><?= $K['poliklinikname'] ?> </td>
                    <td><?= $K['paymentmethodname'] ?> </td>
                    <td><?= $K['bpjs_sep'] ?> </td>
                    <td><?= $K['doktername'] ?></td>
                    <td><?= $K['reasoncode'] ?> </td>
                    <td><?= $K['icdx'] ?> </td>
                    <td><?= $K['icdxname'] ?> </td>
                    <td><span class="<?php if (($K['statuspasien'] == "DIRAWAT") or ($K['statuspasien'] == "DIRAWAT APS")) {
                                            echo "badge badge-danger";
                                        } else {
                                            echo "badge badge-success";
                                        }  ?>">
                            <?= $K['statuspasien'] ?></span> </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>