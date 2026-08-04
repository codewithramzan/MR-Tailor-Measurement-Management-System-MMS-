<?php require_once "../app/Views/layouts/header.php"; ?>
<?php require_once "../app/Views/layouts/sidebar.php"; ?>
<?php require_once "../app/Views/layouts/navbar.php"; ?>

  <div class="container-fluid mt-4">

  <div class="card shadow border-0">

  <div class="card-header bg-success text-white">

    <h4 class="mb-0">

    <i class="fas fa-plus-circle me-2"></i>

    Add Measurement Field

    </h4>

    </div>

    <div class="card-body">

    <form action="index.php?page=update-measurement-type" method="POST">
      <input
      type="hidden"
      name="id"
      value="<?= $measurement['id'] ?? '' ?>">

    <div class="row">
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Garment Type
        </label>

        <select
            class="form-select"
            name="garment_type_id"
            required>

            <?php foreach($garments as $garment): ?>

                <option
                    value="<?= $garment['id'] ?>"
                    <?= $measurement['garment_type_id'] == $garment['id'] ? "selected" : "" ?>>

                    <?= htmlspecialchars($garment['garment_name']) ?>

                </option>

            <?php endforeach; ?>

        </select>

    </div>

  <div class="col-md-6 mb-3">

    <label class="form-label">

    Section

    </label>

    <input
    type="text"
    class="form-control"
    name="section"
    value="<?= htmlspecialchars($measurement['section'] ?? '') ?>">

  </div>
  <div class="col-md-6 mb-3">
    <label class="form-label">Section Urdu</label>

    <input
        type="text"
        class="form-control"
        name="section_urdu"
        value="<?= htmlspecialchars($measurement['section_urdu'] ?? '') ?>">
</div>
  <div class="col-md-6 mb-3">

    <label class="form-label">

    English Name

    </label>

    <input
    type="text"
    class="form-control"
    name="option_name"
    value="<?= htmlspecialchars($measurement['option_name'] ?? '') ?>"
    required>

  </div>
  <div class="col-md-6 mb-3">

    <label class="form-label">

    Urdu Name

    </label>

    <input
    type="text"
    class="form-control"
    name="urdu_name"
    value="<?= htmlspecialchars($measurement['urdu_name'] ?? '') ?>">

  </div>
  <div class="col-md-6 mb-3">

  <label class="form-label">

  Placeholder

  </label>

  <input
  type="text"
  class="form-control"
  name="placeholder"
  value="<?= htmlspecialchars($measurement['placeholder'] ?? '') ?>"
  placeholder="40">

  </div>
  <div class="col-md-6 mb-3">

    <label class="form-label">

    print Order

    </label>

    <input
    type="number"
    class="form-control"
    name="print_order"
    value="<?= htmlspecialchars($measurement['print_order'] ?? '') ?>"
    value="1">

  </div>
  <div class="col-md-6 mb-3">

    <label class="form-label">

    Status

    </label>
  <select

  class="form-select"
  name="status">


  <option

  value="Active"

  <?= $measurement['status']=="Active" ? "selected" : "" ?>>

  Active

  </option>

  <option

  value="Inactive"

  <?= $measurement['status']=="Inactive" ? "selected" : "" ?>>

  Inactive

  </option>

  </select>
  </div>
  <div class="col-12 mt-4">

  <button

  class="btn btn-primary"

  type="submit">

  <i class="fas fa-save"></i>

  Update Measurement

  </button>

  <a
  href="index.php?page=measurement-types"
  class="btn btn-secondary">

  Cancel

  </a>

  </div>

  </div>

  </form>

  </div>

  </div>

</div>
<?php require_once "../app/Views/layouts/footer.php"; ?>