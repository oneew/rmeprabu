<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>Nomor Rekam Medis</th>
            <th>Nama Pasien</th>
            <th>Tanggal Lahir</th>
            <th>Metode Pembayaran</th>
            <th>Tindakan Operasi</th>
            <th>Dokter Operator</th>
            <th>Dokter Anestesi</th>
            <th>Ruangan OK</th>
            <th>Jadwal</th>
            <th>Asal Pasien</th>
            <th>Diagnosa</th>
            <th>Tim Bedah</th>
            <th>Tim Anestesi</th>
            <th>Tanggal Keputusan</th>
            <th>Tanggal Input</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td>


                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['pasienname'] ?></td>
                    <td><?= $row['pasiendateofbirth'] ?></td>
                    <td><?= $row['paymentmethodname'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['ibsdoktername'] ?></td>
                    <td><?= $row['ibsanestesiname'] ?></td>
                    <td><?= $row['room'] ?></td>
                    <td>
                        <?= $row['dateOp'] ?>
                        <br><?= $row['datetimeOp'] ?>
                    </td>
                    <td><?= $row['asalRuangan'] ?></td>
                    <td><?= $row['diagnosa'] ?></td>
                    <td><?= $row['timpelaksana'] ?></td>
                    <td><?= $row['timanestesi'] ?></td>
                    <td><?= $row['tgl_keputusan'] ?></td>
                    <td><?= $row['tanggaljaminput'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


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
            window.open("<?php echo base_url('IGD/printkarcis') ?>?page=" + id, "_blank");

        })
    });
</script>