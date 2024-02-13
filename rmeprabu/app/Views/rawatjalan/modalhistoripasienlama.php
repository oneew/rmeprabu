<style type="text/css">
    .swal-container {
        z-index: 999999999;
    }
</style>

<div id="modalhistoripasienlama" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Histori Riwayat Pelayanan Pasien</h4>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->
                    <?php
                    foreach ($pasienlama as $pasien) :
                    ?>
                        <div class="col-lg-2 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    $tanggallahir = $pasien['dateofbirth'];
                                    $dob = strtotime($tanggallahir);
                                    $current_time = time();
                                    $age_years = date('Y', $current_time) - date('Y', $dob);
                                    $age_months = date('m', $current_time) - date('m', $dob);
                                    $age_days = date('d', $current_time) - date('d', $dob);

                                    if ($age_days < 0) {
                                        $days_in_month = date('t', $current_time);
                                        $age_months--;
                                        $age_days = $days_in_month + $age_days;
                                    }

                                    if ($age_months < 0) {
                                        $age_years--;
                                        $age_months = 12 + $age_months;
                                    }

                                    $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";
                                    if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecillaki.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years <= 5)) {
                                        $gambar = base_url() . '/assets/images/users/anakkecilperempuan.jpeg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 6) and ($age_years <= 12)) {
                                        $gambar = base_url() . '/assets/images/users/remajapria.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 6) and ($age_years <= 12)) {

                                        $gambar = base_url() . '/assets/images/users/remajaperempuan.jpeg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 13) and ($age_years <= 59)) {
                                        $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 13) and ($age_years <= 59)) {

                                        $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                                    } else if (($pasien['gender'] == 'LAKI-LAKI') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/priatua.jpeg';
                                    } else if (($pasien['gender'] == 'PEREMPUAN') and ($age_years >= 60)) {

                                        $gambar = base_url() . '/assets/images/users/wanitatua.jpeg';
                                    }
                                    ?>
                                    <div class="mt-4 text-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                        <h4 class="card-title mt-2"><?= $pasien['name']; ?></h4>
                                        <h6 class="card-subtitle"><?= $pasien['code']; ?></h6>

                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="card-body"> <small class="text-muted">Alamat </small>
                                    <h6><?= $pasien['address']; ?></h6> <small class="text-muted pt-4 d-block">NIK</small>
                                    <h6><?= $pasien['ssn']; ?></h6> <small class="text-muted pt-4 d-block">No Asuransi</small>
                                    <h6><?= $pasien['cardnumber']; ?></h6>
                                    <div class="map-box"></div>

                                    <small class="text-muted pt-4 d-block">Tanggal Lahir</small>

                                    <h6><?= $pasien['dateofbirth']; ?> [<?= $umur; ?>]</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-12">
                            <div class="card">
                                <div class="modal-body">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Rawat Jalan & IGD</a></li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">Rawat Inap</a></li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Penunjang</a></li>
                                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">Farmasi</a></li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="profile3" role="tabpanel">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="datahistori" class="table color-table success-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Kunjungan</th>
                                                                        <th>Tanggal</th>
                                                                        <th>JournalNumber</th>
                                                                        <th>No.SEP</th>
                                                                        <th>NomorRekamMedik</th>
                                                                        <th>CaraPembayaran</th>
                                                                        <th>Pelayanan</th>
                                                                        <th>Dokter</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $no = 0;
                                                                    foreach ($rajal as $row) :
                                                                        $no++; ?>
                                                                        <tr>
                                                                            <td><?= $no ?></td>
                                                                            <td><?= $row['groups'] ?></td>
                                                                            <td><?= $row['documentdate'] ?></td>
                                                                            <td><?= $row['journalnumber'] ?></td>
                                                                            <td><?= $row['bpjs_sep'] ?></td>
                                                                            <td><?= $row['pasienid'] ?></td>
                                                                            <td><?= $row['paymentmethodname']  ?></td>
                                                                            <td><?= $row['poliklinikname']  ?></td>
                                                                            <td><?= $row['doktername']  ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="home" role="tabpanel">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="datahistoriranap" class="table color-table success-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>TanggalMasuk</th>
                                                                        <th>TanggalKeluar</th>
                                                                        <th>NoReferensi</th>
                                                                        <th>Ruangan</th>
                                                                        <th>NomorRekamMedik</th>
                                                                        <th>CaraPembayaran</th>
                                                                        <th>Dokter</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $no = 0;
                                                                    foreach ($ranap as $row) :
                                                                        $no++; ?>
                                                                        <tr>
                                                                            <td><?= $no ?></td>
                                                                            <td><?= $row['datein'] ?></td>
                                                                            <td><?= $row['dateout'] ?></td>
                                                                            <td><?= $row['referencenumber'] ?></td>
                                                                            <td><?= $row['roomname'] ?></td>
                                                                            <td><?= $row['pasienid'] ?></td>
                                                                            <td><?= $row['paymentmethodname']  ?></td>
                                                                            <td><?= $row['doktername']  ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="profile" role="tabpanel">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="datahistoripenunjang" class="table color-table success-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Kelompok</th>
                                                                        <th>Tanggal</th>
                                                                        <th>NoReferensi</th>
                                                                        <th>Pemeriksaan</th>
                                                                        <th>NomorRekamMedik</th>
                                                                        <th>CaraPembayaran</th>
                                                                        <th>Dokter</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $no = 0;
                                                                    foreach ($penunjang as $row) :
                                                                        $no++; ?>
                                                                        <tr>
                                                                            <td><?= $no ?></td>
                                                                            <td><?= $row['types'] ?></td>
                                                                            <td><?= $row['documentdate'] ?></td>
                                                                            <td><?= $row['referencenumber'] ?></td>
                                                                            <td><?= $row['name'] ?></td>
                                                                            <td><?= $row['relation'] ?></td>
                                                                            <td><?= $row['paymentmethodname']  ?></td>
                                                                            <td><?= $row['employeename']  ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="profile2" role="tabpanel">
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="datahistoripenunjang" class="table color-table success-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Tanggal</th>
                                                                        <th>Dokter</th>
                                                                        <th>KodeObat</th>
                                                                        <th>NamaObat</th>
                                                                        <th>BatchNumber</th>
                                                                        <th>Jumlah</th>
                                                                        <th>NomorRekamMedik</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $no = 0;
                                                                    foreach ($obat as $row) :
                                                                        $no++; ?>
                                                                        <tr>
                                                                            <td><?= $no ?></td>
                                                                            <td><?= $row['documentdate'] ?></td>
                                                                            <td><?= $row['referencenumber'] ?></td>
                                                                            <td><?= $row['code'] ?></td>
                                                                            <td><?= $row['name'] ?></td>
                                                                            <td><?= $row['batchnumber'] ?></td>
                                                                            <td><?= abs($row['qty']) ?></td>
                                                                            <td><?= $row['relation'] ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
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
                    <?php endforeach; ?>
                    <!-- Column -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="viewmodaldeniap" style="display:none;"></div>
<div class="viewmodalpiutang" style="display:none;"></div>