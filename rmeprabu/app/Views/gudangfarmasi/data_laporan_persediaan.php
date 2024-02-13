<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title></title>
    <style type="text/css">
        .tabel1,
        th,
        td {
            padding: 10px 20px;
            text-align: left;
        }

        .tabel1 tr:hover {
            background-color: #f5f5f5;
        }

        .tabel1 tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    </style>
</head>

<table id="registerranap" class="tabel1" border="1">
    <thead>
        <tr>

            <th colspan="7"></th>
            <th colspan="3" style="text-align: center; background-color: bisque;">Saldo Awal Bulan</th>
            <th colspan="3" style="text-align: center; background-color: mistyrose;">Penambhan</th>
            <th colspan="3" style="text-align: center; background-color: silver;">Pengurangan</th>
            <th colspan="3" style="text-align: center;">Saldo Akhir</th>

        </tr>
        <tr>

            <th>No</th>
            <th>Kode</th>
            <th style="width: 10px;">Uraian</th>
            <th>Satuan</th>
            <th>Jenis</th>
            <th>Sumber Dana</th>
            <th>Expired Date</th>
            <th>Volume</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Volume</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Volume</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Volume</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['KodeObat'] ?></td>
                <td style="width: 10px;"><?= $row['NamaObat'] ?></td>
                <td><?= $row['satuan'] ?></td>
                <td><?= $row['jenis'] ?></td>
                <td><?= $row['SumberDana'] ?></td>
                <td><?= $row['Ed'] ?></td>
                <td style="background-color: bisque;"><?= $row['saldo_awal_bulan'] ?></td>
                <td style="background-color: bisque;"><?php if ($row['saldo_awal_bulan'] > 0) {
                                                            echo  number_format($row['HargaObat'], 2, ",", ".");
                                                        } else {
                                                            echo "0.00";
                                                        } ?></td>
                <td style="background-color: bisque;"><?php $jumlah_awal = $row['saldo_awal_bulan'] * $row['HargaObat'];
                                                        echo number_format($jumlah_awal, 2, ",", ".");   ?></td>
                <td style="background-color: mistyrose;"><?= $row['PenambahanObatJumlah'] ?></td>
                <td style="background-color: mistyrose;"><?php if ($row['PenambahanObatJumlah'] > 0) {
                                                                echo  number_format($row['HargaObat'], 2, ",", ".");
                                                            } else {
                                                                echo "0.00";
                                                            } ?></td>
                <td style="background-color: mistyrose;"><?php $jumlah_masuk = $row['PenambahanObatJumlah'] * $row['HargaObat'];
                                                            echo number_format($jumlah_masuk, 2, ",", ".");   ?></td>
                <td style="background-color: silver;"><?= abs($row['PenguranganObatJumlah']) ?></td>
                <td style="background-color: silver;"><?php if (abs($row['PenguranganObatJumlah']) > 0) {
                                                            echo number_format($row['HargaObat'], 2, ",", ".");
                                                        } else {
                                                            echo "0.00";
                                                        } ?></td>
                <td style="background-color: silver;"><?php $jumlah_keluar = abs($row['PenguranganObatJumlah'] * $row['HargaObat']);
                                                        echo number_format($jumlah_keluar, 2, ",", ".");   ?></td>
                <td><?php $volume_akhir = ($row['saldo_awal_bulan'] + $row['PenambahanObatJumlah']) - $row['PenguranganObatJumlah'];
                    echo $volume_akhir;  ?></td>
                <td><?= number_format($row['PenambahanObatHarga'], 2, ",", "."); ?></td>
                <td><?php $jumlah_akhir = $volume_akhir * $row['HargaObat'];
                    echo number_format($jumlah_akhir, 2, ",", ".");  ?></td>
                <?php $TotPersediaan[] = $jumlah_akhir;  ?>

            </tr>

        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <td colspan="18" class="text-right"><b>Total Nilai Persediaan</b></td>
        <td class="text-center"><?php $check_TotPersediaan = isset($TotPersediaan) ? array_sum($TotPersediaan) : 0;
                                $TotalASET = $check_TotPersediaan;
                                echo number_format($TotalASET, 2, ",", "."); ?></td>
    </tfoot>
</table>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('LaporanGudangFarmasi/printdistribusi') ?>?page=" + id, "_blank");

        })
    });
</script>