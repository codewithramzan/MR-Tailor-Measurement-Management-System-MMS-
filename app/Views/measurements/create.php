<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>




<div class="main-content">
  <div class="page-content">
    <div class="card shadow border-0">

    <div class="card-header bg-primary text-white">

    <h4>

    <i class="fas fa-ruler-combined"></i>

    Measurements

    </h4>

    </div>

    <div class="card-body">

    <!-- Customer Information -->

    <div class="row mb-4">

    <div class="col-md-3">

    <label class="fw-bold">

    Booking No

    </label>

    <input
    type="text"
    class="form-control"
    value="<?= $order['booking_no'] ?? '' ?>"
    readonly>

    </div>

    <div class="col-md-3">

    <label class="fw-bold">

    Customer

    </label>

    <input
    type="text"
    class="form-control"
    value="<?= $order['full_name'] ?? '' ?>"
    readonly>

    </div>

    <div class="col-md-3">

    <label class="fw-bold">

    Phone

    </label>

    <input
    type="text"
    class="form-control"
    value="<?= $order['phone'] ?? '' ?>"
    readonly>

    </div>

    <div class="col-md-3">

    <label class="fw-bold">

    Garment

    </label>

    <input
    type="text"
    class="form-control"
    value="<?= $order['garment_type'] ?? '' ?>"
    readonly>

    </div>

    </div>

    <hr>

    <form method="POST" action="index.php?page=save-measurements">

    <input
    type="hidden"
    name="order_id"
    value="<?= $order['id'] ?? '' ?>">

    <div class="row">

    <?php foreach($types as $type): ?>

    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">

    <label class="form-label">

    <?= $type['name'] ?>

    </label>

    <input
    type="text"
    name="measurements[<?= $type['id'] ?>]"
    class="form-control"
    placeholder="<?= $type['name'] ?>">

    </div>

    <?php endforeach; ?>

    </div>
    <hr class="my-4">

    <h4 class="mb-3">
    <i class="fas fa-cut"></i>
    Special Stitching Instructions
    </h4>

    <?php foreach($options as $category=>$items): ?>

    <div class="card mb-3">

    <div class="card-header bg-light">

    <strong><?= $category ?></strong>

    </div>

    <div class="card-body">

    <div class="row">

    <?php foreach($items as $item): ?>

    <div class="col-md-4 mb-2">

    <div class="form-check">

    <input
    class="form-check-input"
    type="checkbox"
    name="options[]"
    value="<?= $item['id'] ?>"
    id="option<?= $item['id'] ?>">

    <label
    class="form-check-label"
    for="option<?= $item['id'] ?>">

    <?= $item['urdu_name'] ?>

    </label>

    </div>

    </div>

    <?php endforeach; ?>

    </div>

    </div>

    </div>

    <?php endforeach; ?>
    <div class="text-end mt-4">

    <button class="btn btn-success btn-lg">

    <i class="fas fa-save"></i>

    Save Measurements

    </button>

    </div>

    </form>

    </div>

    </div>

    </div>

    </div>

  </div>
</div>


<?php require dirname(__DIR__)."/layouts/footer.php"; ?>