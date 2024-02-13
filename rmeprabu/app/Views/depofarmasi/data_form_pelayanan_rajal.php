<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

<?php if (check_obat_racikan($kodejournal) != "TIDAK ADA") : ?>
    <div class="m-1">
        <div class="bg-success p-2 mb-3">
            <h3 class="text-white mb-0">Obat Racikan</h6>
            <span class="text-white">Note: Jangan lupa di entry ulang ya !!!</span>
        </div>
        <?php foreach (check_obat_racikan($kodejournal) as $item) : ?>
            <div class="d-flex border-top border-bottom py-3">
                <?= $item['description'] ;?>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>

<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>E-tiket</th>
                <th>Kode</th>
                <th>Jumlah</th>
                <th>JmlKronis</th>
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
                    <td>
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapusresep('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                    </td>

                    <td><?= $no ?></td>
                    <td> <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnprintetiket" data-id="<?= $row['id']; ?>"> <i class="ti-printer"></i></button></td>
                    
                    <td>[<?= $row['code']  ?>] <b><?= $row['name']  ?></b>
                        <br><?= $row['uom']  ?>
                    </td>
                    <td><?= $row['qtypaket'] ?></td>
                    <td><?= $row['qtyluarpaket'] ?></td>
                    <td><?= $row['batchnumber']  ?></td>
                    <td><?= number_format($row['price'], 2, ",", ".");  ?></td>
                    <td><?= abs($row['subtotal']) ?></td>
                    <?php $Total[] = abs($row['subtotal']); ?>
                    <td><?php echo number_format($row['signa1'], 0, ",", "."); ?> x <?php echo number_format($row['signa2'], 0, ",", "."); ?></td>
                    <td>
                        <?= $row['eticket_aturan']; ?>
                        <br><?= $row['eticket_carapakai']; ?>
                        <br><?= $row['eticket_petunjuk']; ?>
                    </td>
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
                <div class="dropup ">
                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cetak Resep</button>
                        <div class="dropdown-menu ">
                    <button id="print" class="dropdown-item btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span><strong> Bukti Resep </strong></button>
                    <!-- <button id="print" class="dropdown-item  btn btnprintbukti" type="button"> <span><i class="fa fa-print"></i></span> Bukti Resep </button> -->
                    <button id="print" class="dropdown-item  btn btnprintbuktikronis" type="button"> <span><i class="fa fa-print"></i></span><strong> Resep Kronis</strong></button>
                    <button id="print" class=" dropdown-item btn btnprintbuktinonkronis" type="button"> <span><i class="fa fa-print"></i></span><strong> Resep Non Kronis</strong></button>
                    <button id="print" class="dropdown-item" type="button" onclick="printEResep('<?= $kodejournal ?>')"> <span><i class="fas fa-print"></i></span><strong>Resep Klaim</strong></button>
                    <input type="hidden" id="nomorjournal" autocomplet="off" name="nomorjournal" class="form-control" value="<?= $kodejournal; ?>">
                        </div>
                        <?php if ($validasilunas == "0.00") { ?>
                        <button id="validasi" class="btn btn-primary btn-outline btn btnvalidasi" type="button" onclick="Validasi('<?= $kodejournal ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Validasi Lunas ?</button>
                    <?php } ?>
                    <?php if ($validasilunas == "1.00") { ?>
                        <button id="batalvalidasi" class="btn btn-danger btn-outline btn btnvalidasi" type="button" onclick="BatalValidasi('<?= $kodejournal ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Batalkan Validasi Lunas ?</button>
                    <?php } ?>
                    <input type="hidden" id="validationby" name="validationby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                    <?php if ($validasilunas == "0.00") ?>
                    <button id="print" class="btn btn-secondary btn-outline btn btnrinciangabung" type="button" onclick="lihatRincianGabung('<?= $referencenumber ?>')"> <span><i class="mdi mdi-search-web"></i></span>Rincian Pelayanan</button>
                </td>

            </tr>
            <tr>
                <td colspan="15" class="text-center">
                    <button id="print" class="btn btn-info btn-outline btn btntaskid" type="button" onclick="TaskID('<?= $referencenumber ?>')"> <span><i class="mdi mdi-network"></i></span> List Task ID JKN Mobile </button>
                    <button id="print" class="btn btn-danger btn-outline btn btnupdateantrean" type="button" onclick="UpdateAntrean('<?= $referencenumber ?>')"> <span><i class="mdi mdi-map-marker-radius"></i></span> Update Waktu Antrian JKN Mobile </button>
                </td>
            </tr>
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
    function ValidasiTelaah(telaah) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan melakukan Validasi Telaah Resep ini ?",
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
                    url: "<?php echo base_url('FarmasiPelayananRanap/ValidasiTelaah'); ?>",
                    data: {
                        telaah: telaah,
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
    $(document).ready(function() {
        $('#datapaketLab').DataTable({
            responsive: true,
            paging: false,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>
<script>
    function printEResep(referencenumber) {
        window.open("<?php echo base_url('FarmasiPelayananRajal/printEResep') ?>?journalnumber=" + referencenumber, "_blank");
    }
</script>