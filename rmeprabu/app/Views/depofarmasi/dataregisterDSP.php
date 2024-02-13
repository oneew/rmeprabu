<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>

            <th>#</th>
            <th>#</th>
            <th>No</th>
            <th>Kelompok</th>
            <th>TglPermintaan</th>
            <th>Journalnumber</th>
            <th>SumberPermintaan</th>
            <th>NamaPembuat</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td>
                    <form method="post" action="<?= base_url(); ?>/AmprahFarmasi/DetailDSP">
                        <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm"><i class="fa fa-tags"></i></button>
                    </form>
                </td>
                <td>
                    <button id="print" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnprint" type="button" data-id="<?= $row['journalnumber']; ?>"> <span><i class="fas fa-book"></i></span> </button>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['groups'] ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['locationname'] ?></td>
                <td><?= $row['createdby'] ?></td>
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
            window.open("<?php echo base_url('AmprahFarmasi/printamprah') ?>?page=" + id, "_blank");

        })
    });
</script>