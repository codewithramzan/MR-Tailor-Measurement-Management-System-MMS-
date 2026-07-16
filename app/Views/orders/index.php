<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

<div class="main-content">

<div class="container-fluid">

<div class="card shadow border-0">

<div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

<h4>
<i class="fas fa-receipt"></i>
Manage Orders
</h4>

<a href="index.php?page=create-order" class="btn btn-light">
<i class="fas fa-plus"></i>
New Order
</a>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-dark">

<tr>

<th>#</th>
<th>Booking</th>
<th>Customer</th>
<th>Garment</th>
<th>Delivery</th>
<th>Status</th>
<th>Balance</th>
<th>Actions</th>

</tr>

</thead>

<tbody>

<?php foreach($orders as $index=>$row): ?>

<tr>

<td><?= $index+1 ?></td>

<td><?= htmlspecialchars($row['booking_no']) ?></td>

<td><?= htmlspecialchars($row['full_name']) ?></td>

<td><?= htmlspecialchars($row['garment_type']) ?></td>

<td><?= htmlspecialchars($row['delivery_date']) ?></td>

<td>

<?php

$status = strtolower($row['status']);

$badge = "secondary";

if($status=="pending") $badge="warning";
if($status=="ready") $badge="success";
if($status=="delivered") $badge="primary";

?>

<span class="badge bg-<?= $badge ?>">
<?= htmlspecialchars($row['status']) ?>
</span>

</td>

<td>
Rs. <?= number_format($row['balance'] ?? 0) ?>
</td>

<td>

<a
href="index.php?page=view-order&id=<?= $row['id'] ?>"
class="btn btn-info btn-sm">

<i class="fas fa-eye"></i>

</a>

<a
href="index.php?page=edit-order&id=<?= $row['id'] ?>"
class="btn btn-warning btn-sm">

<i class="fas fa-edit"></i>

</a>

<a
href="index.php?page=edit-measurement&order_id=<?= $row['id'] ?>"
class="btn btn-primary btn-sm">

<i class="fas fa-ruler"></i>

</a>

<a
href="index.php?page=print-measurement&id=<?= $row['id'] ?>"
class="btn btn-success btn-sm">

<i class="fas fa-print"></i>

</a>

<a
href="index.php?page=delete-order&id=<?= $row['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this order?')">

<i class="fas fa-trash"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>