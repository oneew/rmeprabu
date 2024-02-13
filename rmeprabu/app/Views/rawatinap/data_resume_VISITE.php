<table id="dataTNO" class="tablesaw table-bordered table-hover table no-wrap" width="30%">
    <thead class="text-white bg-success">
        <tr>
            <th></th>
            <th>No</th>
            <th>Tanggal</th>
            <th>JournalNumber</th>
            <th>Pelayanan</th>
            <th>Tarif</th>
            <th>Dokter</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td>
                    <?php if (session()->get('del') == 0) { ?>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusVisite('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                    <?php } ?>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['name']  ?></td>
                <td><?= number_format($row['totaltarif'], 2, ",", ".") ?></td>
                <td><?= $row['doktername'] ?></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>



<script>
    function hapusVisite(id) {

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
                    url: "<?php echo base_url('PelayananRanap/hapusVISITE'); ?>",
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
                            resumeVisite();
                            dataresume();

                        }
                    }

                });


            }
        })

    }
</script>

<script>
    $(document).ready(function() {
        $('#dataTNO').DataTable({
            responsive: true,
            paging: false,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>