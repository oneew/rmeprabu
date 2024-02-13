<div class="container" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black">
    <div class="table-responsive">
        <table id="dataLPA" class="table color-table success-table" style="color: black; color:black" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th></th>
                    <th>No</th>
                    <th>Type</th>
                    <th>Tanggal</th>
                    <th>JournalNumber</th>
                    <th>Pelayanan</th>
                    <th>Tarif</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($Radiologi as $row) :
                    $no++; ?>
                    <tr>
                        <td><button type="button" class="btn btn-danger btn-rounded btn-sm" onclick="hapus('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                        <td><?= $no ?></td>
                        <td><?= $row['types'] ?></td>
                        <td><?= $row['documentdate'] ?></td>
                        <td><?= $row['journalnumber'] ?></td>
                        <td><?= $row['name']  ?></td>
                        <td><?= number_format($row['totaltarif'], 2, ",", ".");
                            ?></td>
                        <?php $totalbiaya[] = $row['totaltarif']; ?>
                    </tr>

                <?php endforeach; ?>
            </tbody>
            <tfoot>

                <td colspan="5"><b></b></td>
                <td><b>Total Tagihan</b></td>
                <td><b><?php
                        $check_Totbiaya = isset($totalbiaya) ? array_sum($totalbiaya) : 0;
                        $Total_biaya = $check_Totbiaya;
                        echo number_format($Total_biaya, 2, ",", "."); ?></b></td>
            </tfoot>
        </table>
    </div>
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
                    url: "<?php echo base_url('PelayananLPK/hapusLPK'); ?>",
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
                            dataresume();

                        }
                    }

                });


            }
        })

    }
</script>