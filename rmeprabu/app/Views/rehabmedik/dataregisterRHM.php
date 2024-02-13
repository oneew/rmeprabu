<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>#</th>
            <th>#</th>
            <th>Status</th>
            <th>No</th>
            <th>TglPelayanan</th>
            <th>AsalDaftar</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>JenisKelamin</th>
            <th>MetodePembayaran</th>
            <th>DokterPengirim</th>
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

                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapusHeader('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>

                </td>
                <td>
                    <form method="post" action="PelayananRHM/inputdetailRHM2">
                        <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm"><i class="fa fa-plus"></i></button>
                    </form>
                </td>
                <td>

                    <button type="button" id="btn-card" class="btn waves-effect waves-light btn-rounded  btn-outline-secondary btn-sm btn-card" data-pasiencard="<?= $row['paymentcardnumber']; ?>" data-registerdate="<?= $row['documentdate']; ?>"><span class="mr-1"><i class="fa fa-check"></i></span>Cek</button>
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm suara" data-nama="<?= $row['pasienname']; ?>"> <i class="mdi mdi-volume-high"></i></button>
                </td>
                <td><span class="<?php if ($row['validation'] == "BELUM") {
                                        echo "badge badge-danger";
                                    } else {
                                        echo "badge badge-success";
                                    }  ?>"><?= $row['validation'] ?></span></td>

                <td><?= $no ?></td>
                <td><?= $row['documentdate'] ?>
                    <br><?= $row['journalnumber'] ?>
                    <br>Reborn : <?= $row['created_at'] ?>
                </td>
                <td></td>
                <td><?= $row['pasienid'] ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td class="center"> <?php
                                    if ($row['pasiengender'] == "L") {
                                        $gambar = base_url() . '/assets/images/users/avatarlaki.jpeg';
                                    } else {
                                        $gambar = base_url() . '/assets/images/users/avatarperempuan.jpeg';
                                    }
                                    echo "<img src='" . $gambar . "' class='rounded-circle' width='30'>";

                                    ?></td>
                <td><?= $row['paymentmethod'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['pasienaddress'] ?> <?php ?></td>

            </tr>

        <?php endforeach; ?>

    </tbody>
</table>


<script>
    function layani(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalan/rincianrajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('DRJ').html(response.data);
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
                msg.text = "atas nama pasien " + $(this).data('nama') + ", silahkan masuk ke ruang periksa ";

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
            myWindow = window.open("<?php echo base_url('RawatJalan/printkarcis') ?>?page=" + id, "myWindow", "width=200,height=100");

        })
    });
</script>
<script>
    function hapusHeader(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data ini ?",
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
                    url: "<?php echo base_url('PelayananRHM/hapusHeaderBD'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            dataRegisterPoli();

                        }
                    }

                });


            }
        })

    }
</script>