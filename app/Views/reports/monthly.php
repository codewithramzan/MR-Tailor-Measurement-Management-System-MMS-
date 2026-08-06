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

                <i class="fas fa-calendar-alt text-primary"></i>

                Monthly Report

            </h3>

            <small class="text-muted">

                View monthly business performance.

            </small>

        </div>

        <a href="index.php?page=reports"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Back

        </a>

    </div>

    <!-- ===========================
         Filter
    ============================ -->

    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form method="GET">

                <input
                    type="hidden"
                    name="page"
                    value="monthly-report">

                <div class="row">

                    <div class="col-md-3">

                        <label class="form-label">

                            Month

                        </label>

                        <select
                            name="month"
                            class="form-select">

                            <?php for($m=1;$m<=12;$m++): ?>

                                <option
                                    value="<?= $m ?>"

                                    <?= $month==$m ? 'selected':'' ?>>

                                    <?= date("F",mktime(0,0,0,$m,1)) ?>

                                </option>

                            <?php endfor; ?>

                        </select>

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">

                            Year

                        </label>

                        <select
                            name="year"
                            class="form-select">

                            <?php

                            for($y=date('Y')-5;$y<=date('Y')+2;$y++):

                            ?>

                                <option
                                    value="<?= $y ?>"

                                    <?= $year==$y ? 'selected':'' ?>>

                                    <?= $y ?>

                                </option>

                            <?php endfor; ?>

                        </select>

                    </div>

                    <div class="col-md-3 d-flex align-items-end  mt-sm-3 mb-lg-2">

                        <button
                            class="btn btn-primary">

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
         Summary
    ============================ -->

    <div class="row g-3 mb-4">

        <div class="col-lg-2">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <small>Orders</small>

                    <h3><?= $totalOrders ?></h3>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

            <div class="card border-success shadow-sm">

                <div class="card-body text-center">

                    <small>Total</small>

                    <h4 class="text-success">

                        Rs. <?= number_format($totalAmount,2) ?>

                    </h4>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

            <div class="card border-primary shadow-sm">

                <div class="card-body text-center">

                    <small>Advance</small>

                    <h4 class="text-primary">

                        Rs. <?= number_format($totalAdvance,2) ?>

                    </h4>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-warning shadow-sm">

                <div class="card-body text-center">

                    <small>Discount</small>

                    <h4 class="text-warning">

                        Rs. <?= number_format($totalDiscount,2) ?>

                    </h4>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-danger shadow-sm">

                <div class="card-body text-center">

                    <small>Balance</small>

                    <h4 class="text-danger">

                        Rs. <?= number_format($totalBalance,2) ?>

                    </h4>

                </div>

            </div>

        </div>

    </div>

    <!-- ===========================
         Table
    ============================ -->

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between">

            <strong>

                Monthly Orders

            </strong>

        <div class="btn-group">

            <button
                onclick="window.print()"
                class="btn btn-secondary btn-sm">

                <i class="fas fa-print"></i>

                Print

            </button>

            <a
                href="index.php?page=export&type=monthly&format=pdf&month=<?= urlencode($month) ?>&year=<?= urlencode($year) ?>"
                class="btn btn-danger btn-sm">

                <i class="fas fa-file-pdf"></i>

                PDF

            </a>

            <a
                href="index.php?page=export&type=monthly&format=excel&month=<?= urlencode($month) ?>&year=<?= urlencode($year) ?>"
                class="btn btn-success btn-sm">

                <i class="fas fa-file-excel"></i>

                Excel

            </a>

        </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-primary">

                        <tr>

                            <th>#</th>
                            <th>Booking</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Garment</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Advance</th>
                            <th>Discount</th>
                            <th>Balance</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(empty($reports)): ?>

                        <tr>

                            <td
                                colspan="11"
                                class="text-center">

                                No records found.

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php foreach($reports as $i=>$row): ?>

                        <tr>

                            <td><?= $i+1 ?></td>

                            <td><?= htmlspecialchars($row['booking_no']) ?></td>

                            <td><?= date("d M Y",strtotime($row['order_date'])) ?></td>

                            <td><?= htmlspecialchars($row['full_name']) ?></td>

                            <td><?= htmlspecialchars($row['phone']) ?></td>

                            <td><?= htmlspecialchars($row['garment_name'] ?? '') ?></td>

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

                                <?= number_format($row['discount'],2) ?>

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