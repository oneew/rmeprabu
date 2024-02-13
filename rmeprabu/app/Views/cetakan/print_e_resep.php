<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak E-Resep</title>
    <style>
        @page {
            size: A4;
            font-family: 'Arial', sans-serif;
            margin: 2cm;
        }

        body {
            margin: 2cm;
        }
    </style>
</head>

<body>
    <div class="container">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="text-align: center;">
                    <img src="<?= base_url('assets/images/gallery/muaraenim.jpg'); ?>" alt="logo pemkot" width="75px">
                </td>
                <td style="text-align: center;">
                    <p style="margin: 0; padding: 0; font-weight: bold; font-size: 13px;">PEMERINTAH KABUPATEN MUARA ENIM</p>
                    <p style="margin: 0; padding: 0; font-weight: bold; font-size: 20px;">RUMAH SAKIT UMUM DAERAH</p>
                    <p style="margin: 0; padding: 0; font-weight: bold; font-size: 21px;">MUARA ENIM</p>
                    <p style="margin: 0; padding: 0; font-size: 9px;">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314</p>
                </td>
                <!-- <td style="text-align: center;">
                    <img src="<?= base_url('assets/images/gallery/muaraenim.jpg'); ?>" alt="logo pemkot" width="75px">
                </td> -->
            </tr>
        </table>

        <hr style="border: 1px solid #000;">

        <table style=" width: 100%; border-collapse: collapse; font-size: 12px;">
            <tr>
                <td style="width: 55%;">
                    <table style="width: 100%; font-size: 12px; border-collapse: collapse">
                        <tr>
                            <td>No. Rm</td>
                            <td>: <?= $headerpelayanan['pasienid']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: <?= $headerpelayanan['pasienname']; ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>: <?= $headerpelayanan['pasiengender']; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>: <?= $headerpelayanan['dateofbirth']; ?> / <?= $headerpelayanan['pasienage']; ?></td>
                        </tr>
                        <tr>
                            <td>Berat Badan</td>
                            <td>: <?= $asesment['bb']; ?> Kg</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: <?= $headerpelayanan['pasienaddress']; ?></td>
                        </tr>
                    </table>
                </td>
                <td style="width: 45%;">
                    <table style="width: 100%; font-size: 12px; border-collapse: collapse">
                        <tr>
                            <td>Poli/Ruangan</td>
                            <td>: <?= $headerpelayanan['poliklinikname']; ?></td>
                        </tr>
                        <tr style="vertical-align: top;">
                            <td>Dokter</td>
                            <td>: <?= $headerpelayanan['doktername']; ?></td>
                        </tr>
                        <tr style="vertical-align: top;">
                            <td style="width: 100px;">Penjamin</td>
                            <td>: <?= $headerpelayanan['paymentmethodname']; ?></td>
                        </tr>
                        <tr>
                            <td>No. Telepon</td>
                            <td>:</td>
                        </tr>
                        <tr>
                            <td>Riwayat Alergi</td>
                            <td>
                                : <?=  in_array($asesment['alergi'], ['Tidak', null]) ? 'Tidak Ada' : $asesment['alergiObat']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <hr style="border: 1px solid #000;">
        <p style="margin: 0; padding: 0; font-size: 12px;"><?= date('d F Y H:i:s', strtotime($headerpelayanan['createddate'])); ?></p>
        <hr style="border: 1px solid #000;">

        <table style="border-collapse: collapse; width: 100%; font-size: 12px;">
            <h3>R/</h3>
            <?php foreach ($DetailObat as $row) : ?>
                <tr style="border-bottom: 1px solid black;">
                    <td style="width: 80%;">
                        <?= $row['name']; ?>
                        <br>
                        <b><i>S</i></b>
                        <?php echo number_format($row['signa1'], 0, ",", "."); ?> x <?php echo number_format($row['signa2'], 0, ",", ".") . " "; ?>
                        <?php if ($row['eticket_aturan'] != "-") : ?>
                            <?= $row['eticket_aturan']; ?>
                        <?php endif ?>
                        <?php if ($row['eticket_petunjuk'] != "-") : ?>
                            <?= str_replace(', ', '', $row['eticket_petunjuk']);; ?>
                        <?php endif ?>
                        <?php if ($row['eticket_carapakai'] != "-") : ?>
                            <?= "[" . $row['eticket_carapakai'] . "]"; ?>
                        <?php endif ?>
                    </td>
                    <td>No</td>
                    <td><?= abs(number_format($row['qty'], 0, ",", ".")); ?></td>
                </tr>

            <?php endforeach ?>
            <div>
                <tr>
                    <td>
                        Muara Enim, <?= tgl_indo_helper($headerpelayanan['documentdate']); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Dokter penangung jawab pelayanan
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= barcode_helper($headerpelayanan['journalnumber'] . $headerpelayanan['doktername'] . $headerpelayanan['createddate']); ?>
                    </td>
                </tr>
                <tr>
                    <td>Dokter: <?= $headerpelayanan['doktername']; ?></td>
                </tr>
            </div>
        </table>
    </div>
</body>

<script type="text/javascript">
    window.print();
</script>

</html>