<head>
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

<div id="printThis">
    <div class="pull-center text-center">
        <address>
            <h3> &nbsp;<b class="text-info">PEMERINTAH KOTA SUKABUMI</b></h3>
            <p class="text-info">UOBK RSUD R SYAMSUDIN, SH

                <br /> INSTALASI FARMASI
                <br />
            <h5> LAPORAN DISTRIBUSI BARANG </h5>
            </p>
        </address>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <a class="btn btn-success btn-outline excel" href="<?php
                                                                echo base_url('LaporanGudangFarmasi/EksporDataDistribusi') . '/' . $tujuanlokasi; ?> role=" button"><span><i class="fas fa-shekel-sign"></i></span> Ekspor ke Excel</a>
        </div>
    </div>
    <table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
        <thead>
            <tr>

                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Tanggal</th>
                <th>No.Register</th>
                <th>Tujuan</th>
                <th>No. Batch</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Jumlah Permintaan</th>
                <th>Jumlah Dipenuhi</th>
                <th>Jumlah Kekurangan</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['referencelocationname'] ?></td>
                    <td><?= $row['batchnumber'] ?></td>
                    <td><?= abs($row['qty']) ?></td>
                    <td><?= $row['uom'] ?></td>
                    <td><?= $row['qtyrequest'] ?></td>
                    <td><?= ABS($row['qty']) ?></td>
                    <td><?php
                        $minta = $row['qtyrequest'];
                        $dipenuhi = ABS($row['qty']);
                        $kurang = $minta - $dipenuhi;
                        echo $kurang;
                        ?></td>

                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<table>
    <td colspan="11" class="text-center">
        <button id="btnPrint" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
        <input type="hidden" id="tujuanlokasi" name="tujuanlokasi" value="<?= $tujuanlokasi; ?>" class="form-control">
        <input type="hidden" id="mulaitanggaldistribusi" name="mulaitanggaldistribusi" value="<?= $mulaitanggaldistribusi; ?>" class="form-control">
        <input type="hidden" id="akhirtanggaldistribusi" name="akhirtanggaldistribusi" value="<?= $akhirtanggaldistribusi; ?>" class="form-control">
        <input type="hidden" id="obat" name="obat" value="<?= $obat; ?>" class="form-control">
        <button id="btnPrint" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>

    </td>
</table>


<script type="text/javascript">
    document.getElementById("btnPrint").onclick = function() {

        printElement(document.getElementById("printThis"));

    };

    function printElement(elem) {
        var domClone = elem.cloneNode(true);
        var $printSection = document.getElementById("printSection");
        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
        }
        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        window.print();
    }
</script>


<script>
    $('#excel').click(function(e) {
        e.preventDefault();

        let tujuanlokasi = $('#tujuanlokasi').val();
        let mulaitanggaldistribusi = $('#mulaitanggaldistribusi').val();
        let akhirtanggaldistribusi = $('#akhirtanggaldistribusi').val();
        let namaobat = $('#obat').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanGudangFarmasi/EksporDataDistribusi') ?>",
            dataType: "json",
            data: {
                tujuanlokasi: tujuanlokasi,
                mulaitanggaldistribusi: mulaitanggaldistribusi,
                akhirtanggaldistribusi: akhirtanggaldistribusi,
                namaobat: namaobat
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>