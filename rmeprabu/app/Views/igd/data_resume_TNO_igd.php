<div class="table-responsive">
    <table id="dataTNO" class="table color-table success-table">
        <thead>
            <tr>
                <th colspan="2" align="center">#</th>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelaksana</th>
                <th>Pelayanan</th>
                <th>Jumlah</th>
                <th>Tarif</th>
                <th>Dokter</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><?php if ($validation == "BELUM") { ?>
                            <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="hapusTNOigd('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                        <?php } ?>
                    </td>
                    <td><?php if ($validation == "BELUM") { ?>
                            <button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="tambahTNOigd('<?= $row['journalnumber']; ?>')"> <i class="fa fa-plus"></i></button>
                        <?php } ?>
                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?php
                        if ($row['pelaksana'] == "Paramedis") {
                            $gambar = base_url() . '/assets/images/users/avatarnurse.png';
                        } else {
                            $gambar = base_url() . '/assets/images/users/avatardoctor.png';
                        }
                        echo "<img src='" . $gambar . "' class='rounded-circle' width='30'>";

                        ?></td>
                    <td class="<?php if ($row['pelaksana'] == "Paramedis") {
                                    echo "text-warning";
                                } ?>"><?= $row['name']  ?>
                        <br><span class="badge badge-info"><?= $row['paramedicName']; ?></span>
                    </td>
                    <td><?= $row['qty']  ?></td>
                    <td><?= number_format($row['subtotal'], 2, ",", ".") ?></td>
                    <td><?= $row['doktername'] ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function hapusTNOigd(id) {

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
                    url: "<?php echo base_url('PelayananIGD/hapusTNO'); ?>",
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
                            resumeTNOIGD();
                            dataresume()

                        }
                    }

                });


            }
        })

    }
</script>

<script>
    function tambahTNOigd(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananIGD/tambahTNOdetail'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputTNOigd_add').modal('show');

                }
            }

        });


    }
</script>