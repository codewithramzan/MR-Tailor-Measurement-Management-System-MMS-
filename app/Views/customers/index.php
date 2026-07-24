<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>
<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <h4 class="mb-0">
                        <i class="fas fa-users text-primary"></i>
                        Manage Customers
                    </h4>

                    <a href="index.php?page=add-customer"
                       class="btn btn-success rounded-pill px-4">

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

                                    <td><?= htmlspecialchars($row['full_name']) ?></td>

                                    <td><?= htmlspecialchars($row['phone']) ?></td>

                                    <td><?= htmlspecialchars($row['village']) ?></td>

                                    <td class="text-nowrap">

                                        <!-- New Booking -->
                                        <a
                                            href="index.php?page=create-order&customer_id=<?= $row['id'] ?>"
                                            class="btn btn-primary btn-sm"
                                            title="New Booking">

                                            <i class="fas fa-plus"></i>

                                        </a>

                                      <a href="index.php?page=customer-profile&id=<?= $row['id'] ?? '' ?>"
                                        class="btn btn-info btn-sm"
                                        title="Profile">

                                            <i class="fas fa-user"></i>

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

                        <?php else: ?>

                        <tr>

                        <td colspan="6" class="text-center py-5">

                        <i
                        class="fas fa-users-slash fa-3x text-muted mb-3">
                        </i>

                        <h5 class="text-muted">

                        No Customers Found

                        </h5>

                        </td>

                        </tr>

                         <?php endif; ?>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>


<?php require dirname(__DIR__)."/layouts/footer.php"; ?>