<?php require dirname(__DIR__) . "/layouts/header.php"; ?>
<?php require dirname(__DIR__) . "/layouts/navbar.php"; ?>
<?php require dirname(__DIR__) . "/layouts/sidebar.php"; ?>

<h3 class="fw-bold mb-4">
    <i class="fas fa-user-circle text-primary"></i>
    Customer Profile
</h3>

<div class="row">

    <!-- Customer Information -->
    <div class="col-lg-4 mb-4">

        <div class="card shadow border-0">

            <div class="card-header bg-primary text-white">

                <i class="fas fa-user"></i>
                Customer Information

            </div>

            <div class="card-body">

                <table class="table table-borderless mb-0">

                    <tr>
                        <th width="40%">Booking</th>
                        <td><?= htmlspecialchars($profile['booking_no']) ?></td>
                    </tr>

                    <tr>
                        <th>Name</th>
                        <td><?= htmlspecialchars($profile['full_name'])  ?></td>
                    </tr>

                    <tr>
                        <th>Father</th>
                        <td><?= htmlspecialchars($profile['father_name']) ?></td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                        <td><?= htmlspecialchars($profile['phone']) ?></td>
                    </tr>

                    <tr>
                        <th>Village</th>
                        <td><?= htmlspecialchars($profile['village']) ?></td>
                    </tr>

                    <tr>
                        <th>Mohalla</th>
                        <td><?= htmlspecialchars($profile['mohalla']) ?></td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

    <!-- Summary -->
    <div class="col-lg-8 mb-4">

        <div class="row g-3">

            <div class="col-md-3">

                <div class="card shadow text-center border-0">

                    <div class="card-body">

                        <h6>Total Orders</h6>

                        <h3 class="text-primary">

                            <?= $summary['total_orders'] ?? 0 ?>

                        </h3>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow text-center border-0">

                    <div class="card-body">

                        <h6>Total Amount</h6>

                        <h5 class="text-success">

                            <?= Config::get("currency") ?>
                            <?= number_format($summary['total_amount'] ?? 0) ?>

                        </h5>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow text-center border-0">

                    <div class="card-body">

                        <h6>Advance</h6>

                        <h5 class="text-warning">

                            <?= Config::get("currency") ?>
                            <?= number_format($summary['total_advance'] ?? 0) ?>

                        </h5>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card shadow text-center border-0">

                    <div class="card-body">

                        <h6>Balance</h6>

                        <h5 class="text-danger">

                           <?= Config::get("currency") ?>
                            <?= number_format($summary['total_balance'] ?? 0) ?>

                        </h5>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Order History -->

<div class="card shadow border-0">

    <div class="card-header bg-dark text-white">

        <i class="fas fa-history"></i>
        Order History

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

            <tr>

                <th>Booking</th>
                <th>Garment</th>
                <th>Order Date</th>
                <th>Delivery</th>
                <th>Status</th>
                <th>Total</th>
                <th>Action</th>

            </tr>

            </thead>

            <tbody>

            <?php if (!empty($orders)): ?>

                <?php foreach ($orders as $order): ?>

                    <?php

                    $badge = "bg-secondary";

                    if ($order['status'] == "Pending")
                        $badge = "bg-warning text-dark";

                    elseif ($order['status'] == "Ready")
                        $badge = "bg-primary";

                    elseif ($order['status'] == "Delivered")
                        $badge = "bg-success";

                    ?>

                    <tr>

                        <td><?= htmlspecialchars($order['booking_no']) ?></td>

                        <td><?= htmlspecialchars($order['garment_type']) ?></td>

                        <td><?= htmlspecialchars($order['order_date']) ?></td>

                        <td><?= htmlspecialchars($order['delivery_date']) ?></td>

                        <td>

                            <span class="badge <?= $badge ?>">

                                <?= htmlspecialchars($order['status']) ?>

                            </span>

                        </td>

                        <td>

                            <?= Config::get("currency") ?>
                            <?= number_format($order['total_amount']) ?>

                        </td>

                        <td>

                            <a
                                href="index.php?page=view-order&id=<?= $order['id'] ?>"
                                class="btn btn-primary btn-sm">

                                <i class="fas fa-eye"></i>

                            </a>

                            <a
                                href="index.php?page=print-measurement&id=<?= $order['id'] ?>"
                                class="btn btn-success btn-sm">

                                <i class="fas fa-print"></i>

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="7" class="text-center text-muted">

                        No Orders Found

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?php require dirname(__DIR__) . "/layouts/footer.php"; ?>