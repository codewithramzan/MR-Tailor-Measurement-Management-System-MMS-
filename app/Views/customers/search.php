<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

<div class="main-content">
    <div class="page-content">

   <div class="card shadow-sm form-card ">

    <div class="card-header bg-primary text-white py-3">

        <h4 class="mb-0">
            <i class="fas fa-search"></i>
            Search Customer
        </h4>

    </div>

    <div class="card-body">

<!-- Search Form -->

<form method="GET" action="index.php">

    <input
        type="hidden"
        name="page"
        value="search-customer">

    <div class="row g-3">

        <div class="col-md-10">

            <input
                type="text"
                name="keyword"
                class="form-control"
                placeholder="Search by Name, Phone, Mohalla, Village">

        </div>

        <div class="col-md-2">

            <button
                class="btn btn-success w-100"
                type="submit">

                <i class="fas fa-search"></i>

                Search

            </button>

        </div>

    </div>

</form>

<hr>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="table-dark">

    <tr>

        <th>ID</th>

        <th>Name</th>

        <th>Phone</th>

        <th>Action</th>

    </tr>

</thead>

<tbody>

<?php if(!empty($customers)): ?>

    <?php foreach($customers as $row): ?>

        <tr>

            <td><?= $row['id']; ?></td>

            <td><?= $row['full_name']; ?></td>

            <td><?= $row['phone']; ?></td>

            <td>

                <a
                    href="index.php?page=create-order&customer_id=<?= $row['id']; ?>"
                    class="btn btn-primary btn-sm rounded-pill px-4">

                    <i class="fas fa-plus"></i>

                    New Booking

                </a>

            </td>

        </tr>

    <?php endforeach; ?>

<?php else: ?>

    <tr>

        <td colspan="4" class="text-center">

            No Customer Found

        </td>

    </tr>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

  </div>
 </div>
</div>
<?php require dirname(__DIR__)."/layouts/footer.php"; ?>