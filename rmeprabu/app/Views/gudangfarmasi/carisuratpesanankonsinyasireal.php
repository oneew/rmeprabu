<table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>No Surat Permintaan</th>
            <th>Jumlah Item</th>
            <th>Jumlah Distribusi</th>
            <th>Permintaan Dari</th>
            <th>Dibuat Oleh</th>
            <th>Waktu</th>

        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td>
                        <?php if ($row['qtydistribusi'] <= 0) { ?>
                            <button type="button" class="btn btn-info btn-sm" onclick="daftar('<?= $row['id'] ?>')"> <i class="fa fa-tags"></i></button>
                        <?php } ?>
                    </td>
                    <td><?= $no ?></td>
                    <td><span class="<?php if ($row['qtydistribusi'] <= 0) {
                                            echo "badge badge-warning";
                                        } else {
                                            if ($row['qtydistribusi'] > 0) {
                                                echo "badge badge-success";
                                            }
                                        }  ?>"><?= $row['journalnumber'] ?></span></td>
                    <td><?= $row['qtyrequest'] ?></td>
                    <td><?= $row['qtydistribusi'] ?></td>
                    <td><?= $row['locationname'] ?></td>
                    <td><?= $row['createdby'] ?></td>
                    <td><?= $row['createddate'] ?></td>


                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function daftar(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DistribusiAmprahFarmasi/detailSP'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#referencenumber').val(response.journalnumber);
                $('#referencelocationcode').val(response.locationcode);
                $('#referencelocationname').val(response.locationname);
                $('#locationcode_header').val(response.destinationcode);
                $('#locationname').val(response.destinationname);
                $('#referenceuserid').val(response.createdby);
                $('#referencedate').val(response.documentdate);
                $('#referencedatetime').val(response.createddate);

                $('#modalcariSPKonsinyasiReal').modal('hide');
            }
        });
    }
</script>