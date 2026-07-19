<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

    <h3 class="fw-bold mb-4">
        Dashboard
    </h3>

    <!-- Statistics -->
    <div class="row g-4">

        <div class="col-xl-4 col-md-6">
            <div class="stat-card bg-customer">
                <h6>Total Customers</h6>
                <h2><?= $customers ?? 0 ?></h2>
                <i class="fas fa-users"></i>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="stat-card bg-booking">
                <h6>Total Bookings</h6>
                <h2><?= $bookings ?? 0 ?></h2>
                <i class="fas fa-receipt"></i>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="stat-card bg-pending">
                <h6>Pending Orders</h6>
                <h2><?= $pending ?? 0 ?></h2>
                <i class="fas fa-clock"></i>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card ready-card shadow border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Ready</h6>
                        <h2><?= $ready ?? 0 ?></h2>
                    </div>
                    <i class="fas fa-check fa-3x"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card delivery-card shadow border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Delivered</h6>
                        <h2><?= $delivered ?? 0 ?></h2>
                    </div>
                    <i class="fas fa-truck fa-3x"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card income-card shadow border-0">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Income</h6>
                        <h2>Rs. <?= number_format($income ?? 0) ?></h2>
                    </div>
                    <i class="fas fa-money-bill-wave fa-3x"></i>
                </div>
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

                <div class="card-body">

                    <canvas id="bookingChart"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card shadow">

                <div class="card-header">

                    Order Status

                </div>

                <div class="card-body">

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

                            <span class="badge bg-success">

                                <?= $row['status'] ?>

                            </span>

                        </td>

                        <td>

                            Rs. <?= number_format($row['total_amount']) ?>

                        </td>

                        <td>

                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i>
                            </button>

                            <button class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button class="btn btn-success btn-sm">
                                <i class="fas fa-print"></i>
                            </button>

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

new Chart(document.getElementById("bookingChart"),{
    type:"line",
    data:{
        labels:["Jan","Feb","Mar","Apr","May","Jun"],
        datasets:[{
            label:"Bookings",
            data:[5,8,12,15,18,25],
            borderWidth:3,
            fill:true
        }]
    }
});

new Chart(document.getElementById("statusChart"),{
    type:"doughnut",
    data:{
        labels:["Pending","Ready","Delivered"],
        datasets:[{
            data:[12,8,25]
        }]
    }
});

</script>

<?php require dirname(__DIR__)."/layouts/footer.php"; ?>