<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Catatan</th>
                <th>No Batch</th>
                <th>Exp.dDate</th>
                <th>Stock Sistem</th>
                <th>Stock Fisik</th>
                <th>Selisih</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DetailObat as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapus('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                    <input type="hidden" id="journalnumber" autocomplete="off" name="journalnumber" class="form-control" value="<?= $row['journalnumber']; ?>">
                    <td><?= $no ?></td>
                    <td><?= $row['code']  ?></td>
                    <td><?= $row['name']  ?></td>
                    <td><?= $row['referencenumber']  ?></td>
                    <td><?= $row['batchnumber']  ?></td>
                    <td><?= $row['expireddate']  ?></td>
                    <td><?= $row['stockqty']  ?></td>
                    <td><?= $row['realqty']  ?></td>
                    <td><?= $row['qty']  ?></td>
                    <td><?= $row['uom']  ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>

            <td colspan="11" class="text-center">
                <button id="print" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
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
                    url: "<?php echo base_url('StockOpnameDepo/hapus_detail_so'); ?>",
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

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $('#journalnumber').val();
            window.open("<?php echo base_url('StockOpnameDepo/printstockopname') ?>?page=" + id, "_blank");

        })
    });
</script>