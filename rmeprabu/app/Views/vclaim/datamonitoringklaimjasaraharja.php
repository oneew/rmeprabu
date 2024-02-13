<table id="datamonitoring" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>NoFPK</th>
            <th>NoSep</th>
            <th>TglSep</th>
            <th>NamaPasien</th>
            <th>NoKartu</th>
            <th>Norm</th>
            <th>KelasRawat</th>
            <th>Pelayanan</th>
            <th>TanggalPulang</th>
            <th>Status</th>
            <th>BiayaPengajuan</th>
            <th>BiayaDisetujui</th>
            <th>BiayatarifGruper</th>
            <th>BiayaTarifRs</th>
            <th>BiayaTopUp</th>
            <th>KodeInaCbg</th>
            <th>Nama</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        $list = $response->response->jaminan;
        if ($response->response->jaminan !== null) {
            foreach ($list as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->noFPK; ?></td>
                    <td><?= $row->noSEP; ?></td>
                    <td><?= $row->tglSep; ?></td>
                    <td><?= $row->peserta->nama ?></td>
                    <td><?= $row->peserta->noKartu ?></td>
                    <td><?= $row->peserta->noMR ?></td>
                    <td><?= $row->kelasRawat ?></td>
                    <td><?= $row->poli ?></td>
                    <td><?= $row->tglPulang ?></td>
                    <td><?= $row->status ?></td>
                    <td class="text-right"><?= $row->biaya->byPengajuan ?> <?php $TotPengajuan[] = $row->biaya->byPengajuan;  ?></td>
                    <td class="text-right"><?= $row->biaya->bySetujui ?> <?php $TotSetujui[] = $row->biaya->bySetujui;  ?></td>
                    <td class="text-right"><?= $row->biaya->byTarifGruper ?></td>
                    <td class="text-right"><?= $row->biaya->byTarifRS ?> <?php $TotTarifRS[] = $row->biaya->byTarifRS;  ?></td>
                    <td class="text-right"><?= $row->biaya->byTopup ?></td>
                    <td><?= $row->Inacbg->kode ?></td>
                    <td><?= $row->Inacbg->nama ?></td>
                </tr>
        <?php endforeach;
        } ?>
    </tbody>
    <tfoot>
        <td colspan="11" class="text-right"> Total</td>
        <td class="text-right"> <b> <?php
                                    $check_TotPengajuan = isset($TotPengajuan) ? array_sum($TotPengajuan) : 0;
                                    $TotalPengajuan = $check_TotPengajuan;
                                    echo number_format($TotalPengajuan, 2, ",", "."); ?></b></td>
        <td class="text-right"> <b> <?php
                                    $check_TotSetujui = isset($TotSetujui) ? array_sum($TotSetujui) : 0;
                                    $TotalSetujui = $check_TotSetujui;
                                    echo number_format($TotalSetujui, 2, ",", "."); ?></b></td>
        <td class="text-right"> Total Tarif RS</td>
        <td class="text-right"> <b> <?php
                                    $check_TotTarifRS = isset($TotTarifRS) ? array_sum($TotTarifRS) : 0;
                                    $TotalTarifRS = $check_TotTarifRS;
                                    echo number_format($TotalTarifRS, 2, ",", "."); ?></b></td>
        <td colspan="3">
            <?php $check_TotSetujui = isset($TotSetujui) ? array_sum($TotSetujui) : 0;
            $TotalSetujui = $check_TotSetujui;
            $check_TotTarifRS = isset($TotTarifRS) ? array_sum($TotTarifRS) : 0;
            $TotalTarifRS = $check_TotTarifRS;
            if ($TotalTarifRS < $TotalSetujui) {
                $kesimpulan = "Selisih Positif";
            } else {
                $kesimpulan = "Selisih Negatif";
            }

            ?>
            <span class="<?php if ($kesimpulan == "Selisih Negatif") {
                                echo "badge badge-danger";
                            } else {
                                echo "badge badge-success";
                            }  ?>"><?= $kesimpulan ?></span>
        </td>
    </tfoot>
</table>


<script>
    $(document).ready(function() {
        $('#datakontrol').DataTable();
    });
</script>