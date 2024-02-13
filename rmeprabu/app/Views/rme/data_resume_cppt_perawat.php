<table id="datariwayatCPPT" class="table display <?= (count($tampildata) > 1) ? "table-striped" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black; width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th>Aksi</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>Perawat</th>
            <th>Hasil Asesmen Pasien dan Tatalaksana</th>
            <th>Intruksi</th>
            <th>Validasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td>
                    <button class="btn btn-sm btn-danger btn-delete-cppt" data-id="<?= $row['id']; ?>"><i class="fas fa-trash"></i></button>
                    <button type="button" class="btn btn-warning btn-sm" onclick="editCpptRajal('<?= $row['id']; ?>')"><i class="fas fa-edit"></i></button>
                </td>
                <td><?= $no; ?></td>
                <td><?php
                    $tanggal = $row['createddate'];
                    echo date('d F Y', strtotime($tanggal)); ?></td>
                <td><?= $row['paramedicName']  ?></td>
                <td class="align-top" style="white-space: normal;"><b>
                        <h6>Subyektif
                    </b></h6>
                    <br>Keluhan Utama : <?= $row['keluhanUtama']; ?>

                    </br>
                    <br><b>
                        <h6>Obyektif
                    </b></h6>
                    <br>BB : <?= $row['bb']; ?>
                    <br>TB : <?= $row['tb']; ?>
                    <br>Sistolik : <?= $row['tdSistolik']; ?>
                    <br>Diastolik : <?= $row['tdDiastolik']; ?>
                    <br>Frekuensi Nadi : <?= $row['frekuensiNadi']; ?>
                    <br>Suhu : <?= $row['suhu']; ?>
                    <br>Frekuensi Nafas : <?= $row['frekuensiNafas']; ?>
                    <br>Skala Nyeri : <?= $row['skalaNyeri']; ?>
                    </br>
                    <br><b>
                        <h6>Asesmen
                    </b></h6>
                    <br>Diagnosa Keperawatan : <?= $row['DiagnosaAskep']; ?>
                    </br>
                    <br><b>
                        <h6>Planning
                    </b></h6>
                    <br>Kolaborasi dengan PPA/Medis
                    </br>
                    <?= $row['uraianAskep']; ?>

                </td>
                <td> Catatan :
                    <br> <?= $row['sasaranRencana']; ?>
                </td>
                <td></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>




<script>
    $(document).ready(function() {
        $('#dataresumepenunjang').DataTable({
            responsive: true,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>

<script>
    function editCpptRajal(id) {
        $.ajax({
            url: "<?= base_url('PelayananRawatJalanRME/editCpptRajal'); ?>",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(response) {
                $('.edit_cppt').html(response.data).show();
                $('#modal_edit_cppt').modal({
                    show: true,
                    backdrop: false
                });
            }
        });
    }
</script>

<script>
    $('#datariwayatCPPT tbody').on('click', '.btn-delete-cppt', function(e) {
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
                    url: '<?= base_url('PelayananRawatJalanRME/hapusCPPTRajal'); ?>',
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