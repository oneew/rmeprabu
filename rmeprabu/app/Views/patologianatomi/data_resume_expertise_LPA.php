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
            <?php foreach ($Radiologi as $no => $row) : ?>
                <tr>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" data-display="static" aria-expanded="false">
                                <i class="fa fa-edit"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button type="button" class="dropdown-item" onclick="CE('<?= $row['id']; ?>')">Histopatologi</button>
                                <button class="dropdown-item" type="button" onclick="pap('<?= $row['id']; ?>')">Pap Smear</button>
                            </div>
                        </div>
                        
                    </td>
                    <td><?= ++$no ?></td>
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
            url: "<?php echo base_url('PelayananLPA/CreateExpertise'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalexpertiseLPA').modal('show');
                }
            }
        });
    }

    function pap(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananLPA/CreateExpertisePap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalexpertiseLPA').modal('show');
                }
            }
        });
    }
</script>