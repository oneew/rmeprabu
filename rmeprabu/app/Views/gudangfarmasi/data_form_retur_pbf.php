<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>BatchNumber</th>
                <th>Satuan</th>
                <th>Exp.dDate</th>
                <th>Box</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Subtotal</th>
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
                    <td><?= $row['uom']  ?></td>
                    <td><?= $row['expireddate']  ?></td>
                    <td><?= ABS($row['qtybox'])  ?></td>

                    <td><?= $row['volume']  ?></td>
                    <td><?= ABS($row['qty'])  ?></td>
                    <td><?= number_format(ABS($row['subtotal']), 2, ",", "."); ?></td>

                </tr>

            <?php endforeach; ?>
        </tbody>

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
                    url: "<?php echo base_url('ObatKeluarGudang/hapus_detail_retur_pbf'); ?>",
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
                            detail();

                        }
                    }

                });


            }
        })

    }
</script>