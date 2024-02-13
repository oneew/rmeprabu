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
                                <th colspan="2">Keterangan Kecelakaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kode Status kecelakaan</td>
                                <td>: <b><?= $kdStatusKecelakaan; ?></b></td>
                            </tr>

                            <tr>
                                <td>Nama Status Kecelakaan</td>
                                <td>: <?= $nmstatusKecelakaan; ?></td>
                            </tr>
                            <tr>
                                <td>Wilayah Kecelakaan</td>
                                <td>: <?= $lokasi; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Kejadian</td>
                                <td>: <?= $tglKejadian; ?></td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>: <?= $ketKejadian; ?></td>
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
                                <th colspan="2">Keterangan SEP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>No SEP</td>
                                <td>: <b><?= $noSep; ?></b></td>
                            </tr>
                            <tr>
                                <td>Tanggal SEP</td>
                                <td>: <?= $tglSep; ?></td>
                            </tr>
                            <tr>
                                <td>Jenis Pelayanan</td>
                                <td>: <?= $jnsPelayanan; ?></td>
                            </tr>


                            <tr>
                                <td>Nomor Rujukan</td>
                                <td>: <?= $noRujukan; ?></td>
                            </tr>
                            <tr>
                                <td>Poli</td>
                                <td>: <?= $poli; ?> => Poli Ekekutif : <?= $poliEksekutif; ?></td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td>: <?= $catatan; ?></td>
                            </tr>
                            <tr>
                                <td>Diagnosa</td>
                                <td>: <?= $diagnosa; ?></td>
                            </tr>
                            <tr>
                                <td>Kelas Rawat</td>
                                <td>: <?= $kelasRawat; ?></td>
                            </tr>
                            <tr>
                                <td>Kelas Rawat Naik</td>
                                <td>: <?= $klsRawatNaik; ?></td>
                            </tr>
                            <tr>
                                <td>Pembiayaan</td>
                                <td>: <?= $pembiayaan; ?></td>
                            </tr>
                            <tr>
                                <td>DPJP</td>
                                <td>: <?= $nmDPJP; ?> [<?= $kdDPJP; ?>]</td>
                            </tr>
                            <tr>
                                <td>No Surat SPRI/ Kontrol</td>
                                <td>: <?= $noSurat; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



</div>