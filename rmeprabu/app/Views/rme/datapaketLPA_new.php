<div class="row">
    <?php foreach ($tampildata as $row) : ?>
        <div class="col">
            <div class="card mx-3">
                <div class="card-footer">
                    <div class="form-check px-0 filter">
                        <input type="checkbox" class="selectAll" id="selectAll-<?= str_replace([' ', '(', ')'], '_',$row['name']) ;?>" data-category_mark="<?= str_replace([' ', '(', ')'], '_',$row['name']) ;?>">
                        <label class="form-check-label" for="selectAll-<?= str_replace([' ', '(', ')'], '_',$row['name']) ;?>">
                            <?= $row['name'] ;?>
                        </label>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <?php if (get_data_penunjang($data_classroom, $row['name'], 'LPA')) : ?>
                        <?php foreach (get_data_penunjang($data_classroom, $row['name'], 'LPA') as $item) : ?>
                            <?php 
                                if ($classroom == 'IRJ') {
                                    $asal = $registernumber_rawatjalan;
                                    $jenisrawat = '1';
                                } else {
                                    if ($classroom == 'IGD') {
                                        $asal = $registernumber_rawatjalan;
                                        $jenisrawat = '6';
                                    } else {
                                        if (($classroom == 'KLS2') and ($room = 'NONE')) {
                                            $asal = $registernumber_rawatjalan;
                                            $jenisrawat = '1';
                                        } else {
                                            $asal = $registernumber_rawatinap;
                                            $jenisrawat = '2';
                                        }
                                    }
                                }
                            ?>
                            
                            <li class="list-group-item filter">
                            <div class="form-check px-0">
                                <input class="tandai-<?= str_replace([' ', '(', ')'], '_',$row['name']) ;?>" type="checkbox" id="defaultCheck<?= $item['id'] ;?>" name="tandai[]" value="<?= $groups; ?>|<?= $journalnumber; ?>|<?= $documentdate; ?>|<?= $pasienid; ?>|<?= $pasienname; ?>|<?= $paymentmethod; ?>|<?= $paymentmethod; ?>|<?= $classroom; ?>|<?= $classroomname; ?>|<?= $room; ?>|<?= $roomname; ?>|<?= $smf; ?>|<?= $smfname; ?>|<?= $dokter; ?>|<?= $doktername; ?>|<?= $employee; ?>|<?= $employeename; ?>|<?= $asal; ?>|<?= $referencenumber; ?>|<?= $referencenumberparent; ?>|<?= $locationcode; ?>|<?= $item['code']; ?>|<?= $item['name']; ?>|1|<?= $item['groups']; ?>|<?= $item['groupname']; ?>|<?= $item['category']; ?>|<?= $item['categoryname']; ?>|<?= $item['price']; ?>|0|<?= $item['price']; ?>|0|<?= $item['price']; ?>|<?= $item['share1']; ?>|<?= $item['share2']; ?>|PELAYANAN DAN TINDAKAN PENUNJANG MEDIS||<?= session()->get('email'); ?>|<?= date('Y-m-d h:m:s'); ?>|<?= $item['kelompokLab']; ?>|<?= $pasienaddress; ?>|<?= $asal_lab; ?>|<?= $jenkel; ?>|<?= $pasiendateofbirth; ?>|<?= $usia; ?>|<?= $icdxname; ?>|<?= $jenisrawat; ?>|<?= $koinsiden; ?>">
                                <label class="form-check-label" for="defaultCheck<?= $item['id'] ;?>">
                                    <?= $item['name'] ;?>
                                </label>
                            </div>
                            </li>         
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    <?php endforeach ?>
</div>

<script>
    $(".selectAll").click(function(){
        let name = 'tandai-' + $(this).attr('data-category_mark');
        $("input[class= " + name + "]").prop('checked', $(this).prop('checked'));
    });
    
    $("#filterItem").on("keyup", function() {
        const value = $(this).val().toLowerCase().trim();
        const v = value.split("%");
        $(".filter").each(function(j, k) {
            let s = true;
            $.each(v, function(i, x) {
                if (s) {
                    s = $(k).text().toLowerCase().indexOf(x) > -1;
                }
            });
            $(this).toggle(s);
        });
    });
</script>