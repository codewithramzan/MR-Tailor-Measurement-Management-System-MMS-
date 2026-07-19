<?php require "../app/Views/layouts/header.php"; ?>

<div class="container vh-100 d-flex align-items-center justify-content-center">

    <div class="card shadow-lg p-5 rounded-4" style="width:450px;">

        <h2 class="text-center mb-4">

            <i class="bi bi-scissors"></i>

            MR Tailor

        </h2>

        <form method="POST" action="index.php?page=login">

            <div class="mb-3">

                <label class="form-label">

                    Username

                </label>

                <input
                name="username"
                type="text"
                class="form-control">

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Password

                </label>

                <input
                  name="password"
                  type="password"
                  class="form-control">

            </div>

            <button
                class="btn btn-warning w-100">

                Login

            </button>

        </form>

    </div>

</div>

<?php require "../app/Views/layouts/footer.php"; ?>