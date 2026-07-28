<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="fw-bold">

            <i class="fas fa-file-invoice-dollar text-success"></i>

            Invoice Details

        </h3>

        <small class="text-muted">

            Review invoice before printing.

        </small>

    </div>

    <div>

        <a
            href="index.php?page=invoices"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Back

        </a>

        <a
            href="index.php?page=print-invoice&id=<?= $invoice['id'] ?? '' ?>"
            target="_blank"
            class="btn btn-success">

            <i class="fas fa-print"></i>

            Print Invoice

        </a>

    </div>

</div>

<div class="card shadow border-0">

<div class="card-body">

<div class="row">

<div class="col-md-6">

<h4 class="fw-bold text-success">

MR Tailor

</h4>

<p class="mb-1">

Tailoring & Boutique

</p>

<p class="mb-1">

Phone:
<?= htmlspecialchars($invoice['phone'] ?? '') ?>

</p>

</div>

<div class="col-md-6 text-end">

<h4>

Invoice

</h4>

<table class="table table-borderless table-sm">

<tr>

<th>

Invoice No

</th>

<td>

<?= htmlspecialchars($invoice['invoice_no'] ?? '') ?>

</td>

</tr>

<tr>

<th>

Booking No

</th>

<td>

<?= htmlspecialchars($invoice['booking_no'] ?? '') ?>

</td>

</tr>

<tr>

<th>

Order Date

</th>

<td>

<?= date("d M Y",strtotime($invoice['order_date'] ?? '')) ?>

</td>

</tr>

<tr>

<th>

Delivery

</th>

<td>

<?= date("d M Y",strtotime($invoice['delivery_date'] ?? '')) ?>

</td>

</tr>

</table>

</div>

</div>

<hr>

<h5 class="fw-bold">

Customer Information

</h5>

<div class="row">

<div class="col-md-6">

<table class="table table-bordered">

<tr>

<th width="35%">

Customer

</th>

<td>

<?= htmlspecialchars($invoice['full_name'] ?? '') ?>

</td>

</tr>

<tr>

<th>

Father

</th>

<td>

<?= htmlspecialchars($invoice['father_name'] ?? '') ?>

</td>

</tr>

<tr>

<th>

Phone

</th>

<td>

<?= htmlspecialchars($invoice['phone'] ?? '') ?>

</td>

</tr>

<tr>

<th>

Village

</th>

<td>

<?= htmlspecialchars($invoice['village'] ?? '') ?>

</td>

</tr>

<tr>

<th>

Mohalla

</th>

<td>

<?= htmlspecialchars($invoice['mohalla'] ?? '') ?>

</td>

</tr>

</table>

</div>

<div class="col-md-6">

<table class="table table-bordered">

<tr>

<th width="35%">

Garment

</th>

<td>

<?= htmlspecialchars($invoice['garment_type'] ?? '') ?>

</td>

</tr>

<tr>

<th>

Status

</th>

<td>

<span class="badge bg-primary">

<?= htmlspecialchars($invoice['status'] ?? '') ?>

</span>

</td>

</tr>

<tr>


</tr>

</table>

</div>

</div>

<hr>

<h5 class="fw-bold">

Measurements

</h5>

<div class="table-responsive">

<table class="table table-bordered">

<thead class="table-light">

<tr>

<th>

Measurement

</th>

<th>

Value

</th>

</tr>

</thead>

<tbody>

<?php foreach($measurements as $row): ?>

<tr>

<td>

<?= htmlspecialchars($row['urdu_name'] ?: $row['option_name']) ?>

</td>

<td>

<?= htmlspecialchars($row['measurement_value'] ?? '') ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

<hr>

<h5 class="fw-bold">

Stitching Instructions

</h5>

<div class="row">

<?php foreach($options as $option): ?>

<div class="col-md-3 mb-2">

<span class="badge bg-info text-dark p-2">

<?= htmlspecialchars($option['urdu_name'] ?: $option['name']) ?>

</span>

</div>

<?php endforeach; ?>

</div>

<hr>

<div class="row justify-content-end">

<div class="col-md-5">

<table class="table table-bordered">

<tr>

<th>

Total Amount

</th>

<td>

<?= number_format($invoice['total_amount'] ?? '',2) ?>

</td>

</tr>

<tr>

<th>

Discount

</th>

<td>

<?= number_format($invoice['discount']?? 0 ,2) ?>

</td>

</tr>

<tr>

<th>

Advance

</th>

<td>

<?= number_format($invoice['advance'] ?? 0,2) ?>

</td>

</tr>

<tr class="table-warning">

<th>

Balance

</th>

<td>

<strong>

<?= number_format($invoice['balance']?? 0,2) ?>

</strong>

</td>

</tr>

</table>

</div>

</div>

<div class="row mt-5">

<div class="col-md-6 text-center">

_____________________

<br>

Customer Signature

</div>

<div class="col-md-6 text-center">

_____________________

<br>

Authorized Signature

</div>

</div>

</div>

</div>

</div>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>