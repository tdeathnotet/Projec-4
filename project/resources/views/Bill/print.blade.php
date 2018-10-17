<?php 
function m2t($number){
    $number = number_format($number, 2, '.', '');
    $numberx = $number;
    $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
    $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
    $number = str_replace(",","",$number); 
    $number = str_replace(" ","",$number); 
    $number = str_replace("บาท","",$number); 
    $number = explode(".",$number); 
    if(sizeof($number)>2){ 
    return 'ทศนิยมหลายตัวนะจ๊ะ'; 
    exit; 
    } 
    $strlen = strlen($number[0]); 
    $convert = ''; 
    for($i=0;$i<$strlen;$i++){ 
        $n = substr($number[0], $i,1); 
        if($n!=0){ 
            if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
            elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
            elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
            else{ $convert .= $txtnum1[$n]; } 
            $convert .= $txtnum2[$strlen-$i-1]; 
        } 
    } 
    
    $convert .= 'บาท'; 
    if($number[1]=='0' OR $number[1]=='00' OR 
    $number[1]==''){ 
    $convert .= 'ถ้วน'; 
    }else{ 
    $strlen = strlen($number[1]); 
    for($i=0;$i<$strlen;$i++){ 
    $n = substr($number[1], $i,1); 
        if($n!=0){ 
        if($i==($strlen-1) AND $n==1){$convert 
        .= 'เอ็ด';} 
        elseif($i==($strlen-2) AND 
        $n==2){$convert .= 'ยี่';} 
        elseif($i==($strlen-2) AND 
        $n==1){$convert .= '';} 
        else{ $convert .= $txtnum1[$n];} 
        $convert .= $txtnum2[$strlen-$i-1]; 
        } 
    } 
    $convert .= 'สตางค์'; 
    }
    //แก้ต่ำกว่า 1 บาท ให้แสดงคำว่าศูนย์ แก้ ศูนย์บาท
    if($numberx < 1)
    {
        $convert = "ศูนย์" .  $convert;
    }
    
    //แก้เอ็ดสตางค์
    $len = strlen($numberx);
    $lendot1 = $len - 2;
    $lendot2 = $len - 1;
    if(($numberx[$lendot1] == 0) && ($numberx[$lendot2] == 1))
    {
        $convert = substr($convert,0,-10);
        $convert = $convert . "หนึ่งสตางค์";
    }
    
    //แก้เอ็ดบาท สำหรับค่า 1-1.99
    if($numberx >= 1)
    {
        if($numberx < 2)
        {
            $convert = substr($convert,4);
            $convert = "หนึ่ง" .  $convert;
        }
    }
    return $convert; 
    }
    $thaimonth=["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"]; 

?>
<!DOCTYPE html>
<html lang="en">
<?php $total = 0; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        #printBtn {
            width: 150px;
            height: 70px;
            background-color: aquamarine;
            border-radius: 5px;
            position: fixed;
            left: 85%;
            top: 15px;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            #printBtn {
                visibility: hidden;
            }

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        table {
            border-collapse: collapse;
            border-radius: 5px;
            width: 100%;
        }

        table td {
            padding: 5px;
            
        }
        td.c{
            text-align: center;
        }
        td.r{
            text-align: right;
        }
    </style>
</head>

<body>
    <button onclick="window.print()" id="printBtn">
        <img src="https://png.icons8.com/metro/1600/print.png" width="50px;" alt="" align="left">
        <b style="font-size:20px;padding-top:5px !important;">Print</b>
    </button>
    <div class="book">
        @foreach ($d as $i=>$r)
        <div class="page">
            <center>
                ใบเสร็จหอพัก <b> {{$ap_detail['name']}}</b> เดือน {{$thaimonth[$d[$i]['month']-1]}} {{$d[$i]['year']}} 
            </center>
            <hr>
            <table border="1">
                <tr>
                    <td colspan="5"  class="c">เลขห้อง <b> {{$d[$i]['room_id']}}</b></td>
                    <td  class="c">วันที่ {{date('d').'/'.date('m').'/'.(date('Y')+543)}}</td>
                </tr>
                <tr>
                    <td class="c">#</td>
                    <td class="c">เลขครั้งนี้</td>
                    <td class="c">เลขครั้งก่อน</td>
                    <td class="c">หน่วย</td>
                    <td class="c">หน่วยละ</td>
                    <td class="c">จำนวนเงิน(บาท)</td>
                </tr>
                <tr>
                    <td class="c">น้ำ</td>
                    <td class="c">{{$d[$i]['water_number']}}</td>
                    <td  class="c">{{$d[$i]['bwater_number']}}</td>
                    <td  class="c">{{$d[$i]['water_number']-$d[$i]['bwater_number']}}</td>
                    <td  class="c">{{$ap_detail['water']}}</td>    
                    <td  class="r">{{number_format( ($d[$i]['water_number']-$d[$i]['bwater_number'])*$ap_detail['water'],2,".",",")}}</td>
                    <?php $total+=($d[$i]['water_number']-$d[$i]['bwater_number'])*$ap_detail['water']; ?>
                </tr>
                <tr>
                    <td  class="c">ไฟฟ้า</td>
                    <td  class="c">{{$d[$i]['elect_number']}}</td>
                    <td  class="c">{{$d[$i]['belect_number']}}</td>
                    <td  class="c">{{$d[$i]['elect_number']-$d[$i]['belect_number']}}</td>
                    <td class="c">{{$ap_detail['elect']}}</td>    
                    <td class="r">{{number_format( ($d[$i]['elect_number']-$d[$i]['belect_number'])*$ap_detail['elect'],2,".",",")}}</td>
                    <?php $total+=($d[$i]['elect_number']-$d[$i]['belect_number'])*$ap_detail['elect']; ?>
                </tr>
                <tr>
                    <td  class="c">ค่าเช่า</td>
                    <td colspan="4"></td>
                    <td  class="r">{{number_format( $d[$i]['room_detail']['rent'],2,".",",")}}</td>
                    <?php $total+=$d[$i]['room_detail']['rent'];?>
                </tr>
                @foreach ($d[$i]['cost'] as $c)
                <tr>
                    <td  class="c">{{$c['name']}}</td>
                    <td colspan="4"></td>
                    <td  class="r">{{number_format( $c['price'],2,".",",")}}</td>
                    <?php $total+=$c['price'];?>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6"></td>
                </tr>
                <tr>
                    <td  class="c">รวมทั้งสิ้น</td>
                <td colspan="4" class="c"><b> {{m2t($total)}}</b></td>
                    <td  class="r">{{number_format( $total,2,".",",")}}</td>
                </tr>
            </table>
            <hr>
            <div>
                {{$ap_detail['detail']}}
            </div>
        </div>
        @endforeach
    </div>
</body>

</html>