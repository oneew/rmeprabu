<head>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css">



    <style>
        @media screen {

            #printSection {
                display: none;
            }

        }

        @media print {

            body * {
                visibility: hidden;
            }

            .modal-dialog {
                max-width: 100%;
                width: 100%;
            }

            #printSection,

            #printSection * {
                visibility: visible;
            }

            .tb {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
                margin: 0;
                padding: 0;
                visibility: visible;
                /**Remove scrollbar for printing.**/
                overflow: visible !important;
            }

            .modal-body {
                overflow: visible !important;
            }

            .modal-dialog {
                visibility: visible !important;
                /**Remove scrollbar for printing.**/
                overflow: visible !important;
            }

            table {
                font-size: 10px;
            }


        }
    </style>

</head>
<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
    <thead>
        <tr>

            <th>No</th>
            <th>No Register</th>
            <th>Tanggal</th>
            <th>Norm</th>
            <th>Nama Pasien</th>
            <th>Cara Pembayaran</th>
            <th>Pelayanan</th>
            <th>Lokasi Depo</th>
            <th>Kelas</th>
            <th>Kode</th>
            <th>uraian</th>
            <th>Jenis</th>
            <th>Pabrikan</th>
            <th>No.Batch</th>
            <th>Expired Date</th>
            <th>Dokter</th>
            <th>Penelaah</th>
            <th>Dispensasi</th>
            <th>Dispensasi Pejabat</th>
            <th>Dispensasi Alasan</th>
            <th>Signa</th>
            <th>Tgl.Habis</th>
            <th>Jumlah Resep Dokter</th>
            <th>Jumlah Dilayani</th>
            <th>Satuan</th>
            <th>HNA</th>
            <th>HNA+PPN</th>
            <th>Harga</th>
            <th>Potongan</th>
            <th>Total</th>
            <th>Petugas Entri</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['relation'] ?></td>
                <td><?= $row['relationname'] ?></td>
                <td><?= $row['paymentmethodname'] ?></td>
                <td><?= $row['groups'] ?></td>
                <td><?= $row['locationcode'] ?></td>
                <td></td>
                <td><?= $row['code'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['jenis'] ?></td>
                <td><?= $row['manufacturename'] ?></td>
                <td><?= $row['batchnumber'] ?></td>
                <td><?= $row['expireddate'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['employeename'] ?></td>
                <td><?php if ($row['dispensasi'] == 1.00) {
                        echo  "Dispensasi";
                    } else {
                        echo "-";
                    } ?></td>
                <td><?php if ($row['karyawan'] == 1.00) {
                        echo  "Dispensasi";
                    } else {
                        echo "-";
                    } ?></td>
                <td><?= $row['dispensasialasan'] ?></td>
                <td><?= $row['signa1'] ?> x <?= $row['signa2'] ?></td>
                <td><?= $row['emptydate'] ?></td>
                <td><?= abs($row['qtyresep']) ?></td>
                <td><?= abs($row['qty']) ?></td>
                <td><?= $row['uom'] ?></td>
                <td></td>
                <td><?= number_format($row['taxprice'], 2, ",", "."); ?></td>
                <td><?= number_format($row['price'], 2, ",", "."); ?></td>
                <td></td>
                <td><?= number_format(ABS($row['subtotal']), 2, ",", "."); ?></td>
                <td><?= $row['createdby'] ?></td>
            </tr>

        <?php endforeach; ?>
    </tbody>

</table>



<script>
    $('#registerranap').DataTable({
        dom: 'Bfrtip',
        "paging": false,
        "scrollX": true,
        // "scrollY":"50vh",
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    })
</script>