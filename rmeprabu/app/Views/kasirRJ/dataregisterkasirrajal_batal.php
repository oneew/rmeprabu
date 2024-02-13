<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>No</th>
            <th>TglValidasi</th>
            <th>NomorRekamMedis</th>
            <th>MetodePembayaran</th>
            <th>Poliklinik</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>

                    <td class="text-center">
                        <?php
                        $encrypter = \Config\Services::encrypter();
                        $nama = $row['id'];
                        $idx = $encrypter->encrypt($nama);
                        ?>
                        <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                        <input type="hidden" name="pasiencard" id="pasiencard" value="<?= $row['pasienid']; ?>">
                        <input type="hidden" name="registerdate" id="registerdate" value="<?= $row['documentdate']; ?>">

                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?>
                        <br><?= $row['memo']; ?>
                        <br><span class="badge badge-danger"><?= $row['alasanBatal']; ?></span>
                    </td>
                    <td><?= $row['pasienid'] ?>
                        <br> <?= $row['pasienname']; ?>
                        <br> <?= $row['journalnumber']; ?>


                    </td>
                    <td><?= $row['paymentmethodname'] ?>
                        <br>Tagihan :<?= $row['grandtotal']; ?>
                        <br>Pembayaran : <?php
                                            $bayar = $row['paymentamount'] + $row['nominaldebet'];
                                            if ($row['grandtotal'] > $bayar) {
                                                $nominalbayar = $bayar;
                                            } else {
                                                $nominalbayar = $row['grandtotal'];
                                            }
                                            echo number_format($nominalbayar, 2, ",", "."); ?>

                        <br><small class="form-text text-muted"><?= $row['cancelby']; ?> [<?= $row['created_at']; ?>]</small>
                    </td>
                    <td><?= $row['poliklinikname'] ?>
                        <br>
                        <?= $row['doktername']; ?>
                        <br><?= $row['referencenumber']; ?>

                    </td>
                    <td><?= $row['pasienaddress'] ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>