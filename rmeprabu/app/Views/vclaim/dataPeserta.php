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
                                <td>: <?= $noKartu; ?></td>
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
                                <td>Tanggal Lahir</td>
                                <td>: <?= $tglLahir; ?></td>
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
                                <td>Umur Saat Ini</td>
                                <td>: <?= $umursekarang; ?></td>
                            </tr>
                            <tr>
                                <td>Umur Saat Pelayanan</td>
                                <td>: <?= $umurSaatPelayanan; ?></td>
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
                                <th colspan="2">Keterangan Kepesertaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jenis Kepesertaan</td>
                                <td>: <?= $keteranganJenisPeserta; ?> - [<?= $kodeJenisPeserta; ?>]</td>
                            </tr>
                            <tr>
                                <td>Hak kelas</td>
                                <td>: <?= $keteranganhakKelas; ?> - [<?= $kodehakKelas; ?>]</td>
                            </tr>
                            <tr>
                                <td>Kode Faskes 1</td>
                                <td>: <?= $kdProvider; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Faskes 1</td>
                                <td>: <?= $nmProvider; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Cetak Kartu</td>
                                <td>: <?= $tglCetakKartu; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal TAT</td>
                                <td>: <?= $tglTAT; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal TMT</td>
                                <td>: <?= $tglTMT; ?></td>
                            </tr>
                            <tr>
                                <td>Dinsos</td>
                                <td>: <?= $dinsos; ?></td>
                            </tr>
                            <tr>
                                <td>Prolanis PRB</td>
                                <td>: <?= $prolanisPRB; ?></td>
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