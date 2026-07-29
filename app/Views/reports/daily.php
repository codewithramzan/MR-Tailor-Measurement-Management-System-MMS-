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

                <i class="fas fa-calendar-day text-success"></i>

                Daily Report

            </h3>

            <small class="text-muted">

                View all orders for a selected date.

            </small>

        </div>

        <div>

            <a href="index.php?page=reports" class="btn btn-secondary">

                <i class="fas fa-arrow-left"></i>

                Back

            </a>

        </div>

    </div>

    <!-- ===========================
         Date Filter
    ============================ -->

    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form method="GET">

                <input
                    type="hidden"
                    name="page"
                    value="daily-report">

                <div class="row align-items-end">

                    <div class="col-md-4">

                        <label class="form-label">

                            Select Date

                        </label>

                        <input
                            type="date"
                            name="date"
                            class="form-control"
                            value="<?= htmlspecialchars($date) ?>">

                    </div>

                    <div class="col-md-3 mt-sm-3 mb-lg-2">

                        <button class="btn btn-success">

                            <i class="fas fa-search"></i>

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

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

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h6>Total Orders</h6>

                    <h2><?= $totalOrders ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-success shadow-sm">

                <div class="card-body text-center">

                    <h6>Total Amount</h6>

                    <h2 class="text-success">

                        Rs. <?= number_format($totalAmount,2) ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-primary shadow-sm">

                <div class="card-body text-center">

                    <h6>Advance</h6>

                    <h2 class="text-primary">

                        Rs. <?= number_format($totalAdvance,2) ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-danger shadow-sm">

                <div class="card-body text-center">

                    <h6>Balance</h6>

                    <h2 class="text-danger">

                        Rs. <?= number_format($totalBalance,2) ?>

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <!-- ===========================
         Report Table
    ============================ -->

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <strong>

                Orders

            </strong>

            <div>

             <div class="btn-group">

                <button
                    onclick="window.print()"
                    class="btn btn-secondary btn-sm">

                    <i class="fas fa-print"></i>

                    Print

                </button>

                <a
                   href="index.php?page=export&type=daily&format=pdf&date=<?= urlencode($date) ?>"
                    class="btn btn-danger btn-sm">

                    <i class="fas fa-file-pdf"></i>

                    PDF

                </a>

                <a
                   href="index.php?page=export&type=daily&format=excel&date=<?= urlencode($date) ?>"
                    class="btn btn-success btn-sm">

                    <i class="fas fa-file-excel"></i>

                    Excel

                </a>

            </div>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-success">

                        <tr>

                            <th>#</th>

                            <th>Booking</th>

                            <th>Customer</th>

                            <th>Phone</th>

                            <th>Garment</th>

                            <th>Status</th>

                            <th>Total</th>

                            <th>Advance</th>

                            <th>Balance</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(empty($reports)): ?>

                        <tr>

                            <td colspan="9" class="text-center text-muted">

                                No records found.

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

                            <td>

                               <?php  $badge = $this->getStatusColor($row['status'])  ?>
																<span class="badge bg-<?= $badge ?>">
                                    <?= htmlspecialchars($row['status']) ?>

                                </span>

                            </td>

                            <td>

                                <?= number_format($row['total_amount'],2) ?>

                            </td>

                            <td>

                                <?= number_format($row['advance'],2) ?>

                            </td>

                            <td>

                                <?= number_format($row['balance'],2) ?>

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