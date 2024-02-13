<!-- Primary Header Modal -->

<head>
    <link href="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
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
        }
    </style>

</head>


<div id="modalprintkwitansikasirranap" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div id="printThis">

                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pull-center text-center">
                                            <address>
                                                <h3> &nbsp;<b class="text-info"><?= $header1; ?></b></h3>
                                                <p class="text-muted ml-1"><?= $header2; ?>
                                                    <br /> <?= $status; ?>
                                                    <br /> <?= $alamat; ?>
                                                    <br />
                                                <h5> <?= $deskripsi; ?></h5>
                                                </p>
                                            </address>
                                        </div>
                                        <hr>
                                        <div class="pull-text text-left">
                                            <table class="table full-color-table full-info-table hover-table">
                                                <tbody>
                                                    <tr>
                                                        <td> No Kwitansi </td>
                                                        <td>:</td>
                                                        <td><?= $journalnumber; ?></td>
                                                        <td>Tanggal</td>
                                                        <td>:</td>
                                                        <td><?php echo date('d M Y') ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td> Nomor Rekam Medis </td>
                                                        <td>:</td>
                                                        <td><?= $pasienid; ?></td>
                                                        <td>Nama Pasien</td>
                                                        <td>:</td>
                                                        <td><?= $pasienname; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td> Cara Bayar </td>
                                                        <td>:</td>
                                                        <td><?= $paymentmethodname; ?></td>
                                                        <td>Poliklinik</td>
                                                        <td>:</td>
                                                        <td><?= $poliklinikname; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive mt-1" style="clear: both;">
                                            <table class="table table-hover no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Uraian</th>
                                                        <th class="text-right">Tarif</th>
                                                        <th class="text-right">Disc</th>
                                                        <th class="text-right">Total Tarif</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td>Biaya Kamar</td>
                                                        <td class="text-right"><?= number_format($kamar, 2, ",", ".") ?></td>
                                                        <td class="text-right"> 0</td>
                                                        <td class="text-right"> <?= number_format($kamar, 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">2</td>
                                                        <td>Pemeriksaan</td>
                                                        <td class="text-right"><?= number_format($pemeriksaan, 2, ",", ".") ?></td>
                                                        <td class="text-right"> 0</td>
                                                        <td class="text-right"> <?= number_format($pemeriksaan, 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td>Tindakan</td>
                                                        <td class="text-right"> <?= number_format($tindakan, 2, ",", ".") ?></td>
                                                        <td class="text-right"> 0 </td>
                                                        <td class="text-right"> <?= number_format($tindakan, 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">4</td>
                                                        <td>Operasi</td>
                                                        <td class="text-right"> <?= number_format($operasi, 2, ",", ".") ?></td>
                                                        <td class="text-right"> 0 </td>
                                                        <td class="text-right"> <?= number_format($operasi, 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">5</td>
                                                        <td>Penunjang</td>
                                                        <td class="text-right"> <?= number_format($penunjang, 2, ",", ".") ?> </td>
                                                        <td class="text-right"> 0 </td>
                                                        <td class="text-right"> <?= number_format($penunjang, 2, ",", ".") ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">6</td>
                                                        <td>BHP Penunjang</td>
                                                        <td class="text-right"> <?= number_format($bhp, 2, ",", ".") ?> </td>
                                                        <td class="text-right">0 </td>
                                                        <td class="text-right"> <?= number_format($bhp, 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">5</td>
                                                        <td>Farmasi</td>
                                                        <td class="text-right"> <?= number_format($farmasi, 2, ",", ".") ?> </td>
                                                        <td class="text-right">0 </td>
                                                        <td class="text-right"> <?= number_format($farmasi, 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">5</td>
                                                        <td>Gizi</td>
                                                        <td class="text-right"> <?= number_format($makan, 2, ",", ".") ?> </td>
                                                        <td class="text-right">0 </td>
                                                        <td class="text-right"> <?= number_format($makan, 2, ",", ".") ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center">5</td>
                                                        <td>Biaya <?php if ($groups == "IRJ") {
                                                                        echo "Pelayanan Rawat Jalan";
                                                                    } else {
                                                                        echo "Pelayanan IGD";
                                                                    }
                                                                    ?></td>
                                                        <?php $totalasal = $totaldaftarklinik + $totaltindakanklinik + $totalbhptindakanklinik + $totalfarmasiklinik + $totalpenunjangklinik + $totalbhppenunjangklinik; ?>
                                                        <td class="text-right"> <?= number_format($totalasal, 2, ",", ".") ?> </td>
                                                        <td class="text-right">0 </td>
                                                        <td class="text-right"> <?= number_format($totalasal, 2, ",", ".") ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="pull-right mt-1 text-right">
                                            <?php $totalbiaya = $kamar + $pemeriksaan + $tindakan + $operasi + $penunjang + $bhp + $farmasi + $makan + $totalasal; ?>
                                            <p>Sub - Total : <?= number_format($totalbiaya, 2, ",", ".") ?></p>
                                            <?php $disc = 0;
                                            $totaldisc = $totalbiaya * $disc; ?>
                                            <p>Disc (0%) : <?= number_format($totaldisc, 2, ",", ".") ?> </p>
                                            <?php $totaltagihan = $totalbiaya - $totaldisc; ?>
                                            <p>Total Tagihan : <?= number_format($totaltagihan, 2, ",", ".") ?> </p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Metode Pembayaran </td>
                                                    <td>:</td>
                                                    <td><span class="badge badge-success"><?= $metodepembayaran; ?></span></td>
                                                    <td>Referensi Bank</td>
                                                    <td>:</td>
                                                    <td><span class="badge badge-danger"><?= $referensibank ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Pembayaran Cash </td>
                                                    <td>:</td>
                                                    <td><?= number_format($paymentamount, 2, ",", ".") ?></td>
                                                    <td>Nominal Debet</td>
                                                    <td>:</td>
                                                    <td><?= number_format($nominaldebet, 2, ",", ".") ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Bayar </td>
                                                    <td>:</td>
                                                    <td><span class="badge badge-success"><?= $waktu; ?></span></td>
                                                    <td>Nama Penyetor</td>
                                                    <td>:</td>
                                                    <td><span class="badge badge-danger"><?= $payersname ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td>Status Pembayaran </td>
                                                    <td>:</td>
                                                    <td><span class="badge badge-success"><?= $paymentstatus; ?></span></td>
                                                    <td>Sisa pembayaran</td>
                                                    <td>:</td>
                                                    <?php $sisabayar = $totaltagihan - ($paymentamount + $nominaldebet); ?>
                                                    <td><span class="badge badge-danger"><?= number_format($sisabayar, 2, ",", ".") ?></span></td>
                                                </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <div class="pull-right mt-1 text-left">
                                                <table class="table color-table info-table">
                                                    <tbody>
                                                        <tr>
                                                            <td><?php
                                                                $tanggal = date('Y-m-d');
                                                                function tgl_indo($tanggal)
                                                                {
                                                                    $bulan = array(
                                                                        1 =>   'Januari',
                                                                        'Februari',
                                                                        'Maret',
                                                                        'April',
                                                                        'Mei',
                                                                        'Juni',
                                                                        'Juli',
                                                                        'Agustus',
                                                                        'September',
                                                                        'Oktober',
                                                                        'November',
                                                                        'Desember'
                                                                    );
                                                                    $pecahkan = explode('-', $tanggal);
                                                                    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                                                                }
                                                                echo tgl_indo($tanggal);
                                                                ?></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>

                                                            <td></td>
                                                        </tr>
                                                        <tr style="height: 50px;">
                                                            <td>
                                                                <div class="col-md-6">
                                                                    <div class="el-card-avatar el-overlay-1"> <img src="<?= $signaturekasir; ?>" />
                                                                    </div>
                                                                    <div class="el-card-content">
                                                                        <h5 class="mb-0"><?= $kasir; ?></h5> <small>Kasir</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <div class="col-md-6">
                                                                    <div class="el-card-avatar el-overlay-1"> <img src="<?= $signaturepasien; ?>" />
                                                                    </div>
                                                                    <div class="el-card-content">
                                                                        <h5 class="mb-0"><?= $payersname; ?></h5> <small>Pasien/ Keluarga Pasien</small>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="btnPrint" type="button" class="btn btn-default btn-outline"><span><i class="fa fa-print"></i> Print</span></button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

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
<script src="../assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
<script src="../assets/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>