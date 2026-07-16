<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

<div class="main-content">

  <div class="page-content">

      <div class="card shadow border-0">

      <div class="card-header bg-warning text-dark">

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

      <div class="row">

      <div class="col-md-6 mb-3">

      <label>Garment Type</label>

      <input
      type="text"
      name="garment_type"
      class="form-control"
      value="<?= htmlspecialchars($data['garment_type'])  ?>">

      </div>

      <div class="col-md-6 mb-3">

      <label>Quantity</label>

      <input
      type="number"
      name="quantity"
      class="form-control"
      value="<?= $data['quantity'] ?? 0 ?>">

      </div>

      <div class="col-md-6 mb-3">

      <label>Delivery Date</label>

      <input
      type="date"
      name="delivery_date"
      class="form-control"
      value="<?= $data['delivery_date']?? '' ?>">

      </div>

      <div class="col-md-6 mb-3">

      <label>Status</label>

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

      <label>Total Amount</label>

      <input
      type="number"
      name="total_amount"
      class="form-control"
      value="<?= $data['total_amount']?? 0 ?>">

      </div>

      <div class="col-md-4 mb-3">

      <label>Advance</label>

      <input
      type="number"
      name="advance"
      class="form-control"
      value="<?= $data['advance'] ?? 0 ?>">

      </div>

      <div class="col-md-4 mb-3">

      <label>Discount</label>

      <input
      type="number"
      name="discount"
      class="form-control"
      value="<?= $data['discount']?? 0 ?>">

      </div>

      <div class="col-md-6 mb-3">

      <label>Balance</label>

      <input
      type="number"
      name="balance"
      class="form-control"
      value="<?= $data['balance']?? 0 ?>">

      </div>

      <div class="col-md-6 mb-3">

      <label>Notes</label>

      <textarea
      name="notes"
      class="form-control"
      rows="3"><?= htmlspecialchars($data['notes']) ?></textarea>

      </div>

      </div>

      <button class="btn btn-warning">

      <i class="fas fa-save"></i>

      Update Order

      </button>

      <a
      href="index.php?page=orders"
      class="btn btn-secondary">

      Back

      </a>

      </form>

      </div>

      </div>

  </div>

</div>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>