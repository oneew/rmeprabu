<head>
    <link href="../assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
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
            <h3> &nbsp;<b class="text-info"><?= $header1; ?></b></h3>
            <p class="text-muted ml-1"><?= $header2; ?>
                <br /> <?= $status; ?>
                <br /> <?= $alamat; ?>
                <br />
            <h5> <?= $deskripsi; ?></h5>
            </p>
        </address>
    </div>
    <table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th>No</th>
                <th>TglPelayanan</th>
                <th>TglValidasiKasir</th>
                <th>NoRm</th>
                <th>NamaPasien</th>
                <th>Gender</th>
                <th>MP</th>
                <th>Poliklinik</th>
                <th>Dokter</th>
                <th>Status</th>
                <th>TotalBiaya</th>
                <th>TotalBayar</th>
                <th>SisaBayar</th>
                <th>Metode</th>
                <th>RefBank</th>
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
                    <td><?= $row['created_at'] ?></td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['pasienname'] ?></td>
                    <td><?= $row['pasiengender'] ?></td>
                    <td><?= $row['paymentmethodname'] ?></td>
                    <td><?= $row['poliklinikname'] ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><span class="<?php if ($row['paymentstatus'] == "PIUTANG") {
                                            echo "badge badge-danger";
                                        } else {
                                            echo "badge badge-success";
                                        }  ?>"><?= $row['paymentstatus'] ?></span></td>
                    <td><?= number_format($row['subtotal'], 2, ",", "."); ?>
                        <?php $Totbiaya[] = $row['subtotal'];  ?></td>
                    <td><?php $cash = $row['paymentamount'];
                        $debet = $row['nominaldebet'];
                        $totalbayar = $cash + $debet;
                        echo number_format($totalbayar, 2, ",", ".");
                        ?>
                        <?php $Totincome[] = $totalbayar;  ?></td>
                    <td><?php $cash = $row['paymentamount'];
                        $debet = $row['nominaldebet'];
                        $totalbayar = $cash + $debet;
                        $totalbiaya = $row['subtotal'];
                        $sisabayar = $totalbiaya - $totalbayar;
                        echo number_format($sisabayar, 2, ",", ".");
                        ?>
                        <?php $Totpiutang[] = $sisabayar;  ?></td>
                    <td><?= $row['metodepembayaran'] ?></td>
                    <td><?= $row['referensibank'] ?></td>

                </tr>

            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="9"></td>
                <td>TOTAL</td>
                <td><?php
                    $check_Totbiaya = isset($Totbiaya) ? array_sum($Totbiaya) : 0;
                    $Totalbiaya = $check_Totbiaya;
                    echo number_format($Totalbiaya, 2, ",", "."); ?></td>
                <td><?php
                    $check_Totincome = isset($Totincome) ? array_sum($Totincome) : 0;
                    $Totalincome = $check_Totincome;
                    echo number_format($Totalincome, 2, ",", "."); ?></td>
                <td><?php
                    $check_Totpiutang = isset($Totpiutang) ? array_sum($Totpiutang) : 0;
                    $Totalpiutang = $check_Totpiutang;
                    echo number_format($Totalpiutang, 2, ",", "."); ?></td>
                <td colspan="2"></td>

            </tr>
        </tfoot>
    </table>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="pull-right mt-1 text-left">
            <button id="btnPrint" type="button" class="btn btn-default btn-outline"><span><i class="fa fa-print"></i> Print</span></button>
        </div>
    </div>
</div>


<script>
    function layani(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalan/rincianrajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('DRJ').html(response.data);
                }

            }

        });


    }
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {

        if ('speechSynthesis' in window) {


            $('.suara').click(function() {
                var text = $('#message').val();
                var msg = new SpeechSynthesisUtterance();
                var voices = window.speechSynthesis.getVoices();

                msg.voice = voices[6];

                msg.rate = 1;

                msg.pitch = 1;
                msg.text = "atas nama pasien atau keluarga pasien" + $(this).data('nama') + ", silahkan masuk ke bagian kasir rawat jalan ";

                speechSynthesis.speak(msg);
            })
        } else {
            alert('Browser yang digunakan tidak support speechSynthesis');
        }
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

    });


    $('.btn-card').on('click', function() {

        if ($('#pasiencard').val() == '' || $('#registerdate').val == '') {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Tidak Boleh Kosong'

            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bpjs/check_card') ?>",
                data: {
                    card: $(this).data('pasiencard'),
                    date: $(this).data('registerdate')
                },
                success: function(response) {
                    let parseResponse = JSON.parse(response);
                    if (parseResponse.metaData.code == 200) {

                        Swal.fire({
                            html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                '<br>Hak Kelas: ' + parseResponse.response.peserta.pisa + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
                                '<br>Kode Faskes 1: ' + parseResponse.response.peserta.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.peserta.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.peserta.tglTMT,

                            icon: 'success',
                            text: parseResponse.metaData.message,
                        });
                        $('#faskesname').val(parseResponse.response.peserta.provUmum.nmProvider);
                        $('#faskes').val(parseResponse.response.peserta.provUmum.kdProvider);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            //title: 'Error',
                            text: parseResponse.metaData.message

                        });
                    }
                }
            })
        }

    })
</script>

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