<div id="modal_get_lo_general" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Templet Laporan Operasi General</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover w-100" id="dataTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Pembuat</td>
                                <td>Tanggal Buat</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_data as $no => $item) : ?>
                                <tr>
                                    <td><?= ++$no; ?></td>
                                    <td><?= $item['nama']; ?></td>
                                    <td><?= $item['created_by']; ?></td>
                                    <td><?= date('d-m-Y H:i:s', strtotime($item['created_at'])); ?></td>
                                    <td>
                                        <div class="btn btn-sm btn-success use-templet" data-id="<?= $item['id'] ;?>" data-name="<?= $item['nama'] ;?>">Gunakan Templet</div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $('#modal_get_lo_general').on('shown.bs.modal', function(event) {
        $('#dataTable').dataTable({
            scrollX: true
        })
    })

    $('#dataTable tbody').on('click', '.use-templet', function(e) {
        Swal.fire({
            title: "Perhatian !!",
            text: "Apakah anda yakin untuk menggunakan templet tindakan " + $(this).data('name')+", Harap cermati lagi data dengan seksama !",
            showCancelButton: true,
            confirmButtonText: "Gunakan",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: '<?= base_url('TempletLapOk/getDataLapGeneral'); ?>',
                    data: {
                        id: $(this).data("id"),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.data.cito == '1') {
                            $('#cito').prop('checked', true);
                        }else{
                            $('#cito').prop('checked', false);
                        }

                        if (response.data.elektif == '1') {
                            $('#elektif').prop('checked', true);
                        }else{
                            $('#elektif').prop('checked', false);
                        }
                        $('#smfName').val(response.data.smfName)
                        $('#dokterAnestesi').val(response.data.dokterAnestesi)
                        $('#perawatAnestesi').val(response.data.perawatAnestesi)
                        $('#scrubNurse').val(response.data.scrubNurse)
                        $('#asisten1').val(response.data.asisten1)
                        $('#asisten2').val(response.data.asisten2)
                        $('#circulationNurse').val(response.data.circulationNurse)
                        $('#posisiOperasi').val(response.data.posisiOperasi)
                        $('#jenisSayatan').val(response.data.jenisSayatan)
                        $('#skinPerparasi').val(response.data.skinPerparasi).change()
                        $('#jenisPembedahan').val(response.data.jenisPembedahan).change()
                        $('#diagnosaPraBedah').val(response.data.diagnosaPraBedah)
                        $('#indikasiOperasi').val(response.data.indikasiOperasi)
                        $('#jenisOperasi').val(response.data.jenisOperasi)
                        $('#diagnosaPascaBedah').val(response.data.diagnosaPascaBedah)
                        $('#prosedurOp').val(response.data.prosedurOp)
                        if (response.data.jaringanSpesimenOperasi == '1') {
                            $('#jaringanSpesimenOperasi').prop('checked', true);
                        }else{
                            $('#jaringanSpesimenOperasi').prop('checked', false);
                        }
                        if (response.data.jaringanSpesimenAspirasi == '1') {
                            $('#jaringanSpesimenAspirasi').prop('checked', true);
                        } else {
                            $('#jaringanSpesimenAspirasi').prop('checked', false);
                        }
                        
                        if (response.data.jaringanSpesimenkaterisasi == '1') {
                            $('#jaringanSpesimenkaterisasi').prop('checked', true);
                        } else {
                            $('#jaringanSpesimenkaterisasi').prop('checked', false);
                        }
                        
                        $('#lokalisasi').val(response.data.lokalisasi)
                        if (response.data.dikirimPA == '1') {
                            $('#dikirimPA').prop('checked', true);
                        } else {
                            $('#dikirimPA').prop('checked', false);
                        }

                        $('#profilaksisAntibiotik').val(response.data.profilaksisAntibiotik)
                        $('#jamPemberian').val(response.data.jamPemberian)
                        $('#laporanJalanOperasi').data("wysihtml5").editor.setValue(response.data.laporanJalanOperasi)
                        $('#komplikasiPascaBedah').data("wysihtml5").editor.setValue(response.data.komplikasiPascaBedah)
                        $('#jumlahPerdarahan').val(response.data.jumlahPerdarahan)
                        if (response.data.transfusiDarah == '1') {
                            $('#transfusiDarah').prop('checked', true)
                        } else {
                            $('#transfusiDarah').prop('checked', false)
                        }
                        
                        if (response.data.pcr == '1') {
                            $('#pcr').prop('checked', true)
                        } else {
                            $('#pcr').prop('checked', false)
                        }
                        
                        if (response.data.wb == '1') {
                            $('#wb').prop('checked', true)
                        } else {
                            $('#wb').prop('checked', false)
                        }
                        
                        $('#jumlahPcrWb').val(response.data.jumlahPcrWb)
                        $('#jenisInplan').val(response.data.jenisInplan)
                        $('#noRegInplan').val(response.data.noRegInplan)
                    }
                });
            }
        });
    })
</script>