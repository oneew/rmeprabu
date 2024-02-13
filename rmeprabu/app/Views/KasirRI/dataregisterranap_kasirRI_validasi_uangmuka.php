<table id="datauangmukapasien" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>Keterangan</th>
            <th>Nominal Uang Muka</th>
            <th>NomorRekamMedis</th>
            <th>Ruangan</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td>
                    <button type="button" class="btn waves-effect waves-light btn-rounded  btn-outline-danger btn-sm" onclick="hapusUangMuka('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                    <button type="button" id="btn-card" class="btn waves-effect waves-light btn-rounded  btn-outline-secondary btn-sm btn-card" data-pasiencard="<?= $row['paymentcardnumber']; ?>" data-registerdate="<?= $row['documentdate']; ?>"><span class="mr-1"><i class="fa fa-check"></i></span>Cek</button>
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm suarakasir" data-nama="<?= $row['pasienname']; ?>" data-poli="<?= $row['roomname']; ?>" data-noantrian="<?= $row['noantrian']; ?>"> <i class="mdi mdi-volume-high"></i></button>
                    <button id="print" class="btn waves-effect waves-light btn-rounded  btn-outline-info btn-sm btnprintBPuangmuka" type="button" data-id="<?= $row['referencenumber']; ?>"> <span class="mr-1"><i class="fa fa-print"></i></span> Print BP</button>

                </td>
                <td><?= $no ?></td>
                <td><?= $row['paymentstatus'] ?>
                    <br><?= $row['documentdate']; ?>
                    <br><span class="badge badge-success"><?= $row['validationnumber']; ?></span>
                    <br><small class="form-text text-muted"><?= $row['createdby']; ?></small>
                </td>
                <td><b><?= number_format($row['paymentamount'], 2, ",", ".") ?></b>
                    <br><small class="form-text text-muted"><?= $row['payersname']; ?></small>
                    <b><small class="form-text text-muted"><?= $row['memo']; ?></small></b>
                </td>
                <td><b><span class="badge badge-info"><?= $row['pasienid'] ?></span></b>
                    <br><?= $row['pasienname'] ?>
                    <br><?= $row['paymentmethodname'] ?>
                </td>
                <td><?= $row['roomname'] ?>
                    <br><?= $row['doktername']; ?>
                </td>
                <td><?= $row['pasienaddress'] ?>
                    <input type="hidden" id="pengguna" name="pengguna" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $row['referencenumber']; ?>" readonly>
                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>
</table>




<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {

        if ('speechSynthesis' in window) {


            $('.suarakasir').click(function() {
                var text = $('#message').val();
                var msg = new SpeechSynthesisUtterance();
                var voices = window.speechSynthesis.getVoices();

                msg.voice = voices[6];

                msg.rate = 1;

                msg.pitch = 1;
                msg.text = "atas nama pasien atau keluarga pasien" + $(this).data('nama') + ", silahkan masuk ke bagian kasir rawat Inap ";

                speechSynthesis.speak(msg);
            })
        } else {
            alert('Browser yang digunakan tidak support speechSynthesis');
        }
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        //$('#datauangmukapasien').DataTable();
    });


    $('.btn-card').on('click', function() {

        if ($('#pasiencard').val() == '' || $('#registerdate').val == '') {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Tidak Boleh Kosong'

            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bpjs/check_card') ?>",
                data: {
                    card: $(this).data('pasiencard'),
                    date: $(this).data('registerdate')
                },
                success: function(response) {
                    let parseResponse = JSON.parse(response);
                    if (parseResponse.metaData.code == 200) {

                        Swal.fire({
                            html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                '<br>Hak Kelas: ' + parseResponse.response.peserta.pisa + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
                                '<br>Kode Faskes 1: ' + parseResponse.response.peserta.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.peserta.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.peserta.tglTMT,

                            icon: 'success',
                            text: parseResponse.metaData.message,
                        });
                        $('#faskesname').val(parseResponse.response.peserta.provUmum.nmProvider);
                        $('#faskes').val(parseResponse.response.peserta.provUmum.kdProvider);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            //title: 'Error',
                            text: parseResponse.metaData.message

                        });
                    }
                }
            })
        }

    })
</script>


<script>
    function hapusUangMuka(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data uang muka ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KasirRanap/BatalUangMuka'); ?>",
                    data: {
                        id: id,
                        deletedby: $('#pengguna').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            dataRegisteruangmuka();
                        }
                    }
                });
            }
        })
    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintBPuangmuka').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('KasirRanap/printbuktipembayaran_uangmuka') ?>?page=" + id, "_blank");
        })
    });
</script>