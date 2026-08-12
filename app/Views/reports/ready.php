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

                <i class="fas fa-box-open text-info"></i>

                Ready Orders Report

            </h3>

            <small class="text-muted">

                Orders that are ready for customer pickup.

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
$totalBalance = 0;

foreach($reports as $row){

    $totalAmount += $row['total_amount'];
    $totalAdvance += $row['advance'];
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

                    <small>Total Ready Orders</small>

                    <h2><?= $totalOrders ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-success">

                <div class="card-body text-center">

                    <small>Total Amount</small>

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

            <div class="card shadow-sm border-danger">

                <div class="card-body text-center">

                    <small>Outstanding Balance</small>

                    <h4 class="text-danger">

                        Rs. <?= number_format($totalBalance,2) ?>

                    </h4>

                </div>

            </div>

        </div>

    </div>

    <!-- ===========================
         Ready Orders Table
    ============================ -->

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <strong>

                Ready Orders

            </strong>

            <div class="btn-group">

                <button
                    onclick="window.print()"
                    class="btn btn-secondary btn-sm">

                    <i class="fas fa-print"></i>

                    Print

                </button>

                <a
                    href="index.php?page=export&type=ready&format=pdf"
                    class="btn btn-danger btn-sm">

                    <i class="fas fa-file-pdf"></i>

                    PDF

                </a>

                <a
                   href="index.php?page=export&type=ready&format=excel"
                    class="btn btn-success btn-sm">

                    <i class="fas fa-file-excel"></i>

                    Excel

                </a>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-info">

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
                            <th>Balance</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(empty($reports)): ?>

                        <tr>

                            <td colspan="11" class="text-center text-muted">

                                No ready orders found.

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php foreach($reports as $i=>$row): ?>

                        <tr>

                            <td><?= $i+1 ?></td>

                            <td><?= htmlspecialchars($row['booking_no']) ?></td>

                            <td><?= htmlspecialchars($row['full_name']) ?></td>

                            <td><?= htmlspecialchars($row['phone']) ?></td>

                            <td><?= htmlspecialchars($row['garment_name']) ?></td>

                            <td><?= date("d M Y", strtotime($row['order_date'])) ?></td>

                            <td><?= date("d M Y", strtotime($row['delivery_date'])) ?></td>

                            <td>

                                Rs. <?= number_format($row['total_amount'],2) ?>

                            </td>

                            <td>

                                Rs. <?= number_format($row['advance'],2) ?>

                            </td>

                            <td>

                                <?php if($row['balance'] > 0): ?>

                                    <span class="text-danger fw-bold">

                                        Rs. <?= number_format($row['balance'],2) ?>

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-success">

                                        Paid

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <span class="badge bg-info text-dark">

                                    <?= htmlspecialchars($row['status']) ?>

                                </span>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>