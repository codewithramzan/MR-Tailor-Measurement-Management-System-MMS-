
<?php require dirname(__DIR__) . "/layouts/header.php"; ?>
<?php require dirname(__DIR__) . "/layouts/navbar.php"; ?>
<?php require dirname(__DIR__) . "/layouts/sidebar.php"; ?>




            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">

                        <i class="fas fa-database"></i>

                        Backup & Restore Database

                    </h4>

                </div>

                <div class="card-body">
  
                    <div class="row">

                        <!-- Backup -->

                        <div class="col-md-6">

                            <div class="card border-success h-100">

                                <div class="card-body text-center">

                                    <i class="fas fa-download fa-4x text-success mb-3"></i>

                                    <h4>

                                        Backup Database

                                    </h4>

                                    <p class="text-muted">

                                        Download the complete database as an SQL file.

                                    </p>

                                    <a

                                        href="index.php?page=backup-download"

                                        class="btn btn-success btn-lg">

                                        <i class="fas fa-download"></i>

                                        Backup Now

                                    </a>

                                </div>

                          </div>
                      
                      </div>
                  </div>
            </div>
                      
      

<?php require dirname(__DIR__) . "/layouts/footer.php"; ?>