<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>


	<div class="card shadow-sm form-card">

	 <div class="card-header bg-white py-3 border-0">

	<h4>Create New Booking</h4>

	</div>

	<div class="card-body">
		<form method="POST" action="index.php?page=save-order">

		<input
		type="hidden"
		name="customer_id"
		value="<?= $customer['id'] ?? '' ?>">

		<div class="row g-3">

			<!-- Customer -->

			<div class="col-md-4 mb-3">

				<label class="form-label">Booking No
					<span class="required">*</span>
				</label>

				<input
				type="text"
				name="booking_no"
				class="form-control"
				value="<?= $customer['booking_no'] ?? '' ?>"
				readonly>

			</div>

			<div class="col-md-4 mb-3">

				<label class="form-label">Customer Name
					<span class="required">*</span>
				</label>

				<input
				type="text"
				class="form-control"
				value="<?= $customer['full_name'] ?? '' ?>"
				readonly>

			</div>

			<div class="col-md-4 mb-3">

				<label class="form-label">Phone
					<span class="required">*</span>
				</label>

				<input
				type="text"
				class="form-control"
				value="<?= $customer['phone'] ?? '' ?>"
				readonly>

			</div>

			<!-- Garment -->

			<div class="col-md-4 mb-3">

				<label>Garment Type
					<span class="required">*</span>
				</label>

					<select
						name="garment_type_id"
						class="form-select"
						required>

					<option value="">Select Garment</option>

						<?php foreach ($garments as $garment): ?>

						<option
								value="<?= $garment['id']; ?>"

								<?= OldInput::get('garment_type_id') == $garment['id']
										? 'selected'
										: ''; ?>>

						<?= htmlspecialchars($garment['name']); ?>

						</option>

						<?php endforeach; ?>

			</select>

					</div>

				<div class="col-md-2 mb-3">

					<label class="form-label">Quantity
						<span class="required">*</span>
					</label>

				<input
				type="number"
				id="quantity"
				name="quantity"
				class="form-control"
				value="<?= htmlspecialchars(OldInput::get('quantity')) ?? 1 ?>">

				</div>

				<div class="col-md-3 mb-3">

					<label class="form-label">Order Date
						<span class="required">*</span>
					</label>

					<input
					type="date"
					name="order_date"
					value="<?= date('Y-m-d') ?>"
					class="form-control">

				</div>

				<div class="col-md-3 mb-3">

					<label class="form-label">Delivery Date
						<span class="required">*</span>
					</label>
					<input
					type="date"
					name="delivery_date"
					class="form-control"
					value="<?= htmlspecialchars(OldInput::get('delivery_date')) ?>">

				</div>

				<!-- Payment -->

				<div class="col-md-3 mb-3">

					<label class="form-label">Total Amount
						(<?= Config::get("currency") ?>)
						<span class="required">*</span>
					</label>

				<input
				type="number"
				id="total"
				name="total_amount"
				class="form-control"
				value="<?= htmlspecialchars(OldInput::get('total_amount')) ?? 0 ?>">

				</div>

				<div class="col-md-3 mb-3">

					<label class="form-label">Advance
						(<?= Config::get("currency") ?>)
					</label>

					<input
					type="number"
					id="advance"
					name="advance"
					class="form-control"
					value="<?= htmlspecialchars(OldInput::get('advance')) ?? 0?>">

				</div>

				<div class="col-md-3 mb-3">

					<label class="form-label">Discount(
						<?= Config::get("currency") ?>)
					</label>

					<input
					type="number"
					id="discount"
					name="discount"
					class="form-control"
					value="<?= htmlspecialchars(OldInput::get('discount'))??0 ?>">

				</div>

				<div class="col-md-3 mb-3">

					<label class="form-label">Remaining
						(<?= Config::get("currency") ?>)
					</label>

					<input
					id="balance"
					type="number"
					name="balance"
					readonly
					class="form-control">

				</div>

				<!-- Status -->

				<div class="col-md-4 mb-3">

					<label class="form-label">Status
						<span class="required">*</span>
					</label>

					<select
					name="status"
					class="form-select">

						<option>Pending</option>

						<option>Ready</option>

						<option>Delivered</option>

					</select>

				</div>

				<!-- Notes -->

				<div class="col-md-8 mb-3">

					<label>Special Notes</label>

					<textarea
					name="notes"
					class="form-control"><?= htmlspecialchars(OldInput::get('notes')) ?></textarea>

				</div>

				</div>

				<button class="btn btn-primary rounded-pill px-4">

				<i class="fas fa-save"></i>

				Save Booking

				</button>

				<a
				href="index.php?page=customers"
				class="btn btn-secondary rounded-pill px-4">

				Back

				</a>

				</form>

	 </div>

<script src="<?= BASE_URL ?>assets/js/order.js"></script>
<?php OldInput::clear(); ?>
<?php require dirname(__DIR__)."/layouts/footer.php"; ?>