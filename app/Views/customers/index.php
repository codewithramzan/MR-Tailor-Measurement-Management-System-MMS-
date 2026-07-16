<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>




    <div class="main-content">

      <div class="page-content">
        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <div class="d-flex justify-content-between align-items-center">

                    <h4 class="mb-0">
                        <i class="fas fa-users text-primary"></i>
                        Manage Customers
                    </h4>

                    <a href="index.php?page=add-customer"
                       class="btn btn-success">

                        <i class="fas fa-plus"></i>

                        Add Customer

                    </a>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead class="table-dark">

                            <tr>
                                <th>#</th>
                                <th>Booking</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Village</th>
                                <th>Action</th>
                            </tr>

                        </thead>

                        <tbody>

                        <?php if(!empty($customers)): ?>

                            <?php foreach($customers as $index=>$row): ?>

                                <tr>

                                    <td><?= $index+1 ?></td>

                                    <td><?= $row['booking_no'] ?></td>

                                    <td><?= $row['full_name'] ?></td>

                                    <td><?= $row['phone'] ?></td>

                                    <td><?= $row['village'] ?></td>

                                    <td>

                                        <!-- New Booking -->
                                        <a
                                            href="index.php?page=create-order&customer_id=<?= $row['id'] ?>"
                                            class="btn btn-primary btn-sm"
                                            title="New Booking">

                                            <i class="fas fa-plus"></i>

                                        </a>

                                        <!-- View -->
                                        <a
                                            href="index.php?page=view-customer&id=<?= $row['id'] ?>"
                                            class="btn btn-info btn-sm"
                                            title="View">

                                            <i class="fas fa-eye"></i>

                                        </a>

                                        <!-- Edit -->
                                        <a
                                            href="index.php?page=edit-customer&id=<?= $row['id'] ?>"
                                            class="btn btn-warning btn-sm"
                                            title="Edit">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <!-- Delete -->
                                        <a
                                            href="index.php?page=delete-customer&id=<?= $row['id'] ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this customer?')"
                                            title="Delete">

                                            <i class="fas fa-trash"></i>

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>


<?php require dirname(__DIR__)."/layouts/footer.php"; ?>