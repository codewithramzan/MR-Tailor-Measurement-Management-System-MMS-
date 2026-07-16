<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>


<div class="main-content">

	<div class="page-content">

			<div class="card shadow-sm border-0 rounded-4">

				<div class="card-header bg-white border-0 py-3">
					<h4 class="mb-0">
						<i class="fas fa-users text-primary me-2"></i>
						Add New Customer
					</h4>
				</div>

				<div class="card-body">

					<!-- Your Form Starts Here -->

			<form method="POST" action="index.php?page=save-customer">

				<div class="row">

					<div class="col-md-6 mb-3">

						<label class="form-label">Booking Number
							<span class="required">*</span>
						</label>

						<input
						  type="text"
						  name="booking_no"
						  class="form-control"
						  value="<?php echo isset($bookingNo) ? $bookingNo : ''; ?>"
						  readonly>

					</div>

					<div class="col-md-6 mb-3">

						<label class="form-label">Phone Number
							<span class="required">*</span>
						</label>

						<input
							type="text"
							name="phone"
							class="form-control"
							required>

					</div>

					<div class="col-md-6 mb-3">

						<label class="form-label">Full Name
							<span class="required">*</span>
						</label>

						<input
							type="text"
							name="full_name"
							class="form-control"
							required>

					</div>

					<div class="col-md-6 mb-3">

						<label class="form-label">Father Name</label>

						<input
							type="text"
							name="father_name"
							class="form-control"
							required>

					</div>

					<div class="col-md-6 mb-3">

						<label class="form-label">Mohalla
							<span class="required">*</span>
						</label>

						<input
							type="text"
							name="mohalla"
							class="form-control">

					</div>

					<div class="col-md-6 mb-3">

						<label class="form-label">Village
							<span class="required">*</span>
						</label>

						<input
							type="text"
							name="village"
							class="form-control">

					</div>

				</div>

				<button class="btn btn-success rounded-pill px-4">

					Save & Continue

				</button>

			</form>
				</div>

			</div>

		</div>

	</div>

</div>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>