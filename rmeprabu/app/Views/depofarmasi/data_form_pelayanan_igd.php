<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

<?php if (check_obat_racikan($kodejournal) != "TIDAK ADA") : ?>
    <div class="m-1">
        <div class="bg-success p-2 mb-3">
            <h3 class="text-white mb-0">Obat Racikan</h6>
                <span class="text-white">Note: Jangan lupa di entry ulang ya !!!</span>
        </div>
        <?php foreach (check_obat_racikan($kodejournal) as $item) : ?>
            <div class="d-flex border-top border-bottom py-3">
                <?= $item['description']; ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>

<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>#</th>
                <th>#</th>
                <th>No</th>
                <th>R/</th>
                <th>Kode</th>
                <th>Jumlah</th>
                <th>Jml Kronis</th>
                <th>Batch</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aturan</th>
                <th>Aturan Pakai</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DetailObat as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapusresep('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnset" onclick="Etiket('<?= $row['id']; ?>')"> <i class="ti-tablet"></i></button></td>
                    <td> <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnprintetiket" data-id="<?= $row['id']; ?>"> <i class="ti-printer"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['r']  ?></td>
                    <td>[<?= $row['code']  ?>] <b><?= $row['name']  ?></b>
                        <br><?= $row['uom']  ?>
                    </td>
                    <td><?= ABS(round($row['qty'])) ?></td>
                    <td><?= $row['qtyluarpaket'] ?></td>
                    <td><?= $row['batchnumber']  ?></td>
                    <td><?= number_format($row['price'], 2, ",", ".");  ?></td>
                    <td><?= abs($row['subtotal']) ?></td>
                    <td><?php echo number_format($row['signa1'], 0, ",", "."); ?> x <?php echo number_format($row['signa2'], 0, ",", "."); ?></td>
                    <td>
                        <?= $row['eticket_aturan']; ?>
                        <br><?= $row['eticket_carapakai']; ?>
                        <br><?= $row['eticket_petunjuk']; ?>
                    </td>

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
                <td colspan="11" class="text-center">
                    <h4>Grand Total : Rp.<?= number_format($totalbiaya, 2, ",", "."); ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="15" class="text-center">
                    <span class="badge badge-warning mb-3">
                        <h3 class="mb-0 text-white"><?= $status; ?></h3>
                    </span>
                    <div class="dropup ">
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cart-arrow-down"></i> Status Order
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item btn-timestamp" data-status="Pending" type="button">Pending</button>
                                <button class="dropdown-item btn-timestamp" data-status="Check 1: pengkajian resep" type="button">Check 1: pengkajian resep</button>
                                <button class="dropdown-item btn-timestamp" data-status="Prepare: pengemasan" type="button">Prepare: pengemasan</button>
                                <button class="dropdown-item btn-timestamp" data-status="Check 2: telaah obat" type="button">Check 2: telaah obat</button>
                                <button class="dropdown-item btn-timestamp" data-status="Finish: obat siap diserahkan" type="button">Finish: obat siap diserahkan</button>
                                <button class="dropdown-item btn-timestamp" data-status="Given: pasien sudah di konseling" type="button">Given: pasien sudah di konseling</button>
                            </div>
                        </div>
                        <div class="btn-group dropup">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cart-arrow-down"></i> Cetak
                            </button>
                            <div class="dropdown-menu">
                                <button id="print" class="dropdown-item btnprintbukti" type="button">Bukti Resep</button>
                                <button id="print" class="dropdown-item btnprint" type="button">Print resep</button>
                                <button id="print" class="dropdown-item btnprintbuktikronis" type="button">Resep Kronis</button>
                                <button id="print" class="dropdown-item btnprintbuktinonkronis" type="button">Resep Non Kronis</button>
                                <button id="print" class="dropdown-item" type="button" onclick="printEResep('<?= $kodejournal ?>')">Resep Klaim</button>
                                <input type="hidden" id="nomorjournal" autocomplet="off" name="nomorjournal" class="form-control" value="<?= $kodejournal; ?>">
                            </div>
                        </div>
                        <!-- <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-cart-arrow-down"></i> Cetak
                        </button>
                        <div class="dropdown-menu">
                            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cetak Resep</button> 
                            <button id="print" class="dropdown-item  btn btnprintbukti" type="button"> <span><i class="fa fa-print"></i></span> Bukti Resep </button>
                            <button id="print" class="dropdown-item btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span><strong> Bukti Resep </strong></button>
                            <button id="print" class="dropdown-item  btn btnprintbuktikronis" type="button"> <span><i class="fa fa-print"></i></span><strong> Resep Kronis</strong></button>
                            <button id="print" class=" dropdown-item btn btnprintbuktinonkronis" type="button"> <span><i class="fa fa-print"></i></span><strong> Resep Non Kronis</strong></button>
                            <button id="print" class="dropdown-item" type="button" onclick="printEResep('<?= $kodejournal ?>')"> <span><i class="fas fa-print"></i></span><strong> Resep Klaim</strong></button>
                            <input type="hidden" id="nomorjournal" autocomplet="off" name="nomorjournal" class="form-control" value="<?= $kodejournal; ?>">
                        </div> -->
                        <?php if ($validasilunas == "0.00") { ?>
                            <button id="validasi" class="btn btn-primary btn-outline btn btnvalidasi" type="button" onclick="Validasi('<?= $kodejournal ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Validasi Lunas ?</button>
                        <?php } ?>
                        <?php if ($validasilunas == "1.00") { ?>
                            <button id="batalvalidasi" class="btn btn-danger btn-outline btn btnvalidasi" type="button" onclick="BatalValidasi('<?= $kodejournal ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Batalkan Validasi Lunas ?</button>
                        <?php } ?>
                        <input type="hidden" id="validationby" name="validationby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>

                </td>
            </tr>
</div>
</tfoot>
</table>
</div>


<script>
    function hapusresep(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('FarmasiPelayananRanap/hapus_detail_resep'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            detail();

                        }
                    }

                });


            }
        })

    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananRajal/printpenjualan') ?>?page=" + id, "_blank");
        })
    });
