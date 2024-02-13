<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>No</th>
            <th>TglValidasi</th>
            <th>NomorRekamMedis</th>
            <th>MetodePembayaran</th>
            <th>RuanganTerakhir</th>
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
                        <button type="button" id="btn-card" class="btn waves-effect waves-light btn-rounded  btn-outline-secondary btn-sm btn-card" data-pasiencard="<?= $row['paymentcardnumber']; ?>" data-registerdate="<?= $row['documentdate']; ?>"><span class="mr-1"><i class="fa fa-check"></i></span>Cek</button>
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnprintsep" onclick="Cetak('<?= $row['referencenumber']; ?>')"> <i class="fas fa-compress"></i></button>
                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?>
                        <br>No Trans: <?= $row['validationnumber']; ?>
                        <br><small class="form-text text-muted"><?= $row['createdby']; ?> [<?= $row['createddate']; ?>]</small>
                    </td>
                    <td><?= $row['pasienid'] ?>
                        <br> <?= $row['pasienname']; ?>
                        <br> <?= $row['journalnumber']; ?>


                    </td>
                    <td><?= $row['paymentmethodname'] ?>
                        <br>Tagihan :<?= number_format($row['grandtotal'], 2, ",", "."); ?>
                        <br>Pembayaran : <?php
                                            $bayar = $row['paymentamount'] + $row['nominaldebet'];
                                            if ($row['grandtotal'] > $bayar) {
                                                $nominalbayar = $bayar;
                                            } else {
                                                $nominalbayar = $row['grandtotal'];
                                            }
                                            echo number_format($nominalbayar, 2, ",", "."); ?>
                        <br><span class="<?php 
                            $sisa=$row['grandtotal']-$row['paymentamount'];
                            if ($row['grandtotal'] > $row['paymentamount'] or $sisa>1) {
                                                echo "badge badge-danger";
                                                $status = "piutang";
                                            } else {
                                                echo "badge badge-success";
                                                $status = "lunas";
                                            }  ?>"><?= $status; ?></span>
                        <br><small class="form-text text-muted"><?= $row['payersname']; ?></small>
                    </td>
                    <td><?= $row['roomname'] ?>
                        <br>
                        <?= $row['doktername']; ?>
                        <br><?= $row['referencenumber']; ?>
                        <br>TglKeluar : <?= $row['dateout']; ?>
                        <br><?= $row['statuspasien']; ?>

                    </td>
                    <td><?= $row['pasienaddress'] ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function Cetak(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRanap/lihatrincianranap_validasi'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesbayar) {
                    $('.viewmodalvalidasiranap').html(response.suksesbayar).show();
                    $('#modalpembayaranranap_validasi').modal('show');

                }
            }

        });
    }
</script>