<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>No</th>
            <th>TglPulang</th>
            <th>NomorRekamMedis</th>
            <th>MetodePembayaran</th>
            <th>Dokter</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>

                    <td class="text-center">
                        <?php
                        $encrypter = \Config\Services::encrypter();
                        $nama = $row['id'];
                        $idx = $encrypter->encrypt($nama);
                        ?>
                        <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                        <input type="hidden" name="pasiencard" id="pasiencard" value="<?= $row['pasienid']; ?>">
                        <input type="hidden" name="registerdate" id="registerdate" value="<?= $row['documentdate']; ?>">
                        <button type="button" id="btn-card" class="btn waves-effect waves-light btn-rounded  btn-outline-secondary btn-sm btn-card" data-pasiencard="<?= $row['paymentcardnumber']; ?>" data-registerdate="<?= $row['documentdate']; ?>"><span class="mr-1"><i class="fa fa-check"></i></span>Cek</button>
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnprintsep" onclick="Cetak('<?= $row['id']; ?>')"> <i class="fas fa-compress"></i></button>
                    </td>
                    <td><?= $no ?></td>
                    <?php
                    if (($row['pasienclassroom'] == 'KLS3') and ($row['classroom'] == 'KLS3')) {
                        $kesimpulankelas = 'Sesuai Hak kelas';
                        $naik = 0;
                    } else {
                        if (($row['pasienclassroom'] == 'KLS3') and ($row['classroom'] == 'KLS2')) {
                            $kesimpulankelas = 'Naik kelas';
                            $naik = 1;
                        } else {
                            if (($row['pasienclassroom'] == 'KLS3') and ($row['classroom'] == 'KLS1')) {
                                $kesimpulankelas = 'Naik kelas';
                                $naik = 1;
                            } else {
                                if (($row['pasienclassroom'] == 'KLS2') and ($row['classroom'] == 'KLS2')) {
                                    $kesimpulankelas = 'Sesuai Hak kelas';
                                    $naik = 0;
                                } else {
                                    if (($row['pasienclassroom'] == 'KLS2') and ($row['classroom'] == 'KLS1')) {
                                        $kesimpulankelas = 'Naik kelas';
                                        $naik = 1;
                                    } else {
                                        if (($row['pasienclassroom'] == 'KLS1') and ($row['classroom'] == 'VIP')) {
                                            $kesimpulankelas = 'Naik kelas';
                                            $naik = 1;
                                        } else {
                                            $kesimpulankelas = 'Sesuai Hak Kelas';
                                            $naik = 0;
                                        }
                                    }
                                }
                            }
                        }
                    } ?>
                    <td><?= $row['datein'] ?>
                        <br><?= $row['timein']; ?>
                        <br><?= $row['roomname']; ?>
                        <br> <b>KP:<?= $row['classroomname']; ?></b>
                        <br><b>Hak Kelas: <?= $row['pasienclassroom']; ?></b>
                        <br><b><span class="<?php if ($naik == 1) {
                                                echo "badge badge-danger";
                                            } else {
                                                echo "badge badge-success";
                                            }  ?>"><?= $kesimpulankelas ?></span></b>
                    </td>
                    <td><?= $row['pasienid'] ?>
                        <br>
                        <?= $row['pasienname'] ?>[<?= $row['pasiengender'] ?>]
                        <br>
                        <?= $row['journalnumber']; ?>
                    </td>
                    <td><?= $row['paymentmethodname'] ?></td>
                    <td>
                        <?= $row['doktername'] ?>
                    </td>
                    <td><?= $row['pasienaddress'] ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script type="text/javascript">
    $(document).ready(function() {
        $('#registerranap').DataTable();
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
    function Cetak(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRanap/lihatrincianranap_pindahkelas'); ?>",
            data: {
                id: id,
                pasiendid: $('#pasiencard').val()
            },
            dataType: "json",
            success: function(response) {
                if (response.suksespindahkelas) {
                    $('.viewmodal').html(response.suksespindahkelas).show();
                    $('#modalpembayaranranap_pindahkelas').modal('show');
                }
            }
        });
    }
</script>