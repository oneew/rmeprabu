<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>JumlahPesan</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Operator</th>
                <th>Waktu</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DetailObat as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapusamprah('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['code']  ?></td>
                    <td><?= $row['name']  ?></td>
                    <td><?= $row['qty']  ?></td>
                    <td><?= $row['uom']  ?></td>
                    <td><?= $row['qtystock']  ?></td>
                    <td><?= $row['createdby']  ?></td>
                    <td><?= $row['createddate']  ?></td>


                </tr>

            <?php endforeach; ?>
        </tbody>
        <tfoot>

            <td colspan="15" class="text-center">
                <button id="print" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
            </td>
        </tfoot>
    </table>
</div>


<script>
    function hapusamprah(id) {

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
                    url: "<?php echo base_url('AmprahFarmasi/hapus_detail_amprah'); ?>",
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
            window.open("<?php echo base_url('AmprahFarmasi/printamprah') ?>?page=" + id, "_blank");

        })
    });
</script>