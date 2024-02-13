<div class="table-responsive">
    <table id="dataoperasi" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Kelompok Penunjang</th>
                <th>Tanggal</th>
                <th>Nama Pemeriksaan</th>
                <th>Dokter Pemeriksa</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($RANAP as $K) :
                $no++;
            ?>
                <tr>
                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm" onclick="laporanpenunjang('<?= $K['id'] ?>')"> <i class="fas fa-download"></i></button></td>
                    <td><?= $no ?></td>
                    <td><span class="<?php if ($K['types'] == "BD") {
                                            echo "badge badge-danger";
                                            $pem = 'Bank Darah';
                                        } else {
                                            if ($K['types'] == "RAD") {
                                                echo "badge badge-success";
                                                $pem = 'Radiologi';
                                            } else {
                                                if ($K['types'] == "LPK") {
                                                    echo "badge badge-info";
                                                    $pem = 'Laboartorium Patologi Klinik';
                                                } else {
                                                    if ($K['types'] == "LPA") {
                                                        echo "badge badge-warning";
                                                        $pem = 'Laboartorium Patologi Anatomi';
                                                    }
                                                }
                                            }
                                        }  ?>">
                            <?= $pem ?></span> </td>
                    <td><?= $K['documentdate'] ?></td>
                    <td><?= $K['name'] ?> </td>
                    <td><?= $K['employeename'] ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>