<?php

if (empty($rows)) {
    die("No measurement data found.");
}

$info = $rows[0];

/*
|--------------------------------------------------------------------------
| Group Saved Measurements
|--------------------------------------------------------------------------
|
| Only records returned from getSlip() are shown.
| Therefore only measurements actually saved for
| this order appear here.
|
*/

$measurements = [];

foreach ($rows as $row) {

    $section = trim($row['section_urdu'] ?? '');

    if ($section === '') {
        $section = trim($row['section'] ?? '');
    }

    if ($section === '') {
        $section = 'پیمائش';
    }

    $label = trim($row['measurement_urdu_name'] ?? '');

    if ($label === '') {
        $label = trim($row['option_name'] ?? '');
    }

    $measurements[$section][] = [
        'label' => $label,
        'value' => $row['measurement_value'] ?? ''
    ];
}


/*
|--------------------------------------------------------------------------
| Dynamic Shop Settings
|--------------------------------------------------------------------------
*/

$shopName = Config::get('shop_name') ?: 'MR Tailor';

$ownerName = Config::get('owner_name') ?: '';

$phone = Config::get('phone') ?: '';

$address = Config::get('address') ?: '';

$currency = Config::get('currency') ?: 'Rs.';

$footer = Config::get('invoice_footer') ?: '';

$logo = Config::get('logo');


/*
|--------------------------------------------------------------------------
| Logo
|--------------------------------------------------------------------------
*/

$logoPath = '';

if (!empty($logo)) {

    $logoPath = BASE_URL . 'uploads/logo/' . htmlspecialchars($logo);
}

?>

<!DOCTYPE html>

<html lang="ur" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        <?= htmlspecialchars($shopName) ?> - Measurement Slip
    </title>

    <link
        rel="stylesheet"
        href="<?= BASE_URL ?>assets/css/print.css"
    >

</head>

<body>

<div class="print-page">

    <div class="slip">

        <!-- =====================================================
             HEADER
        ====================================================== -->

        <header class="slip-header">

            <div class="header-logo">

                <?php if (!empty($logoPath)): ?>

                    <img
                        src="<?= $logoPath ?>"
                        alt="Logo"
                    >

                <?php endif; ?>

            </div>

            <div class="header-title">

                <h1>
                    <?= htmlspecialchars($shopName) ?>
                </h1>

                <div class="subtitle">
                    پیمائش سلپ
                </div>

                <?php if ($ownerName): ?>

                    <div class="owner">
                        <?= htmlspecialchars($ownerName) ?>
                    </div>

                <?php endif; ?>

            </div>

            <div class="header-booking">

                <div class="booking-label">
                    سیریل نمبر
                </div>

                <strong>
                    <?= htmlspecialchars($info['booking_no'] ?? '') ?>
                </strong>

            </div>

        </header>


        <!-- =====================================================
             CUSTOMER + ORDER INFORMATION
        ====================================================== -->

        <section class="top-grid">

            <!-- Customer -->

            <div class="info-box">

                <div class="box-title">
                    کسٹمر کی معلومات
                </div>

                <table>

                    <tr>
                        <td>نام</td>
                        <td>
                            <?= htmlspecialchars($info['full_name'] ?? '') ?>
                        </td>
                    </tr>

                    <?php if (!empty($info['father_name'])): ?>

                    <tr>
                        <td>والد کا نام</td>
                        <td>
                            <?= htmlspecialchars($info['father_name']) ?>
                        </td>
                    </tr>

                    <?php endif; ?>

                    <tr>
                        <td>موبائل</td>
                        <td>
                            <?= htmlspecialchars($info['phone'] ?? '') ?>
                        </td>
                    </tr>

                    <tr>
                        <td>گاؤں</td>
                        <td>
                            <?= htmlspecialchars($info['village'] ?? '') ?>
                        </td>
                    </tr>

                    <?php if (!empty($info['mohalla'])): ?>

                    <tr>
                        <td>محلہ</td>
                        <td>
                            <?= htmlspecialchars($info['mohalla']) ?>
                        </td>
                    </tr>

                    <?php endif; ?>

                </table>

            </div>


            <!-- Order -->

            <div class="info-box">

                <div class="box-title">
                    آرڈر کی معلومات
                </div>

                <table>

                    <tr>
                        <td>لباس</td>
                        <td>
                            <?= htmlspecialchars(
                                $info['garment_urdu_name']
                                ?: $info['garment_name']
                                ?? ''
                            ) ?>
                        </td>
                    </tr>

                    <tr>
                        <td>تاریخ</td>
                        <td>
                            <?= htmlspecialchars($info['order_date'] ?? '') ?>
                        </td>
                    </tr>

                    <tr>
                        <td>ڈیلیوری</td>
                        <td>
                            <?= htmlspecialchars(
                                $info['delivery_date'] ?? '---'
                            ) ?>
                        </td>
                    </tr>

                    <tr>
                        <td>حالت</td>
                        <td>
                            <?= htmlspecialchars($info['status'] ?? '') ?>
                        </td>
                    </tr>

                </table>

            </div>

        </section>


<!-- ===========================
MEASUREMENTS + STITCHING
=========================== -->

<?php

/*
|--------------------------------------------------------------------------
| Prepare measurement items
|--------------------------------------------------------------------------
| Only measurements saved for this order are displayed.
|--------------------------------------------------------------------------
*/

