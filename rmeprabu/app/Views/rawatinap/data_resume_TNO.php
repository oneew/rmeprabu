<div class="table-responsive">
    <table id="dataTNO" class="table color-table success-table">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th>No</th>
                <th>Tanggal</th>
                <th>JournalNumber</th>
                <th>Pelaksana</th>
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
                            <button type="button" class="btn btn-danger btn-rounded btn-sm" onclick="hapus('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                        <?php } ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="tambah('<?= $row['journalnumber']; ?>')"> <i class="fa fa-plus"></i></button>
                    </td>

                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td></td>
                    <td><?= $row['name']  ?></td>
                    <td> [<?= number_format($row['qty'], 2, ",", ".") ?>]<?= number_format($row['totaltarif'], 2, ",", ".") ?></td>
                    <td><?= $row['doktername'] ?></td>
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
                    url: "<?php echo base_url('PelayananRanap/hapusTNO'); ?>",
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
                            resumeTNO();

                        }
                    }

                });


            }
        })

    }
</script>

<script>
    function tambah(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/tambahTNOdetail_ranap'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldact').html(response.sukses).show();
                    $('#modalinputTNOadd').modal('show');
                }
            }
        });
    }
</script>