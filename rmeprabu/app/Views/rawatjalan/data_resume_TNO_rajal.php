<div class="table-responsive">
    <table id="dataTNO" class="table color-table success-table">
        <thead>
            <tr>
                <th colspan="2" align="center">#</th>
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
                    <td><?php if ($validation == "BELUM") { ?>
                            <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="hapusTNO('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                    </td>
                <?php } ?>
                <td><?php if ($validation == "BELUM") { ?>
                        <button type="button" class="btn btn-success waves-light btn-rounded  btn-sm" onclick="tambahTNO('<?= $row['journalnumber']; ?>')"> <i class="fa fa-plus"></i></button>
                    <?php } ?>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td> <?php
                        if ($row['pelaksana'] == "Paramedis") {
                            $gambar = base_url() . '/assets/images/users/avatarnurse.png';
                        } else {
                            $gambar = base_url() . '/assets/images/users/avatardoctor.png';
                        }
                        echo "<img src='" . $gambar . "' class='rounded-circle' width='30'>";

                        ?></td>

                <td>[<?php $code = explode("_", $row['code']);
                        $kode = $code[1];
                        echo $kode; ?>]
                    <br><span class="<?php if ($row['pelaksana'] == "Paramedis") {
                                            echo "badge badge-warning";
                                        } else {
                                            echo "badge badge-info";
                                        }  ?>"><?= $row['name'] ?></span>
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
                            resumeTNO();
                            dataresume()

                        }
                    }

                });


            }
        })

    }
</script>

<script>
    function tambahTNO(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalan/tambahTNOdetail'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputTNOrajal_add').modal('show');

                }
            }

        });


    }
</script>