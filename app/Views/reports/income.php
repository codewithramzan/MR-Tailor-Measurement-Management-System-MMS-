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

								<i class="fas fa-money-bill-wave text-success"></i>

								Income Report

						</h3>

						<small class="text-muted">

								View income between any selected dates.

						</small>

				</div>

				<a href="index.php?page=reports"
					 class="btn btn-secondary">

						<i class="fas fa-arrow-left"></i>

						Back

				</a>

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
										value="income-report">

								<div class="row">

										<div class="col-md-4">

												<label class="form-label">

														From Date

												</label>

												<input
														type="date"
														name="from"
														class="form-control"
														value="<?= htmlspecialchars($from) ?>">

										</div>

										<div class="col-md-4">

												<label class="form-label">

														To Date

												</label>

												<input
														type="date"
														name="to"
														class="form-control"
														value="<?= htmlspecialchars($to) ?>">

										</div>

										<div class="col-md-4 d-flex align-items-end">

												<button class="btn btn-success mb-2">

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
				 Summary Cards
		============================ -->

		<div class="row g-3 mb-4">

				<div class="col-lg-3">

						<div class="card shadow-sm">

								<div class="card-body text-center">

										<small>Total Orders</small>

										<h2><?= $totalOrders ?></h2>

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
				 Income Table
		============================ -->

		<div class="card shadow-sm">

				<div class="card-header d-flex justify-content-between align-items-center">

						<strong>

								Income Details

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
														<th>Booking</th>
														<th>Date</th>
														<th>Customer</th>
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

														<td colspan="10" class="text-center">

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

																<?= number_format($row['discount'],2) ?>

														</td>

														<td>

																<?php if($row['balance'] > 0): ?>

																		<span class="text-danger fw-bold">

																				<?= number_format($row['balance'],2) ?>

																		</span>

																<?php else: ?>

																		<span class="text-success fw-bold">

																				Paid

																		</span>

																<?php endif; ?>

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