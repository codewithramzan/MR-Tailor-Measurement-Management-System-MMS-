<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

<div class="container-fluid">

	<!-- ===========================
		 Page Header
	============================ -->

	<div class="d-flex justify-content-between align-items-center mb-4">

		<div>

			<h3 class="fw-bold mb-1">

				<i class="fas fa-chart-line text-success"></i>

				Reports Dashboard

			</h3>

			<small class="text-muted">

				View business reports and analytics.

			</small>

		</div>

	</div>

	<!-- ===========================
		 Summary Cards
	============================ -->

	<div class="row g-4 mb-4">

		<div class="col-xl-3 col-md-6">

			<div class="card border-0 shadow-sm">

				<div class="card-body">

					<div class="d-flex justify-content-between">

						<div>

							<small class="text-muted">

								Customers

							</small>

							<h3>

								<?= $summary['totalCustomers'] ?? 'undefined' ?>

							</h3>

						</div>

						<i class="fas fa-users fa-2x text-primary"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6">

			<div class="card border-0 shadow-sm">

				<div class="card-body">

					<div class="d-flex justify-content-between">

						<div>

							<small class="text-muted">

								Orders

							</small>

							<h3>

								<?= $summary['totalOrders'] ?? 'undefined' ?>

							</h3>

						</div>

						<i class="fas fa-receipt fa-2x text-success"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6">

			<div class="card border-0 shadow-sm">

				<div class="card-body">

					<div class="d-flex justify-content-between">

						<div>

							<small class="text-muted">

								Pending

							</small>

							<h3>

								<?= $summary['pendingOrders'] ?? 'undefined' ?>

							</h3>

						</div>

						<i class="fas fa-clock fa-2x text-warning"></i>

					</div>

				</div>

			</div>

		</div>

		<div class="col-xl-3 col-md-6">

			<div class="card border-0 shadow-sm">

				<div class="card-body">

					<div class="d-flex justify-content-between">

						<div>

							<small class="text-muted">

								Delivered

							</small>

							<h3>

								<?= $summary['deliveredOrders'] ?? 'undefined' ?>

							</h3>

						</div>

						<i class="fas fa-check-circle fa-2x text-info"></i>

					</div>

				</div>

			</div>

		</div>

	</div>

	<!-- ===========================
		 Income Cards
	============================ -->

	<div class="row g-4 mb-4">

		<div class="col-lg-4">

			<div class="card shadow-sm border-success">

				<div class="card-body text-center">

					<h6>

						Today's Income

					</h6>

					<h2 class="text-success">

						Rs.
						<?= number_format($summary['todayIncome'] ?? 'undefined',2) ?>

					</h2>

				</div>

			</div>

		</div>

		<div class="col-lg-4">

			<div class="card shadow-sm border-primary">

				<div class="card-body text-center">

					<h6>

						Monthly Income

					</h6>

					<h2 class="text-primary">

						Rs.
						<?= number_format($summary['monthlyIncome'] ?? 'undefined',2) ?>

					</h2>

				</div>

			</div>

		</div>

		<div class="col-lg-4">

			<div class="card shadow-sm border-danger">

				<div class="card-body text-center">

					<h6>

						Outstanding Balance

					</h6>

					<h2 class="text-danger">

						Rs.
						<?= number_format($summary['totalBalance'] ?? 'undefined',2) ?>

					</h2>

				</div>

			</div>

		</div>

	</div>

	<!-- ===========================
		 Charts
	============================ -->

	<div class="row mb-4">

		<div class="col-lg-6">

			<div class="card shadow-sm " >

				<div class="card-header">

					Monthly Income

				</div>

				<div class="card-body " style="height: 300px;">

					<canvas id="incomeChart"></canvas>

				</div>

			</div>

		</div>

		<div class="col-lg-6 mb-4">

			<div class="card shadow" >

				<div class="card-header">

					Order Status

				</div>

				<div class="card-body d-flex justify-content-center" style="height: 300px;" width="330px">

					<canvas id="statusChart"></canvas>

				</div>

			</div>

		</div>

	</div>

	<!-- ===========================
		 Quick Reports
	============================ -->

	<div class="card shadow-sm">

		<div class="card-header">

			Quick Reports

		</div>

		<div class="card-body">

			<div class="row g-3">

				<div class="col-lg-3">

					<a href="index.php?page=daily-report" class="btn btn-outline-success w-100">

						Daily Report

					</a>

				</div>

				<div class="col-lg-3">

					<a href="index.php?page=monthly-report" class="btn btn-outline-primary w-100">

						Monthly Report

					</a>

				</div>

				<div class="col-lg-3">

					<a href="index.php?page=customer-report" class="btn btn-outline-info w-100">

						Customer Report

					</a>

				</div>

				<div class="col-lg-3">

					<a href="index.php?page=income-report" class="btn btn-outline-dark w-100">

						Income Report

					</a>

				</div>

				<div class="col-lg-3">

					<a href="index.php?page=pending-report" class="btn btn-outline-warning w-100">

						Pending Orders

					</a>

				</div>

				<div class="col-lg-3">

					<a href="index.php?page=ready-report" class="btn btn-outline-secondary w-100">

						Ready Orders

					</a>

				</div>

				<div class="col-lg-3">

					<a href="index.php?page=delivered-report" class="btn btn-outline-success w-100">

						Delivered Orders

					</a>

				</div>

				<div class="col-lg-3">

					<a href="index.php?page=invoice-report" class="btn btn-outline-danger w-100">

						Invoice Report

					</a>

				</div>

			</div>

		</div>

	</div>

</div>

<script>

new Chart(document.getElementById("statusChart"),{

	type:"doughnut",

	data:{

		labels:["Pending","Ready","Delivered"],

		datasets:[{

			data:[

				<?= $summary['pendingOrders'] ??'pending orders' ?>,

				<?= $summary['readyOrders'] ?? 'ready orders' ?>,

				<?= $summary['deliveredOrders'] ?? 'delivered orders' ?>

			]

		}]

	}

});

new Chart(document.getElementById("incomeChart"),{

	type:"bar",

	data:{

		labels:["Today","Month"],

		datasets:[{

			label:"Income",

			data:[

				<?= $summary['todayIncome'] ?? 'undefined' ?>,

				<?= $summary['monthlyIncome'] ?? 'undefined' ?>

			]

		}]

	}

});

</script>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>