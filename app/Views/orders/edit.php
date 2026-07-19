<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

      <div class="card shadow-sm form-card">

      <div class="card-header bg-white py-3 border-0">

      <h4>

      <i class="fas fa-edit"></i>

      Edit Order

      </h4>

      </div>

      <div class="card-body">

      <form method="POST" action="index.php?page=update-order">

      <input
      type="hidden"
      name="id"
      value="<?= $data['id'] ?? '' ?>">

      <div class="row g-3">

      <div class="col-md-6 mb-3">

      <label class="form-label">Garment Type</label>

      <input
      type="text"
      name="garment_type"
      class="form-control"
      value="<?= htmlspecialchars($data['garment_type'])  ?>">

      </div>

      <div class="col-md-6 mb-3">

      <label class="form-label">Quantity</label>

      <input
      type="number"
      name="quantity"
      class="form-control"
      value="<?= $data['quantity'] ?? 0 ?>">

      </div>

      <div class="col-md-6 mb-3">

      <label class="form-label">Delivery Date</label>

      <input
      type="date"
      name="delivery_date"
      class="form-control"
      value="<?= $data['delivery_date']?? '' ?>">

      </div>

      <div class="col-md-6 mb-3">

      <label class="form-label">Status</label>

      <select
      name="status"
      class="form-select">

      <option <?= $data['status']=="Pending"?"selected":"" ?>>
      Pending
      </option>

      <option <?= $data['status']=="Ready"?"selected":"" ?>>
      Ready
      </option>

      <option <?= $data['status']=="Delivered"?"selected":"" ?>>
      Delivered
      </option>

      </select>

      </div>

      <div class="col-md-4 mb-3">

      <label class="form-label">Total Amount</label>

      <input
      type="number"
      name="total_amount"
      class="form-control"
      value="<?= $data['total_amount']?? 0 ?>">

      </div>

      <div class="col-md-4 mb-3">

      <label class="form-label">Advance</label>

      <input
      type="number"
      name="advance"
      class="form-control"
      value="<?= $data['advance'] ?? 0 ?>">

      </div>

      <div class="col-md-4 mb-3">

      <label class="form-label">Discount</label>

      <input
      type="number"
      name="discount"
      class="form-control"
      value="<?= $data['discount']?? 0 ?>">

      </div>

      <div class="col-md-6 mb-3">

      <label class="form-label">Balance</label>

      <input
      type="number"
      name="balance"
      class="form-control"
      value="<?= $data['balance']?? 0 ?>">

      </div>

      <div class="col-md-6 mb-3">

      <label class="form-label">Notes</label>

      <textarea
      name="notes"
      class="form-control"
      rows="3"><?= htmlspecialchars($data['notes']) ?></textarea>

      </div>

      </div>

      <button class="btn btn-warning rounded-pill px-4">

      <i class="fas fa-save"></i>

      Update Order

      </button>

      <a
      href="index.php?page=orders"
      class="btn btn-secondary rounded-pill px-4">

      Back

      </a>

      </form>

      </div>

      </div>


<?php require dirname(__DIR__)."/layouts/footer.php"; ?>