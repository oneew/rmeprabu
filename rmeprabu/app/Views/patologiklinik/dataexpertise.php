<table id="dataexpertise" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>MetodePembayaran</th>
            <th>RuanganAsal</th>
            <th>DokterPengirim</th>
            <th>TanggalPemeriksaan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td>
                    <button type="button" class="btn-rounded btn-outline-success btnprintsep" onclick="Cetak('<?= $row['journalnumber']; ?>')"> <i class="fas fa-eye"></i></button>
                    <button id="printX" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnprint" type="button" data-id="<?= $row['id']; ?>"> <span><i class="fa fa-print"></i></span> </button>
                    <button id="printY" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnprinteticket" type="button" data-id="<?= $row['id']; ?>"> <span><i class="fa fa-print"></i></span> </button>
                    <button id="printZ" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm btnprinteticketdetail" type="button" data-id="<?= $row['journalnumber']; ?>"> <span><i class="fa fa-print"></i></span> </button>
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm suara" data-nama="<?= $row['pasienname']; ?>"> <i class="mdi mdi-volume-high"></i></button>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['pasienid'] ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['paymentmethod'] ?></td>
                <td><?= $row['roomname'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['documentdate'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script>
    function Cetak(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananLPK/ViewExpertise'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.suksescari) {
                    $('.viewmodal').html(response.suksescari).show();
                    $('#modalviewexpertiseLPK').modal('show');
                }
            }
        });
    }
</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {

        if ('speechSynthesis' in window) {


            $('.suara').click(function() {
                var text = $('#message').val();
                var msg = new SpeechSynthesisUtterance();
                var voices = window.speechSynthesis.getVoices();

                msg.voice = voices[6];

                msg.rate = 1;

                msg.pitch = 1;
                msg.text = "atas nama pasien " + $(this).data('nama') + ", Silahkan Masuk Untuk Mengambil Hasil Pemeriksaan Lab ";

                speechSynthesis.speak(msg);
            })
        } else {
            alert('Browser yang digunakan tidak support speechSynthesis');
        }
    });
</script>



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {

        if ('speechSynthesis' in window) {


            $('.suara').click(function() {
                var text = $('#message').val();
                var msg = new SpeechSynthesisUtterance();
                var voices = window.speechSynthesis.getVoices();

                msg.voice = voices[6];

                msg.rate = 1;

                msg.pitch = 1;
                msg.text = "atas nama pasien " + $(this).data('nama') + ", Silahkan Masuk Untuk Mengambil Hasil Pemeriksaan Lab ";

                speechSynthesis.speak(msg);
            })
        } else {
            alert('Browser yang digunakan tidak support speechSynthesis');
        }
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

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

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {
            let id = $(this).data('id');
            myWindow = window.open("<?php echo base_url('PelayananRegisterLPK/printexpertise') ?>?page=" + id, "myWindow", "width=200,height=100");

        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprinteticket').on('click', function() {
            let id = $(this).data('id');
            myWindow = window.open("<?php echo base_url('PelayananRegisterLPK/printsticker') ?>?page=" + id, "myWindow", "width=200,height=100");

        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprinteticketdetail').on('click', function() {
            let id = $(this).data('id');
            myWindow = window.open("<?php echo base_url('PelayananRegisterLPK/printstickerDetail') ?>?page=" + id, "myWindow", "width=200,height=100");

        })
    });
</script>