<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

<div class="container-fluid">

    <!-- =======================================
            Page Header
    ======================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold">

                <i class="fas fa-users text-primary"></i>

                Customer Report

            </h3>

            <small class="text-muted">

                Customer business summary and outstanding balances.

            </small>

        </div>

        <a href="index.php?page=reports"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Back

        </a>

    </div>

<?php

$totalCustomers = count($reports);

$totalOrders = 0;
$totalBusiness = 0;
$totalAdvance = 0;
$totalBalance = 0;

foreach($reports as $row){

    $totalOrders += $row['total_orders'];
    $totalBusiness += $row['total_amount'];
    $totalAdvance += $row['advance'];
    $totalBalance += $row['balance'];

}

?>

    <!-- =======================================
            Summary Cards
    ======================================== -->

    <div class="row g-3 mb-4">

        <div class="col-lg-3">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center">

                    <small>Total Customers</small>

                    <h3><?= $totalCustomers ?></h3>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-success">

                <div class="card-body text-center">

                    <small>Total Orders</small>

                    <h3 class="text-success">

                        <?= $totalOrders ?>

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card shadow-sm border-primary">

                <div class="card-body text-center">

                    <small>Total Business</small>

                    <h4 class="text-primary">

                        Rs. <?= number_format($totalBusiness,2) ?>

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

    <!-- =======================================
            Customer Table
    ======================================== -->

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <strong>

                Customer Summary

            </strong>

            <button
                class="btn btn-success btn-sm"
                onclick="window.print()">

                <i class="fas fa-print"></i>

                Print

            </button>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">

                        <tr>

                            <th>#</th>

                            <th>Customer</th>

                            <th>Phone</th>

                            <th>Village</th>

                            <th>Total Orders</th>

                            <th>Total Amount</th>

                            <th>Advance</th>

                            <th>Balance</th>

                            <th width="140">

                                Action

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(empty($reports)): ?>

                        <tr>

                            <td colspan="9"
                                class="text-center text-muted">

                                No customers found.

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php foreach($reports as $i=>$row): ?>

                        <tr>

                            <td>

                                <?= $i+1 ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['full_name']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['phone']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['village']) ?>

                            </td>

                            <td>

                                <?= $row['total_orders'] ?>

                            </td>

                            <td>

                                Rs.
                                <?= number_format($row['total_amount'],2) ?>

                            </td>

                            <td>

                                Rs.
                                <?= number_format($row['advance'],2) ?>

                            </td>

                            <td>

                                <?php if($row['balance']>0): ?>

                                    <span class="badge bg-danger">

                                        Rs.
                                        <?= number_format($row['balance'],2) ?>

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-success">

                                        Paid

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <a
                                   href="index.php?page=customer-profile&id=<?= $row['id'] ?>"
                                   class="btn btn-primary btn-sm">

                                    <i class="fas fa-user"></i>

                                    Profile

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

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>