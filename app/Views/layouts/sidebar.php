<aside class="sidebar" id="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <i class="fas fa-cut"></i>
        <span><?= Config::get("shop_name") ?></span>
    </div>

    <!-- Navigation -->
    <ul  class="sidebar-menu">

        <li>
            <a href="index.php?page=dashboard" class="active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Customers -->
        <li class="menu-item">

            <a href="#" class="menu-toggle">
                <div>
                    <i class="fas fa-users"></i>
                    <span>Customers</span>
                </div>

                <i class="fas fa-chevron-down arrow"></i>
            </a>

            <ul class="submenu">

                <li>
                    <a href="index.php?page=add-customer">
                        Add Customer
                    </a>
                </li>

                <li>
                    <a href="index.php?page=customers">
                        Manage Customers
                    </a>
                </li>

                <li>
                    <a href="index.php?page=search-customer">
                        Search Customer
                    </a>
                </li>

            </ul>

        </li>

        <!-- Bookings -->
        <li class="menu-item">

            <a href="#" class="menu-toggle">
                <div>
                    <i class="fas fa-receipt"></i>
                    <span>Bookings</span>
                </div>

                <i class="fas fa-chevron-down arrow"></i>
            </a>

            <ul class="submenu">

                <li>
                    <a href="#">New Booking</a>
                </li>

                <li>
                    <a href="#">Pending</a>
                </li>

                <li>
                    <a href="#">Ready</a>
                </li>

                <li>
                    <a href="#">Delivered</a>
                </li>

            </ul>

        </li>

        <!-- Measurements -->
        <li>

            <a href="#">
                <i class="fas fa-ruler"></i>
                <span>Measurements</span>
            </a>

        </li>
         <!-- manage orders -->
        <li>
       
            <a href="index.php?page=orders">

            <i class="fas fa-receipt"></i>

            Manage Orders

            </a>

        </li>
        <!-- Invoices -->
        <li class="nav-item">

            <a href="index.php?page=invoices" class="nav-link">

                <i class="fas fa-file-invoice"></i>

                <span>Invoices</span>

            </a>

        </li>
                        <!-- Reports -->
     
        <li class="menu-item">

            <a href="#" class="menu-toggle">
                <div>
                    <i class="fas fa-chart-line"></i>
                    <span>Reports</span>
                </div>

                <i class="fas fa-chevron-down arrow"></i>
            </a>

            <ul class="submenu">

                <li>
                    <a href="index.php?page=reports">Dashboard</a>
                </li>

                <li>
                    <a href="index.php?page=daily-report">Daily Report</a>
                </li>

                <li>
                    <a href="index.php?page=monthly-report">Monthly Report</a>
                </li>

                <li>
                    <a href="index.php?page=customer-report"> Customer Report</a>
                </li>
                <li>
                    <a href="index.php?page=income-report"> Income Report</a>
                </li>
                <li>
                    <a href="index.php?page=pending-report"> Pending Orders</a>
                </li>
                <li>
                    <a href="index.php?page=ready-report">Ready Orders</a>
                </li>
                <li>
                    <a href="index.php?page=delivered-report"> Delivered Orders</a>
                </li>
                <li>
                    <a href="index.php?page=invoice-report"> Invoice Report</a>
                </li>

            </ul>

        </li>

        <!-- Settings -->
        <li>

            <a href="#">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>

        </li>

        <!-- Logout -->
        <li>

            <a href="index.php?page=logout">

                <i class="fas fa-sign-out-alt"></i>

                <span>Logout</span>

            </a>

        </li>

    </ul>

</aside>