<div class="table-responsive">
    <table id="dataTNO" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelaksana</th>
                <th>Pelayanan</th>
                <th>Tarif</th>
                <th>Dokter/Advisor</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td>
                        <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="hapusTNO('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                    </td>

                    <td><?= $no ?></td>
                    <td><?= date('d-m-Y' ,strtotime($row['documentdate'])) ?></td>
                    <td>
                        <img src="<?= $row['pelaksana'] == "Paramedis" ? base_url('assets/images/users/avatarnurse.png') : base_url('assets/images/users/avatardoctor.png') ;?>" class="rounded-circle" width="30">
                    </td>

                    <td>
                    <span class="badge badge-<?= $row['pelaksana'] == "Paramedis" ? "warning" : "info" ;?>"><?= $row['name'] ?></span>
                        <?php if ($row['pelaksana'] == "Paramedis") : ?>
                            <span class="badge badge-primary"><?= $row['paramedicName'] ;?></span>
                        <?php endif ?>
                    </td>
                    <td><?= number_format($row['subtotal'], 2, ",", ".") ?></td>
                    <td><?= $row['doktername'] ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function hapusTNO(id) {

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
                    url: "<?php echo base_url('PelayananRawatJalan/hapusTNO'); ?>",
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
                            dataTNOMedis();

                        }
                    }

                });


            }
        })

    }
</script>