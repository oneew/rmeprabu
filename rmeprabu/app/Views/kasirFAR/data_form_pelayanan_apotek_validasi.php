<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table" style="width: 100%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Jumlah</th>
                <th>JmlKronis</th>
                <th>Batch</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DetailObat as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no ?></td>
                    <td>[<?= $row['code']  ?>] <b><?= $row['name']  ?></b>
                        <br><?= $row['uom']  ?>
                    </td>
                    <td><?= $row['qtypaket'] ?></td>
                    <td><?= $row['qtyluarpaket'] ?></td>
                    <td><?= $row['batchnumber']  ?></td>
                    <td><?= number_format($row['price'], 2, ",", ".");  ?></td>
                    <td><?= abs($row['subtotal']) ?></td>
                    <?php $Total[] = abs($row['subtotal']); ?>
                </tr>

            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <?php $check_Total = isset($Total) ? array_sum($Total) : 0;
            $grandtotal = $check_Total;
            $totalbiaya = abs($grandtotal);
            ?>
            <tr>
                <td colspan="15" class="text-center">
                    <h4>Grand Total : Rp.<?= number_format($totalbiaya, 2, ",", "."); ?></h4>
                </td>
            </tr>

            <td colspan="15" class="text-center">
                <input type="hidden" id="validationby" name="validationby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
            </td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="form-body">
    <?php
    foreach ($pasienlama as $pasien) :
    ?>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Metode Pembayaran</label>
                    <select name="metodepembayaran" id="metodepembayaran" class="select2" style="width: 100%;">
                        <?php foreach ($metodebayar as $mb) : ?>
                            <option data-id="<?= $mb['id']; ?>" data-name="<?= $mb['metodepembayaran']; ?>" class="select-metodepembayaran"><?= $mb['metodepembayaran']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Refrensi Bank</label>
                    <select name="daftarbank" id="daftarbank" class="select2" style="width: 100%" disabled>
                        <option>-</option>
                        <?php foreach ($daftarbank as $bank) : ?>
                            <option data-id="<?= $bank['id']; ?>" data-room="<?= $bank['namabank']; ?>" class="select-daftarbank"><?= $bank['namabank']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Jumlah Pembayaran</label>
                    <input type="text" id="paymentamount" name="paymentamount" class="form-control" required value="<?= $totalbiaya; ?>">
                    <input type="hidden" id="grandtotal" name="grandtotal" class="form-control" value="<?= $totalbiaya; ?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Disc %</label>
                    <input type="text" id="disc" name="disc" class="form-control" value="0">

                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label>No.Referensi Bank</label>
                    <input type="text" id="referensibank" name="referensibank" class="form-control" disabled>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Nominal Debit</label>
                    <input type="text" id="nominaldebet" name="nominaldebet" class="form-control" value="0" disabled>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Penyetor</label>
                    <input type="text" id="payersname" required name="payersname" class="form-control form-rupiah" onkeyup="this.value = this.value.toUpperCase()" value="<?= $pasien['pasienname']; ?>">
                    <input type="hidden" id="groups" name="groups" class="form-control" value="<?= $pasien['groups']; ?>">
                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $pasien['journalnumber']; ?>">
                    <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= $pasien['documentdate']; ?>">
                    <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= $pasien['documentyear']; ?>">
                    <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= $pasien['documentmonth']; ?>">
                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $pasien['referencenumber']; ?>">
                    <input type="hidden" id="idbayar" name="idbayar" class="form-control" value="<?= $pasien['id']; ?>">
                    <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasien['pasienid']; ?>">
                    <input type="hidden" id="oldcode" name="oldcode" class="form-control">
                    <input type="hidden" id="pasienname" name="pasienname" class="form-control" value="<?= $pasien['pasienname']; ?>">
                    <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasien['pasiengender']; ?>">
                    <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $pasien['pasienage']; ?>">
                    <input type="hidden" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasien['dateofbirth']; ?>">
                    <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasien['pasienaddress']; ?>">
                    <input type="hidden" id="pasienarea" name="pasienarea" class="form-control">
                    <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control">
                    <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control">
                    <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $pasien['paymentmethod']; ?>">
                    <input type="hidden" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $pasien['paymentmethodname']; ?>">
                    <input type="hidden" id="paymentcardnumber" name="paymentcardnumber" class="form-control" value="<?= $pasien['paymentcardnumber']; ?>">
                    <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $pasien['poliklinik']; ?>">
                    <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $pasien['poliklinikname']; ?>">
                    <input type="hidden" id="classroom" name="classroom" class="form-control">
                    <input type="hidden" id="classroomname" name="classroomname" class="form-control">
                    <input type="hidden" id="totalbhp" name="totalbhp" class="form-control">
                    <input type="hidden" id="totalitembhp" name="totalitembhp" class="form-control">
                    <input type="hidden" id="kasirpenunjang" name="kasirpenunjang" class="form-control">
                    <input type="hidden" id="subtotal" name="subtotal" class="form-control">
                    <input type="hidden" id="totaldiscount" name="totaldiscount" class="form-control">
                    <input type="hidden" id="memo" name="memo" value="Biaya Pelayanan Penunjang Medik" class="form-control">
                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="<?= $pasien['locationcode']; ?>">
                    <input type="hidden" id="locationname" name="locationname" class="form-control" value="<?= $pasien['locationname']; ?>">
                    <input type="hidden" id="cancel" name="cancel" class="form-control">
                    <input type="hidden" id="cancelreason" name="cancelreason" class="form-control">
                    <input type="hidden" id="cancelmemo" name="cancelmemo" class="form-control">
                    <input type="hidden" id="cancelby" name="cancelby" class="form-control">
                    <input type="hidden" id="numberseq" name="numberseq" class="form-control">
                    <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>

                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>

