<div class="table-responsive">
    <table id="dataperawat" class="table color-table success-table">
        <thead>
            <tr>

                <th>#</th>
                <th>No</th>
                <th>Tanggal</th>
                <th>Dokter</th>
                <th>Anestesi</th>
                <th>Nama Tindakan</th>
                <th>Tarif</th>
                <th>Bhp</th>
                <th>Total Tarif</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>

                    <td><?= $no ?></td>
                    <td><button type="button" class="btn btn-info btn-rounded  btn-danger" onclick="hapus('<?= $row['id'] ?>')"> <i class="fa fa-trash"></i></button></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['doktername']  ?></td>
                    <td><?= $row['ibsanestesiname']  ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= number_format($row['price'], 0, ",", ".") ?></td>
                    <td><?= number_format($row['totalbhp'], 0, ",", ".") ?></td>
                    <td><?= number_format($row['subtotal'], 0, ",", ".") ?></td>


                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('rawatinap/formedit'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldaftaribs').modal('show');

                }
            }

        });


    }

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
                    url: "<?php echo base_url('rawatinap/hapus'); ?>",
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
                            dataperawat();
                            datahistoritindakan();

                        }
                    }

                });


            }
        })

    }
</script>