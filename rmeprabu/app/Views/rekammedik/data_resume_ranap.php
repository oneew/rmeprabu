<div class="table-responsive">
    <table id="dataranap" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th>No</th>
                <th>Asal Masuk</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Pulang</th>
                <th>Cara Bayar</th>
                <th>Diagnosa Masuk</th>
                <th>DPJP</th>
                <th>Ruangan Terakhir</th>
                <th>Cara Pulang</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($RANAP as $K) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $K['groups'] ?></td>
                    <td><?= $K['datein'] ?> </td>
                    <td><?= $K['dateout'] ?> </td>
                    <td><?= $K['paymentmethodname'] ?> </td>
                    <td><?= $K['icdxname'] ?> </td>
                    <td><?= $K['doktername'] ?></td>
                    <td><?= $K['roomname'] ?></td>
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