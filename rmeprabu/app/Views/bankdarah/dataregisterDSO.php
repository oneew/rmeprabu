<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>Kelompok</th>
            <th>Tgl Stok Opname</th>
            <th>Lokasi</th>
            <th>Journalnumber</th>
            <th>Catatan</th>
            <th>Operator</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td>
                    <button id="print" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnprint" type="button" data-id="<?= $row['journalnumber']; ?>"> <span><i class="fas fa-book"></i></span> </button>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['groups'] ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['locationname'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['memo'] ?></td>
                <td><?= $row['createdby'] ?>
                    <br><span class="badge badge-info"> <?= $row['createddate']; ?></span>
                </td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>


<script>
    function layani(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalan/rincianrajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('DRJ').html(response.data);
                }

            }

        });


    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('StockOpnameDepo/printstockopname') ?>?page=" + id, "_blank");

        })
    });
</script>