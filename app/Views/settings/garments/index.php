<?php require_once "../app/Views/layouts/header.php"; ?>
<?php require_once "../app/Views/layouts/sidebar.php"; ?>
<?php require_once "../app/Views/layouts/navbar.php"; ?>

<div class="container-fluid mt-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                <i class="fas fa-tshirt me-2"></i>
                Manage Garments
            </h4>

            <a href="index.php?page=add-garment" class="btn btn-light">
                <i class="fas fa-plus"></i>
                Add Garment
            </a>

        </div>

        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-4">

                    <input
                        type="text"
                        id="searchInput"
                        class="form-control"
                        placeholder="Search garment...">

                </div>

            </div>

            <table class="table table-bordered table-hover align-middle" id="garmentTable">

                <thead class="table-dark">

                    <tr>

                        <th width="70">#</th>

                        <th>English Name</th>

                        <th>Urdu Name</th>

                        <th>Status</th>

                        <th width="170">Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($garments as $row): ?>

                    <tr>

                        <td><?= $row['id'] ?></td>

                        <td><?= htmlspecialchars($row['garment_name']) ?></td>

                        <td><?= htmlspecialchars($row['urdu_name']) ?></td>

                        <td>

                            <?php if($row['status']=="Active"): ?>

                                <span class="badge bg-success">
                                    Active
                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <a
                                href="index.php?page=edit-garment&id=<?= $row['id'] ?>"
                                class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <a
                                href="index.php?page=delete-garment&id=<?= $row['id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Deactivate this garment?')">

                                <i class="fas fa-ban"></i>

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

const searchInput=document.getElementById("searchInput");

const rows=document.querySelectorAll("#garmentTable tbody tr");

searchInput.addEventListener("keyup",function(){

    const value=this.value.toLowerCase();

    rows.forEach(row=>{

        row.style.display=
            row.innerText.toLowerCase().includes(value)
            ? ""
            : "none";

    });

});

</script>

<?php require_once "../app/Views/layouts/footer.php"; ?>