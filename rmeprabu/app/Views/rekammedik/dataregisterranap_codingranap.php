<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>#</th>
            <th>Status Coding</th>
            <th>TglPulang</th>
            <th>NomorRekamMedis</th>
            <th>Poliklinik</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;


        ?>
            <tr>
                <td><?= $no ?></td>
                <td>
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" onclick="coding('<?= $row['id'] ?>')"><i class="fas fa-database"></i></button>
                </td>
                <td><span class="<?php if ($row['coding'] == "BELUM") {
                                        echo "badge badge-danger";
                                    } else {
                                        echo "badge badge-success";
                                    }  ?>"><?= $row['coding'] ?></span></td>

                <td><?= $row['dateout'] ?>
                    <br><?= $row['statuspasien'] ?>
                    <br><?= $row['paymentmethodname'] ?>
                </td>
                <td><?= $row['pasienid'] ?>
                    <br><?= $row['pasienname'] ?>[<?= $row['pasiengender'] ?>]
                </td>
                <td><?= $row['poliklinikname'] ?>
                    <br><?= $row['doktername'] ?>
                </td>
                <td><?= $row['pasienaddress'] ?> <?php ?></td>

            </tr>

        <?php endforeach; ?>

    </tbody>
</table>

<script>
    function coding(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RekMedCodingRanap/CodingRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalcodingranap').modal('show');

                }
            }

        });


    }
</script>