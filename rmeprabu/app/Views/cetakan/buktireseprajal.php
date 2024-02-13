<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }

    hr {
        border: none;
        border-top: 3px double #333;
        color: #333;
        overflow: visible;
        text-align: center;
        height: 5px;
    }

    hr:after {
        background: #fff;
        content: '';
        padding: 0 4px;
        position: relative;
        top: -13px;
    }

    .resep {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        font-weight: bold;

    }

    .header {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
        font-weight: bold;

    }
</style>
<table class="header" style="height: 270px; width: 100%; border-collapse: collapse; font-size:70%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
    <tr style="height: 18px;">
            <td style="width: 84.2718%; height: 18px;" colspan="5"><b>RSUD KOTA PRABUMULIH</b></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 84.2718%; height: 18px;" colspan="5"><b>Pemerintah Kota Prabumulih</b></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 84.2718%; height: 18px;" colspan="5"><b>NPWP</b></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 84.2718%; height: 18px;" colspan="5"><b>Jln. Lingkar Kel. Gunung Ibul Prabumulih Timur 31111</b></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 84.2718%; height: 18px;" colspan="5"><b>Telp (0713)3300402 </b></td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 84.2718%; height: 18px; text-align: center;" colspan="5">
                <b>PELAYANAN FARMASI DEPO RAWAT JALAN</b>
            </td>
        </tr>
        <tr style="height: 18px;">
            <td style="width: 84.2718%; height: 18px;" colspan="5">
                <hr>
            </td>
        </tr>
        <?php
        foreach ($dataheaderpenjualan as $row) :
        ?>
            <tr style="height: 18px;">
                <td style="width: 42.447%; height: 18px;" colspan="2">Tanggal</td>
                <td style="width: 41.8248%; height: 18px;" colspan="3">: <?= $row['documentdate']; ?></td>
            </tr>
            <tr style="height: 18px;">
                <td style="width: 42.447%; height: 18px;" colspan="2">No Kuitansi</td>
                <td style="width: 41.8248%; height: 18px;" colspan="3">: <?= $row['journalnumber']; ?></td>
            </tr>
            <tr style="height: 18px;">
                <td style="width: 42.447%; height: 18px;" colspan="2">Nama</td>
                <td style="width: 41.8248%; height: 18px;" colspan="3">: <?= $row['pasienname']; ?></td>
            </tr>
            <tr style="height: 18px;">
                <td style="height: 18px;" colspan="2">Alamat</td>
                <td style="height: 18px;" colspan="3">: <?= $row['pasienaddress']; ?></td>
            </tr>
            <tr style="height: 18px;">
                <td style="height: 18px;" colspan="2">TglLahir/Umur</td>
                <td style="height: 18px;" colspan="3">: <?= $row['pasienage']; ?></td>
            </tr>
            <tr style="height: 18px;">
                <td style="height: 18px;" colspan="2">JenisKelamin</td>
                <td style="height: 18px;" colspan="3">: <?php if ($row['pasiengender'] == "L") {
                                                            $kelamin = "Laki-laki";
                                                        } else {
                                                            $kelamin = "Perempuan";
                                                        }
                                                        echo $kelamin;
                                                        ?></td>
            </tr>
            <tr style="height: 18px;">
                <td style="height: 18px;" colspan="2">Norm</td>
                <td style="height: 18px;" colspan="3">: <?= $row['pasienid']; ?></td>
            </tr>
            <tr style="height: 18px;">
                <td style="height: 18px;" colspan="2">Poli/ruangan</td>
                <td style="height: 18px;" colspan="3">: <?= $row['poliklinikname']; ?></td>
            </tr>
            <tr style="height: 18px;">
                <td style="height: 18px;" colspan="2">Nama Dokter</td>
                <td style="height: 18px;" colspan="3">: <?= $row['doktername']; ?></td>
            </tr>
            <tr>
                <td style="width: 42.447%;" colspan="2">Cara Bayar</td>
                <td style="width: 1.82482%;" colspan="3">: <?= $row['paymentmethodname']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<hr>
