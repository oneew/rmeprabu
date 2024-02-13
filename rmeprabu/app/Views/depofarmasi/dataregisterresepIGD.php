<table id="registerranap" class="table-bordered table-hover table no-wrap">
    <thead>
        <tr>

            <!-- <th>#</th> -->
            <!-- <th>#</th> -->
            <th>No</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Norm</th>
            <th>Nama</th>
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
                 <!--
                <td>
                    
                    <div class="d-flex">
                        <form method="post" action="?= base_url(); ?>/FarmasiPelayananIGD/DetailDFPR">
                            <input type="hidden" name="id" id="id" value="?= $row['id']; ?>">
                            <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm"><i class="fa fa-tags"></i></button>
                        </form>
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cart-arrow-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item btn-timestamp" data-id="?= $row['id']; ?>" data-status="Pending" type="button">Pending</button>
                                <button class="dropdown-item btn-timestamp" data-id="?= $row['id']; ?>" data-status="Check 1: pengkajian resep" type="button">Check 1: pengkajian resep</button>
                                <button class="dropdown-item btn-timestamp" data-id="?= $row['id']; ?>" data-status="Prepare: pengemasan" type="button">Prepare: pengemasan</button>
                                <button class="dropdown-item btn-timestamp" data-id="?= $row['id']; ?>" data-status="Check 2: telaah obat" type="button">Check 2: telaah obat</button>
                                <button class="dropdown-item btn-timestamp" data-id="?= $row['id']; ?>" data-status="Finish: obat siap diserahkan" type="button">Finish: obat siap diserahkan</button>
                                <button class="dropdown-item btn-timestamp" data-id="?= $row['id']; ?>" data-status="Given: pasien sudah di konseling" type="button">Given: pasien sudah di konseling</button>
                            </div>
                        </div>
                    </div>
                </td> 
                <td>
                    <button id="print" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnprint" type="button" data-id="?= $row['journalnumber']; ?>"> <span><i class="fas fa-book"></i></span> </button>
                </td>-->
                <td><?= $no ?></td>
                <td>
                    <span class="badge badge-<?= $row['eresep'] == 1 ? 'danger' : 'success'; ?>"><?= $row['eresep'] == 1 ? 'eResep' : 'Non eResep'; ?></span>
                    <br><strong><?= $row['status']; ?></strong>
                </td>
                <td>
                    <?= date('d-m-Y H:i:s', strtotime($row['createddate'])); ?>
                    <!-- <br>?= $row['journalnumber'] ?> -->
                </td>
                <td><?= $row['pasienid'] ?></td>
                <td><?= $row['pasienname'] ?> [<?= $row['pasiengender'] ?>]</td>
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
            window.open("<?php echo base_url('FarmasiPelayananIGD/printpenjualan') ?>?page=" + id, "_blank");

        })
    });

    $('.btn-timestamp').click(function() {
        Swal.fire({
            title: 'Peringatan !!',
            text: "Apakah anda yakin untuk update status order resep menjadi : " + $(this).data('status'),
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
                    url: "<?php echo base_url('FarmasiPelayananRanap/updateStatusResep'); ?>",
                    data: {
                        id_header: $(this).data('id'),
                        status: $(this).data('status'),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success,
                            }).then((result) => {
                                if (result.value) {
                                    dataRegisterDDA();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal',
                                text: response.error,
                            })
                        }
                    }

                });
            }
        })
    });
</script>