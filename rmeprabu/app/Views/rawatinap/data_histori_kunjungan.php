<table id="datahistori" class="tablesaw table-bordered table-hover table no-wrap" width="100%">
    <thead class="text-white bg-success">
        <thead>
            <tr>

                <th>#</th>
                <th>No</th>
                <th>Keterangan</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>JournalNumber</th>
                <th>NoReferensi</th>
                <th>SepRajal</th>
                <th>SepRanap</th>
                <th>CaraPembayaran</th>
                <th>Ruangan</th>
                <th>Dokter</th>
            </tr>
        </thead>
    <tbody>
        <?php $no = 0;
        foreach ($kunjungan as $row) :
            $no++; ?>
            <tr>

                <td>
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="ubahadmisi('<?= $row['id']; ?>')"> <i class="far fa-edit"></i></button>

</td>
                <td><?= $no ?></td>
                <td><?= $row['types'] ?></td>
                <!-- <td><?= $row['datetimein'] ?></td> -->
                <td> <?php if ($row['datetimein'] <> '1900-01-01 00:00:00') { ?>
                        <?= $row['datetimein'] ?>
                    <?php } ?>
                <td> <?php if ($row['datetimeout'] <> '1900-01-01 00:00:00') { ?>
                        <?= $row['datetimeout'] ?>
                    <?php } ?>
                </td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['referencenumber'] ?></td>
                <td><?= $row['bpjs_sep_poli'] ?></td>
                <td><?= $row['bpjs_sep'] ?></td>
                <td><?= $row['paymentmethodname']  ?></td>
                <td><?= $row['roomname']  ?></td>
                <td><?= $row['doktername']  ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>


<script>
    function ubahadmisi(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/UbahAdmisiRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalranap').html(response.sukses).show();
                    $('#modalubahadmisiranap').modal('show');

                }
            }

        });


    }
</script>

<script>
    $(document).ready(function() {
        $('#datahistori').DataTable({
            responsive: true,
            paging: false,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>