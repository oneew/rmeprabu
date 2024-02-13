<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <h6 class="card-subtitle"></h6>
                <div class="row mt-4">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-info">
                            <div class="p-2 rounded bg-info text-center">
                                <h4 class="font-light text-white">AP</h4>
                                <h6 class="text-white">Asesmen Perawat</h6>
                                <div class="text-center mb-0">
                                    <button id="print" class="btn btn-info btnprintAsesmenPerawat" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-primary card-inverse">
                            <div class="p-2 rounded text-center">
                                <h4 class="font-light text-white">RM</h4>
                                <h6 class="text-white">Resume Medis</h6>
                                <div class="text-center mb-0">
                                    <button id="print" class="btn btn-primary btnprintResumeMedis" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-success">
                            <div class="p-2 rounded text-center">
                                <h4 class="font-light text-white">RAD</h4>
                                <h6 class="text-white">Radiologi</h6>
                                <div class="text-center mb-0">
                                    <button id="print" class="btn btn-success btnRad" type="button" onclick="Rad('<?= $referencenumber ?>')"> <span><i class="fa fa-download"></i></span></button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-dark">
                            <div class="p-2 rounded text-center">
                                <h4 class="font-light text-white">LAB</h4>
                                <h6 class="text-white">Laboratorium</h6>
                                <div class="text-center mb-0">
                                    <button id="print" class="btn btn-danger btnLab" type="button" onclick="Lpk('<?= $referencenumber ?>')"> <span><i class="fa fa-download"></i></span>PK</button>
                                    <button id="print" class="btn btn-warning btnPA" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span>PA</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-info">
                            <div class="p-2 rounded bg-info text-center">
                                <h4 class="font-light text-white">FAR</h4>
                                <h6 class="text-white">Farmasi</h6>
                                <div class="text-center mb-0">
                                    <button id="print" class="btn btn-info btnFar" type="button" onclick="Farmasi('<?= $referencenumber ?>')"> <span><i class="fa fa-download"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-primary card-inverse">
                            <div class="p-2 rounded text-center">
                                <h4 class="font-light text-white">RB</h4>
                                <h6 class="text-white">Rincian Biaya</h6>
                                <div class="text-center mb-0">
                                    <button id="print" class="btn btn-primary btnRBpoli" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-success">
                            <div class="p-2 rounded text-center">
                                <h4 class="font-light text-white">LO</h4>
                                <h6 class="text-white">Laporan Operasi</h6>
                            </div>
                            <div class="text-center mb-0">
                            <button id="print" class="btn btn-success btnLOGeneral" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-dark">
                            <div class="p-2 rounded text-center">
                                <h4 class="font-light text-white">Katarak</h4>
                                <h6 class="text-white">Laporan Operasi Katarak</h6>
                            </div>
                            <div class="text-center mb-0">
                            <button id="print" class="btn btn-dark btnLOKatarak" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-warning">
                            <div class="p-2 rounded text-center">
                                <h4 class="font-light text-white">File RME</h4>
                                <h6 class="text-white">Data File RME</h6>
                            </div>
                            <div class="text-center mb-0">
                                <button class="btn btn-dark btnHistoryFile" type="button" data-ref="<?= $referencenumber ?>"> <span><i class="fa fa-clock"></i></span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-danger">
                            <div class="p-2 rounded text-center">
                                <h4 class="font-light text-white">Arsip Digital</h4>
                                <h6 class="text-white">Download Seluruh Berkas</h6>
                            </div>
                            <div class="text-center mb-0">
                                <button id="print" class="btn btn-danger downloadAll" type="button" data-id="<?= $referencenumber ?>" data-rincian="<?= $paymentmethodname; ?>"> <span><i class="fa fa-download"></i></span></button>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <div class="table-responsive">
                    <table id="demo-foo-addrow" class="table mt-4 mb-0 table-hover no-wrap contact-list" data-paging="true" data-paging-size="7">
                        <thead>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pelayanan</th>
                            <th>Diagnosa</th>
                            <th>Resep</th>
                            <th>Tindakan</th>
                            <th>Operasi</th>
                            <th>Radiologi</th>
                            <th>Patologi Klinik</th>
                            <th>Patologi Anatomi</th>
                        </thead>
                        <tbody>

                            <?php $no = 0;
                            foreach ($tampildata as $row) :
                                $no++;
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row['documentdate'] ?></td>
                                    <td><?= $row['poliklinikname'] ?>
                                        </br><?= $row['doktername']; ?></td>
                                    <td>
                                        <table style="border-collapse: collapse; height: 36px;" border="0">
                                            <tbody>
                                                <?php $noA = 0;
                                                foreach ($row['listDiagnosa'] as $Diagnosa) :
                                                    $noA++;
                                                ?>
                                                    <tr>
                                                        <td style="width: 5%;"><?= $noA; ?></td>
                                                        <td style="width: 5%;"><?= $Diagnosa['codeicdx']; ?></td>
                                                        <td style="width: 5%;"><?= $Diagnosa['nameicdx']; ?>(<?= $Diagnosa['kategori']; ?>)</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table style="border-collapse: collapse; height: 36px;" border="0">
                                            <tbody>
                                                <?php $noD = 0;
                                                foreach ($row['listResep'] as $resep) :
                                                    $noD++;
                                                ?>
                                                    <tr>
                                                        <td style="width: 5%;"><?= $noD; ?></td>
                                                        <td style="width: 5%;"><?= $resep['name']; ?>[<?= $resep['signa1'] ?> x <?= $resep['signa2']; ?>](<?= ABS($resep['qty']); ?>)</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table style="border-collapse: collapse; height: 36px;" border="0">
                                            <tbody>
                                                <?php $nox = 0;
                                                foreach ($row['list'] as $pemeriksaan) :
                                                    $nox++;
                                                ?>
                                                    <tr>
                                                        <td style="width: 5%;"><?= $nox; ?></td>
                                                        <td style="width: 5%;"><?= $pemeriksaan['name']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td></td>
                                    <td>
                                        <table style="border-collapse: collapse; height: 36px;" border="0">
                                            <tbody>
                                                <?php $noB = 0;
                                                foreach ($row['listRad'] as $rad) :
                                                    $noB++;
                                                ?>
                                                    <tr>
                                                        <td style="width: 5%;"><?= $noB; ?></td>
                                                        <td style="width: 5%;"><?= $rad['name']; ?></td>
                                                        <td>
                                                            <?php if ($rad['idPenunjangDetail'] !== null) { ?>
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="expertiseRad('<?= $rad['id'] ?>')"> <i class="fas fa-file-alt"></i></button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table style="border-collapse: collapse; height: 36px;" border="0">
                                            <tbody>
                                                <?php $noC = 0;
                                                foreach ($row['listLpk'] as $lpk) :
                                                    $noC++;
                                                    $nojournal = $lpk['journalnumber'];
                                                ?>
                                                    <tr>
                                                        <td style="width: 5%;"><?= $noC; ?></td>
                                                        <td style="width: 5%;"><?= $lpk['name']; ?></td>
                                                        <td> <button type="button" class="btn btn-warning btn-sm" onclick="HasilLPK('<?= $nojournal ?>')"> <i class="far fa-envelope"></i></button></td>

                                                    </tr>

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                    </td>
                                    <td>
                                        <table style="border-collapse: collapse; height: 36px;" border="0">
                                            <tbody>
                                                <?php $noC = 0;
                                                foreach ($row['listLpa'] as $lpa) :
                                                    $noC++;
                                                ?>
                                                    <tr>
                                                        <td style="width: 5%;"><?= $noC; ?></td>
                                                        <td style="width: 5%;"><?= $lpa['name']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintResumeMedis').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printResumeMedisRajal') ?>?page=" + id, "_blank");
        })
    });
