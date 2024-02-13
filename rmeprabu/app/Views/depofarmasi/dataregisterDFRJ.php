<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>

            <th>#</th>
            <th>#</th>
            <th>Keterangan</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>NoRegister</th>
            <th>Norm</th>
            <th>Nama</th>
            <th>JenisKelamin</th>
            <th>CaraBayar</th>
            <th>Ruangan</th>
            <th>Dokter</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td>
                    <form method="post" action="<?= base_url(); ?>/FarmasiPelayananRajal/DetailDFPR">
                        <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm"><i class="fa fa-tags"></i></button>
                    </form>
                </td>
                <td>
                    <button id="print" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnprint" type="button" data-id="<?= $row['journalnumber']; ?>"> <span><i class="fas fa-book"></i></span> </button>
                </td>
                <td>
                    <span class="<?php if ($row['eresep'] == 1) {
                                        echo "badge badge-danger";
                                        $periksa = "eResep";
                                    } else {
                                        echo "badge badge-success";
                                        $periksa = "Non eResep";
                                    }  ?>"><?= $periksa; ?></span>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['pasienid'] ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['pasiengender'] ?></td>
                <td><?= $row['paymentmethod'] ?></td>
                <td><?= $row['poliklinikname'] ?></td>
                <td><?= $row['doktername'] ?></td>
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
            window.open("<?php echo base_url('FarmasiPelayananRajal/printpenjualan') ?>?page=" + id, "_blank");

        })
    });
</script>