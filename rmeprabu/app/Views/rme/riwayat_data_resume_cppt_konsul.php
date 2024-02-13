<div class="table-responsive d-block">
    <table id="datariwayatCPPTMedis" class="w-100 table display <?= (count($tampildata) > 1) ? "" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black;">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Perawat</th>
                <th>Hasil Asesmen Pasien dan Tatalaksana</th>
                <th>Intruksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tampildata as $no => $row) : ?>
                <tr>
                    <td><?= ++$no; ?></td>
                    <td>
                        <?= tgl_indo_helper($row['createddate']); ?>
                        </br>
                        <?= date('H:i:s', strtotime($row['createddate'])); ?>
                        <br>
                        <button class="btn btn-sm btn-danger btn-delete-cppt" data-id="<?= $row['id']; ?>"><i class="fas fa-trash"></i></button>
                    </td>
                    <td>
                        <h6><?= $row['doktername']  ?></h6>
                        <br><?= $row['poliklinikname']; ?>
                    </td>
                    <td class="align-top" style="white-space: normal;">
                        <h6><strong>Subyektif</strong></h6>
                        <br>Keluhan Utama : <?= $row['s']; ?>

                        </br>
                        <br>
                        <h6><strong>Obyektif</strong></h6>
                        <!-- <br>BB : ?= $row['tb']; ?>
                        <br>TB : ?= $row['bb']; ?>
                        <br>Sistolik : ?= $row['tdSistolik']; ?>
                        <br>Diastolik : ?= $row['tdDiastolik']; ?>
                        <br>Frekuensi Nadi : ?= $row['frekuensiNadi']; ?>
                        <br>Suhu :?= $row['suhu']; ?> -->
                        <!-- <br>Frekuensi Nafas : ?= $row['pernapasan']; ?> -->
                        <br>
                        <strong><?= $row['o']; ?></strong>
                        </br>
                        <br>
                        <h6><strong>Asesmen</strong></h6>
                        <br>Diagnosa : <?= $row['a']; ?>
                        </br>
                        <!-- <br>Diagnosa sekunder : ?= $row['diagnosisSekunder']; ?></br> -->
                        <br>
                        <h6><strong>Planning</strong></h6>
                        <br> <?= $row['p']; ?>
                    </td>
                    <!-- <td> Catatan :
                        <br> ?= $row['tindakLanjut']; ?>
                    </td> -->
                    <td>
                        <button type="button" class="btn btn-info btn-sm" onclick="gunakanRiwayat('<?= $row['id'] ?>')"> <i class="fas fa-download"></i> Gunakan Riwayat</button>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#datariwayatCPPTMedis').DataTable({
            responsive: true,
            // fixedHeader: {
            //     header: true,
            //     footer: true
            // },
            // scrollY: "200px",
            // scrollCollapse: true,
            // scrollX: true,
            // fixedHeader: true
        });
    });
</script>


<script>
    function gunakanRiwayat(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/detailCPPT'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#objective').val(response.objektive);
                $('#keluhanUtama').val(response.keluhanUtama);
                $('#riwayatPenyakitSekarang').val(response.riwayatPenyakitSekarang);
                $('#riwayatPenyakitKeluarga').val(response.riwayatPenyakitKeluarga);
                $('#diagnosis').val(response.diagnosis);
                $('#objective_medis').val(response.planning);
                $('#objective').val(response.objektive);
                $('#modalresume_cppt').modal('hide');
            }
        });
    }
</script>

<script>
    $('#datariwayatCPPTMedis tbody').on('click', '.btn-delete-cppt', function(e) {
        Swal.fire({
            title: "Perhatian !!!",
            text: "Apakah anda yakin ingin menghapus CPPT ini, CPPT yang sudah di hapus tidak dapat di kembalikan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            confirmButtonText: "Iya !!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('PelayananRawatJalanRME/hapusCPPT'); ?>',
                    data: {
                        id: $(this).data("id"),
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $('.btn-delete-cppt').attr('disable', 'disabled');
                        $('.btn-delete-cppt').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Terhapus!",
                                text: response.success,
                                icon: "success"
                            });
                            dataresumePenunjang();
                        }

                        if (response.error) {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.error,
                            });
                        }
                    }
                });
            }
        });
    })
</script>