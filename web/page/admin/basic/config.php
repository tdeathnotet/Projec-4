<?php   require $_SERVER['DOCUMENT_ROOT']."/static/header.php";
        require $_SERVER['DOCUMENT_ROOT']."/static/sidebar.php"; ?>

<div class="container card p-2 ">
    <div class="card-header">
        <h1>
            <span class="mif-cog icon"></span>ค่าใช้จ่ายพื้นฐาน</h1>
    </div>
    <div class="card-content p-2">
        <table class="table  cell-border">
            <thead >
                <tr class="bg-blue">
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">ชื่อค่าใช้จ่าย</th>
                    <th class="text-center">ประเภทห้อง</th>
                    <th class="text-center">จำนวนเงิน</th>
                    <th class="text-center">.</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-gray">
                    <td>เพิ่ม</td>
                    <td>
                        <input type="text" placeholder="ชื่อค่าใช้จ่าย" data-role="input">
                    </td>
                    <td>
                        <select name="" id="" data-role="select">
                            <option value="ทั้งหมด" selected>ทั้งหมด</option>
                            <option value="รายวัน">รายวัน</option>
                            <option value="รายเดือน">รายเดือน</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" value="0.00" style="text-indent: 20px;text-align:right;">
                    </td>
                    <td class="text-center"  style="width:5% !important">
                        <button class="button success drop-shadow">
                            <span class="mif-plus"></span> เพิ่ม
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>
                        <input type="text" value="ค่าไฟฟ้า" data-role="input text">
                    </td>
                    <td>
                        <select name="" id="" data-role="select">
                            <option value="ทั้งหมด">ทั้งหมด</option>
                            <option value="รายวัน">รายวัน</option>
                            <option value="รายเดือน" selected>รายเดือน</option>
                        </select>
                    </td>
                    <td>
                        <input type="text" value="0.00" style="text-indent: 20px;text-align:right;" dir="rtl" class="number">
                    </td>
                    <td class="text-center">
                        <button class="button alert">
                            <span class="mif-cross"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php require $_SERVER['DOCUMENT_ROOT']."/static/footer.php"; ?>