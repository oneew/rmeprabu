<table class="table table-bordered table-striped w-100" id="datatable">
    <thead>
        <tr class="bg-primary text-white">
            <th>No</th>
            <th>Jenis</th>
            <th>Tanggal Upload</th>
            <th>Hapus File</th>
            <th>Dowload File</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataGambar as $key => $item) : ?>
            <tr>
                <th><?= ++$key ;?></th>
                <th><?= $item['type'] ;?></th>
                <th><?= date('d-m-Y H:i', strtotime($item['created_at'])) ;?></th>
                <th> <button type="button" class="btn btn-danger waves-light btn-rounded  btn-sm" onclick="hapusfile_rmeranap('<?= $item['id']; ?>')"> <i class="fa fa-trash"></i></button></th>
                <th>
                    <a href="<?= base_url('assets/data_file_rme/'. $item['nama_file']) ;?>" target="_blank" class="btn btn-success waves-light btn-rounded  btn-sm">
                        <i class="fas fa-download"></i>
                    </a>
                </th>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $('#datatable').dataTable();
</script>
