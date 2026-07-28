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

                <i class="fas fa-file-invoice-dollar text-success"></i>

                Invoice Report

            </h3>

            <small class="text-muted">

                View all customer invoices and payment details.

            </small>

        </div>

        <a href="index.php?page=reports"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Back

        </a>

    </div>

    <!-- ===========================
            Filters
    ============================ -->

    <div class="card shadow-sm mb-4">

        <div class="card-body">

            <form method="GET">

                <input
                    type="hidden"
                    name="page"
                    value="invoice-report">

                <div class="row">

                    <div class="col-md-3">

                        <label class="form-label">

                            From Date

                        </label>

                        <input
                            type="date"
                            name="from"
                            class="form-control"
                            value="<?= htmlspecialchars($from) ?>">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">

                            To Date

                        </label>

                        <input
                            type="date"
                            name="to"
                            class="form-control"
                            value="<?= htmlspecialchars($to) ?>">

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="">All</option>

                            <option value="Pending"
                                <?= $status=="Pending"?'selected':'' ?>>

                                Pending

                            </option>

                            <option value="Ready"
                                <?= $status=="Ready"?'selected':'' ?>>

                                Ready

                            </option>

                            <option value="Delivered"
                                <?= $status=="Delivered"?'selected':'' ?>>

                                Delivered

                            </option>

                        </select>

                    </div>

                    <div class="col-md-3 d-flex align-items-end">

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

$totalInvoices = count($reports);

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

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <small>Total Invoices</small>

                    <h2><?= $totalInvoices ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3">

            <div class="card border-success shadow-sm">

                <div class="card-body text-center">

                    <small>Total Amount</small>

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

        <div class="col-lg-2">

            <div class="card border-warning shadow-sm">

                <div class="card-body text-center">

                    <small>Discount</small>

                    <h4 class="text-warning">

                        Rs. <?= number_format($totalDiscount,2) ?>

                    </h4>

                </div>

            </div>

        </div>

        <div class="col-lg-2">

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
            Invoice Table
    ============================ -->

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <strong>

                Invoice List

            </strong>

            <div class="btn-group">

                <button
                    onclick="window.print()"
                    class="btn btn-secondary btn-sm">

                    <i class="fas fa-print"></i>

                    Print

                </button>

                <a
                 href="index.php?page=export&type=invoice&format=pdf&from=<?= urlencode($from) ?>&to=<?= urlencode($to) ?>&status=<?= urlencode($status) ?>"
                    class="btn btn-danger btn-sm">

                    <i class="fas fa-file-pdf"></i>

                    PDF

                </a>

                <a
                 href="index.php?page=export&type=invoice&format=excel&from=<?= urlencode($from) ?>&to=<?= urlencode($to) ?>&status=<?= urlencode($status) ?>"
                    class="btn btn-success btn-sm">

                    <i class="fas fa-file-excel"></i>

                    Excel

                </a>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-success">

                        <tr>

                            <th>#</th>
                            <th>Invoice No</th>
                            <th>Booking</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Advance</th>
                            <th>Discount</th>
                            <th>Balance</th>
                            <th width="160">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(empty($reports)): ?>

                        <tr>

                            <td colspan="11"
                                class="text-center text-muted">

                                No invoices found.

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php foreach($reports as $i=>$row): ?>

                        <tr>

                            <td><?= $i+1 ?></td>

                            <td><?= htmlspecialchars($row['invoice_no']) ?></td>

                            <td><?= htmlspecialchars($row['booking_no']) ?></td>

                            <td><?= htmlspecialchars($row['full_name']) ?></td>

                            <td><?= htmlspecialchars($row['phone']) ?></td>

                            <td>

                                <?php  $badge = $this->getStatusColor($row['status'])  ?>
																                    <span class="badge bg-<?= $badge ?>">

                                    <?= htmlspecialchars($row['status']) ?>

                                </span>

                            </td>

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

                                <?php if($row['balance']>0): ?>

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

                                <a
                                    href="index.php?page=invoice&id=<?= $row['id'] ?>"
                                    class="btn btn-primary btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a
                                    href="index.php?page=print-invoice&id=<?= $row['id'] ?>"
                                    class="btn btn-success btn-sm">

                                    <i class="fas fa-print"></i>

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                    <tfoot class="table-light fw-bold">

                        <tr>

                            <td colspan="6" class="text-end">

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