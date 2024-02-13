<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>BatchNumber</th>
                <th>Exp.dDate</th>
                <th>Box</th>
                <th>Harga/Box</th>
                <th>IsiBox</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Pot%</th>
                <th>PPn%</th>
                <th>TotalRp%</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DetailObat as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapus('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['code']  ?></td>
                    <td><?= $row['name']  ?></td>
                    <td><?= $row['batchnumber']  ?></td>
                    <td><?= $row['expireddate']  ?></td>
                    <td><?= $row['qtybox']  ?></td>
                    <td><?= number_format($row['price'], 2, ",", "."); ?></td>
                    <td><?= $row['volume']  ?></td>
                    <td><?= $row['qty']  ?></td>
                    <td><?= $row['uom']  ?></td>
                    <td><?= number_format(($row['price'] * $row['qtybox']), 2, ",", "."); ?></td>
                    <td><?= number_format($row['disc'], 2, ",", "."); ?></td>
                    <td><?= $row['tax']  ?></td>
                    <td><?php $pricetotal = $row['price'] * $row['qtybox'];
                        $subtotalawal = $pricetotal * ($row['disc'] / 100);
                        $subtotal = $pricetotal - $subtotalawal;
                        $potonganpajak = ($subtotal * ($row['tax'] / 100));
                        $totalbersih = $subtotal - $potonganpajak;
                        echo number_format($totalbersih, 2, ",", "."); ?></td>
                    <?php $Total[] = $totalbersih; ?>

                </tr>

            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <?php $check_Total = isset($Total) ? array_sum($Total) : 0;
            $grandtotal = $check_Total; ?>
            <td colspan="15" class="text-center">
                <h4>Grand Total : Rp.<?= number_format($grandtotal, 2, ",", "."); ?></h4>
            </td>
        </tfoot>
    </table>
</div>


<script>
    function hapus(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('ObatMasukGudang/hapus_detail_terima_non_pbf'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            detail_nonpbf();

                        }
                    }

                });


            }
        })

    }
</script>