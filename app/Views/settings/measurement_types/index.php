<?php require_once "../app/Views/layouts/header.php"; ?>
<?php require_once "../app/Views/layouts/sidebar.php"; ?>
<?php require_once "../app/Views/layouts/navbar.php"; ?>

<div class="container-fluid mt-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

            <h4 class="mb-0">

                <i class="fas fa-ruler-combined me-2"></i>

                Measurement Fields

            </h4>

            <a
                href="index.php?page=add-measurement-type"
                class="btn btn-light">

                <i class="fas fa-plus"></i>

                Add Measurement

            </a>

        </div>

        <div class="card-body">
          <div class="row mb-3">

    <div class="col-md-4">

        <select
            id="garmentFilter"
            class="form-select">

            <option value="">

                All Garments

            </option>

            <?php foreach($garments as $garment): ?>

                <option
                    value="<?= htmlspecialchars($garment['garment_type']) ?>">

                    <?= htmlspecialchars($garment['garment_type']) ?>

                </option>

            <?php endforeach; ?>

        </select>

    </div>

    <div class="col-md-4">

        <input
            type="text"
            id="searchInput"
            class="form-control"
            placeholder="Search measurement...">

    </div>

</div>
<table
class="table table-bordered table-hover align-middle"
id="measurementTable">

<thead class="table-dark">

<tr>

  <th>#</th>

  <th>Garment</th>

  <th>Section</th>

  <th>English</th>

  <th>Urdu</th>

  <th>Placeholder</th>

  <th>Order</th>

  <th>Status</th>

  <th width="150">

  Action

  </th>

  </tr>

  </thead>

  <tbody>

  <?php foreach($types as $row): ?>

  <tr>

  <td>

  <?= $row['id'] ?>

  </td>

  <td>

  <?= htmlspecialchars($row['garment_type'] ?? 'undefined') ?>

  </td>

  <td>

  <?= htmlspecialchars($row['section'] ?? 'undefined') ?>

  </td>

  <td>

  <?= htmlspecialchars($row['option_name'] ?? 'undefined') ?>

  </td>

  <td>

  <?= htmlspecialchars($row['urdu_name'] ?? 'undefined') ?>

  </td>

  <td>

  <?= htmlspecialchars($row['placeholder'] ?? 'undefined') ?>

  </td>

  <td>

  <?= $row['display_order'] ?? '' ?>

</td>

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
  href="index.php?page=edit-measurement-type&id=<?= $row['id'] ?>"
  class="btn btn-warning btn-sm">

  <i class="fas fa-edit"></i>

  </a>

  <a
  href="index.php?page=delete-measurement-type&id=<?= $row['id'] ?>"
  class="btn btn-danger btn-sm"
  onclick="return confirm('Delete this measurement?')">

  <i class="fas fa-trash"></i>

  </a>

  </td>

  </tr>

  <?php endforeach; ?>

</tbody>

</table>

<script>

const searchInput = document.getElementById("searchInput");

const garmentFilter = document.getElementById("garmentFilter");

const rows = document.querySelectorAll("#measurementTable tbody tr");

function filterTable()
{
    const search = searchInput.value.toLowerCase();

    const garment = garmentFilter.value.toLowerCase();

    rows.forEach(row=>{

        const text = row.innerText.toLowerCase();

        const rowGarment =
            row.cells[1].innerText.toLowerCase();

        const show =
            text.includes(search) &&
            (garment=="" || rowGarment===garment);

        row.style.display = show ? "" : "none";

    });

}

searchInput.addEventListener("keyup",filterTable);

garmentFilter.addEventListener("change",filterTable);

</script>
        </div>

    </div>

</div>

<?php require_once "../app/Views/layouts/footer.php"; ?>