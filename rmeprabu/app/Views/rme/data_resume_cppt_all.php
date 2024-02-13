<table id="datariwayatCPPT" class="table display <?= (count($tampildata) > 1) ? "table-striped" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black; width:100%">

    <thead class="bg-primary text-white">
        <tr>
            <th>No</th>
            <th>#</th>
            <th class="text-center">Tanggal
                </br>& Jam</th>
            <th class="text-center">Profesional
                </br>Pemberi
                </br>Asuhan
                </br>(PPA)
            </th>
            <th class="text-center">Hasil Asesmen Pasien
                </br>dan Tatalaksana</th>
            <th class="text-center">Intruksi PPA
                </br> Termasuk Pasca Bedah
            </th>
            <th class="text-center">Verifikasi
                </br>DPJP
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tampildata as $no => $row) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" onclick="editCppt('<?= $row['id']; ?>')"><i class="fas fa-edit"></i></button>
                </td>
                <td class="text-center">
                    <?= date('d F Y', strtotime($row['createddate'])) ;?>
                    <br>
                    <?= date('H:i:s', strtotime($row['createddate'])) ;?>
                    <br>dibuat Oleh: <?= $row['createdBy'] ;?>
                </td>
                <td class="text-center">
                    <?= $row['createdBy']  ?>
                    </br>
                    [<?= $row['kelompokCppt']; ?>]
                </td>
                <td class="align-top" style="white-space: normal;">
                    <h6 class="font-weight-bold">Subyektif</h6>
                    <?= $row['s']; ?>
                    <br><br>
                    <h6 class="font-weight-bold">Obyektif</h6>
                    <?= $row['o']; ?>
                    <br><br>
                    <h6 class="font-weight-bold">Asesmen</h6>
                    <?= $row['a']; ?>
                    <br><br>
                    <h6 class="font-weight-bold">Planning</h6>
                    <?= $row['p']; ?>
                </td>
                <td class="bisa-diedit" data-id="<?= $row['id']; ?>"><?= $row['instruksiPPA'] ?></td>
                <td class="text-center">
                    <?php if ($row['verifikasiDPJP'] == 0) { ?>
                        <button id="print" class="btn btn-info btn-outline btn btnbatalperiksa" type="button" onclick="Verifikasi('<?= $row['id'] ?>')"> Selesai Verifikasi <span><i class="fas fa-question"></i></span> </button>
                    <?php } ?>
                    <?php if ($row['verifikasiDPJP'] == 1) { ?>
                        Diverifikasi Oleh : <?= $row['verifikator']; ?>
                        </br>Pada Tanggal : <?= $row['tanggalJamVerifikasi']; ?>
                        </br>
                        <button id="print" class="btn btn-danger btn-outline btn btnupdatesep" type="button" onclick="batalVerifikasi('<?= $row['id'] ?>')"> Batal Verifikasi<span><i class="fas fa-question"></i></span> </button>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<div class="edit_cppt"></div>


<script>
    $(document).ready(function() {
        $('#dataresumepenunjang').DataTable({
            responsive: true,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>



<script>
    function Verifikasi(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan Verifikasi CPPT ini Selesai ?",
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
                    url: "<?php echo base_url('PelayananRawatJalanRME/VerifikasiCPPTAll'); ?>",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                            dataresumeCPPTAll();
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oopss !',
                                text: response.error,
                            });
                            dataresumeCPPTAll();
                        }
                    }

                });


            }
        })

    }
</script>


<script>
    function batalVerifikasi(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan Membatalkan Verifikasi CPPT ini ?",
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
                    url: "<?php echo base_url('PelayananRawatJalanRME/BatalkanVerifikasiCPPTAll'); ?>",
                    data: {
                        id: id,
                        modifiedby: $('#createdby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    dataresumeCPPTAll();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>

<script>
    function editCppt(id){
        $.ajax({
            url: "<?= base_url('PelayananRawatJalanRME/editCppt'); ?>",
            data: {
                id: id,
            },
            dataType: "json",
            success: function(response) {
                $('.edit_cppt').html(response.data).show();
                $('#modal_edit_cppt').modal({
                    show: true,
                    backdrop: false
                });
            }
        });
    }
</script>