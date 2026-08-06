<?php require_once "../app/Views/layouts/header.php"; ?>
<?php require_once "../app/Views/layouts/sidebar.php"; ?>
<?php require_once "../app/Views/layouts/navbar.php"; ?>

<div class="container-fluid mt-4">


      <div class="card shadow border-0">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">

                <i class="fas fa-cut me-2"></i>

                Stitching Options

            </h4>

            <a href="index.php?page=add-stitching-option"
               class="btn btn-light">

                <i class="fas fa-plus"></i>

                Add Option

            </a>

        </div>

        <div class="card-body">
            <form method="GET" class="row g-2 mb-3">

            <input type="hidden" name="page" value="stitching-options">

            <div class="col-md-3">

                <select
                    name="garment_type_id"
                    class="form-select"
                    onchange="this.form.submit()">

                    <option value="0">

                        All Garments

                    </option>

                    <?php foreach($garments as $garment): ?>

                        <option
                            value="<?= $garment['id']?? '' ?>"
                            <?= ($garmentTypeId == $garment['id']) ? 'selected' : '' ?>>

                            <?= htmlspecialchars($garment['garment_name'] ?? '') ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </form>
          <div class="row mb-3 gy-3">
            <div class="col-md-3">
                <select id="statusFilter" class="form-select">

                <option value="">

                    All Status

                </option>

                <option value="active">

                    Active

                </option>

                <option value="inactive">

                    Inactive

                </option>

            </select>
        </div>

    <div class="col-md-3">

        <input
            type="text"
            id="searchInput"
            class="form-control"
            placeholder="Search option...">

    </div>

    <div class="col-md-3">

        <select
            id="categoryFilter"
            class="form-select">

            <option value="">

                All Categories

            </option>

            <?php foreach($categories as $category): ?>

            <option value="<?= htmlspecialchars($category) ?>">

                <?= htmlspecialchars($category) ?>

            </option>

            <?php endforeach; ?>

        </select>

    </div>

</div>
<table
class="table table-bordered table-hover align-middle"
id="optionTable">

    <thead class="table-dark">

        <tr>

        <th width="70">ID</th>
        <th>Garment</th>

        <th>Option</th>

        <th>Urdu</th>

        <th>Category</th>

        <th>Selection</th>

        <th width="100">Order</th>

        <th>Status</th>

        <th width="150">Action</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach($options as $row): ?>

        <tr>

        <td>

        <?= $row["id"] ?>

        </td>

        <td>

        <?= htmlspecialchars($row["garment_name"]) ?>

        </td>
        <td>

        <?= htmlspecialchars($row["option_name"]) ?>

        </td>

        <td>

        <?= htmlspecialchars($row["urdu_name"]) ?>

        </td>

        <td>

        <span class="badge bg-info">

        <?= htmlspecialchars($row["category"]) ?>

        </span>

        </td>

        <td>

        <?php

        $type = strtolower($row["selection_type"]);

        if($type=="radio"){

        echo '<span class="badge bg-primary">Radio</span>';

        }elseif($type=="checkbox"){

        echo '<span class="badge bg-success">Checkbox</span>';

        }else{

        echo '<span class="badge bg-warning text-dark">Dropdown</span>';

        }

        ?>

        </td>

        <td>

        <?= $row["print_order"] ?>

        </td>
          <td>

        <?php if($row["status"]=="Active"): ?>

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
          href="index.php?page=edit-stitching-option&id=<?= $row["id"] ?>"
          class="btn btn-warning btn-sm">

          <i class="fas fa-edit"></i>

          </a>

          <?php if($row["status"]=="Active"): ?>

          <a

          href="index.php?page=toggle-stitching-option&id=<?= $row["id"] ?>"

          class="btn btn-secondary btn-sm"

          onclick="return confirm('Deactivate this option?')">

          <i class="fas fa-ban"></i>

          </a>

          <?php else: ?>

          <a

          href="index.php?page=toggle-stitching-option&id=<?= $row["id"] ?>"

          class="btn btn-success btn-sm"

          onclick="return confirm('Activate this option?')">

          <i class="fas fa-check"></i>

          </a>

          <?php endif; ?>

          </td>

        </tr>

        <?php endforeach; ?>

    </tbody>

</table>
<script>

const searchInput = document.getElementById("searchInput");
const categoryFilter = document.getElementById("categoryFilter");
const statusFilter = document.getElementById("statusFilter");

const rows = document.querySelectorAll("#optionTable tbody tr");

function filterOptions(){

    const search = searchInput.value.toLowerCase().trim();
    const category = categoryFilter.value.toLowerCase().trim();
    const status = statusFilter.value.toLowerCase().trim();

    rows.forEach(function(row){

        const text = row.innerText.toLowerCase();

        const rowCategory = row.cells[4].innerText.toLowerCase().trim();

        const rowStatus = row.cells[7].innerText.toLowerCase().trim();

        const searchMatch = text.includes(search);

        const categoryMatch =
            category === "" || rowCategory === category;

        const statusMatch =
            status === "" || rowStatus === status;

        row.style.display =
            (searchMatch && categoryMatch && statusMatch)
            ? ""
            : "none";

    });

}

searchInput.addEventListener("keyup", filterOptions);

categoryFilter.addEventListener("change", filterOptions);

statusFilter.addEventListener("change", filterOptions);

</script>

        </div>

    </div>

</div>


<?php require_once "../app/Views/layouts/footer.php"; ?>