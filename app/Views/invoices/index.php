<?php require dirname(__DIR__) . "/layouts/header.php"; ?>
<?php require dirname(__DIR__) . "/layouts/navbar.php"; ?>
<?php require dirname(__DIR__) . "/layouts/sidebar.php"; ?>

<div class="container-fluid">

    <!-- Page Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">

                <i class="fas fa-file-invoice-dollar text-success"></i>

                Invoice Management

            </h3>

            <p class="text-muted mb-0">

                View and print customer invoices.

            </p>

        </div>

    </div>

    <!-- Flash Message -->

    <?php Flash::display(); ?>

    <!-- Invoice Table -->

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Invoice List

            </h5>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table
                    id="invoiceTable"
                    class="table table-hover table-bordered align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Invoice No</th>

                            <th>Booking No</th>

                            <th>Customer</th>

                            <th>Phone</th>

                            <th>Garment</th>

                            <th>Total</th>

                            <th>Advance</th>

                            <th>Balance</th>

                            <th>Status</th>

                            <th width="180">

                                Action

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(!empty($invoices)): ?>

                        <?php foreach($invoices as $index=>$row): ?>

                        <?php

                        if($row['balance']<=0){

                            $paymentBadge='success';
                            $paymentText='Paid';

                        }elseif($row['advance']>0){

                            $paymentBadge='warning';
                            $paymentText='Partial';

                        }else{

                            $paymentBadge='danger';
                            $paymentText='Pending';
                        }

                        ?>

                        <tr>

                            <td>

                                <?= $index+1 ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['invoice_no'] ?: '-') ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['booking_no']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['full_name']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['phone']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($row['garment_type']) ?>

                            </td>

                            <td>

                                <?= Config::get('currency') ?>

                                <?= number_format($row['total_amount'],2) ?>

                            </td>

                            <td>

                                <?= Config::get('currency') ?>

                                <?= number_format($row['advance'],2) ?>

                            </td>

                            <td>

                                <?= Config::get('currency') ?>

                                <?= number_format($row['balance'],2) ?>

                            </td>

                            <td>

                                <span class="badge bg-<?= $paymentBadge ?>">

                                    <?= $paymentText ?>

                                </span>

                            </td>

                            <td>

                                <a
                                    href="index.php?page=view-invoice&id=<?= $row['id'] ?>"
                                    class="btn btn-primary btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a
                                    href="index.php?page=print-invoice&id=<?= $row['id'] ?>"
                                    class="btn btn-success btn-sm"
                                    target="_blank">

                                    <i class="fas fa-print"></i>

                                </a>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="11"
                                class="text-center text-muted py-4">

                                No invoices found.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded",function(){

    if(typeof $!=="undefined" && $.fn.DataTable){

        $("#invoiceTable").DataTable({

            pageLength:10,

            order:[[0,"desc"]],

            responsive:true

        });

    }

});

</script>

<?php require dirname(__DIR__) . "/layouts/footer.php"; ?>