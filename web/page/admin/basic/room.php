<?php require $_SERVER['DOCUMENT_ROOT'] . "/static/header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/static/sidebar.php";?>

<div class="container card p-2 ">
    <div class="card-header">
        <h1>
            <span class="mif-home icon"></span>จัดการห้อง
        </h1>
    </div>
    <div class="card-content p-1">
        <ul data-role="tabs" data-expand="sm">
            <li>
                <a href="#list">
                    <span class="mif-list icon"></span>รายการ
                </a>
            </li>
            <li>
                <a href="#add_room">
                    <span class="mif-plus icon"></span>
                    เพิ่มห้อง
                </a>
            </li>
        </ul>
        <div class="card bg-gray grid" id="add_room">
            <div class="row p-3 pl-5">
                <div class="cell-2"></div>
                <div class="cell">
                    <div class="row">
                        <div class="cell-2 text-right">
                            เลข/ชื่อห้อง
                        </div>
                        <div class="cell-4 mb-2">
                            <input type="text" placeholder="เพิ่มเลข/ชื่อห้อง" data-role="input">
                        </div>
                        <div class="cell-2 text-right">
                            ประเภทห้อง
                        </div>
                        <div class="cell-4 mb-2">
                            <select name="" data-role="select">
                                <option value="รายเดือน" selected>รายเดือน</option>
                                <option value="รายวัน">รายวัน</option>
                            </select>
                        </div>
                        <div class="cell-2 text-right">
                            ราคา/คืน
                        </div>
                        <div class="cell-4 mb-2">
                            <input type="text" value="0.00" dir="rtl">
                        </div>
                        <div class="cell-2 text-right">
                            ราคา/เดือน
                        </div>
                        <div class="cell-4 mb-2">
                            <input type="text" value="0.00" dir="rtl">
                        </div>
                        <div class="cell-2 text-right">
                            ค่าใช้จ่ายอื่นๆ
                        </div>
                        <div class="cell-10 mb-2">
                            <select data-role="select" title="" multiple>
                                <optgroup label="รายเดือน">
                                    <option value="tv" selected>ค่าทีวี</option>
                                    <option value="net" selected>ค่าเนต</option>
                                    <option value="center" selected>ค่าส่วนกลาง</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="cell-2 text-right">
                            สถานะ
                        </div>
                        <div class="cell-4 mb-2">
                            <select name="" data-role="select">
                                <option value="ว่าง" selected>ว่าง</option>
                                <option value="ไม่ว่าง">ไม่ว่าง</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="cell-2">
                    <button class="button success">
                        <span class="mif-plus"></span> เพิ่ม
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <div class="card p-2" id="list">
            <table class="table striped cell-border data_list">
                <thead>
                    <tr class="bg-blue">
                        <th class="text-center">เลข/ชื่อห้อง</th>
                        <th class="text-center">ประเภทห้อง</th>
                        <th class="text-center">ราคา/คืน</th>
                        <th class="text-center">ราคา/เดือน</th>
                        <th class="text-center" style="width:10%">สถานะ</th>
                        <th class="text-center" style="width:5%">.</th>
                        <th class="text-center" style="width:5%">.</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="d-flex flex-justify-center my-pagination-wrapper"></div>
        </div>
    </div>
</div>

<script>
    function change(e) {

        if ($(e).data('edit') == '1') {
            let parent = $(e).parentsUntil('tr').parent();
            parent.find('td .td-text').hide()
            parent.find('td .td-input').css({
                'visibility': 'visible',
                'height': 'auto'
            })
            $(e).removeClass('info').addClass('success').html('<span class="mif-checkmark"></span>')
            $(e).data('edit', '0')
        } else {
            let parent = $(e).parentsUntil('tr').parent();
            parent.find('td .td-text').show()
            parent.find('td .td-input').css({
                'visibility': 'hidden',
                'height': '0'
            })
            $(e).removeClass('success').addClass('info').html('<span class="mif-pencil"></span>')
            $(e).data('edit', '1')
        }

        $('td .td-input').change(function () {
            if ($(this).hasClass('room')) {
                let val = $(this).val()
                let check = $('input.td-input[value="' + val + '"]').not($(this))
                if (check.length == 0) {
                    if ($(this).val() != '') {
                        let parent = $(this).parents('td');
                        parent.children('div.td-text').text($(this).val())
                    }
                } else {
                    alert('มีเลขห้องซ้ำ')
                    $(this).focus()
                    $(this).val('')
                }
            } else {
                if ($(this).val() != '') {
                    let parent = $(this).parents('td');
                    parent.children('div.td-text').text($(this).val())
                    parent.find('input').val($(this).val())
                }
            }
        })

        $('.number')
            .keypress(function (e) {
                return /^[0-9]{1,10}$/.test(e.key)
            })
            .click(function () {
                if ($(this).val() != '')
                    $(this).attr('placeholder', $(this).val())
                $(this).val('')
            }).blur(function () {
                if ($(this).val() == '') {
                    $(this).val($(this).attr('placeholder'))
                }
            })
    }

    function get_data(page = 1) {
        $.getJSON('/api/test')
            .then((data) => {
                //console.log('data', data)
                let gen = data.map(x => `<tr>
                        <td>
                            <div class="td-text text-center">
                                ${x.room}
                            </div>
                            <input type="text" value="${x.room}" class="td-input room" style="visibility:hidden;height:0;">
                        </td>
                        <td>
                            <div class="td-text text-center">${x.type}</div>
                            <select name="" data-role="select" class="td-input" style="visibility:hidden;height: 0">
                                <option value="รายเดือน" ${x.type == 'รายเดือน' ? 'selected' : ''}>รายเดือน</option>
                                <option value="รายวัน" ${x.type == 'รายวัน' ? 'selected' : ''}>รายวัน</option>
                            </select>
                        </td>
                        <td>
                            <div dir="rtl" class="td-text">${x.day}</div>
                            <input type="text" value="${x.day}" dir="rtl" class="td-input number" style="visibility:hidden;height: 0">
                        </td>
                        <td>
                            <div dir="rtl" class="td-text">${x.month}</div>
                            <input type="text" value="${x.month}" dir="rtl" class="td-input number" style="visibility:hidden;height: 0">
                        </td>
                        <td style="width:10%">
                            <div class="td-text text-center">${x.status}</div>
                            <select name="" data-role="select" class="td-input" style="visibility:hidden;height: 0">
                                <option value="ว่าง" ${x.status == 'ว่าง' ? 'selected' : ''}>ว่าง</option>
                                <option value="ไม่ว่าง" ${x.status == 'ไม่ว่าง' ? 'selected' : ''}>ไม่ว่าง</option>
                            </select>
                        </td>
                        <td width="7%" class="text-center">
                            <button class="button info btn-block edit-line" data-edit="1" onclick="change(this)">
                                <span class="mif-pencil"></span>
                            </button>
                        </td>
                        <td width="7%" class="text-center">
                            <button class="button alert btn-block">
                                <span class="mif-cross"></span>
                            </button>
                        </td>
                    </tr>`
                ).join('')
                //console.log(gen)
                $('table.data_list tbody').html(gen)
            })
            .catch(e => console.log(e))
    }

    $(function () {
        get_data()
        setInterval(() => get_data(), 60 * 1000);
    })

</script>
<?php require $_SERVER['DOCUMENT_ROOT'] . "/static/footer.php";?>