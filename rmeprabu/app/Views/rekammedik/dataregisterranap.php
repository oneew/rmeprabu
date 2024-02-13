<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>Metodepembayaran</th>
            <th>TanggalMasuk</th>
            <th>TanggalKeluar</th>
            <th>Dokter</th>
            <th>SMF</th>
            <th>Resume Medis</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['pasienid'] ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['paymentmethodname'] ?></td>
                <td><?= $row['datein'] ?></td>
                <td><?= $row['dateout'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['smfname'] ?></td>
                <td class="badge badge-<?= check_resume_ranap($row['referencenumber']) == 'ADA' ? 'success' : 'danger' ;?>">
                            <?= check_resume_ranap($row['referencenumber']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="pull-right mt-1 text-left">
            <button id="btnPrint" type="button" class="btn btn-info btn-outline"><span><i class="fa fa-print"></i> Print</span></button>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("btnPrint").onclick = function() {
        printElement(document.getElementById("printThis"));

    };

    function printElement(elem) {

        var domClone = elem.cloneNode(true);
        var $printSection = document.getElementById("printSection");
        if (!$printSection) {

            var $printSection = document.createElement("div");

            $printSection.id = "printSection";

            document.body.appendChild($printSection);

        }
        $printSection.innerHTML = "";

        $printSection.appendChild(domClone);

        window.print();

    }
</script>

<script>
    $('#registerranap').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        columnDefs: [{
                responsivePriority: 3,
                targets: 0
            },
            {
                responsivePriority: 2,
                targets: -1
            }
        ],
        "displayLength": 50,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    })
</script>