</script>



<script>
    function Farmasi(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/PelayananResepRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_pelayanan_farmasi_mobilisasi_dana').modal('show');
                }
            }
        });
    }
    $('.btnHistoryFile').click(function(){
        var ref = $('.btnHistoryFile').data('ref');
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/historyFile'); ?>",
            data: {
                referencenumber: ref
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modalhistory_file').modal('show');
                }
            }
        });
    });
</script>


<script>
    function Rad(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/PelayananRadRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_pelayanan_rad_mobilisasi_dana').modal('show');
                }
            }
        });
    }
</script>


<script>
    function Lpk(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/PelayananLpkRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_pelayanan_lpk_mobilisasi_dana').modal('show');
                }
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnRBpoli').on('click', function() {
            let id = $('#referencenumber').val();
            let rincian = $('#rincian').val();
            window.open("<?php echo base_url('KasirRJ/printdetailkwitansiVerifikasi') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");

        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnLOGeneral').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printLaporanOperasiGeneralRajal') ?>?page=" + id, "_blank");
        })

        $('.btnLOKatarak').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printLaporanOperasiKatarakRajal') ?>?page=" + id, "_blank");
        })

        $('.downloadAll').click(function(){
            window.open("<?= base_url('PelayananRawatJalanRME/downloadAllArsipRajal'); ?>?page=" + $(this).data('id')+"&rincian="+$(this).data('rincian'), "_blank")
        });
    });
</script>