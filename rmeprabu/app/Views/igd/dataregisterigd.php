<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>TglPelayanan</th>
            <th>NomorRekamMedis</th>
            <th>MetodePembayaran</th>
            <th>Pelayanan</th>
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
                    <td>
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="ubahigd('<?= $row['id']; ?>')"> <i class="far fa-edit"></i></button>
                        <button type="button" id="btn-card" class="btn waves-effect waves-light btn-rounded  btn-outline-secondary btn-sm btn-card" data-pasiencard="<?= $row['paymentcardnumber']; ?>" data-registerdate="<?= $row['documentdate']; ?>"><span class="mr-1"><i class="fa fa-check"></i></span>Cek</button>
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnprintsep" onclick="Cetakigd('<?= $row['id']; ?>')"> <i class="ti-printer"></i></button>
                        <?php
                        if ($row['kelompok_triase'] == "KEBIDANAN DAN KANDUNGAN") {
                            $gambar = base_url() . '/assets/images/users/hamil.jpeg';
                        } else if ($row['kelompok_triase'] == "ANAK") {
                            $gambar = base_url() . '/assets/images/users/triase_anak.jpeg';
                        } else if ($row['kelompok_triase'] == "BEDAH") {
                            $gambar = base_url() . '/assets/images/users/surgery.jpeg';
                        } else {
                            $gambar = base_url() . '/assets/images/users/non_surgery.png';
                        }
                        echo "<img src='" . $gambar . "' class='rounded-circle' width='30'>";

                        ?>

                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['pasienid'] ?>
                        <br><b><?= $row['pasienname'] ?> [<?= $row['pasiengender'] ?>]</b>
                        <br><span class="<?php if ($row['rencanaOperasi'] == 1) {
                                                echo "badge badge-danger";
                                                $rencana = "Rencana Operasi";
                                            } else {
                                                echo "badge badge-info";
                                                $rencana = "Reguler";
                                            }  ?>"><?= $rencana; ?></span>
                    </td>
                    <td><?= $row['paymentmethodname'] ?>
                        <br><span class="badge badge-info"><?= $row['paymentcardnumber']; ?></span>
                        <br><span class="badge badge-success"><?= $row['bpjs_sep']; ?></span>
                    </td>
                    <td><?= $row['description'] ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?= $row['pasienaddress'] ?>
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
                                '<br>Hak Kelas: ' + parseResponse.response.peserta.hakKelas.kode + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
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


<script>
    function ubahigd(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/UbahIGD'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalubahigd').modal('show');

                }
            }

        });


    }
</script>

<script>
    function Cetakigd(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/Cetak'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalprintregisterigd').modal('show');

                }
            }

        });


    }
</script>