</script>


<script>
    function Validasi(kodejournal) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan melakukan Validasi Lunas Pada Transaksi ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('FarmasiPelayananRanap/ValidasiLunas'); ?>",
                    data: {
                        kodejournal: kodejournal,
                        validationby: $('#validationby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    detail();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>

<script>
    function BatalValidasi(kodejournal) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan melakukan Validasi Lunas Pada Transaksi ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('FarmasiPelayananRanap/BatalValidasiLunas'); ?>",
                    data: {
                        kodejournal: kodejournal,
                        validationby: $('#validationby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    detail();

                                }
                            });
                        }
                    }

                });
            }
        })
    }
</script>


<script>
    function ValidasiLuarPaket(kodejournal) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan melakukan Validasi Luar Paket Ina CBG Pada Transaksi ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('FarmasiPelayananRanap/ValidasiLuarPaket'); ?>",
                    data: {
                        kodejournal: kodejournal,
                        validationby: $('#validationby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    detail();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>

<script>
    function BatalValidasiLuarPaket(kodejournal) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan melakukan Membatalkan Validasi Luar Paket Ina CBG Pada Transaksi ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('FarmasiPelayananRanap/BatalValidasiLuarPaket'); ?>",
                    data: {
                        kodejournal: kodejournal,
                        validationby: $('#validationby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    detail();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
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

<script>
    function setpakai(id) {

        Swal.fire({
            title: 'Aturan Pakai',
            text: "Apakah Aturan Pakai Sudah Benar ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('FarmasiPelayananRanap/Update_cara_pakai'); ?>",
                    data: {
                        id: id,
                        aturanpakai: $('#aturanpakai').val(),
                        carapakai: $('#carapakai').val(),
                        carapetunjuk: $('#carapetunjuk').val(),
                        pagi: $('#pagi').val(),
                        siang: $('#siang').val(),
                        sore: $('#sore').val(),
                        malam: $('#malam').val()

                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            detail();

                        }
                    }

                });


            }
        })

    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintbukti').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananIGD/printpenjualanKonvesional') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
        $('.btnprintbuktikronis').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananIGD/printpenjualanKonvesionalKronis') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
        $('.btnprintbuktinonkronis').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananIGD/printpenjualanKonvesionalNonKronis') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintetiket').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('FarmasiPelayananIGD/printetiket') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=500, height=400");
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
    function printEResep(referencenumber) {
        window.open("<?php echo base_url('FarmasiPelayananRajal/printEResep') ?>?journalnumber=" + referencenumber, "_blank");
    }

    $('.btn-timestamp').click(function() {
        Swal.fire({
            title: 'Peringatan !!',
            text: "Apakah anda yakin untuk update status order resep menjadi : " + $(this).data('status'),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('FarmasiPelayananRanap/updateStatusResep'); ?>",
                    data: {
                        id_header: '<?= $id_header; ?>',
                        status: $(this).data('status'),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success,
                            }).then((result) => {
                                if (result.value) {
                                    detail();
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal',
                                text: response.error,
                            })
                        }
                    }

                });
            }
        })
    });
</script>