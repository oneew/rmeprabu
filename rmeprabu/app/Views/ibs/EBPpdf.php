<!DOCTYPE html>
<html>

<head>

    <style>
        div {
            border: 1px solid gray;
            padding: 1px;
        }

        h4 {
            text-align: center;
            text-transform: uppercase;
            color: #4CAF50;
        }

        p {
            text-indent: 2px;
            text-align: justify;
            letter-spacing: 0px;
        }

        p.small {
            line-height: 0.7;
        }

        .divisi {
            padding: 70px;
            border: 1px solid #4CAF50;
            text-align: left;
        }

        div.gallery {
            margin: 5px;
            border: 1px solid #ccc;
            float: left;
            width: 180px;
        }

        div.gallery:hover {
            border: 1px solid #777;
        }

        div.gallery img {
            width: 100%;
            height: auto;
        }

        div.desc {
            padding: 15px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div>
        <h4>Dokumen Edukasi Pra Bedah</h4>
        <h4>Bedah Sentral RSUD R SYAMSUDIN, SH</h4>

    </div>
    <br>

    <p>No Dokumen : <?= $journalnumber; ?></p>
    <p>Tanggal : <?= $created_at; ?></p>
    <p>No Rekam Medis : <?= $pasienid; ?></p>
    <p>Nama Pasien : <?= $pasienname; ?></p>
    <p>Tanggal Lahir : <?= $pasiendateofbirth; ?></p>
    <p>Ruang rawat : <?= $roomname; ?></p>
    <p>Pemberi Informasi : <?= $pemberiinformasi; ?></p>
    <p>Penerima Informasi : <?= $penerimainformasi; ?></p>
    <p>Diagnosis : <?= $diagnosis; ?></p>
    <p>Kondisi Pasien : <?= $kondisipasien; ?></p>
    <p>Manfaat Tindakan : <?= $manfaattindakan; ?></p>
    <p>Tatacara Uraian Singkat Prosedur : <?= $tatacara; ?></p>
    <p>Resiko tindakan : <?= $risikotindakan; ?></p>
    <p>Komplikasi tindakan : <?= $komplikasitindakan; ?></p>
    <p>Dampak Tindakan : <?= $dampaktindakan; ?></p>
    <p>Manfaat Tindakan : <?= $manfaattindakan; ?></p>
    <p>Prognosis Tindakan : <?= $prognosistindakan; ?></p>
    <p>Alternatif Tindakan : <?= $alternatif; ?></p>
    <p>Bila Tidak Dilakukan Tindakan : <?= $bilatidakditindak; ?></p>

    <div class="gallery">
        <a target="_blank">
            <img src="<?= $signature ?>" alt="Cinque Terre" width="600" height="600">
        </a>
        <div class="desc"><?= $doktername; ?></div>
    </div>


</body>

</html>