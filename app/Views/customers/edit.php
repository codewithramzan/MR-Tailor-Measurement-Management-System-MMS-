
<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

     <div class="card form-card shadow-sm">

        <div class="card-header bg-white py-3 border-0">

            <h4>
                <i class="fas fa-user-edit"></i>
                Edit Customer
            </h4>

        </div>

        <div class="card-body">

            <form method="POST" action="index.php?page=update-customer">

                <!-- Hidden ID -->
                <input
                    type="hidden"
                    name="id"
                    value="<?= $customer['id'] ?? 0 ?>">

                <div class="row g-3">

                    <!-- Booking Number -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Booking Number</label>

                        <input
                            type="text"
                            name="booking_no"
                            class="form-control"
                             value="<?= htmlspecialchars($customer['booking_no']) ?? '' ?>"
                            readonly>

                    </div>

                    <!-- Phone -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Phone Number</label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="<?= htmlspecialchars($customer['phone']) ?? 0 ?>"
                            required>

                    </div>

                    <!-- Full Name -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Full Name</label>

                        <input
                            type="text"
                            name="full_name"
                            class="form-control"
                            value="<?= htmlspecialchars($customer['full_name'])?? ''?>"
                            required>

                    </div>

                    <!-- Father Name -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Father Name</label>

                        <input
                            type="text"
                            name="father_name"
                            class="form-control"
                            value="<?= htmlspecialchars($customer['father_name']) ?? '' ?>"
                            required>

                    </div>

                    <!-- Mohalla -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Mohalla</label>

                        <input
                            type="text"
                            name="mohalla"
                            class="form-control"
                            value="<?= htmlspecialchars($customer['mohalla']) ?? '' ?>">

                    </div>

                    <!-- Village -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">Village</label>

                        <input
                            type="text"
                            name="village"
                            class="form-control"
                            value="<?= htmlspecialchars($customer['village']) ?? '' ?>">

                    </div>

                </div>

                <div class="mt-3">

                    <button type="submit" class="btn btn-warning rounded-pill px-4">

                        <i class="fas fa-save"></i>

                        Update Customer

                    </button>

                    <a href="index.php?page=customers" class="btn btn-secondary rounded-pill px-4">

                        <i class="fas fa-arrow-left"></i>

                        Back

                    </a>

                </div>

            </form>

        </div>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>