<table class="resep" style="height: 100px; width: 100%; border-collapse: collapse; font-size:70%" border="0" cellspacing="1" cellpadding="2">

    <thead>
        <tr>

            <td style="width: 5.58394%;"><b>No</b></td>
            <td style="width: 34.2337%;"><b>Nama Obat</b></td>
            <td style="width: 15.0291%;"><b>Harga</b></td>
            <td style="width: 15.0291%;"><b>Qty</b></td>
            <td style="width: 15.0291%;"><b>Total</b></td>
            <td style="width: 20.0291%;"><b>Harga Kronis</b></td>
            <td style="width: 20.0291%;"><b>Qty Kronis</b></td>
            <td style="width: 20.0291%;"><b>Total Kronis</b></td>
            <td style="width: 20%; text-align: right;"><b>Total</b></td>
        </tr>
    </thead>

    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr style="height: 40px;">
                <td style="width: 5.58394%;"><?= $no; ?></td>
                <td style="width: 34.2337%;"><?= $row['name']; ?></td>
                <td style="width: 15.0291%;"><?php echo number_format($row['price'], 2, ",", "."); ?></td>
                <td style="width: 15.0291%;"><?= $row['qtypaket']; ?></td>
                <td style="width: 15.0291%;"><?= $totalharganonkronis = $row['qtypaket'] * $row['price'];
                                                echo number_format($totalharganonkronis, 2, ",", "."); ?>
                    <?php $TotHargaNonKronis[] = $totalharganonkronis;  ?></td>
                <td style="width: 15.0291%;"><?php echo number_format($row['price'], 2, ",", "."); ?></td>
                <td style="width: 15.0291%;"><?= $row['qtyluarpaket']; ?></td>
                <td style="width: 15.0291%;"><?= $totalhargakronis = $row['qtyluarpaket'] * $row['price'];
                                                echo number_format($totalhargakronis, 2, ",", "."); ?>
                    <?php $TotHargaKronis[] = $totalhargakronis;  ?></td>
                <td style="width: 20%; text-align: right;"><?php $total = abs($row['subtotal']);
                                                            echo number_format($total, 2, ",", "."); ?></td>
                <?php $TotHargaObat[] = $total;  ?>
            </tr>
        <?php endforeach; ?>
    </tbody>

    <tr class="header">
        <td colspan="4"></td>
        <td><b><u><?php
                    $check_TotHargaNonKronis = isset($TotHargaNonKronis) ? array_sum($TotHargaNonKronis) : 0;
                    $TotalHargaNonKronis = $check_TotHargaNonKronis;
                    echo number_format($TotalHargaNonKronis, 2, ",", "."); ?></u></b></td>
        <td colspan="2"></td>
        <td><b><u><?php
                    $check_TotHargaKronis = isset($TotHargaKronis) ? array_sum($TotHargaKronis) : 0;
                    $TotalHargaKronis = $check_TotHargaKronis;
                    echo number_format($TotalHargaKronis, 2, ",", "."); ?></u></b></td>
        <td>
            <b><u><?php
                    $check_TotHargaObat = isset($TotHargaObat) ? array_sum($TotHargaObat) : 0;
                    $TotalHargaObat = $check_TotHargaObat;
                    echo number_format($TotalHargaObat, 2, ",", "."); ?></u></b>
        </td>
    </tr>
    <?php
    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }
        return $hasil;
    }


    ?>
    <tr>
        <td colspan="5"><i> Terbilang :#<?php echo ucwords(terbilang($TotalHargaObat)) . " Rupiah"; ?>#</i></td>
    </tr>

</table>

<table class="resep" style="height: 270px; width: 100%; border-collapse: collapse; font-size:70%" border="0" cellspacing="0" cellpadding="0">
    <tbody>
        <tr>
            <td style="width: 50%; text-align: center;">Pembeli</td>
            <td style="width: 50%; text-align: center;">Penerima</td>
        </tr>
        <tr>
            <td style="width: 50%;">&nbsp;</td>
            <td style="width: 50%;">
                <p>&nbsp;</p>
                <p>&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td style="width: 50%; text-align: center;">
                ================================
            </td>
            <td style="width: 50%; text-align: center;">
                ================================
            </td>
        </tr>
    </tbody>
</table>
<script type="text/javascript">
    window.print();
</script>