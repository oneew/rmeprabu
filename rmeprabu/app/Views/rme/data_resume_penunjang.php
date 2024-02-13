<table id="dataresumepenunjang" class="table display <?= (count($tampildata) > 1) ? "table-striped" : "" ?> no-wrap" style="width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th></th>
            <th>No</th>
            <th>Type</th>
            <th>Tanggal</th>
            <th>Pemeriksaan</th>
            <th>Tarif</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td><button type="button" class="btn btn-danger btn-rounded btn-sm" onclick="hapus('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                <td><?= $no ?></td>
                <td><?php if ($row['types'] == "RAD") {
                        $jenis = "Radiologi";
                    }
                    if ($row['types'] == "LPK") {
                        $jenis = "Patologi Klinik";
                    }
                    if ($row['types'] == "LPA") {
                        $jenis = "Patologi Anatomi";
                    }
                    if ($row['types'] == "RHM") {
                        $jenis = "Rehab Medik";
                    }
                    echo $jenis;
                    ?> </td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['name']  ?></td>
                <td><?= number_format($row['totaltarif'], 2, ",", ".");
                    ?></td>
                <?php $totalbiaya[] = $row['totaltarif']; ?>
            </tr>

        <?php endforeach; ?>
    </tbody>
    <tfoot>

        <td colspan="4"><b></b></td>
        <td><b>Total Biaya Penunjang</b></td>
        <td><b><?php
                $check_Totbiaya = isset($totalbiaya) ? array_sum($totalbiaya) : 0;
                $Total_biaya = $check_Totbiaya;
                echo number_format($Total_biaya, 2, ",", "."); ?></b></td>
    </tfoot>
</table>




<script>
    function hapus(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananLPK/hapusLPK'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            dataresumePenunjang();

                        }
                    }

                });


            }
        })

    }
</script>

<script>
    $(document).ready(function() {
        $('#modalresumeorder_rajal').on('shown.bs.modal', function (event) {
            $('#dataresumepenunjang').DataTable({
                responsive: true,
                scrollX: true,
                scrollY: "50vh"
            });
        })
    });
</script>