$measurementItems = [];

foreach ($rows as $row) {

    if (
        !isset($row['measurement_value']) ||
        trim((string)$row['measurement_value']) === ''
    ) {
        continue;
    }

    $label = trim($row['measurement_urdu_name'] ?? '');

    if ($label === '') {
        $label = trim($row['option_name'] ?? '');
    }

    if ($label === '') {
        continue;
    }

    $measurementItems[] = [
        'label' => $label,
        'value' => $row['measurement_value']
    ];
}


/*
|--------------------------------------------------------------------------
| Split measurements into two columns
|--------------------------------------------------------------------------
*/

$totalMeasurements = count($measurementItems);

$leftCount = (int) ceil($totalMeasurements / 2);

$measurementLeft = array_slice(
    $measurementItems,
    0,
    $leftCount
);

$measurementRight = array_slice(
    $measurementItems,
    $leftCount
);

?>

<div class="measurement-stitching-grid">

    <!-- =========================================
         MEASUREMENTS
    ========================================== -->

    <div class="print-card measurement-card">

        <div class="print-card-header">
            پیمائش
        </div>

        <div class="measurement-two-columns">

            <!-- LEFT MEASUREMENT COLUMN -->

            <div class="measurement-list">

                <?php foreach ($measurementLeft as $item): ?>

                    <div class="measurement-row">

                        <span class="measurement-label">
                            <?= htmlspecialchars($item['label']) ?>
                        </span>

                        <span class="measurement-value">
                            <?= htmlspecialchars($item['value']) ?>
                        </span>

                    </div>

                <?php endforeach; ?>

            </div>


            <!-- RIGHT MEASUREMENT COLUMN -->

            <div class="measurement-list">

                <?php foreach ($measurementRight as $item): ?>

                    <div class="measurement-row">

                        <span class="measurement-label">
                            <?= htmlspecialchars($item['label']) ?>
                        </span>

                        <span class="measurement-value">
                            <?= htmlspecialchars($item['value']) ?>
                        </span>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>


    <!-- =========================================
         STITCHING OPTIONS
    ========================================== -->

    <div class="print-card stitching-card">

        <div class="print-card-header">
            سلائی کی ہدایات
        </div>

        <div class="stitching-two-columns">

            <?php

            /*
            |--------------------------------------------------------------------------
            | Only selected/saved stitching options
            |--------------------------------------------------------------------------
            */

            $totalOptions = count($options);

            $optionLeftCount = (int) ceil($totalOptions / 2);

            $optionsLeft = array_slice(
                $options,
                0,
                $optionLeftCount
            );

            $optionsRight = array_slice(
                $options,
                $optionLeftCount
            );

            ?>

            <!-- LEFT OPTIONS -->

            <div class="stitching-list">

                <?php foreach ($optionsLeft as $item): ?>

                    <div class="stitch-row">

                        <span class="check-box">✓</span>

                        <span>
                            <?= htmlspecialchars(
                                !empty($item['urdu_name'])
                                    ? $item['urdu_name']
                                    : $item['option_name']
                            ) ?>
                        </span>

                    </div>

                <?php endforeach; ?>

            </div>


            <!-- RIGHT OPTIONS -->

            <div class="stitching-list">

                <?php foreach ($optionsRight as $item): ?>

                    <div class="stitch-row">

                        <span class="check-box">✓</span>

                        <span>
                            <?= htmlspecialchars(
                                !empty($item['urdu_name'])
                                    ? $item['urdu_name']
                                    : $item['option_name']
                            ) ?>
                        </span>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>



        <!-- =====================================================
             PAYMENT - HORIZONTAL
        ====================================================== -->

        <section class="payment-box">

            <div class="payment-item">

                <span>
                    کل رقم
                </span>

                <strong>
                    <?= htmlspecialchars($currency) ?>
                    <?= number_format((float)($info['total_amount'] ?? 0), 0) ?>
                </strong>

            </div>

            <div class="payment-item">

                <span>
                    ایڈوانس
                </span>

                <strong>
                    <?= htmlspecialchars($currency) ?>
                    <?= number_format((float)($info['advance'] ?? 0), 0) ?>
                </strong>

            </div>

            <div class="payment-item">

                <span>
                    رعایت
                </span>

                <strong>
                    <?= htmlspecialchars($currency) ?>
                    <?= number_format((float)($info['discount'] ?? 0), 0) ?>
                </strong>

            </div>

            <div class="payment-item balance">

                <span>
                    بقایا
                </span>

                <strong>
                    <?= htmlspecialchars($currency) ?>
                    <?= number_format((float)($info['balance'] ?? 0), 0) ?>
                </strong>

            </div>

        </section>


        <!-- =====================================================
             FOOTER
        ====================================================== -->

        <footer class="slip-footer">

            <div>
                <?= htmlspecialchars($address) ?>
            </div>

            <?php if ($phone): ?>

                <div>
                    <?= htmlspecialchars($phone) ?>
                </div>

            <?php endif; ?>

            <?php if ($footer): ?>

                <div class="footer-message">
                    <?= htmlspecialchars($footer) ?>
                </div>

            <?php endif; ?>

        </footer>


        <!-- =====================================================
             PRINT BUTTON
        ====================================================== -->

        <div class="print-button">

            <button onclick="window.print()">
                🖨 Print Slip
            </button>

        </div>

    </div>

</div>

</body>

</html>