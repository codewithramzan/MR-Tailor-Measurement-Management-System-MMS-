<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>


    <div class="card form-card shadow-sm">

      <div class="card-header bg-white border-0">

        <h4 class="mb-0">

          <i class="fas fa-ruler-combined text-success"></i>

          Take Measurements

        </h4>

        <small class="text-muted">

          Enter customer measurements and stitching instructions.

        </small>

        </div>

        <div class="card-body">

        <!-- Customer Information -->

        <div class="row mb-4 g-3">

        <div class="col-md-3">

        <label class=" form-label">

        Booking No
        <span class="required">*</span>
        </label>

        <input
        type="text"
        class="form-control"
        value="<?= $order['booking_no'] ?? '' ?>"
        readonly>

        </div>

        <div class="col-md-3">

        <label class=" form-label">

        Customer
        <span class="required">*</span>
        </label>

        <input
        type="text"
        class="form-control"
        value="<?= $order['full_name'] ?? '' ?>"
        readonly>

        </div>

        <div class="col-md-3">

        <label class="form-label">

        Phone
        <span class="required">*</span>
        </label>

        <input
        type="text"
        class="form-control"
        value="<?= $order['phone'] ?? '' ?>"
        readonly>

        </div>

        <div class="col-md-3">

        <label class="form-label">

        Garment
        <span class="required">*</span>
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

            <!-- ===========================
          QAMEES MEASUREMENTS
      =========================== -->

      <div class="card shadow-sm border-0 mb-4">

          <div class="card-header bg-primary text-white">

              <i class="fas fa-shirt"></i>

              Qamees Measurements

          </div>

          <div class="card-body">

              <div class="row">

              <?php foreach($qameesMeasurements as $type): ?>

                  <div class="col-xl-3 col-lg-4 col-md-6 mb-3">

                      <label class="form-label fw-semibold">

                          <?= htmlspecialchars($type['urdu_name'] ?: $type['name']) ?>

                      </label>

                      <input
                          type="text"
                          class="form-control"
                          name="measurements[<?= $type['id'] ?>]"
                          value="<?= htmlspecialchars(OldInput::get('measurements')[$type['id']] ?? '') ?>"
                          placeholder="<?= htmlspecialchars($type['name'])?? '' ?>">

                  </div>

              <?php endforeach; ?>

              </div>

          </div>

      </div>
      <!-- ===========================
          SHALWAR MEASUREMENTS
      =========================== -->

      <div class="card shadow-sm border-0 mb-4">

          <div class="card-header bg-success text-white">

              <i class="fas fa-ruler"></i>

              Shalwar Measurements

          </div>

          <div class="card-body">

              <div class="row">

              <?php foreach($shalwarMeasurements as $type): ?>

                  <div class="col-xl-3 col-lg-4 col-md-6 mb-3">

                      <label class="form-label fw-semibold">

                          <?= htmlspecialchars($type['urdu_name']?: $type['name']) ?>

                      </label>

                      <input
                          type="text"
                          class="form-control"
                          name="measurements[<?= $type['id'] ?>]"
                          value="<?= htmlspecialchars(OldInput::get('measurements')[$type['id']] ?? '') ?>"
                          placeholder="<?= htmlspecialchars($type['name']) ?>">

                  </div>

              <?php endforeach; ?>

              </div>

          </div>

      </div>
        <hr class="my-4">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-warning text-dark">

                <h5 class="mb-0">

                    <i class="fas fa-cut me-2"></i>

                    Special Stitching Instructions

                </h5>

            </div>

            <div class="card-body">
        <div class="row">

        <?php foreach($options as $category => $items): ?>

        <div class="col-lg-6 mb-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-light">

                    <h6 class="mb-0">

                        <i class="fas fa-cut text-success me-2"></i>

                        <?= htmlspecialchars($category) ?>

                    </h6>

                </div>

                <div class="card-body">

                    <?php foreach($items as $item): ?>
                        <?php

                            $name = $item['selection_type'] == 'radio'
                                ? "options_radio[".$category."]"
                                : "options[]";

                            ?>

                        <div class="form-check mb-2">

                            <input
                                class="form-check-input"
                                type="<?= $item['selection_type'] ?>"
                                id="option<?= $item['id'] ?>"
                                name="<?= $name ?>"
                                value="<?= $item['id'] ?>"
                                <?= in_array($item['id'], OldInput::get('options', [])) ? 'checked' : '' ?>>

                            <label
                                class="form-check-label"
                                for="option<?= $item['id'] ?>">

                                <?= htmlspecialchars($item['urdu_name'] ?: $item['name']) ?>

                            </label>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

        </div>

        </div>

        </div>

        </div>
    </div>
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
    <?php OldInput::clear(); ?>
<?php require dirname(__DIR__)."/layouts/footer.php"; ?>