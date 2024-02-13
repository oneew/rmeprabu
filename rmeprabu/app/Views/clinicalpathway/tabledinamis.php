<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/bootstrap/css/bootstrap.css">
</head>

<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Data</th>
                            <th colspan="<?= $max_column; ?>" class="text-center">Data dinamis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) { ?>
                            <tr>
                                <td><b><i><?= $row['name']; ?></i></b></td>


                                <?php for ($x = 1; $x <= $row['jumlah']; $x++) { ?>
                                    <td>Kolom data ke <?= $x; ?></td>
                                <?php } ?>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</body>

</html>