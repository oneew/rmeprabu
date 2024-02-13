<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>TglPelayanan</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>MetodePembayaran</th>
            <th>Poliklinik</th>
            <th>Dokter</th>
            <th>Upload</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td>
                        <?php
                        $encrypter = \Config\Services::encrypter();
                        $nama = $row['id'];
                        $idx = $encrypter->encrypt($nama);
                        ?>
                        <button type="button" class="btn btn-circle btn-danger btn-sm" onclick="hapusArsip('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                        <button type="button" class="btn btn-circle btn-info btn-sm" onclick="lihatdataarsipdigital('<?= $row['referencenumber'] ?>')"> <i class="mdi mdi-eye"></i></button>

                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?>
                    </td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['pasienname'] ?></td>
                    <td><?= $row['paymentmethodname'] ?></td>
                    <td><?= $row['poliklinikname'] ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?= $row['createdBy'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('RawatJalan/printkarcis') ?>?page=" + id, "_blank");

        })
    });
</script>

<script type="text/javascript">
    $('.btnprint2').on('click', function() {
        let id = $(this).data('id');
        $.ajax({
            type: 'post',
            url: "<?php echo base_url('RawatJalan/printkarcis'); ?>",
            data: {
                id: id
            },
        })
    })
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


<script>
    function Cetak(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DigitalisasiRawatJalan/Cetak'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalprintregisterrajal').modal('show');

                }
            }

        });


    }
</script>


<script>
    function ubahrajal(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DigitalisasiRawatJalan/UbahRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalubahrajal').modal('show');

                }
            }

        });


    }
</script>


<script>
    function lihatdataarsipdigital(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DigitalisasiRawatJalan/ViewDataArsipDetailRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalviewarsip_detail_rajal').modal('show');
                }
            }
        });
    }
</script>


<script>
    function hapusArsip(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus Arsip ini ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('DigitalisasiRawatJalan/hapusArsip'); ?>",
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