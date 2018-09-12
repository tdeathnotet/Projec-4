<?php require $_SERVER['DOCUMENT_ROOT'] . "/static/header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/static/sidebar.php";?>

<div class="container card p-2 ">
    <div class="card-header">
        <h3>
            <span class="mif-floppy-disk icon"></span>บันทึกค่าหอ
        </h3>
    </div>
    <div class="card-content p-2">
        <div class="grid bg-gray p-2">
            <div class="row">
                <div class="cell-3"></div>
                <div class="cell-2 pt-2 text-right">
                    เลือกเดือนที่จะบันทึก : 
                </div>
                <div class="cell-3">
                    <input type="text" data-day="false" data-role="datepicker" data-value="<?php echo date('Y-m');?>"
                    data-buttons="today,clear" data-locale="th-TH" readonly>
                </div>
            </div>
        </div>
        <hr>
        <table class="table striped cell-border">
            <thead>
                <tr class="bg-blue">
                    <th class="text-center">ชื่อ/เลขที่ห้อง</th>
                    <th class="text-center">ค่าเช่าห้อง</th>
                    <th class="text-center">เลขมิเตอร์น้ำ</th>
                    <th class="text-center">เลขมิเตอร์ไฟ</th>
                    <th class="text-center">จำนวนเงินรวม</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1;$i<=10;$i++){ ?>
                <tr>
                    <td>
                    <span><?=$i;?></span>
                    </td>
                    <td>
                        <input type="text" value="0.00" align="right" class="number" data-role="input" disabled>
                        <div class="bg-light fg-grayBlue" data-role="collapse" data-toggle-element="#collapse_toggle_<?=$i;?>" data-collapsed="true">
                            <div class="p-3">
                                <b>ห้อง : </b> MR101 <br>
                                <b>ค่าเช่า : </b> <?php echo number_format(1300,2,'.',',');?> <br>
                                <b>ค่าเช่า : </b> <br>
                                <b>ค่าเช่า : </b> <br>
                                <b>ค่าเช่า : </b> <br>
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="text" value="" data-role="input" class="small" data-clear-button="false">
                    </td>
                    <td>
                        <input type="text" value="" data-role="input" data-clear-button="false">
                    </td>
                    <td>
                        <input type="text" value="" data-role="input" data-clear-button="false" disabled>
                    </td>
                    <td>
                        <button class="button" id="collapse_toggle_<?=$i;?>" onclick="getdetail(this,<?=$i-1?>)" data-click="0">
                            ดู
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
getdetail = (e,index)=>{
    let toggle = $(e).data('click')
    let parent = $(e).parentsUntil('tr').parent()
    if(toggle==0){
        parent.children('td:eq(1)').attr('colspan',4).children('.input').hide()
        parent.children('td:not(:eq(0),:eq(1),:eq(5))').map(function(){ return $(this).hide() })
        $(e).data('click',1)
    }else{
        parent.children('td:not(:eq(0),:eq(1),:eq(5))').map(function(){ return $(this).show() })
        parent.children('td:eq(1)').prop('colspan',false).children('.input').show()
        $(e).data('click',0)
    }
}
</script>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/static/footer.php";?>