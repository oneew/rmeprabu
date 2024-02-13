<div class="table-responsive">
    <table id="dataexpertiseradiologi" class="table color-table success-table">
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
            foreach ($Radiologi as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn btn-warning btn-sm" onclick="CE('<?= $row['id']; ?>')"> <i class="fa fa-edit"></i></button></td>
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
    function CE(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananBD/CreateExpertise'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalexpertisebd').modal('show');

                }
            }

        });


    }
</script>