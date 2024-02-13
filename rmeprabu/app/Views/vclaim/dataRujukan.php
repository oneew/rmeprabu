<div class="row">

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <h6 class="card-subtitle"></h6>
                <div class="table-responsive">
                    <table class="table color-table success-table">
                        <thead>
                            <tr>
                                <th colspan="2">Identitas Peserta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No Kartu</td>
                                <td>: <b><?= $noKartu; ?></b></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>: <?= $nik; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Peserta</td>
                                <td>: <?= $nama; ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: <?= $sex; ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Tanggungan</td>
                                <td>: <?= $pisa; ?></td>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td>: <?= $noTelepon; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>: <?= $tglLahir; ?></td>
                            </tr>
                            <tr>
                                <td>Umur Saat Ini</td>
                                <td>: <?= $umursekarang; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <h6 class="card-subtitle"></h6>
                <div class="table-responsive">
                    <table class="table color-table success-table">
                        <thead>
                            <tr>
                                <th colspan="2">Keterangan Rujukan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No Rujukan</td>
                                <td>: <b><?= $noKunjungan; ?></b> <button id="print" class="btn btn-warning btn-outline btn btninputsep" type="button" onclick="buatkanRujukanKhusus('<?= $noKunjungan; ?>','<?= $nama; ?>','<?= $noKartu; ?>','<?= $sex; ?>','<?= $umursekarang; ?>','<?= $tglLahir; ?>')"> <span><i class="fas fa-calendar-check"></i></span> Tambah Rujukan Khusus </button></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>: <?= $tglKunjungan; ?></td>
                            </tr>
                            <tr>
                                <td>Perujuk</td>
                                <td>: <?= $namaprovPerujuk; ?> - [<?= $kodeprovPerujuk; ?>]</td>
                            </tr>
                            <tr>
                                <td>Poli Rujukan</td>
                                <td>: <?= $namapoliRujukan; ?> - [<?= $kodepoliRujukan; ?>] - [<?= $namapelayanan; ?>]</td>
                            </tr>

                            <tr>
                                <td>Keluhan</td>
                                <td>: <?= $keluhan; ?></td>
                            </tr>
                            <tr>
                                <td>Kode Diagnosa</td>
                                <td>: <?= $kodediagnosa; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Diagnosa</td>
                                <td>: <?= $namadiagnosa; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body text-center">
                <span class="<?php if ($keteranganStatusPeserta == "AKTIF") {
                                    echo "badge badge-info";
                                } else {
                                    echo "badge badge-danger";
                                }  ?>">
                    <h2 class="text-white"><b><?= $keteranganStatusPeserta; ?></b></h2>
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <h6 class="card-subtitle"></h6>
                <div class="table-responsive">
                    <table class="table color-table success-table">
                        <thead>
                            <tr>
                                <th colspan="4">COB</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No Asuransi COB</td>
                                <td>: <?= $noAsuransiCob; ?> - [<?= $nmAsuransiAsuransiCob; ?>]</td>
                                <td>tanggal TMT & TAT Cob</td>
                                <td>: <?= $tglTMTCob; ?> - [<?= $tglTATCob; ?>]</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function buatkanRujukanKhusus(noRujukan, nama, noKartu, sex, umursekarang, tglLahir) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/CreateRujukanKhusus'); ?>",
            data: {
                noRujukan: noRujukan,
                nama: nama,
                noKartu: noKartu,
                sex: sex,
                umursekarang: umursekarang,
                tglLahir: tglLahir,
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodalrujukan').html(response.suksesmodalsep).show();
                    $('#modalinsertRujukanKhusus').modal();
                }
            }
        });
    }
</script>