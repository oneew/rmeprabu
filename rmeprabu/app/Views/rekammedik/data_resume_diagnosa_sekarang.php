<div class="table-responsive">
    <table id="datadiagnosa" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Tanggal</th>
                <th>JenisDiagnosa</th>
                <th>Kategori</th>
                <th>ICDX</th>
                <th>Deskripsi ICDX</th>
                <th>ICDIX</th>
                <th>Deskripsi ICDIX</th>
                <th>Tanggal Coding</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DIAGNOSA as $K) :
                $no++;
            ?>
                <tr>
                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapusdiagnosa('<?= $K['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $K['documentdate'] ?>
                        <br><?= $K['poliklinikname'] ?>
                        <br><?= $K['doktername'] ?>
                    </td>
                    <td><span class="<?php if ($K['coding'] == "ICDIX") {
                                            echo "badge badge-danger";
                                        } else {
                                            echo "badge badge-success";
                                        }  ?>">
                            <?= $K['coding'] ?></span> </td>
                    <td><span class="<?php if ($K['kategori'] == "Primer") {
                                            echo "badge badge-warning";
                                        } else {
                                            echo "badge badge-info";
                                        }  ?>"><?= $K['kategori'] ?> </td>
                    <td><?= $K['codeicdx'] ?> </td>
                    <td><?= $K['nameicdx'] ?> </td>
                    <td><?= $K['codeicdix'] ?> </td>
                    <td><?= $K['nameicdix'] ?> </td>
                    <td><?= $K['createddate'] ?>
                        <br><?= $K['createdby'] ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function hapusdiagnosa(id) {

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
                    url: "<?php echo base_url('RekMedCodingRajal/hapusdiagnosa'); ?>",
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
                            dataresumediagnosa();
                            $('#form-filter-bawah').css('display', 'block');
                        }
                    }
                });
            }
        })

    }
</script>