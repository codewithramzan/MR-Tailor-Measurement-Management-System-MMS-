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

        <div class="row mb-4">

            <div class="col-md-3">

                <label class="form-label fw-bold">Booking No</label>

                <input
                    type="text"
                    class="form-control"
                    readonly
                    value="<?= htmlspecialchars($order['booking_no'] ?? '') ?>">

            </div>

            <div class="col-md-3">

                <label class="form-label fw-bold">Customer</label>

                <input
                    type="text"
                    class="form-control"
                    readonly
                    value="<?= htmlspecialchars($order['full_name'] ?? '') ?>">

            </div>

            <div class="col-md-3">

                <label class="form-label fw-bold">Phone</label>

                <input
                    type="text"
                    class="form-control"
                    readonly
                    value="<?= htmlspecialchars($order['phone'] ?? '') ?>">

            </div>

            <div class="col-md-3">

                <label class="form-label fw-bold">Garment</label>

                <input
                    type="text"
                    class="form-control"
                    readonly
                    value="<?= htmlspecialchars($order['garment_type'] ?? '') ?>">

            </div>

        </div>

        <form method="POST" action="index.php?page=save-measurements">

            <input
                type="hidden"
                name="order_id"
                value="<?= $order['id'] ?? ''?>">

            <!-- ========================= -->
            <!-- Dynamic Measurement Groups -->
            <!-- ========================= -->

            <?php foreach($sections as $section => $items): ?>

                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-primary text-white">

                        <h5 class="mb-0">

                            <i class="fas fa-ruler me-2"></i>

                            <?= htmlspecialchars($section) ?>

                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <?php foreach($items as $type): ?>

                                <div class="col-xl-3 col-lg-4 col-md-6 mb-3">

                                    <label class="form-label fw-semibold">

                                        <?= htmlspecialchars(
                                            $type['urdu_name'] ?: $type['option_name']
                                        ) ?>

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        name="measurements[<?= $type['id'] ?>]"
                                        value="<?= htmlspecialchars(OldInput::get('measurements')[$type['id']] ?? '') ?>"
                                        placeholder="<?= htmlspecialchars($type['option_name']) ?>">

                                </div>

                            <?php endforeach; ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

            <!-- ========================= -->
            <!-- Stitching Instructions -->
            <!-- ========================= -->

            <div class="card shadow-sm border-0 mb-4">

                <div class="card-header bg-warning">

                    <h5 class="mb-0">

                        <i class="fas fa-cut me-2"></i>

                        Special Stitching Instructions

                    </h5>

                </div>

                <div class="card-body">

                    <div class="row">

                        <?php foreach($options as $category=>$items): ?>

                            <div class="col-lg-6 mb-4">

                                <div class="card h-100">

                                    <div class="card-header bg-light">

                                        <strong>

                                            <?= htmlspecialchars($category) ?>

                                        </strong>

                                    </div>

                                    <div class="card-body">

                                        <?php foreach($items as $item): ?>

                                            <?php

                                            $name = $item['selection_type']=="radio"
                                                ? "options_radio[$category]"
                                                : "options[]";

                                            ?>

                                            <div class="form-check mb-2">

                                                <input
                                                    class="form-check-input"
                                                    type="<?= $item['selection_type'] ?>"
                                                    id="option<?= $item['id'] ?>"
                                                    name="<?= $name ?>"
                                                    value="<?= $item['id'] ?>"

                                                    <?=
                                                    (
                                                        in_array(
                                                            $item['id'],
                                                            OldInput::get('options',[])
                                                        )
                                                    )
                                                    ? 'checked'
                                                    : ''
                                                    ?>>

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

            <div class="text-end">

                <button class="btn btn-success btn-lg">

                    <i class="fas fa-save"></i>

                    Save Measurements

                </button>

            </div>

        </form>

    </div>

</div>

<?php OldInput::clear(); ?>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>