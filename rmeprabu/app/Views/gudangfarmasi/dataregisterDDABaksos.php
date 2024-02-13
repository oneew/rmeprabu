<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th>#</th>
            <th>#</th>
            <th>No</th>
            <th>NoRegisterDistribusi</th>
            <th>Memo</th>
            <th>Operator</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>

                <td>
                    <form method="post" action="<?= base_url(); ?>/DistribusiAmprahFarmasiBaksos/DetailDDA2">
                        <input type="hidden" name="id2" id="id2" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm"><i class="fa fa-tags"></i></button>
                    </form>
                </td>
                <td>
                    <button id="print" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnprint" type="button" data-id="<?= $row['journalnumber']; ?>"> <span><i class="fas fa-book"></i></span> </button>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['journalnumber'] ?>


                </td>
                <td><?= $row['memo'] ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['createdby'] ?></td>
                <td><?= $row['createddate'] ?></td>
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
            window.open("<?php echo base_url('DistribusiAmprahFarmasiBaksos/printdistribusi') ?>?page=" + id, "_blank");

        })
    });
</script>