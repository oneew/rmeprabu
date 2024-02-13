<div class="table-responsive">
    <table id="dataAsupanGizi" class="table color-table success-table">
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
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>

                    <td>
                        <?php if (($row['types'] == "RAD") and ($row['statusexpertise'] == "SUDAH")) { ?>
                            <button type="button" class="btn btn-success btn-sm" onclick="viewexpertise('<?= $row['id']; ?>')"> <i class="fas fa-eye"></i></button>
                        <?php } ?>
                        <?php if (($row['types'] == "LPA") and ($row['statusexpertise'] == "SUDAH")) { ?>
                            <button type="button" class="btn btn-info btn-sm" onclick="viewexpertiseLPA('<?= $row['id']; ?>')"> <i class="fas fa-eye"></i></button>
                        <?php } ?>
                        <?php if (($row['types'] == "LPK") and ($row['statusexpertise'] == "SUDAH")) { ?>
                            <button type="button" class="btn btn-warning btn-sm" onclick="viewexpertiseLPK('<?= $row['id']; ?>')"> <i class="fas fa-eye"></i></button>
                        <?php } ?>
                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['types'] ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['name']  ?></td>
                    <td><?= number_format($row['totaltarif'], 2, ",", ".");
                        ?></td>

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
                            resumeAsupanGizi();

                        }
                    }

                });


            }
        })

    }
</script>

<script>
    function viewexpertise(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRadiologi/ViewExpertise'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldact').html(response.sukses).show();
                    $('#modalexpertiseradiologi_view').modal('show');

                }
            }

        });


    }

    function viewexpertiseLPA(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananLPA/ViewExpertise'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaldact').html(response.sukses).show();
                    $('#modalexpertiseLPA_view').modal('show');

                }
            }

        });


    }
</script>