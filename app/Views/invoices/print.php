<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>

Invoice - <?= htmlspecialchars($invoice['invoice_no']) ?>

</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    background:#eceff3;

    font-family:Arial,Helvetica,sans-serif;

    color:#333;

    padding:25px;

}

.invoice{

    width:210mm;

    min-height:297mm;

    margin:auto;

    background:#fff;

    padding:30px;

    border-radius:10px;

    box-shadow:0 0 15px rgba(0,0,0,.08);

}

.header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    border-bottom:3px solid #198754;

    padding-bottom:20px;

    margin-bottom:20px;

}

.logo{

    width:90px;

    height:90px;

    border:2px solid #198754;

    border-radius:50%;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:36px;

    color:#198754;

}

.shop{

    flex:1;

    padding-left:20px;

}

.shop h2{

    margin-bottom:8px;

    color:#198754;

    font-weight:700;

}

.shop p{

    margin:3px 0;

    color:#666;

    font-size:14px;

}

.invoice-title{

    text-align:right;

}

.invoice-title h1{

    font-size:34px;

    color:#198754;

    margin-bottom:10px;

}

.info-grid{

    display:grid;

    grid-template-columns:repeat(2,1fr);

    gap:20px;

    margin-bottom:25px;

}

.card-box{

    border:1px solid #dee2e6;

    border-radius:8px;

    overflow:hidden;

}

.card-head{

    background:#198754;

    color:#fff;

    padding:10px 15px;

    font-weight:bold;

}

.card-body{

    padding:15px;

}

.info-table{

    width:100%;

}

.info-table td{

    padding:7px 0;

    vertical-align:top;

    font-size:14px;

}

.info-table td:first-child{

    width:42%;

    font-weight:bold;

    color:#555;

}

.section{

    margin-top:25px;

}

.section-title{

    background:#198754;

    color:#fff;

    padding:10px 15px;

    border-radius:5px;

    font-weight:bold;

    margin-bottom:10px;

}

.print-btn{

    position:fixed;

    right:25px;

    bottom:25px;

    z-index:999;

}

@media print{

body{

    background:#fff;

    padding:0;

}

.print-btn{

    display:none;

}

.invoice{

    width:100%;

    box-shadow:none;

    border-radius:0;

    padding:10mm;

}

}

</style>

</head>

<body>

<div class="invoice">

<!-- ===========================
     Header
=========================== -->

<div class="header">

<div class="d-flex align-items-center">

<div class="logo">

<i class="fas fa-cut"></i>

</div>

<div class="shop">

<h2>

MR TAILOR

</h2>

<p>

Professional Tailoring & Boutique

</p>

<p>

Address: Your Shop Address

</p>

<p>

Phone: +92-3XX-XXXXXXX

</p>

<p>

Email: mrtailor@gmail.com

</p>

</div>

</div>

<div class="invoice-title">

<h1>

INVOICE

</h1>

<h5 class="text-muted">

<?= htmlspecialchars($invoice['invoice_no'] ?? '') ?>

</h5>

</div>

</div>

<!-- ===========================
     Top Information
=========================== -->

<div class="info-grid">

<div class="card-box">

<div class="card-head">

Customer Information

</div>

<div class="card-body">

<table class="info-table">

<tr>

<td>Name</td>

<td><?= htmlspecialchars($invoice['full_name'] ?? 'undefined') ?></td>

</tr>

<tr>

<td>Father</td>

<td><?= htmlspecialchars($invoice['father_name'] ?? 'undefined') ?></td>

</tr>

<tr>

<td>Phone</td>

<td><?= htmlspecialchars($invoice['phone'] ?? 'undefined') ?></td>

</tr>

<tr>

<td>Village</td>

<td><?= htmlspecialchars($invoice['village'] ?? 'undefined') ?></td>

</tr>

<tr>

<td>Mohalla</td>

<td><?= htmlspecialchars($invoice['mohalla'] ?? 'undefined') ?></td>

</tr>

</table>

</div>

</div>

<div class="card-box">

<div class="card-head">

Order Information

</div>

<div class="card-body">

<table class="info-table">

<tr>

<td>Booking</td>

<td><?= htmlspecialchars($invoice['booking_no'] ?? '') ?></td>

</tr>

<tr>

<td>Garment</td>

<td><?= htmlspecialchars($invoice['garment_name'] ?? '') ?></td>

</tr>

<tr>

<td>Order Date</td>

<td><?= date("d M Y",strtotime($invoice['order_date'] ?? '')) ?></td>

</tr>

<tr>

<td>Delivery</td>

<td><?= date("d M Y",strtotime($invoice['delivery_date'] ?? '')) ?></td>

</tr>

<tr>

<td>Status</td>

<td>

<span class="badge bg-primary">

<?= htmlspecialchars($invoice['status'] ?? '') ?>

</span>

</td>

</tr>

</table>

</div>

</div>

</div>

<!-- ===========================
     Next Parts Start Here
=========================== -->

<!-- ==========================================
     Measurements
=========================================== -->

<?php

/*
|--------------------------------------------------------------------------
| Group Measurements by Section
|--------------------------------------------------------------------------
|
| Example:
|
| Shirt
| Trouser
| Sleeve
|
*/

$measurementSections = [];

foreach ($measurements as $row) {

    $section = trim($row['section'] ?? '');

    if ($section === '') {

        $section = 'General';
    }

    $measurementSections[$section][] = $row;
}

?>

