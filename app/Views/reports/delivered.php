<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

<div class="container-fluid">

    <!-- ===========================
         Page Header
    ============================ -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold">

                <i class="fas fa-check-circle text-success"></i>

                Delivered Orders Report

            </h3>

            <small class="text-muted">

                Completed customer orders and payment summary.

            </small>

        </div>

        <a href="index.php?page=reports"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Back

        </a>

    </div>

<?php

$totalOrders = count($reports);

$totalAmount = 0;
$totalAdvance = 0;
$totalDiscount = 0;
$totalBalance = 0;

foreach($reports as $row){

    $totalAmount += $row['total_amount'];
    $totalAdvance += $row['advance'];
    $totalDiscount += $row['discount'];
    $totalBalance += $row['balance'];

}

?>

    <!-- ===========================
         Summary Cards
    ============================ -->

    <div class="row g-3 mb-4">

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <small>Total Delivered</small>

                    <h2><?= $totalOrders ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-success">

                <div class="card-body text-center">

                    <small>Total Business</small>

                    <h4 class="text-success">

                        Rs. <?= number_format($totalAmount,2) ?>

                    </h4>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-primary">

                <div class="card-body text-center">

                    <small>Advance Received</small>

                    <h4 class="text-primary">

                        Rs. <?= number_format($totalAdvance,2) ?>

                    </h4>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-warning">

                <div class="card-body text-center">

                    <small>Discount Given</small>

                    <h4 class="text-warning">

                        Rs. <?= number_format($totalDiscount,2) ?>

                    </h4>

                </div>

            </div>

        </div>

    </div>

    <!-- ===========================
         Delivered Orders Table
    ============================ -->

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <strong>

                Delivered Orders

            </strong>

            <button
                onclick="window.print()"
                class="btn btn-success btn-sm">

                <i class="fas fa-print"></i>

                Print

            </button>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-success">

                        <tr>

                            <th>#</th>
                            <th>Booking No</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Garment</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Total</th>
                            <th>Advance</th>
                            <th>Discount</th>
                            <th>Balance</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(empty($reports)): ?>

                        <tr>

                            <td colspan="12" class="text-center text-muted">

                                No delivered orders found.

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php foreach($reports as $i=>$row): ?>

                        <tr>

                            <td><?= $i+1 ?></td>

                            <td><?= htmlspecialchars($row['booking_no']) ?></td>

                            <td><?= htmlspecialchars($row['full_name']) ?></td>

                            <td><?= htmlspecialchars($row['phone']) ?></td>

                            <td><?= htmlspecialchars($row['garment_type']) ?></td>

                            <td><?= date("d M Y", strtotime($row['order_date'])) ?></td>

                            <td><?= date("d M Y", strtotime($row['delivery_date'])) ?></td>

                            <td>

                                Rs. <?= number_format($row['total_amount'],2) ?>

                            </td>

                            <td>

                                Rs. <?= number_format($row['advance'],2) ?>

                            </td>

                            <td>

                                Rs. <?= number_format($row['discount'],2) ?>

                            </td>

                            <td>

                                <?php if($row['balance'] > 0): ?>

                                    <span class="badge bg-danger">

                                        Rs. <?= number_format($row['balance'],2) ?>

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-success">

                                        Paid

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <span class="badge bg-success">

                                    <?= htmlspecialchars($row['status']) ?>

                                </span>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                    <tfoot class="table-light fw-bold">

                        <tr>

                            <td colspan="7" class="text-end">

                                Grand Total

                            </td>

                            <td>

                                Rs. <?= number_format($totalAmount,2) ?>

                            </td>

                            <td>

                                Rs. <?= number_format($totalAdvance,2) ?>

                            </td>

                            <td>

                                Rs. <?= number_format($totalDiscount,2) ?>

                            </td>

                            <td>

                                Rs. <?= number_format($totalBalance,2) ?>

                            </td>

                            <td></td>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>

</div>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>