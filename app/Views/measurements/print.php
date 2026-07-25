<?php

$info = $rows[0];
$measurements = [];

foreach($rows as $row){

    if(!empty($row['urdu_name'])){

        $measurements[$row['urdu_name']] = $row['measurement_value'];

    }

}
?>
<!DOCTYPE html>

<html lang="ur" dir="rtl">

<head>

<meta charset="UTF-8">

<title>Measurement Slip</title>

<link rel="stylesheet" href="../../../public/assets/css/print.css">
<style>
    
*{

margin:0;
padding:0;
box-sizing:border-box;

}

body{

background:#eee;

font-family:'Noto Nastaliq Urdu','Jameel Noori Nastaleeq',serif;

padding:20px;

}

.slip{

width:820px;

margin:auto;

background:#fff;

border:2px solid #000;

padding:20px;

}

.title{

text-align:center;

font-size:34px;

font-weight:bold;

letter-spacing:2px;

}

.subtitle{

text-align:center;

font-size:18px;

margin-bottom:15px;

}

.info{

width:100%;

border-collapse:collapse;

margin-bottom:15px;

}

.info td{

padding:8px;

font-size:20px;

}

.measurements{

width:100%;

border-collapse:collapse;

}

.measurements td{

border:1px solid #000;

padding:8px;

font-size:20px;

height:40px;

}

.option-grid{

display:grid;

grid-template-columns:repeat(3,1fr);

gap:10px;

margin-top:25px;

font-size:20px;

}

.footer{

margin-top:25px;

text-align:center;

font-size:18px;

}

.print{

margin-top:20px;

text-align:center;

}

button{

padding:12px 40px;

font-size:18px;

cursor:pointer;

}

@media print{

button{

display:none;

}

body{

background:#fff;

padding:0;

}

.slip{

border:none;

width:100%;

}

}
</style>

</head>

<body>

        <div class="slip">

            <div class="title">

            <?= Config::get("shop_name") ?>
            </div>

            <div class="subtitle">

            پیمائش سلپ

            </div>

            <table class="info">

            <tr>

            <td><b>نام</b></td>

            <td><?= $info['full_name'] ?></td>

            <td><b>فون</b></td>

            <td><?= $info['phone'] ?></td>

            </tr>

            <tr>

            <td><b>گاؤں</b></td>

            <td><?= $info['village'] ?></td>

            <td><b>بکنگ</b></td>

            <td><?= $info['booking_no'] ?></td>

            </tr>

            <tr>

            <td><b>آرڈر</b></td>

            <td><?= $info['order_date'] ?></td>

            <td><b>ڈیلیوری</b></td>

            <td><?= $info['delivery_date'] ?></td>

            </tr>

            </table>

            <table class="measurements">





            <?php

            $labels=array_keys($measurements);

            $values=array_values($measurements);

            $count=max(count($labels),10);

            for($i=0;$i<$count;$i+=2){

            ?>

            <tr>

            <td><?= $labels[$i]??'' ?></td>

            <td><?= $values[$i]??'' ?></td>

            <td><?= $labels[$i+1]??'' ?></td>

            <td><?= $values[$i+1]??'' ?></td>

            </tr>

            <?php } ?>

            </table>


            <hr>

            <h3 style="text-align:center;margin:20px 0;">
            خصوصی ہدایات
            </h3>

            <?php foreach($allOptions as $category=>$items): ?>

            <div style="margin-bottom:18px;">

            <h4 style="border-bottom:1px solid #000;padding-bottom:5px;">

            <?= htmlspecialchars($category) ?>

            </h4>

            <div class="option-grid">

            <?php foreach($items as $item): ?>

            <div>

            <?= in_array($item['urdu_name'],$options) ? "☑" : "☐" ?>

            <?= htmlspecialchars($item['urdu_name']) ?>

            </div>

            <?php endforeach; ?>

            </div>

            </div>

            <?php endforeach; ?>

            </div>

            <hr>

            <table class="info">

            <tr>

            <td>کل رقم</td>
            
            <td>
            <?= Config::get("currency") ?>  
            <?= number_format($info['total_amount']) ?>
            </td>

            <td>ایڈوانس</td>

            <td>
                <?= Config::get("currency") ?>
                <?= number_format($info['advance']) ?></td>

            </tr>

            <tr>

            <td>رعایت</td>

            <td>
            <?= Config::get("currency") ?>
            <?= number_format($info['discount']) ?></td>

            <td>بقایا</td>

            <td>
            <?= Config::get("currency") ?>    
            <?= number_format($info['balance']) ?></td>

            </tr>

            </table>


            <div class="footer">

            <?= Config::get("shop_name") ?>

            <br>

            <?= Config::get("village") ?>

            <br>

            <?= Config::get("phone") ?>

            <br><br>

            ____________________

            <br>

            دستخط

            </div>

            <div class="print">

            <button onclick="window.print()">

            🖨 Print

            </button>

            </div>

            </div>




</body>

</html>