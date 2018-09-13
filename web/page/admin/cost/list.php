<?php require $_SERVER['DOCUMENT_ROOT'] . "/static/header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/static/sidebar.php";?>

<div class="container card p-2 ">
    <div class="card-header">
        <h3>
            <span class="mif-list icon"></span> รายการค่าหอ
        </h3>
    </div>
    <div class="card-content p-2">
        <div class="grid bg-gray p-2">
            <div class="row">
                <div class="cell-2 pt-2 text-right">
                    เดือน :
                </div>
                <div class="cell-3">
                    <input type="text" data-day="false" data-role="datepicker" data-value="<?php echo date('Y-m'); ?>"
                    data-buttons="today,clear" data-locale="th-TH" readonly>
                </div>
                <div class="cell-2 pt-2 text-right">
                    ประเภทห้อง :
                </div>
                <div class="cell-3">
                    <select name="" id="" data-role="select">
                        <option value="ทั้งหมด" selected>ทั้งหมด</option>
                        <option value="รายวัน">รายวัน</option>
                        <option value="รายเดือน">รายเดือน</option>
                    </select>
                </div>
                <div class="cell-2">
                    <button class="button success">
                        <span class="mif-search icon"></span> ค้นหา
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <div class="grid bg-light p-2">
            <div class="row">
                <div class="cell-9"></div>
                <div class="cell-3 text-right">
                    <button class="button primary">
                        <span class="mif-print icon"></span>
                        print
                    </button>
                    <button class="button warning">
                        <span class="mif-barcode icon"></span>
                        สร้างบิล
                    </button>
                    <button class="button alert" onclick="return confirm('ต้องการลบ?')">
                        <span class="mif-bin icon"></span>
                        ลบ
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <table class="table striped cell-border">
            <thead>
                <tr class="bg-blue">
                    <th class="text-center">ชื่อ/เลขที่ห้อง</th>
                    <th class="text-center">ค่าเช่าห้อง</th>
                    <th class="text-center">ค่าเนต</th>
                    <th class="text-center">ค่าน้ำ</th>
                    <th class="text-center">ค่าไฟ</th>
                    <th class="text-center">จำนวนเงินรวม</th>
                    <th class="text-center" style="width:2%">บิล</th>
                    <th style="width:3%" id="select_all" class="text-center">
                        <input type="checkbox" data-role="checkbox" onclick="select_all(this)">
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 10; $i++) {?>
                <tr>
                    <td>
                        <span><?=$i;?></span>
                    </td>
                    <td class="text-right">
                        0.00
                    </td>
                    <td class="text-right">
                        0.00
                    </td>
                    <td class="text-right">
                        0.00
                    </td>
                    <td class="text-right">
                        0.00
                    </td>
                    <td class="text-right">
                        0.00
                    </td>
                    <td class="text-center">
                        <span class="<?=rand(0,1)==1?"fg-green mif-checkmark":"fg-red mif-cross"?> icon"></span>
                    </td>
                    <td class="text-center">
                        <input type="checkbox" data-role="checkbox">
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<script>
function select_all(e){
    let select = $(e).prop('checked')
    $('tbody tr td input[type="checkbox"]').map(function(){ return $(this).prop('checked',select) })
}
</script>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/static/footer.php";?>