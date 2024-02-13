<div class="table-responsive d-block">
    <table id="datariwayatCPPTMedis" class="w-100 table display <?= (count($tampildata) > 1) ? "" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black;">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Perawat</th>
                <th>Hasil Asesmen Pasien dan Tatalaksana</th>
                <th>Intruksi</th>
                <th>Validasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?php
                        $tanggal = $row['createddate'];
                        echo date('d F Y', strtotime($tanggal)); ?></td>
                    <td> <span class="<?php if ($row['verifikasiDPJP'] == 0) {
                                            echo "badge badge-danger";
                                            // $periksa = "Belum";
                                        } else {
                                            echo "badge badge-success";
                                            // $periksa = "Sudah";
                                        }  ?>"><?= $row['paramedicName']  ?></span></td>
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
                    <td>
                        <?php if ($row['verifikasiDPJP'] == 1) { ?>
                            Diverifikasi Oleh : <?= $row['verifikator']; ?>
                            </br>Pada Tanggal : <?= $row['tanggalJamVerifikasi']; ?>
                        <?php } ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" onclick="gunakanRiwayatCPPT('<?= $row['id'] ?>')"> <i class="fas fa-download"></i> Gunakan Riwayat</button>
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
    function gunakanRiwayatCPPT(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/detailCPPTPerawat'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#bb').val(response.bb);
                $('#tb').val(response.tb);
                $('#frekuensiNadi').val(response.frekuensiNadi);
                $('#tdSistolik').val(response.tdSistolik);
                $('#tdDiastolik').val(response.tdDiastolik);
                $('#suhu').val(response.suhu);
                $('#frekuensiNafas').val(response.frekuensiNafas);
                $('#modalresume_cppt_perawat').modal('hide');
            }
        });
    }
</script>