<div class="section">

    <div class="section-title">

        <i class="fas fa-ruler-combined me-2"></i>

        Measurements

    </div>

    <div class="row">

        <?php foreach($measurementSections as $section=>$items): ?>

            <div class="col-md-6 mb-4">

                <div class="card border-success shadow-sm h-100">

                    <div class="card-header bg-success text-white">

                        <strong>

                            <?= htmlspecialchars($section) ?>

                        </strong>

                    </div>

                    <div class="card-body p-0">

                        <table class="table table-sm table-bordered mb-0">

                            <tbody>

                            <?php foreach($items as $measurement): ?>

                                <?php

                                $label = trim((string)($measurement['urdu_name'] ?? ''));

                                if ($label === '') {

                                    $label = trim((string)($measurement['option_name'] ?? ''));
                                }

                                ?>

                                <tr>

                                    <td width="65%">

                                        <?= htmlspecialchars($label) ?>

                                    </td>

                                    <td class="text-center fw-bold">

                                        <?= htmlspecialchars($measurement['measurement_value']) ?>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

<!-- ==========================================
     Stitching Instructions
=========================================== -->

<div class="section">

    <div class="section-title">

        <i class="fas fa-cut me-2"></i>

        Stitching Instructions

    </div>

    <?php

    /*
    ---------------------------------------------------------
    Group Stitching Options
    ---------------------------------------------------------
    */

    $optionSections = [];

    foreach($options as $option){

        $category = trim((string)($option['category'] ?? ''));

        if($category === ''){

            $category = 'General';
        }

        $optionSections[$category][] = $option;
    }

    ?>

    <div class="row">

        <?php foreach($optionSections as $category=>$items): ?>

        <div class="col-md-6 mb-3">

            <div class="card border-info shadow-sm h-100">

                <div class="card-header bg-info text-dark">

                    <strong>

                        <?= htmlspecialchars($category) ?>

                    </strong>

                </div>

                <div class="card-body">

                    <?php foreach($items as $item): ?>

                        <?php

                        $label = trim((string)($item['urdu_name'] ?? ''));

                        if($label === ''){

                            $label = trim((string)($item['option_name'] ?? ''));
                        }

                        ?>

                        <span class="badge bg-secondary me-2 mb-2 p-2">

                            <?= htmlspecialchars($label) ?>

                        </span>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</div>

    <div class="row">

        <div class="col-md-7">

            <div class="card border-success shadow-sm">

                <div class="card-header bg-success text-white">

                    Payment Information

                </div>

                <div class="card-body">

                    <table class="table table-bordered align-middle mb-0">

                        <tr>

                            <th width="45%">Total Amount</th>

                            <td class="text-end">

                                <?= Config::get("currency") ?>
                                <?= number_format($invoice['total_amount']?? 0,2) ?>

                            </td>

                        </tr>

                        <tr>

                            <th>Discount</th>

                            <td class="text-end">

                                Rs.
                                <?= number_format($invoice['discount'] ?? 0,2) ?>

                            </td>

                        </tr>

                        <tr>

                            <th>Advance Paid</th>

                            <td class="text-end">

                                Rs.
                                <?= number_format($invoice['advance'] ?? 0,2) ?>

                            </td>

                        </tr>

                        <tr class="table-warning">

                            <th>Remaining Balance</th>

                            <td class="text-end fw-bold">

                                Rs.
                                <?= number_format($invoice['balance']??0,2) ?>

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

        <div class="col-md-5">

            <div class="card border-primary shadow-sm">

                <div class="card-header bg-primary text-white">

                    Order Summary

                </div>

                <div class="card-body">

                    <table class="table table-borderless mb-0">

                        <tr>

                            <td>Invoice No</td>

                            <td class="text-end">

                                <?= htmlspecialchars($invoice['invoice_no'] ?? '') ?>

                            </td>

                        </tr>

                        <tr>

                            <td>Booking No</td>

                            <td class="text-end">

                                <?= htmlspecialchars($invoice['booking_no'] ?? '') ?>

                            </td>

                        </tr>

                        <tr>

                            <td>Garment</td>

                            <td class="text-end">

                                <?= htmlspecialchars($invoice['garment_name'] ?? '') ?>

                            </td>

                        </tr>

                        <tr>

                            <td>Quantity</td>

                            <td class="text-end">

                                <?= htmlspecialchars($invoice['quantity'] ?? 1) ?>

                            </td>

                        </tr>

                        <tr>

                            <td>Delivery</td>

                            <td class="text-end">

                                <?= date("d M Y", strtotime($invoice['delivery_date'] ?? '')) ?>

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ==========================================
     Signatures
========================================== -->

<div class="row mt-5">

    <div class="col-6 text-center">

        <br><br>

        <div style="border-top:1px solid #000;width:220px;margin:auto;"></div>

        <strong>

            Customer Signature

        </strong>

    </div>

    <div class="col-6 text-center">

        <br><br>

        <div style="border-top:1px solid #000;width:220px;margin:auto;"></div>

        <strong>

            Authorized Signature

        </strong>

    </div>

</div>

<!-- ==========================================
     Footer
========================================== -->

<div class="mt-5 text-center">

    <h5 class="text-success fw-bold">

        Thank You For Choosing MR Tailor

    </h5>

    <p class="text-muted mb-1">

        We appreciate your trust and look forward to serving you again.

    </p>

    <small class="text-secondary">

        This invoice is computer generated and does not require a physical stamp.

    </small>

</div>

<!-- ==========================================
     Print Script
========================================== -->

<script>

window.onload = function(){

    window.print();

};

window.onafterprint = function(){

    window.close();

};

</script>

</div>

<button
class="btn btn-success btn-lg print-btn"
onclick="window.print()">

<i class="fas fa-print"></i>

Print Invoice

</button>

</body>

</html>