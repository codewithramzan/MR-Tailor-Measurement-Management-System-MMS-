<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

    <h3 class="fw-bold mb-4">
        Dashboard
    </h3>

    <!-- Statistics -->
    <div class="row g-4">

        <div class="col-xl-4 col-md-6">
            <a href="index.php?page=customers" class="text-decoration-none text-dark">
            <div class="stat-card bg-customer">
                <h6>Total Customers</h6>
                <h2><?= $customers ?? 0 ?></h2>
                <i class="fas fa-users"></i>
            </div>
           </a>
        </div>

        <div class="col-xl-4 col-md-6">
            <a href="index.php?page=orders" class="text-decoration-none text-dark">
                <div class="stat-card bg-booking">
                <h6>Total Bookings</h6>
                <h2><?= $bookings ?? 0 ?></h2>
                <i class="fas fa-receipt"></i>
            </div>
          </a>
        </div>

        <div class="col-xl-4 col-md-6">
            <a href="index.php?page=orders&status=Pending" class="text-decoration-none text-dark">
            <div class="stat-card bg-pending">
                <h6>Pending Orders</h6>
                <h2><?= $pending ?? 0 ?></h2>
                <i class="fas fa-clock"></i>
            </div>
        </a>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card ready-card shadow border-0">
                <a href="index.php?page=orders&status=Ready" class="text-decoration-none text-dark">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Ready</h6>
                        <h2><?= $ready ?? 0 ?></h2>
                    </div>
                    <i class="fas fa-check fa-3x"></i>
                </div>
             </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card delivery-card shadow border-0">
                <a href="index.php?page=orders&status=Delivered" class="text-decoration-none text-dark">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Delivered</h6>
                        <h2><?= $delivered ?? 0 ?></h2>
                    </div>
                    <i class="fas fa-truck fa-3x"></i>
                </div>
              </a>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card income-card shadow border-0">
                <a href="index.php?page=orders" class="text-decoration-none text-dark">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Income</h6>
                        <h2>Rs. <?= number_format($income ?? 0) ?></h2>
                    </div>
                    <i class="fas fa-money-bill-wave fa-3x"></i>
                </div>
                </a>
            </div>
        </div>

    </div>

    <!-- Search -->
    <div class="card shadow mt-4">
        <div class="card-body">

            <h5>
                <i class="fas fa-search"></i>
                Quick Customer Search
            </h5>

            <form method="GET">

                <input type="hidden" name="page" value="search-customer">

                <div class="input-group mt-3">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Booking No, Name or Phone">

                    <button class="btn btn-success">
                        Search
                    </button>

                </div>

            </form>

        </div>
    </div>

    <!-- Charts -->
    <div class="row mt-4 g-3">

        <div class="col-lg-6 mb-4">

            <div class="card shadow">

                <div class="card-header">

                    Monthly Bookings

                </div>

                <div class="card-body" style="height: 300px;">

                    <canvas id="bookingChart"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card shadow">

                <div class="card-header">

                    Order Status

                </div>

                <div class="card-body" style="height: 300px;">

                    <canvas id="statusChart"></canvas>

                </div>

            </div>

        </div>

    </div>

    <!-- Recent Bookings -->

    <div class="card shadow">

        <div class="card-header">

            Recent Bookings

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>Booking</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php if(!empty($recent)): ?>

                    <?php foreach($recent as $row): ?>

                    <tr>

                        <td><?= $row['booking_no'] ?></td>

                        <td><?= $row['full_name'] ?></td>

                        <td>

                            <?php

                                $statusClass = "bg-secondary";

                                switch ($row['status']) {

                                    case "Pending":
                                        $statusClass = "bg-warning text-dark";
                                        break;

                                    case "Ready":
                                        $statusClass = "bg-primary";
                                        break;

                                    case "Delivered":
                                        $statusClass = "bg-success";
                                        break;
                                }

                                ?>

                                <span class="badge <?= $statusClass ?>">
                                    <?= $row['status'] ?>
                                </span>

                        </td>

                        <td>

                            Rs. <?= number_format($row['total_amount']) ?>

                        </td>

                        <td>

                        <a href="index.php?page=view-order&id=<?= $row['id'] ?>"
                        class="btn btn-primary btn-sm"
                        title="View">

                            <i class="fas fa-eye"></i>

                        </a>

                        <a href="index.php?page=edit-order&id=<?= $row['id'] ?>"
                        class="btn btn-warning btn-sm"
                        title="Edit">

                            <i class="fas fa-edit"></i>

                        </a>

                        <a href="index.php?page=print-measurement&id=<?= $row['id'] ?>"
                        class="btn btn-success btn-sm"
                        title="Print">

                            <i class="fas fa-print"></i>

                        </a>

                    </td>

                    </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="5" class="text-center">

                            No Bookings Found

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>


<script>

    new Chart(document.getElementById("bookingChart"), {
        type: "line",
        data: {
            labels: <?= json_encode($monthlyChart['labels']) ?>,
            datasets: [{
                label: "Bookings",
                data: <?= json_encode($monthlyChart['data']) ?>,
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    new Chart(document.getElementById("statusChart"), {
        type: "doughnut",
        data: {
            labels: <?= json_encode(array_keys($statusChart)) ?>,
            datasets: [{
                data: <?= json_encode(array_values($statusChart)) ?>
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

</script>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>