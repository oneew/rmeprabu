<div class="modal fade" id="modalhistoripiutang" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Data Transaksi Terakhir Keuangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <table id="datapiutang" class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>


                            <th>No</th>
                            <th>Status</th>
                            <th>NoTransaksi</th>
                            <th>TotalBiaya</th>
                            <th>TotalBayar</th>
                            <th>SisaBayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="text-left"> Piutang Rawat Inap</td>
                        </tr>
                        <?php $no = 0;
                        foreach ($piutang as $row) :
                            $no++; ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><span class="<?php if ($row['paymentamount'] > $row['realcost']) {
                                                        echo "badge badge-info";
                                                        $kesimpulan = "LUNAS";
                                                    } else {
                                                        echo "badge badge-danger";
                                                        $kesimpulan = "PIUTANG";
                                                    }  ?>"><?= $kesimpulan ?></span>
                                    <br><span class="badge badge-info"><?= $row['paymentmethodname']; ?></span>
                                </td>

                                <td><?= $row['documentdate'] ?>
                                    <br>
                                    <span class="badge badge-warning"><?= $row['journalnumber'] ?></span>
                                    <br>
                                    <b><?= $row['pasienid']  ?>
                                        <br>
                                        <?= $row['pasienname'] ?></b>
                                    <br><span class="badge badge-success"><?= $row['referencenumber']; ?></span>
                                </td>
                                <td><?= number_format($row['realcost'], 2, ",", ".") ?></td>
                                <td><?= number_format($row['paymentamount'], 2, ",", ".") ?></td>
                                <td><b><?php $sisabayar = $row['realcost'] - $row['paymentamount'];
                                        if ($sisabayar <= 0) {
                                            $sisa = 0;
                                        } else {
                                            $sisa = $sisabayar;
                                        }
                                        echo number_format($sisa, 2, ",", ".");
                                        ?></b>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        <tr>
                            <td colspan="7" class="text-left"> Piutang Rawat Jalan / IGD</td>
                        </tr>
                        <?php $no = 0;
                        foreach ($piutangrajal as $rowrajal) :
                            $no++; ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><span class="<?php if ($rowrajal['paymentamount'] > $rowrajal['subtotal']) {
                                                        echo "badge badge-info";
                                                        $kesimpulan = "LUNAS";
                                                    } else {
                                                        echo "badge badge-danger";
                                                        $kesimpulan = "PIUTANG";
                                                    }  ?>"><?= $kesimpulan ?></span>
                                    <br><span class="badge badge-info"><?= $rowrajal['paymentmethodname']; ?></span>
                                </td>

                                <td><?= $rowrajal['documentdate'] ?>
                                    <br>
                                    <span class="badge badge-warning"><?= $rowrajal['journalnumber'] ?></span>
                                    <br>
                                    <b><?= $rowrajal['pasienid']  ?>
                                        <br>
                                        <?= $rowrajal['pasienname'] ?></b>
                                    <br><span class="badge badge-success"><?= $rowrajal['referencenumber']; ?></span>
                                </td>
                                <td><?= number_format($rowrajal['subtotal'], 2, ",", ".") ?></td>
                                <td><?= number_format($rowrajal['paymentamount'], 2, ",", ".") ?></td>
                                <td><b><?php $sisabayar = $rowrajal['subtotal'] - $rowrajal['paymentamount'];
                                        if ($sisabayar <= 0) {
                                            $sisa = 0;
                                        } else {
                                            $sisa = $sisabayar;
                                        }
                                        echo number_format($sisa, 2, ",", ".");
                                        ?></b>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
    $(document).ready(function() {
        $('#datapiutang').DataTable();
    });
</script>