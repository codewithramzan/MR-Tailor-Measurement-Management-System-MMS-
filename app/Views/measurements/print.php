<?php
$info = $rows[0];
$measurements = [];

foreach ($rows as $row) {

    // Section Name (Urdu first)
    $section = trim($row['section_urdu'] ?? '');

    if ($section === '') {
        $section = trim($row['section'] ?? '');

        if ($section === '') {
            $section = 'General';
        }
    }

    // Measurement Name (Urdu first)
    $label = trim($row['measurement_urdu_name'] ?? '');

    if ($label === '') {
        $label = trim($row['option_name'] ?? '');
    }

    $measurements[$section][] = [
        'label' => $label,
        'value' => $row['measurement_value']
    ];
}

?>
<!DOCTYPE html>
<html lang="ur" dir="rtl">

<head>

<meta charset="UTF-8">

<title>
<?= htmlspecialchars(Config::get("shop_name")) ?>
</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/print.css">

</head>

<body>

<div class="print-wrapper">

<div class="slip">

<!-- ===========================
HEADER
=========================== -->

<div class="header">

<div class="logo">

✂

</div>

<div class="shop">

<h1>

<?= htmlspecialchars(Config::get("shop_name")) ?>

</h1>

<p>

پیمائش سلپ

</p>

<small>

Professional Tailoring Management System

</small>

</div>

</div>

<!-- ===========================
CUSTOMER + ORDER INFO
=========================== -->

<div class="info-grid">

<!-- Customer -->

<div class="card">

<div class="card-header">

کسٹمر کی معلومات

</div>

<div class="card-body">

<table class="info-table">

<tr>

<td>نام</td>

<td><?= htmlspecialchars($info['full_name'] ?? 'Undefined') ?></td>

</tr>

<tr>

<td>فون</td>

<td><?= htmlspecialchars($info['phone'] ?? 'Undefined') ?></td>

</tr>

<tr>

<td>گاؤں</td>

<td><?= htmlspecialchars($info['village'] ?? 'Village') ?? 'Undefined' ?></td>

</tr>

<tr>

<td>لباس</td>

<td><?= htmlspecialchars($info['garment_name'] ?? 'Undefined') ?></td>

</tr>

</table>

</div>

</div>

<!-- Order -->

<div class="card">

<div class="card-header">

آرڈر کی معلومات

</div>

<div class="card-body">

<table class="info-table">

<tr>

<td>بکنگ</td>

<td><?= htmlspecialchars($info['booking_no'] ?? 'Undefined') ?></td>

</tr>

<tr>

<td>آرڈر</td>

<td><?= htmlspecialchars($info['order_date'] ?? 'Undefined') ?></td>

</tr>

<tr>

<td>ڈیلیوری</td>

<td><?= htmlspecialchars($info['delivery_date']?? 'not yet' ) ?></td>

</tr>

<tr>

<td>حالت</td>

<td><?= htmlspecialchars($info['status'] ?? 'Undefined') ?></td>

</tr>

</table>

</div>

</div>

</div>

<!-- ===========================
MEASUREMENTS
=========================== -->

<div class="section-title">

	<h2>

		پیمائش

	</h2>

</div>

<div class="measurement-wrapper">

<?php

/*
|--------------------------------------------------------------------------
| Split Sections into Two Columns
|--------------------------------------------------------------------------
*/

$sectionNames = array_keys($measurements);

$totalSections = count($sectionNames);

$leftCount = ceil($totalSections / 2);

$leftSections = array_slice($sectionNames, 0, $leftCount);

$rightSections = array_slice($sectionNames, $leftCount);

?>

<div class="measurement-column">

<?php foreach($leftSections as $section): ?>

<div class="measurement-card">

<div class="measurement-header">

<?= htmlspecialchars($section) ?>

</div>

<table class="measurement-table">

<tbody>

<?php foreach($measurements[$section] as $item): ?>

<tr>

<td class="label">

<?= htmlspecialchars($item['label']) ?>

</td>

<td class="value">

<?= htmlspecialchars($item['value']) ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

<?php endforeach; ?>

</div>

<div class="measurement-column">

<?php foreach($rightSections as $section): ?>

<div class="measurement-card">

<div class="measurement-header">

<?= htmlspecialchars($section) ?>

</div>

<table class="measurement-table">

<tbody>

<?php foreach($measurements[$section] as $item): ?>

<tr>

<td class="label">

<?= htmlspecialchars($item['label']) ?>

</td>

<td class="value">

<?= htmlspecialchars($item['value']) ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

<?php endforeach; ?>

</div>

</div>
<!-- ===========================
STITCHING + PAYMENT SUMMARY
=========================== -->

<div class="bottom-wrapper">

    <!-- Left Side -->
    <div class="stitching-card">

        <div class="section-title">
            <h2>خصوصی سلائی ہدایات</h2>
        </div>

        <?php if(!empty($options)): ?>

            <div class="stitching-list">

                <?php foreach($options as $item): ?>

                    <div class="stitch-item">

                        ✓
                        <?= htmlspecialchars(
                            !empty($item['urdu_name'])
                                ? $item['urdu_name']
                                : $item['option_name']
                        ) ?>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="stitch-item">
                کوئی خصوصی ہدایت موجود نہیں
            </div>

        <?php endif; ?>

    </div>

    <!-- Right Side -->
    <div class="payment-card">

        <div class="section-title">
            <h2>Payment Summary</h2>
        </div>

        <table>

            <tr>
                <td>Total</td>
                <td>
                    <?= Config::get("currency") ?>
                    <?= number_format($info['total_amount']) ?>
                </td>
            </tr>

            <tr>
                <td>Advance</td>
                <td>
                    <?= Config::get("currency") ?>
                    <?= number_format($info['advance']) ?>
                </td>
            </tr>

            <tr>
                <td>Discount</td>
                <td>
                    <?= Config::get("currency") ?>
                    <?= number_format($info['discount']) ?>
                </td>
            </tr>

            <tr>

                <td><strong>Balance</strong></td>

                <td>

                    <strong>

                        <?= Config::get("currency") ?>

                        <?= number_format($info['balance']) ?>

                    </strong>

                </td>

            </tr>

        </table>

    </div>

</div>
<!-- ===========================
FOOTER
=========================== -->

<div class="footer">

<h3>

<?= htmlspecialchars(Config::get("shop_name") ?? '') ?>

</h3>

<div>

<?= htmlspecialchars(Config::get("village") ?? '') ?>

</div>

<div>

<?= htmlspecialchars(Config::get("phone") ?? '') ?>

</div>

<div>

Thank You For Visiting

</div>

</div>


<div class="print-btn">

<button onclick="window.print()">

🖨 Print Slip

</button>

</div>

</div>

</div>

</body>

</html>