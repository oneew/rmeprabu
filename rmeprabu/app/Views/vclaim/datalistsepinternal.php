<table id="datarujukan" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>TujuanRujukan</th>
            <th>PoliAsal</th>
            <th>TglRujukanInternal</th>
            <th>No Sep</th>
            <th>No Sep Referensi</th>
            <th>PPK Pelayanan</th>
            <th>NoKapst</th>
            <th>TglSep</th>
            <th>NoSurat</th>
            <th>Flag Internal</th>
            <th>KodePoliAsal</th>
            <th>KodePoliTujuan</th>
            <th>NamaPenunjang</th>
            <th>Diagnosa</th>
            <th>NamaDokter</th>
            <th>Diagnosa</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        $response = $list;
        foreach ($response as $row) :
            $no++; ?>
            <tr>
                <td><button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="hapusSepInternal('<?= $row['nosep']; ?>','<?= $row['nosurat']; ?>','<?= $row['tglrujukinternal']; ?>','<?= $row['kdpolituj']; ?>')"> <i class="fa fa-trash"></i></button></td>
                <td><?= $no ?></td>
                <td><?= $row['nmtujuanrujuk']; ?></td>
                <td><?= $row['nmpoliasal']; ?></td>
                <td><?= $row['tglrujukinternal']; ?></td>
                <td><?= $row['nosep']; ?></td>
                <td><?= $row['nosepref']; ?></td>
                <td><?= $row['ppkpelsep']; ?></td>
                <td><?= $row['nokapst']; ?></td>
                <td><?= $row['tglsep']; ?></td>
                <td><?= $row['nosurat']; ?></td>
                <td><?= $row['flaginternal']; ?></td>
                <td><?= $row['kdpoliasal']; ?></td>
                <td><?= $row['kdpolituj']; ?></td>
                <td><?= $row['nmpenunjang']; ?></td>
                <td><?= $row['diagppk']; ?></td>
                <td><?= $row['nmdokter']; ?></td>
                <td><?= $row['nmdiag']; ?></td>
            </tr>
        <?php endforeach;


        ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datarujukan1').DataTable({
            responsive: true
        });
    });
</script>



<script>
    function hapusSepInternal(noSep, nosurat, tglRujukanInternal, kdPoliTuj) {
        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus SEP Internal ini ?",
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
                    url: "<?php echo base_url('VclaimAntrean/HapusSepInternal'); ?>",
                    data: {
                        noSep: noSep,
                        nosurat: nosurat,
                        tglRujukanInternal: tglRujukanInternal,
                        kdPoliTuj: kdPoliTuj

                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                text: response.pesan,
                            });
                            datakunjungan();

                        }
                    }

                });


            }
        })

    }
</script>