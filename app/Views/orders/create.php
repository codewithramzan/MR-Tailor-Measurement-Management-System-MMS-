<?php require dirname(__DIR__)."/layouts/header.php"; ?>
<?php require dirname(__DIR__)."/layouts/navbar.php"; ?>

<div class="d-flex">

<?php require dirname(__DIR__)."/layouts/sidebar.php"; ?>

<div class="main-content flex-grow-1 p-4">

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4>Create New Booking</h4>

</div>

<div class="card-body">
      <form method="POST" action="index.php?page=save-order">

    <input
    type="hidden"
    name="customer_id"
    value="<?= $customer['id'] ?? '' ?>">

    <div class="row">

        <!-- Customer -->

        <div class="col-md-4 mb-3">

            <label class="form-label">Booking No</label>

            <input
            type="text"
            name="booking_no"
            class="form-control"
            value="<?= $customer['booking_no'] ?? '' ?>"
            readonly>

        </div>

        <div class="col-md-4 mb-3">

            <label class="form-label">Customer Name</label>

            <input
            type="text"
            class="form-control"
            value="<?= $customer['full_name'] ?? '' ?>"
            readonly>

        </div>

        <div class="col-md-4 mb-3">

            <label class="form-label">Phone</label>

            <input
            type="text"
            class="form-control"
            value="<?= $customer['phone'] ?? '' ?>"
            readonly>

        </div>

        <!-- Garment -->

        <div class="col-md-4 mb-3">

            <label>Garment Type</label>

            <select
            name="garment_type"
            class="form-select"
            required>

                <option value="">Choose...</option>

                <option>Shalwar Kameez</option>

                <option>Waist Coat</option>

                <option>Coat</option>

                <option>Pant</option>

                <option>Shirt</option>

                <option>Kurta</option>

            </select>

        </div>

        <div class="col-md-2 mb-3">

            <label>Quantity</label>

            <input
            type="number"
            name="quantity"
            value="1"
            min="1"
            class="form-control">

        </div>

        <div class="col-md-3 mb-3">

            <label>Order Date</label>

            <input
            type="date"
            name="order_date"
            value="<?= date('Y-m-d') ?>"
            class="form-control">

        </div>

        <div class="col-md-3 mb-3">

            <label>Delivery Date</label>

            <input
            type="date"
            name="delivery_date"
            class="form-control">

        </div>

        <!-- Payment -->

        <div class="col-md-3 mb-3">

            <label>Total Amount</label>

            <input
            id="total"
            type="number"
            name="total_amount"
            value="0"
            class="form-control">

        </div>

        <div class="col-md-3 mb-3">

            <label>Advance</label>

            <input
            id="advance"
            type="number"
            name="advance"
            value="0"
            class="form-control">

        </div>

        <div class="col-md-3 mb-3">

            <label>Discount</label>

            <input
            id="discount"
            type="number"
            name="discount"
            value="0"
            class="form-control">

        </div>

        <div class="col-md-3 mb-3">

            <label>Remaining</label>

            <input
            id="balance"
            type="number"
            name="balance"
            readonly
            class="form-control">

        </div>

        <!-- Status -->

        <div class="col-md-4 mb-3">

            <label>Status</label>

            <select
            name="status"
            class="form-select">

                <option>Pending</option>

                <option>Cutting</option>

                <option>Stitching</option>

                <option>Ready</option>

                <option>Delivered</option>

            </select>

        </div>

        <!-- Notes -->

        <div class="col-md-8 mb-3">

            <label>Special Notes</label>

            <textarea
            name="notes"
            rows="2"
            class="form-control"></textarea>

        </div>

    </div>

    <button class="btn btn-success">

    <i class="fas fa-save"></i>

    Save Booking

    </button>

    <a
    href="index.php?page=customers"
    class="btn btn-secondary">

    Back

    </a>

    </form>

</div>

</div>

</div>

</div>

</div>

<script>

const total=document.getElementById("total");

const advance=document.getElementById("advance");

const discount=document.getElementById("discount");

const balance=document.getElementById("balance");

function calculate(){

let t=parseFloat(total.value)||0;

let a=parseFloat(advance.value)||0;

let d=parseFloat(discount.value)||0;

balance.value=t-a-d;

}

total.addEventListener("input",calculate);

advance.addEventListener("input",calculate);

discount.addEventListener("input",calculate);

calculate();

</script>
<?php require dirname(__DIR__)."/layouts/footer.php"; ?>