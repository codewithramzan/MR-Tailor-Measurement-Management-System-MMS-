<?php require_once "../app/Views/layouts/header.php"; ?>
<?php require_once "../app/Views/layouts/sidebar.php"; ?>
<?php require_once "../app/Views/layouts/navbar.php"; ?>

<div class="container-fluid mt-4">

<div class="card shadow border-0">

<div class="card-header bg-success text-white">

<h4 class="mb-0">
<i class="fas fa-plus-circle me-2"></i>
Add Garment
</h4>

</div>

<div class="card-body">

<form action="index.php?page=update-garment" method="POST">
  <input
  type="hidden"
  name="id"
  value="<?= $garment['id'] ?? ''?>">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">
English Name
</label>

<input
type="text"
name="name"
class="form-control"
value="<?= htmlspecialchars($garment['name']) ?? ''?>"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Urdu Name
</label>

<input
type="text"
name="urdu_name"
class="form-control"
value="<?= htmlspecialchars($garment['urdu_name']) ?? '' ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">
Status
</label>

<select
name="status"
class="form-select">

<option value="Active">
Active
</option>

<option value="Inactive">
Inactive
</option>

</select>

</div>

<div class="col-12">

<button class="btn btn-success">

<i class="fas fa-save"></i>

Save Garment

</button>

<a
href="index.php?page=garments"
class="btn btn-secondary">

Cancel

</a>

</div>

</div>

</form>

</div>

</div>

</div>

<?php require_once "../app/Views/layouts/footer.php"; ?>