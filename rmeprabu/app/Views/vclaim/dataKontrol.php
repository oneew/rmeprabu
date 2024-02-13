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
                                <td>Nama Peserta</td>
                                <td>: <?= $nama; ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: <?= $kelamin; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>: <?= $tglLahir; ?></td>
                            </tr>
                            <tr>
                                <td>Hak Kelas</td>
                                <td>: <?= $hakKelas; ?></td>
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
                                <th colspan="2">Keterangan Surat Kontrol</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No Surat Kontrol</td>
                                <td>: <b><?= $noSuratKontrol; ?></b></td>
                            </tr>
                            <tr>
                                <td>Tanggal Rencana Kontrol</td>
                                <td>: <?= $tglRencanaKontrol; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Terbit Kontrol</td>
                                <td>: <?= $tglTerbit; ?></td>
                            </tr>
                            <tr>
                                <td>Poli Kontrol</td>
                                <td>: <?= $namaPoliTujuan; ?> - [<?= $poliTujuan; ?>]</td>
                            </tr>

                            <tr>
                                <td>Dokter Tujuan Kontrol</td>
                                <td>: <?= $namaDokter; ?> [<?= $kodeDokter; ?>]</td>
                            </tr>
                            <tr>
                                <td>Dokter Pembuat Surat Kontrol</td>
                                <td>: <?= $namaDokterPembuat; ?> [<?= $kodeDokterPembuat; ?>]</td>
                            </tr>
                            <tr>
                                <td>Jenis Kontrol</td>
                                <td>: <?= $namaJnsKontrol; ?></td>
                            </tr>
                            <tr>
                                <td>Sep Rawat Inap</td>
                                <td>: <?= $noSep; ?></td>
                            </tr>
                            <tr>
                                <td>Perujuk</td>
                                <td>: <?= $nmProviderPerujuk; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>