<div class="text-right">
    <div id="form-filter-atas">
        <button id="button" class="btn btn-danger btnvalidasi" type="submit"><i class="fas fa-credit-card"></i></span> Update Validasi Pembayaran </button>
    </div>
    <br>
    <div id="form-filter-bawah" style="display: block;">
        <button id="print" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Bukti Resep</button>
        <button id="print" class="btn btn-warning btn-outline btn btnprintbukti" type="button"> <span><i class="fa fa-print"></i></span> Bukti Resep </button>
        <button id="print" class="btn btn-dark btn-outline btn btnprintbuktikronis" type="button"> <span><i class="fa fa-print"></i></span> Bukti Resep Kronis</button>
        <button id="print" class="btn btn-success btn-outline btn btnprintbuktinonkronis" type="button"> <span><i class="fa fa-print"></i></span> Bukti Resep Non Kronis</button>
        <button id="print" class="btn btn-danger btnprintBuktipembayaran" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Bukti Pembayaran</button>
        <input type="hidden" id="nomorjournal" autocomplet="off" name="nomorjournal" class="form-control" value="<?= $kodejournal; ?>">

    </div>
    <input type="hidden" id="validationnumber" name="validationnumber" class="form-control" readonly>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananRajal/printpenjualan') ?>?page=" + id, "_blank");
        })
    });
</script>



<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // 
                        page: params.page
                    };
                },
                processResults: function(data, params) {

                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            minimumInputLength: 1,

        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintbukti').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananRajal/printpenjualanKonvesional') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
        $('.btnprintbuktikronis').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananRajal/printpenjualanKonvesionalKronis') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
        $('.btnprintbuktinonkronis').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananRajal/printpenjualanKonvesionalNonKronis') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintetiket').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('FarmasiPelayananRajal/printetiket') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=500, height=400");
        })
    });
</script>


<script>
    function Etiket(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananRajal/Etiket'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalsetetiket').modal('show');

                }
            }

        });
    }
</script>



<script>
    function UpdateAntrean(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('WsAntrean/UpdateTaskIDFarmasi'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodal').html(response.suksesmodalsep).show();
                    $('#modaltaskidrajal').modal();
                }
            }
        });
    }

    function TaskID(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('WsAntrean/TaskIDFarmasi'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                Swal.fire({
                    html: 'Pesan: ' + response.pesan,
                    icon: 'success',
                    timer: 5000
                });
            }
        });
    }

    function lihatRincianGabung(referencenumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananRajal/LihatRincianPelayanan'); ?>",
            data: {
                referencenumber: referencenumber
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalrincian) {
                    $('.viewmodal').html(response.suksesmodalrincian).show();
                    $('#modalrincianpelayananrajal').modal();
                }
            }
        });
    }
</script>


<script>
    var rupiah = document.getElementById('paymentamount');
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value);

    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);


        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>


<script>
    $(document).ready(function() {
        $('.formvalidasibayar').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnvalidasi').attr('disable', 'disabled');
                    $('.btnvalidasi').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnvalidasi').removeAttr('disable');
                    $('.btnvalidasi').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.paymentamount) {
                            $('#paymentamount').addClass('form-control-danger');
                            $('.errorpaymentamount').html(response.error.paymentamount);
                        } else {
                            $('#paymentamount').removeClass('form-control-danger');
                            $('.errorpaymentamount').html('');
                        }
                    } else
                    if (response.gagal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.gagal,

                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                //dataresume();
                                $('#paymentamount').val(response.jumlahbayar);
                                $('#payersname').val(response.pembayar);
                                $('#validationnumber').val(response.validationnumber);
                                $('#form-filter-bawah').css('display', 'block');
                                $('#form-filter-atas').css('display', 'none');
                            }
                        });
                    }
                }
            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintBuktipembayaran').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('KasirFAR/printbuktipembayaranapotekKonvensional') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=600");
        })
    });
</script>