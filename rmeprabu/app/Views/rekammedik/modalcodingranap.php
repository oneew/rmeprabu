<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<div id="modalcodingranap" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Coding Diagnosa Pasien Rawat Inap</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h6>Menu Utama</h6>
                <div class="row">
                    <div class="col-lg-3 col-xlg-2 col-md-4">
                        <div class="stickyside">
                            <div class="list-group" id="top-menu">
                                <a href="#1" class="list-group-item active">Data Register</a>
                                <a href="#22" class="list-group-item">Pemeriksaan/ Visite</a>
                                <a href="#3" class="list-group-item">Tindakan Medis Non Operatif</a>
                                <a href="#13" class="list-group-item">Tindakan Medis Operatif</a>
                                <a href="#4" class="list-group-item">Radiologi</a>
                                <a href="#5" class="list-group-item">Laboratorium Klinik</a>
                                <a href="#6" class="list-group-item">Laboratorium Patologi Anatomi</a>
                                <a href="#7" class="list-group-item">Bank Darah</a>
                                <a href="#8" class="list-group-item">Farmasi</a>
                                <a href="#9" class="list-group-item">Histori Coding</a>
                                <a href="#10" class="list-group-item">Coding</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-xlg-10 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" id="1">1. Data Register Rawat Inap</h4>
                                <form class="form-horizontal form-material" id="form-filter" method="post">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Norm</label>
                                                    <input type="text" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                                                    <input type="hidden" id="id" name="id" class="form-control" value="<?= $id; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Nama Pasien</label>
                                                    <input type="text" id="pasienname" name="pasienname" class="form-control" value="<?= $pasienname; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Tanggal Lahir</label>
                                                    <input type="text" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control" value="<?= $pasiendateofbirth; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Alamat</label>
                                                    <input type="text" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Tanggal Pulang</label>
                                                    <input type="text" id="datetimein" name="datetimein" class="form-control" value="<?= $dateout; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Ruangan</label>
                                                    <input type="text" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $roomname; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Dokter</label>
                                                    <input type="text" id="doktername" name="doktername" class="form-control" value="<?= $doktername; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Cara Bayar</label>
                                                    <input type="text" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <h4 class="card-title mt-4" id="22">2. Pemeriksaan/ Visite</h4>
                                <div class="table-responsive">
                                    <table id="datarajal" class="tablesaw table-bordered table-hover table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Dokter</th>
                                                <th>Pelayanan</th>
                                                <th>Ruangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($pemeriksaan as $K) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $K['documentdate'] ?></td>
                                                    <td><?= $K['doktername'] ?></td>
                                                    <td><?= $K['name'] ?> </td>
                                                    <td><?= $K['roomname'] ?> </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 class="card-title mt-4" id="3">3. Data Tindakan Medis Dan Keperawatan</h4>
                                <div class="table-responsive">
                                    <table id="dataTNO" class="tablesaw table-bordered table-hover table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>JournalNumber</th>
                                                <th>Pelayanan</th>

                                                <th>Dokter</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($TNO as $row) :
                                                $no++; ?>
                                                <td><?= $no ?></td>
                                                <td><?= $row['documentdate'] ?></td>
                                                <td><?= $row['journalnumber'] ?></td>
                                                <td><?= $row['name']  ?></td>
                                                <td><?= $row['doktername'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <h4 class="card-title mt-4" id="3">3. Data Tindakan Medis Operatif</h4>
                                <div class="table-responsive">
                                    <table id="dataoperasi" class="tablesaw table-bordered table-hover table no-wrap">
                                        <thead>
                                            <tr>
                                                <!-- <th>#</th> -->
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>JournalNumber</th>
                                                <th>Pelayanan</th>
                                                <th>Kategori Operasi</th>
                                                <th>Dokter</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($operasi as $row) :
                                                $no++; ?>
                                                <td><?= $no ?>
                                                <!-- <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm" onclick="laporanoperasi('?= $K['id'] ?>')"> <i class="fas fa-download"></i></button></td> -->
                                                </td>
                                                <td><?= $row['documentdate'] ?></td>
                                                <td><?= $row['journalnumber'] ?></td>
                                                <td><?= $row['name']  ?></td>
                                                <td><?= $row['operationgroup']  ?></td>
                                                <td><?= $row['doktername'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <h4 class="card-title mt-4" id="4">4. Pemeriksaan Radiologi</h4>
                                <div class="table-responsive">
                                    <table id="dataoperasi" class="tablesaw table-bordered table-hover table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama Pemeriksaan</th>
                                                <th>Dokter Pemeriksa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($RAD as $K) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm" onclick="laporanpenunjang('<?= $K['id'] ?>')"> <i class="fas fa-download"></i></button></td>
                                                    <td><?= $no ?></td>
                                                    <td><?= $K['documentdate'] ?></td>
                                                    <td><?= $K['name'] ?> </td>
                                                    <td><?= $K['employeename'] ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 class="card-title mt-4" id="5">5. Pemeriksaan Laboratorium Patologi Klinik</h4>
                                <div class="table-responsive">
                                    <table id="datalpk" class="tablesaw table-bordered table-hover table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama Pemeriksaan</th>
                                                <th>Dokter Pemeriksa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($LPK as $K) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm" onclick="laporanpenunjang('<?= $K['id'] ?>')"> <i class="fas fa-download"></i></button></td>
                                                    <td><?= $no ?></td>
                                                    <td><?= $K['documentdate'] ?></td>
                                                    <td><?= $K['name'] ?> </td>
                                                    <td><?= $K['employeename'] ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 class="card-title mt-4" id="6">6. Pemeriksaan Laboratorium Patologi Antomi</h4>
                                <div class="table-responsive">
                                    <table id="datalpk" class="tablesaw table-bordered table-hover table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama Pemeriksaan</th>
                                                <th>Dokter Pemeriksa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($LPA as $K) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm" onclick="laporanpenunjang('<?= $K['id'] ?>')"> <i class="fas fa-download"></i></button></td>
                                                    <td><?= $no ?></td>
                                                    <td><?= $K['documentdate'] ?></td>
                                                    <td><?= $K['name'] ?> </td>
                                                    <td><?= $K['employeename'] ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <h4 class="card-title mt-4" id="7">7. Bank Darah</h4>
                                <div class="table-responsive">
                                    <table id="datalbd" class="tablesaw table-bordered table-hover table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama Pemeriksaan</th>
                                                <th>Dokter Pemeriksa</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($BD as $K) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm" onclick="laporanpenunjang('<?= $K['id'] ?>')"> <i class="fas fa-download"></i></button></td>
                                                    <td><?= $no ?></td>
                                                    <td><?= $K['documentdate'] ?></td>
                                                    <td><?= $K['name'] ?> </td>
                                                    <td><?= $K['employeename'] ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <h4 class="card-title mt-4" id="8">8. Data Pelayanan Obat</h4>
                                <div class="table-responsive">
                                    <table id="datafarmasi" class="tablesaw table-bordered table-hover table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama Obat</th>
                                                <th>Dokter</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($FARMASI as $FAR) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $FAR['documentdate'] ?></td>
                                                    <td><?= $FAR['name'] ?> </td>
                                                    <td><?= $FAR['doktername'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 class="card-title mt-4" id="9">9. Histori Coding</h4>
                                <div class="table-responsive">
                                    <table id="datakamar" class="tablesaw table-bordered table-hover table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kelompok</th>
                                                <th>Tanggal</th>
                                                <th>JenisDiagnosa</th>
                                                <th>ICDX</th>
                                                <th>Deskripsi ICDX</th>
                                                <th>ICDIX</th>
                                                <th>Deskripsi ICDIX</th>
                                                <th>Tanggal Coding</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($DIAGNOSA as $K) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $K['types'] ?></td>
                                                    <td><?= $K['documentdate'] ?>
                                                        <br><?= $K['poliklinikname'] ?>
                                                        <br><?= $K['doktername'] ?>
                                                    </td>

                                                    <td><span class="<?php if ($K['coding'] == "ICDIX") {
                                                                            echo "badge badge-danger";
                                                                        } else {
                                                                            echo "badge badge-success";
                                                                        }  ?>">
                                                            <?= $K['coding'] ?></span> </td>
                                                    <td><?= $K['codeicdx'] ?> </td>
                                                    <td><?= $K['nameicdx'] ?> </td>
                                                    <td><?= $K['codeicdix'] ?> </td>
                                                    <td><?= $K['nameicdix'] ?> </td>
                                                    <td><?= $K['createddate'] ?>
                                                        <br><?= $K['createdby'] ?>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 class="card-title mt-4" id="8">10. Data Asesmen Rawat Inap</h4>
                                <div class="table-responsive">
                                    <table id="datafarmasi" class="tablesaw table-bordered table-hover table no-wrap">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Diagnosa Utama</th>
                                                <th>Diagnosa Sekunder</th>
                                                <th>Posisi Operasi</th>
                                                <th>Diagnosa Pasca Bedah</th>
                                                <th>Dokter</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($Asesmen as $FAR) :
                                            foreach ($Operasi2 as $row2) :
                                                $no++;
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $FAR['admissionDate'] ?></td>
                                                    <td><?= $FAR['diagnosisUtama'] ?> </td>
                                                    <td><?= $FAR['diagnosisSekunder'] ?> </td>
                                                    <td><?= $row2['posisiOperasi'] ?> </td>
                                                    <td><?= $row2['diagnosaPascaBedah'] ?> </td>
                                                    <td><?= $FAR['doktername'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <h4 class="card-title mt-4" id="10">10. Coding</h4>
                                <?php if ($coding <> "SUDAH") { ?>
                                    <div id="form-filter-atas">
                                        <?= form_open('RekMedCodingRanap/simpanrekmedheader', ['class' => 'formperawatheader']); ?>
                                        <?= csrf_field(); ?>
                                        <form method="post" id="form-filter">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">ReferenceNumber</label>
                                                            <input type="text" id="referencenumber_TH" name="referencenumber_TH" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                                            <input type="hidden" id="referencenumber_rawatinap_TH" name="referencenumber_rawatinap_TH" class="form-control" value="<?= $journalnumber_ranap; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">SMF</label>
                                                            <input type="hidden" id="pasiendateofbirth_TH" name="pasiendateofbirth_TH" class="form-control" value="<?= $pasiendateofbirth; ?>" readonly>
                                                            <input type="hidden" id="poliklinik_TH" name="poliklinik_TH" class="form-control" value="<?= $room; ?>" readonly>
                                                            <input type="hidden" id="poliklinikname_TH" name="poliklinikname_TH" class="form-control" value="<?= $roomname; ?>" readonly>
                                                            <input type="hidden" id="groups_TH" name="groups_TH" class="form-control" value="<?= $groups; ?>" readonly>
                                                            <input type="hidden" id="bpjs_sep_TH" name="bpjs_sep_TH" class="form-control" value="<?= $bpjs_sep; ?>" readonly>
                                                            <input type="hidden" id="oldcode_TH" name="oldcode_TH" class="form-control" value="<?= $oldcode; ?>" readonly>
                                                            <input type="hidden" id="pasienid_TH" name="pasienid_TH" class="form-control" value="<?= $pasienid; ?>" readonly>
                                                            <input type="hidden" id="pasiengender_TH" name="pasiengender_TH" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                                            <input type="hidden" id="pasienaddress_TH" name="pasienaddress_TH" class="form-control" value="<?= $pasienaddress; ?>" readonly>
                                                            <input type="hidden" id="pasienarea_TH" name="pasienarea_TH" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                                            <input type="hidden" id="pasiensubarea_TH" name="pasiensubarea_TH" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                                            <input type="hidden" id="pasiensubareaname_TH" name="pasiensubareaname_TH" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                                            <input type="hidden" id="pasienname_TH" name="pasienname_TH" class="form-control" value="<?= $pasienname; ?>" readonly>
                                                            <input type="hidden" id="paymentmethod_TH" name="paymentmethod_TH" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                                            <input type="hidden" id="paymentmethodname_TH" name="paymentmethodname_TH" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                                                            <input type="hidden" id="pasiengender_TH" name="pasiengender_TH" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                                            <input type="hidden" id="paymentcardnumber_TH" name="paymentcardnumber_TH" class="form-control" value="<?= $paymentcardnumber; ?>" readonly>
                                                            <input type="hidden" id="paymentchange_TH" name="paymentchange_TH" class="form-control" value="<?= $paymentchange; ?>" readonly>
                                                            <input type="hidden" id="paymentchangenumber_TH" name="paymentchangenumber_TH" class="form-control" value="<?= $paymentchangenumber; ?>" readonly>
                                                            <input type="hidden" id="pasienclassroom_TH" name="pasienclassroom_TH" class="form-control" value="<?= $pasienclassroom; ?>" readonly>
                                                            <input type="hidden" id="classroom_TH" name="classroom_TH" class="form-control" value="<?= $classroom; ?>" readonly>
                                                            <input type="hidden" id="classroomname_TH" name="classroomname_TH" class="form-control" value="<?= $classroomname; ?>" readonly>
                                                            <input type="hidden" id="bednumber_TH" name="bednumber_TH" class="form-control" value="<?= $bednumber; ?>" readonly>
                                                            <input type="hidden" id="smf_TH" name="smf_TH" class="form-control" value="<?= $smf; ?>" readonly>
                                                            <input type="text" id="smfname_TH" name="smfname_TH" class="form-control" value="<?= $smfname; ?>" readonly>
                                                            <input type="hidden" id="locationcode_TH" name="locationcode_TH" class="form-control" value="RCM" readonly>
                                                            <input type="hidden" id="locationname_TH" name="locationname_TH" class="form-control" value="REKAM MEDIS" readonly>
                                                            <input type="hidden" id="pasienaddress_TH" name="pasienaddress_TH" class="form-control" value="<?= $pasienaddress; ?>" readonly>

                                                            <input type="hidden" id="pasienage_TH" name="pasienage_TH" class="form-control" value="<?= $umur; ?>" readonly>
                                                            <input type="hidden" id="documentdate_TH" name="documentdate_TH" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                                            <input type="hidden" id="documentmonth_TH" name="documentmonth_TH" class="form-control" value="<?= date('m'); ?>" readonly>
                                                            <input type="hidden" id="documentyear_TH" name="documentyear_TH" class="form-control" value="<?= date('Y'); ?>" readonly>
                                                            <input type="hidden" id="createddate_TH" name="createddate_TH" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                                            <input type="hidden" id="createdby_TH" name="createdby_TH" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label">Dokter</label>
                                                            <select name="doktername_TH" id="doktername_TH" class="select2" style="width: 100%">
                                                                <option></option>
                                                                <?php foreach ($list as $do) {
                                                                    $selected = ($do['name'] == $doktername) ? 'selected' : '';
                                                                ?>
                                                                    <option data-id="<?= $do['id']; ?>" <?= $selected; ?> class="select-dokter"><?= $do['name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <input type="hidden" id="dokter_TH" name="dokter_TH" class="form-control" value="<?= $dokter; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label"></label>
                                                            <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i> Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <?= form_close() ?>
                                    </div>
                                <?php } ?>

                                <div id="form-filter-bawah" style="display: none;">
                                    <?= form_open('RekMedCodingRanap/simpanDiagnosaDetail', ['class' => 'formTNO']); ?>
                                    <?= csrf_field(); ?>
                                    <form method="post" id="form-filter">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">ICD X</label>
                                                    <input type="text" id="name" name="name" class="form-control">

                                                    <input type="hidden" id="codingicdx" codingicdx="name" class="form-control" value="ICDX">
                                                    <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber_header; ?>" readonly>
                                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                                    <input type="hidden" id="referencenumber_rawatinap" name="referencenumber_rawatinap" class="form-control" value="<?= $journalnumber_ranap; ?>" readonly>
                                                    <input type="hidden" id="poliklinik" name="poliklinik" class="form-control" value="<?= $room; ?>" readonly>
                                                    <input type="hidden" id="poliklinikname" name="poliklinikname" class="form-control" value="<?= $roomname; ?>" readonly>
                                                    <input type="hidden" id="groups" name="groups" class="form-control" value="<?= $groups; ?>" readonly>
                                                    <input type="hidden" id="bpjs_sep" name="bpjs_sep" class="form-control" value="<?= $bpjs_sep; ?>" readonly>
                                                    <input type="hidden" id="oldcode" name="oldcode" class="form-control" value="<?= $oldcode; ?>" readonly>
                                                    <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                                                    <input type="hidden" id="pasiengender" name="pasiengender" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                                    <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>" readonly>
                                                    <input type="hidden" id="pasienarea" name="pasienarea" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                                    <input type="hidden" id="pasiensubarea" name="pasiensubarea" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                                    <input type="hidden" id="pasiensubareaname" name="pasiensubareaname" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                                    <input type="hidden" id="pasienname" name="pasienname" class="form-control" value="<?= $pasienname; ?>" readonly>
                                                    <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                                                    <input type="hidden" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $paymentmethodname; ?>" readonly>

                                                    <input type="hidden" id="paymentcardnumber" name="paymentcardnumber" class="form-control" value="<?= $paymentcardnumber; ?>" readonly>
                                                    <input type="hidden" id="pasienclassroom" name="pasienclassroom" class="form-control" value="<?= $pasienclassroom; ?>" readonly>
                                                    <input type="hidden" id="classroom" name="classroom" class="form-control" value="<?= $classroom; ?>" readonly>
                                                    <input type="hidden" id="classroomname" name="classroomname" class="form-control" value="<?= $classroomname; ?>" readonly>
                                                    <input type="hidden" id="bednumber" name="bednumber" class="form-control" value="<?= $bednumber; ?>" readonly>
                                                    <input type="hidden" id="smf" name="smf" class="form-control" value="<?= $smf; ?>" readonly>
                                                    <input type="hidden" id="smfname" name="smfname" class="form-control" value="<?= $smfname; ?>" readonly>
                                                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="RCM" readonly>
                                                    <input type="hidden" id="locationname" name="locationname" class="form-control" value="REKAM MEDIS" readonly>
                                                    <input type="hidden" id="pasienaddress" name="pasienaddress" class="form-control" value="<?= $pasienaddress; ?>" readonly>
                                                    <input type="hidden" id="pasienage" name="pasienage" class="form-control" value="<?= $umur; ?>" readonly>
                                                    <input type="hidden" id="age_years" name="age_years" class="form-control" value="<?= $age_years; ?>" readonly>
                                                    <input type="hidden" id="age_months" name="age_months" class="form-control" value="<?= $age_months; ?>" readonly>
                                                    <input type="hidden" id="age_days" name="age_days" class="form-control" value="<?= $age_days; ?>" readonly>
                                                    <input type="hidden" id="date_pelayanan" name="date_pelayanan" class="form-control" value="<?= $dateout; ?>" readonly>
                                                    <input type="hidden" id="journalnumber_ranap" name="journalnumber_ranap" class="form-control" value="<?= $journalnumber_ranap; ?>" readonly>
                                                    <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                                    <input type="hidden" id="documentmonth" name="documentmonth" class="form-control" value="<?= date('m'); ?>" readonly>
                                                    <input type="hidden" id="documentyear" name="documentyear" class="form-control" value="<?= date('Y'); ?>" readonly>
                                                    <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                    <input type="hidden" id="dokter_detail" name="dokter_detail" class="form-control" value="<?= $dokter; ?>" readonly>
                                                    <input type="hidden" id="doktername_detail" name="doktername_detail" class="form-control" value="<?= $doktername; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Deskripsi</label>
                                                    <input type="hidden" id="codeicdx" name="codeicdx" class="form-control">
                                                    <input type="text" id="nameicdx" name="nameicdx" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Diagnosa Primer ? </label>
                                                    <div class="switch">
                                                        <label>Tidak
                                                            <input type="checkbox" value="1" name="diagnosaprimer" id="diagnosaprimer"><span class="lever"></span>Ya</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">ICD IX</label>
                                                    <input type="text" id="namaicdix" name="namaicdix" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Deskripsi ICD IX</label>
                                                    <input type="text" id="nameicdix" name="nameicdix" class="form-control">
                                                    <input type="hidden" id="icdix" name="icdix" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success btnsimpanTNO"> <i class="fa fa-check"></i> Tambah</button>
                                            <button type="button" class="btn btn-inverse" data-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                    <?= form_close() ?>
                                </div>
                                <div class="card-body viewdataresumediagnosa"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
    $(document).ready(function() {

        $('#doktername').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#doktername_TH option:selected').data('id')
                },
                'success': function(response) {
                    let data = JSON.parse(response);
                    $('#doktername_TH').val(data.name);
                    $('#dokter_TH').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })
    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
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
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
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
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.formperawatheader').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.doktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        } else {
                            $('#doktername').removeClass('form-control-danger');
                            $('.erroroktername').html('');
                        }

                        if (response.error.name) {
                            $('#name').addClass('form-control-danger');
                            $('.errorname').html(response.error.name);
                        } else {
                            $('#name').removeClass('form-control-danger');
                            $('.errorname').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        $('#form-filter-atas').css('display', 'none');
                        $('#form-filter-bawah').css('display', 'block');
                        $('#journalnumber').val(response.JN);
                        //$('#kode').val(response.JN);
                        $('#dokter_detail').val(response.dokterdiagnosa);
                        $('#doktername_detail').val(response.dokternamediagnosa);

                    }
                }


            });
            return false;
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.formTNO').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanTNO').attr('disable', 'disabled');
                    $('.btnsimpanTNO').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanTNO').removeAttr('disable');
                    $('.btnsimpanTNO').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {

                        if (response.error.documentdate) {
                            $('#documentdate').addClass('form-control-danger');
                            $('.errordocumentdate').html(response.error.documentdate);
                        } else {
                            $('#documentdate').removeClass('form-control-danger');
                            $('.errordocumentdate').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        //$('#modaltambah').modal('hide');

                        //resumeTNO();
                        $('#name').val('');
                        $('#codeicdx').val('');
                        $('#nameicdx').val('');
                        $('#namaicdix').val('');
                        $('#icdix').val('');
                        $('#nameicdix').val('');
                        dataresumediagnosa();

                    }
                }


            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#name").autocomplete({
            source: "<?php echo base_url('RekMedCodingRanap/ajax_icdx'); ?>",
            select: function(event, ui) {
                $('#name').val(ui.item.value);
                $('#codeicdx').val(ui.item.originalcode);
                $('#nameicdx').val(ui.item.nameicdx);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#namaicdix").autocomplete({
            source: "<?php echo base_url('RekMedCodingRanap/ajax_icdix'); ?>",
            select: function(event, ui) {
                $('#namaicdix').val(ui.item.value);
                $('#icdix').val(ui.item.originalcode);
                $('#nameicdix').val(ui.item.nameicdix);
            }
        });
    });
</script>

<script>
    function dataresumediagnosa() {

        $.ajax({

            url: "<?php echo base_url('RekMedCodingRanap/resumediagnosasekarang') ?>",
            data: {
                referencenumber: $('#journalnumber_ranap').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataresumediagnosa').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresumediagnosa();


    });
</script>