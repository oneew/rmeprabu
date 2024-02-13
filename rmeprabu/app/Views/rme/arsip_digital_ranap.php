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
                                <h4 class="font-light text-white">RM RANAP</h4>
                                <h6 class="text-white">Resume Medis Rawat Inap</h6>
                                <div class="text-center mb-0">
                                    <button id="print" class="btn btn-primary btnprintResumeMedis" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                     <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-primary card-inverse">
                            <div class="p-2 rounded text-center">
                                <h4 class="font-light text-white">RM IGD </h4>
                                <h6 class="text-white">Resume Medis IGD</h6>
                                <div class="text-center mb-0">
                                    <button id="print" class="btn btn-primary btnprintResumeMedis1" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Column -->
                     <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-primary card-inverse">
                            <div class="p-2 rounded text-center">
                                <h4 class="font-light text-white">RM Rajal</h4>
                                <h6 class="text-white">Resume Medis Rawat Jalan</h6>
                                <div class="text-center mb-0">
                                    <button id="print" class="btn btn-primary btnprintResumeMedis2" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span></button>
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
                                    <button id="print" class="btn btn-primary btnprintdetailseluruh" type="button"> <span><i class="fa fa-download"></i></span></button>

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
                    <!-- Column -->
                    <div class="col-md-6 col-lg-3 col-xlg-3">
                        <div class="card card-inverse card-info">
                            <div class="p-2 rounded bg-info text-center">
                                <h4 class="font-light text-white">CPPT</h4>
                                <h6 class="text-white">Histori CPPT Pasien</h6>
                                <div class="text-center mb-0">
                                    <button id="print" class="btn btn-info btnprintfilecppt" type="button" data-id="<?= $referencenumber ?>"> <span><i class="fa fa-download"></i></span></button>
                                </div>
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
                <div class="row">
                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                    <input type="hidden" id="rincian" name="rincian" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                    <div class="col-md-12 col-lg-12 col-xlg-12">
                        <div class="viewdataresume"></div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function dataresume() {

        $.ajax({

            url: "<?php echo base_url('PelayananRawatJalanRME/resumeGabungRanap') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataresume').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresume();


    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintResumeMedis').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printResumeMedisRanap') ?>?page=" + id, "_blank");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintResumeMedis1').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printResumeMedisIGD') ?>?page=" + id, "_blank");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintResumeMedis2').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printResumeMedisRajal') ?>?page=" + id, "_blank");
        })
    });
</script>

<script>
    function Farmasi(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/PelayananResepRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_pelayanan_farmasi_mobilisasi_dana_ranap').modal('show');
                }
            }
        });
    }
</script>


<script>
    function Rad(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/PelayananRadRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_pelayanan_rad_mobilisasi_dana_ranap').modal('show');
                }
            }
        });
    }
</script>


<script>
    function Lpk(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/PelayananLpkRanap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalmedis').html(response.sukses).show();
                    $('#modal_pelayanan_lpk_mobilisasi_dana_ranap').modal('show');
                }
            }
        });
    }
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('.btnLOKatarak').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printLaporanOperasiKatarak') ?>?page=" + id, "_blank");
        })
        $('.btnRB').on('click', function() {
            let id = $('#referencenumber').val();
            let rincian = $('#rincian').val();
            window.open("<?php echo base_url('KlaimRanap/printdetailkwitansiKlaim') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");

        })
        $('.btnprintdetailseluruh').on('click', function() {
            let id = $('#referencenumber').val();
            let rincian = $('#rincian').val();
            window.open("<?php echo base_url('PelayananRawatJalanRME/printdetailkwitansiKlaim') ?>?page=" + id + "&" + "rincian=" + rincian, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");

        })

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnLOGeneral').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printLaporanOperasiGeneral') ?>?page=" + id, "_blank");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintfilecppt').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('PelayananRawatJalanRME/printfilecppt') ?>?page=" + id, "_blank");
        })

        $('.downloadAll').click(function(){
            window.open("<?= base_url('PelayananRawatJalanRME/downloadAllArsip'); ?>?page=" + $(this).data('id')+"&rincian="+$(this).data('rincian'), "_blank")
        });
    });
</script>