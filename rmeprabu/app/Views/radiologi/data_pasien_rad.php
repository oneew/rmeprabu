<table id="myTable" class="table table-bordered table-striped table-hover no-wrap w-100">
    <thead>
        <tr class="bg-info text-white">
            <td>#</td>
            <td>No</td>
            <td>Validasi Kasir</td>
            <td>Note</td>
            <td>Tanggal</td>
            <td>Nama Pasien</td>
            <td>Cara Bayar</td>
            <td>Asal Pasien</td>
            <td>Pemeriksaan</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list_patient as $key => $item) : ?>
            <tr>
                <td>
                    <div class="d-flex flex-row">
                        <form method="post" action="<?= base_url('PelayananRadiologi/inputdetailRAD2') ;?>">
                            <?= csrf_field() ;?>
                            <input type="hidden" name="id" id="id" value="<?= $item['id'] ;?>">
                            <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Tambah atau lihat pemeriksaan"><i class="fa fa-plus"></i></button>
                        </form>
                        <div class="btn-group ml-1">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                Status Pemeriksaan
                            </button>
                            <div class="dropdown-menu">
                                <button type="button" class="dropdown-item" onclick="updateStatus('<?= $item['id']; ?>', 'sedang', '<?= $item['pasienname'] ;?>')">Sedang diperiksa</button>
                                <button type="button" class="dropdown-item" onclick="updateStatus('<?= $item['id']; ?>', 'sudah', '<?= $item['pasienname'] ;?>')">Sudah diperiksa</button>
                            </div>
                        </div>
                    </div>
                </td>
                <td><?= ++$key ;?></td>
                <td>
                    <span class="badge badge-<?= $item['validation'] == 'SUDAH' ? 'success' : 'danger' ;?>"><?= $item['validation'] ;?></span>
                </td>
                <td>
                    <strong><?= $item['note'] ;?></strong>
                    <br><span class="badge badge-<?= $item['status_periksa'] == 'sudah' ? 'success' : ($item['status_periksa'] == 'sedang' ? 'warning' : 'secondary') ;?>"><?= $item['status_periksa'] ;?> periksa</span>
                </td>
                <td><?= date('d-m-Y H:i', strtotime($item['createddate'])) ;?></td>
                <td>
                    <strong><?= $item['pasienname'] ;?></strong>
                    <br><span class="badge badge-warning"><?= $item['pasienid'] ;?></span>
                    <br><span class="badge badge-<?= $item['pasiengender'] == 'L' ? 'success' : 'secondary' ;?>"><?= $item['pasiengender'] ;?></span>
                </td>
                <td><?= $item['paymentmethod'] ;?></td>
                <td>
                    <?php if ($item['classroom'] != "IGD" && $item['pasienid'] != "NONRM") : ?>
                        <span class="badge badge-<?= $item['classroom'] == "IRJ" ? "primary" : "warning" ;?>"><?= $item['classroom'] == "IRJ" ? "RAJAL" : "RANAP" ;?></span>
                    <?php elseif ($item['pasienid'] == "NONRM"): ?>
                        <span class="badge badge-secondary">Pasien Luar Rs</span>
                    <?php endif ?>
                        <span class="badge badge-danger"><?= $item['roomname'] ;?></span>
                    <br><?= $item['doktername'] ;?>
                </td>
                <td>
                    <?php if (radiologi_detail($item['journalnumber']) != "TIDAK ADA PEMERIKSAAN") : ?>
                        <?php foreach (radiologi_detail($item['journalnumber']) as $item) : ?>
                            <li><?= $item['name'] ?></li>
                        <?php endforeach ?>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $('#myTable').dataTable({
        scrollX:true
    });

    function updateStatus(id, status, nama) {
        Swal.fire({
            title: 'Update',
            text: "Apakah anda yakin akan melakukan Update pemeriksaan pasien " + nama+  " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PasienRadiologi/ubahStatus'); ?>",
                    data: {
                        id: id,
                        status: status
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                            dataRegisterPoli();
                        }
                    }
                });
            }
        })

    }
</script>