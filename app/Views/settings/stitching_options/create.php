<?php require_once "../app/Views/layouts/header.php"; ?>
<?php require_once "../app/Views/layouts/sidebar.php"; ?>
<?php require_once "../app/Views/layouts/navbar.php"; ?>

  <div class="container-fluid mt-4">

  <div class="card shadow border-0">

  <div class="card-header bg-success text-white">

    <h4>

    <i class="fas fa-plus-circle me-2"></i>

    Add Stitching Option

    </h4>

  </div>

  <div class="card-body">

  <form action="index.php?page=save-stitching-option" method="POST">

  <div class="row">
    <div class="col-md-6 mb-3">

    <label class="form-label">

    Garment Type

    <span class="text-danger">*</span>

    </label>

    <select
        id="garmentSelect"
        name="garment_type_id"
        class="form-select"
        required>

    <option value="">

    Select Garment

    </option>

    <?php foreach($garments as $garment): ?>

    <option
    value="<?= $garment['id'] ?>">

    <?= htmlspecialchars($garment['garment_name']) ?>

    </option>

    <?php endforeach; ?>

    </select>

    </div>
      <div class="col-md-6 mb-3">

  <label class="form-label">

  Category

  </label>

 <select
    id="categorySelect"
    name="category_select"
    class="form-select">

    <option value="">

        Select Category

    </option>

    <option value="new">

        + Add New Category

    </option>

</select>

    </div>
    <div

    class="col-md-6 mb-3"

    id="newCategoryBox"

    style="display:none;">

    <label>

    New Category

    </label>

    <input

    type="text"

    class="form-control"

    name="new_category"

    placeholder="Example: Collar">

    </div>
    <div class="col-md-6 mb-3">

    <label>

    Option Name

    </label>

    <input

    type="text"

    class="form-control"

    name="option_name"

    required>

    </div>
    <div class="col-md-6 mb-3">

    <label>

    Urdu Name

    </label>

    <input

    type="text"

    class="form-control"

    name="urdu_name">

    </div>

    <div class="col-md-6 mb-3">

    <label>

    Selection Type

    </label>

    <select

    class="form-select"

    name="selection_type">

    <option value="radio">

    Radio Button

    </option>

    <option value="checkbox">

    Checkbox

    </option>

    <option value="dropdown">

    Dropdown

</option>

</select>

    </div>
    <div class="col-md-6 mb-3">

        <label class="form-label">

            Status

        </label>

    <select
        class="form-select"
        name="status">

        <option value="Active" selected>

            Active

        </option>

        <option value="Inactive">

            Inactive

        </option>

    </select>

</div>
<div class="col-md-6 mb-3">

<label>

Print Order

</label>

<input

type="number"

class="form-control"

name="print_order"

value="1">

</div>
<div class="col-12 mt-3">

<button

type="submit"

class="btn btn-success">

<i class="fas fa-save"></i>

Save Option

</button>

<a

href="index.php?page=stitching-options"

class="btn btn-secondary">

Cancel

</a>

</div>

</div>

</form>

</div>

</div>

</div>
<script>

        const garmentSelect = document.getElementById("garmentSelect");
        const categorySelect = document.getElementById("categorySelect");
        const newCategoryBox = document.getElementById("newCategoryBox");

        garmentSelect.addEventListener("change", function () {

            const garmentId = this.value;

            categorySelect.innerHTML =
                '<option value="">Loading...</option>';

            fetch(
                "index.php?page=get-stitching-categories&garment_type_id=" + garmentId
            )
            .then(response => response.json())
            .then(categories => {

                categorySelect.innerHTML =
                    '<option value="">Select Category</option>';

                categories.forEach(function(category){

                    categorySelect.innerHTML +=

                    `<option value="${category}">
                        ${category}
                    </option>`;

                });

                categorySelect.innerHTML +=

                `<option value="new">
                    + Add New Category
                </option>`;

            });

        });

        categorySelect.addEventListener("change", function(){

            if(this.value==="new"){

                newCategoryBox.style.display="block";

            }else{

                newCategoryBox.style.display="none";

            }

        });
</script>

<?php require_once "../app/Views/layouts/footer.php"; ?>