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

  <form action="index.php?page=update-stitching-option" method="POST">
    <input
      type="hidden"
      name="id"
      value="<?= $option['id'] ?? '' ?>">

  <div class="row">
      <div class="col-md-6 mb-3">

  <label class="form-label">

  Category

  </label>

  <select

  class="form-select"

  name="category_select"

  id="categorySelect">

  <option value="">

  Select Category

  </option>

  <?php foreach($categories as $category): ?>

  <option

  value="<?= $category['category'] ?>"

  <?= $option['category']==$category['category'] ? "selected":"" ?>>

  <?= $category['category'] ?>

  </option>

  <?php endforeach; ?>

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
value="<?= htmlspecialchars($option['option_name'] ?? '') ?>"
required>

</div>
<div class="col-md-6 mb-3">

<label>

Urdu Name

</label>

<input

type="text"

class="form-control"

name="urdu_name"
value="<?= htmlspecialchars($option['urdu_name'] ?? '') ?>" >

</div>

<div class="col-md-6 mb-3">

<label>

Selection Type

</label>

<select

class="form-select"

name="selection_type">
<option

value="radio"

<?= $option['selection_type']=="radio" ? "selected":"" ?>>

Radio

</option>

<option

value="checkbox"

<?= $option['selection_type']=="checkbox" ? "selected":"" ?>>

Checkbox

</option>

<option

value="dropdown"

<?= $option['selection_type']=="dropdown" ? "selected":"" ?>>

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

        <option
            value="Active"
            <?= $option["status"]=="Active" ? "selected" : "" ?>>

            Active

        </option>

        <option
            value="Inactive"
            <?= $option["status"]=="Inactive" ? "selected" : "" ?>>

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
value="<?= $option['print_order'] ?? '' ?>"

value="1">

</div>
<div class="col-12 mt-3">

<button

class="btn btn-primary"

type="submit">

<i class="fas fa-save"></i>

Update Option

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

const categorySelect =
document.getElementById("categorySelect");

const newCategoryBox =
document.getElementById("newCategoryBox");

categorySelect.addEventListener("change",function(){

    if(this.value==="new"){

        newCategoryBox.style.display="block";

    }else{

        newCategoryBox.style.display="none";

    }

});

</script>

<?php require_once "../app/Views/layouts/footer.php"; ?>