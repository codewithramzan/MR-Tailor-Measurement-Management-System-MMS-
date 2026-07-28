<?php require dirname(__DIR__) . "/layouts/header.php"; ?>
<?php require dirname(__DIR__) . "/layouts/navbar.php"; ?>
<?php require dirname(__DIR__) . "/layouts/sidebar.php"; ?>


    <div class="card shadow-sm border-0">

        <div class="card-header bg-warning text-dark">

            <h4 class="mb-0">
                <i class="fas fa-database"></i>
                Restore Database
            </h4>

        </div>

        <div class="card-body">

            <?php Flash::display(); ?>

            <div class="alert alert-warning">

                <strong>Warning!</strong><br>

                Restoring a database will overwrite the current data.

                Make sure you have a recent backup before continuing.

            </div>

            <form
                action="index.php?page=restore-database"
                method="POST"
                enctype="multipart/form-data">

                <div class="mb-4">

                    <label class="form-label fw-bold">

                        Select SQL Backup File

                    </label>

                    <input
                        type="file"
                        name="backup_file"
                        class="form-control"
                        accept=".sql"
                        required>

                    <small class="text-muted">

                        Only .sql files are allowed.

                    </small>

                </div>

                <button
                    type="submit"
                    class="btn btn-warning"
                    onclick="return confirm('Are you sure? This will replace the current database.')">

                    <i class="fas fa-upload"></i>

                    Restore Database

                </button>

            </form>

        </div>

    </div>


<?php require dirname(__DIR__) . "/layouts/footer.php"; ?>