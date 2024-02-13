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
                    <td>
                        <?php if ($row['statusexpertise'] == "SUDAH") { ?>
                            <button type="button" class="btn btn-info btn-sm btnprintexpertise" data-id="<?= $row['id']; ?>"> <i class="fa fa-print"></i></button>
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




<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintexpert').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printexpertiseKonvensional') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=800, height=600");
        })
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintexpertise').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printexpertise') ?>?page=" + id, "_blank");

        })
    });
</script>