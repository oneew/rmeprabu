<div id="modalcaripasiennonrm" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Pencarian data pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <form action="#">
                            <div class="form-body">

                                <div class="row pt-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="code" id="code" class="form-control filter-input" placeholder="Nomor Rekam Medis" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="namapasien" id="namapasien" class="form-control filter-input" placeholder="Nama Pasien" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="nomorasuransi" id="nomorasuransi" class="form-control filter-input" placeholder="Nomor JKN" autocomplete="off">
                                            <input type="hidden" name="nik" id="nik" class="form-control filter-input" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="alamat" id="alamat" class="form-control filter-input" placeholder="Alamat Pasien" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdatapasien">


                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Column -->
                    <!-- Column -->

                    <!-- Column -->
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="viewmodalbaru" style="display:none;"></div>

<script>
    function datapasienlama() {
        $.ajax({

            url: "<?php echo base_url('RegisterRAD/ambildatapasienlama') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdatapasien').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datapasienlama();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let namapasien = $('#namapasien').val();
        let code = $('#code').val();
        let alamat = $('#alamat').val();
        let nomorasuransi = $('#nomorasuransi').val();
        let nik = $('#nik').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('RegisterRAD/caridatapasienlama') ?>",
            dataType: "json",
            data: {
                namapasien: namapasien,
                code: code,
                alamat: alamat,
                nomorasuransi: nomorasuransi,
                nik: nik
            },
            success: function(response) {
                $('.viewdatapasien').html(response.data);
            }
        });
    });
</script>