<?php require dirname(__DIR__) . "/layouts/header.php"; ?>
<?php require dirname(__DIR__) . "/layouts/navbar.php"; ?>
<?php require dirname(__DIR__) . "/layouts/sidebar.php"; ?>

<div class="container-fluid">

    <!-- Page Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">

                <i class="fas fa-cogs text-primary"></i>

                Shop Settings

            </h2>

            <p class="text-muted mb-0">

                Manage your tailoring shop information.

            </p>

        </div>

    </div>

    <!-- Flash Message -->

    <?php if (!empty($_SESSION['flash'])): ?>

        <div class="alert alert-<?= $_SESSION['flash']['type'] ?> alert-dismissible fade show">

            <?= htmlspecialchars($_SESSION['flash']['message']) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

        <?php unset($_SESSION['flash']); ?>

    <?php endif; ?>


    <form
        action="index.php?page=save-settings"
        method="POST"
        enctype="multipart/form-data">

        <div class="row">

            <!-- Left Column -->

            <div class="col-lg-8">

                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-header bg-primary text-white">

                        <h5 class="mb-0">

                            <i class="fas fa-store me-2"></i>

                            Shop Information

                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Shop Name

                                </label>

                                <input
                                    type="text"
                                    name="shop_name"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['shop_name'] ?? '') ?>"
                                    required>

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Owner Name

                                </label>

                                <input
                                    type="text"
                                    name="owner_name"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['owner_name'] ?? '') ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Phone

                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['phone'] ?? '') ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['email'] ?? '') ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Website

                                </label>

                                <input
                                    type="text"
                                    name="website"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['website'] ?? '') ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">

                                    Currency

                                </label>

                                <input
                                    type="text"
                                    name="currency"
                                    class="form-control"
                                    value="<?= htmlspecialchars($settings['currency'] ?? 'Rs.') ?>">

                            </div>

                            <div class="col-md-12 mb-3">

                                <label class="form-label">

                                    Address

                                </label>

                                <textarea
                                    name="address"
                                    rows="3"
                                    class="form-control"><?= htmlspecialchars($settings['address'] ?? '') ?></textarea>

                            </div>

                            <div class="col-md-12 mb-3">

                                <label class="form-label">

                                    Invoice Footer

                                </label>

                                <textarea
                                    name="invoice_footer"
                                    rows="3"
                                    class="form-control"><?= htmlspecialchars($settings['invoice_footer'] ?? '') ?></textarea>

                            </div>

                            <div class="col-md-12 mb-3">

                                <label class="form-label">

                                    Time Zone

                                </label>

                                <select
                                    name="timezone"
                                    class="form-select">

                                    <option value="Asia/Karachi"
                                        <?= ($settings['timezone'] ?? '') == 'Asia/Karachi' ? 'selected' : '' ?>>

                                        Asia/Karachi

                                    </option>

                                    <option value="UTC"
                                        <?= ($settings['timezone'] ?? '') == 'UTC' ? 'selected' : '' ?>>

                                        UTC

                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Right Column -->

            <div class="col-lg-4">

                <div class="card shadow-sm border-0">

                    <div class="card-header bg-success text-white">

                        <h5 class="mb-0">

                            <i class="fas fa-image me-2"></i>

                            Shop Logo

                        </h5>

                    </div>

                    <div class="card-body text-center">

                        <?php if (!empty($settings['logo'])): ?>

                            <img
                                src="uploads/logo/<?= htmlspecialchars($settings['logo']) ?>"
                                class="img-fluid rounded border mb-3"
                                style="max-height:180px;">

                        <?php else: ?>

                            <img
                                src="https://via.placeholder.com/180x180?text=No+Logo"
                                class="img-fluid rounded border mb-3">

                        <?php endif; ?>

                        <input
                            type="file"
                            name="logo"
                            class="form-control">

                        <small class="text-muted">

                            JPG, PNG, WEBP

                        </small>

                    </div>

                </div>

                <div class="d-grid mt-4">

                    <button
                        class="btn btn-primary btn-lg">

                        <i class="fas fa-save"></i>

                        Save Settings

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<?php require dirname(__DIR__) . "/layouts/footer.php"; ?>