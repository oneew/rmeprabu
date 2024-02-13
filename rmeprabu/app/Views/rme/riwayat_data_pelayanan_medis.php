<div class="table-responsive d-block">

    <table id="datariwayatCPPTMedis" class="w-100 table display <?= (count($tampildata) > 1) ? "" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black;">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelayanan</th>
                <th>Diagnosa</th>
                <th>Resep</th>
                <th>Tindakan</th>
                <th>Operasi</th>
                <th>Radiologi</th>
                <th>Patologi Klinik</th>
                <th>Patologi Anatomi</th>
            </tr>
        </thead>
        <tbody>

            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['poliklinikname'] ?>
                        </br><?= $row['doktername']; ?></td>
                    <td>
                        <table style="border-collapse: collapse; height: 36px;" border="0">
                            <tbody>
                                <?php $noA = 0;
                                foreach ($row['listDiagnosa'] as $Diagnosa) :
                                    $noA++;
                                ?>
                                    <tr>
                                        <td style="width: 5%;"><?= $noA; ?></td>
                                        <td style="width: 5%;"><?= $Diagnosa['codeicdx']; ?></td>
                                        <td style="width: 5%;"><?= $Diagnosa['nameicdx']; ?>(<?= $Diagnosa['kategori']; ?>)</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table style="border-collapse: collapse; height: 36px;" border="0">
                            <tbody>
                                <?php $noD = 0;
                                foreach ($row['listResep'] as $resep) :
                                    $noD++;
                                ?>
                                    <tr>
                                        <td style="width: 5%;"><?= $noD; ?></td>
                                        <td style="width: 5%;"><?= $resep['name']; ?>[<?= $resep['signa1'] ?> x <?= $resep['signa2']; ?>](<?= ABS($resep['qty']); ?>)</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table style="border-collapse: collapse; height: 36px;" border="0">
                            <tbody>
                                <?php $nox = 0;
                                foreach ($row['list'] as $pemeriksaan) :
                                    $nox++;
                                ?>
                                    <tr>
                                        <td style="width: 5%;"><?= $nox; ?></td>
                                        <td style="width: 5%;"><?= $pemeriksaan['name']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                    <td>
                        <table style="border-collapse: collapse; height: 36px;" border="0">
                            <tbody>
                                <?php $noB = 0;
                                foreach ($row['listRad'] as $rad) :
                                    $noB++;
                                ?>
                                    <tr>
                                        <td style="width: 5%;"><?= $noB; ?></td>
                                        <td style="width: 5%;"><?= $rad['name']; ?></td>
                                        <td>
                                            <?php if ($rad['idPenunjangDetail'] !== null) { ?>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="expertiseRad('<?= $rad['id'] ?>')"> <i class="fas fa-file-alt"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table style="border-collapse: collapse; height: 36px;" border="0">
                            <tbody>
                                <?php $noC = 0;
                                foreach ($row['listLpk'] as $lpk) :
                                    $noC++;
                                    $nojournal = $lpk['journalnumber'];
                                ?>
                                    <tr>
                                        <td style="width: 5%;"><?= $noC; ?></td>
                                        <td style="width: 5%;"><?= $lpk['name']; ?></td>
                                        <td> <button type="button" class="btn btn-warning btn-sm" onclick="HasilLPK('<?= $nojournal ?>')"> <i class="far fa-envelope"></i></button></td>

                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </td>
                    <td>
                        <table style="border-collapse: collapse; height: 36px;" border="0">
                            <tbody>
                                <?php $noC = 0;
                                foreach ($row['listLpa'] as $lpa) :
                                    $noC++;
                                ?>
                                    <tr>
                                        <td style="width: 5%;"><?= $noC; ?></td>
                                        <td style="width: 5%;"><?= $lpa['name']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#datariwayatPelayananMedis').DataTable({
            responsive: true,
            // scrollX: true,
            // scrollY: "50vh"
        });
    });
</script>


<script>
    function expertiseRad(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeHasilRad'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalhasil').html(response.sukses).show();
                    $('#modalexpertiseradiologi_hasil').modal('show');
                }
            }
        });
    }
</script>
<script>
    function HasilLPK(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/resumeHasilLpk'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalhasil').html(response.sukses).show();
                    $('#modalexpertiselpk_hasil').modal('show');
                }
            }
        });
    }
</script>