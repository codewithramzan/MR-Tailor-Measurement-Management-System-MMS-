<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

<div class="main-content">

 <div class="page-content">

    <div class="card shadow border-0">

    <div class="card-header bg-primary text-white py-3">

    <h4>

    <i class="fas fa-eye"></i>

    Order Details

    </h4>

    </div>

    <div class="card-body">

    <h5 class="mb-3">

    Customer Information

    </h5>

    <table class="table table-bordered">

    <tr>

    <th width="200">Booking No</th>

    <td><?= $order['booking_no']?? 0 ?></td>

    </tr>

    <tr>

    <th>Customer</th>

    <td><?= $order['full_name']?? '' ?></td>

    </tr>

    <tr>

    <th>Father Name</th>

    <td><?= $order['father_name'] ?? '' ?></td>

    </tr>

    <tr>

    <th>Phone</th>

    <td><?= $order['phone']?? '' ?></td>

    </tr>

    <tr>

    <th>Village</th>

    <td><?= $order['village'] ?? '' ?></td>

    </tr>

    </table>

    <hr>

    <h5 class="mb-3">

    Order Information

    </h5>

    <table class="table table-bordered">

    <tr>

    <th width="200">Garment</th>

    <td><?= $order['garment_type']?? '' ?></td>

    </tr>

    <tr>

    <th>Delivery Date</th>

    <td><?= $order['delivery_date']?? '' ?></td>

    </tr>

    <tr>

    <th>Status</th>

    <td>

    <span class="badge bg-success">

    <?= $order['status']?? '' ?>

    </span>

    </td>

    </tr>

    <tr>

    <th>Total Amount</th>

    <td>

    Rs. <?= number_format($order['total_amount'])?? 0 ?>

    </td>

    </tr>

    <tr>

    <th>Advance</th>

    <td>

    Rs. <?= number_format($order['advance'])?? 0 ?>

    </td>

    </tr>

    <tr>

    <th>Remaining</th>

    <td>

    Rs. <?= number_format($order['discount'])?? 0 ?>

    </td>

    </tr>
    <tr>
    <th>Quantity</th>
    <td><?= $order['quantity'] ?? 0 ?></td>
    </tr>

    <tr>
    <th>Order Date</th>
    <td><?= $order['order_date']?? '' ?></td>
    </tr>

    <tr>
    <th>Notes</th>
    <td><?= $order['notes'] ?: 'No Notes' ?></td>
    </tr>

    </table>

    <hr>

    <h5>

    Measurements

    </h5>

    <div class="row">

    <?php foreach($measurements as $row): ?>

    <div class="col-md-3 mb-3">

    <label class="fw-bold">

    <?= $row['name'] ?>

    </label>

    <input
    type="text"
    class="form-control"
    value="<?= $row['measurement_value'] ?>"
    readonly>

    </div>

    <?php endforeach; ?>

    </div>

    <div class="mt-4">

    <a
    href="index.php?page=edit-order&id=<?= $order['id'] ?? '' ?>"
    class="btn btn-warning rounded-pill px-4">

    <i class="fas fa-edit"></i>

    Edit Order

    </a>

    <a
    href="index.php?page=edit-measurement&order_id=<?= $order['id'] ?? '' ?>"
    class="btn btn-primary rounded-pill px-4">

    <i class="fas fa-ruler"></i>

    Edit Measurements

    </a>

    <a
    href="index.php?page=print-measurement&id=<?= $order['id'] ?? '' ?>"
    class="btn btn-success rounded-pill px-4">

    <i class="fas fa-print"></i>

    Print Urdu Slip

    </a>

    </div>

    </div>

    </div>

 </div>
</div>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>