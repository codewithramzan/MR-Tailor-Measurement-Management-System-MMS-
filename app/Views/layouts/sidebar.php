<?php
$currentPage = $_GET['page'] ?? 'dashboard';

function active($pages)
{
    global $currentPage;

    return in_array($currentPage, (array)$pages)
        ? 'active'
        : '';
}

function menuOpen($pages)
{
    global $currentPage;

    return in_array($currentPage, (array)$pages)
        ? 'show'
        : '';
}
?>

<aside class="sidebar" id="sidebar">

    <!-- ==========================
            Logo
    =========================== -->

    <div class="sidebar-logo text-white">

        <i class="fas fa-cut"></i>

        <span><?= htmlspecialchars(Config::get("shop_name")) ?></span>

    </div>

    <!-- ==========================
            Navigation
    =========================== -->

    <ul class="sidebar-menu">

        <!-- ==========================
                Dashboard
        =========================== -->

        <li>

            <a
                href="index.php?page=dashboard"
                class="<?= active('dashboard') ?>">

                <i class="fas fa-home"></i>

                <span>Dashboard</span>

            </a>

        </li>

        <!-- ==========================
                Customers
        =========================== -->

        <li class="menu-item">

            <a href="#" class="menu-toggle">

                <div>

                    <i class="fas fa-users"></i>

                    <span>Customers</span>

                </div>

                <i class="fas fa-chevron-down arrow"></i>

            </a>

            <ul class="submenu <?= menuOpen([
                'customers',
                'add-customer',
                'search-customer',
                'edit-customer'
            ]) ?>">

                <li>

                    <a
                        href="index.php?page=add-customer"
                        class="<?= active('add-customer') ?>">

                        Add Customer

                    </a>

                </li>

                <li>

                    <a
                        href="index.php?page=customers"
                        class="<?= active([
                            'customers',
                            'edit-customer'
                        ]) ?>">

                        Manage Customers

                    </a>

                </li>

                <li>

                    <a
                        href="index.php?page=search-customer"
                        class="<?= active('search-customer') ?>">

                        Search Customer

                    </a>

                </li>

            </ul>

        </li>
                <!-- ==========================
                Orders
        =========================== -->

        <li class="menu-item">

            <a href="#" class="menu-toggle">

                <div>

                    <i class="fas fa-receipt"></i>

                    <span>Orders</span>

                </div>

                <i class="fas fa-chevron-down arrow"></i>

            </a>

            <ul class="submenu <?= menuOpen([
                'create-order',
                'save-order',
                'orders',
                'edit-order',
                'pending-report',
                'ready-report',
                'delivered-report'
            ]) ?>">

                <li>

                    <a
                        href="index.php?page=create-order"
                        class="<?= active([
                            'create-order',
                            'save-order'
                        ]) ?>">

                        Create Order

                    </a>

                </li>

                <li>

                    <a
                        href="index.php?page=orders"
                        class="<?= active([
                            'orders',
                            'edit-order'
                        ]) ?>">

                        Manage Orders

                    </a>

                </li>

                <li>

                    <a
                        href="index.php?page=pending-report"
                        class="<?= active('pending-report') ?>">

                        Pending Orders

                    </a>

                </li>

                <li>

                    <a
                        href="index.php?page=ready-report"
                        class="<?= active('ready-report') ?>">

                        Ready Orders

                    </a>

                </li>

                <li>

                    <a
                        href="index.php?page=delivered-report"
                        class="<?= active('delivered-report') ?>">

                        Delivered Orders

                    </a>

                </li>

            </ul>

        </li>


        <!-- ==========================
                Measurements
        =========================== -->

        <li class="menu-item">

            <a href="#" class="menu-toggle">

                <div>

                    <i class="fas fa-ruler-combined"></i>

                    <span>Measurements</span>

                </div>

                <i class="fas fa-chevron-down arrow"></i>

            </a>

            <ul class="submenu <?= menuOpen([
                'measurement-types',
                'stitching-options',
                'measurements',
                'create-measurement',
                'edit-measurement',
                'print-measurement'
            ]) ?>">

                <li>

                    <a
                        href="index.php?page=measurement-types"
                        class="<?= active('measurement-types') ?>">

                        Measurement Types

                    </a>

                </li>

                <li>

                    <a
                        href="index.php?page=stitching-options"
                        class="<?= active('stitching-options') ?>">

                        Stitching Options

                    </a>

                </li>

            </ul>

        </li>


        <!-- ==========================
                Invoices
        =========================== -->

        <li class="menu-item">

            <a href="#" class="menu-toggle">

                <div>

                    <i class="fas fa-file-invoice-dollar"></i>

                    <span>Invoices</span>

                </div>

                <i class="fas fa-chevron-down arrow"></i>

            </a>

            <ul class="submenu <?= menuOpen([
                'create-invoice',
                'invoice',
                'invoices',
                'print-invoice'
            ]) ?>">

                <li>

                    <a
                        href="index.php?page=create-invoice"
                        class="<?= active([
                            'create-invoice',
                            'invoice'
                        ]) ?>">

                        Create Invoice

                    </a>

                </li>

                <li>

                    <a
                        href="index.php?page=invoices"
                        class="<?= active([
                            'invoices',
                            'print-invoice'
                        ]) ?>">

                        Manage Invoices

                    </a>

                </li>

            </ul>

        </li>
                <!-- ==========================
                Reports
        =========================== -->

        <li class="menu-item">

            <a href="#" class="menu-toggle">

                <div>

                    <i class="fas fa-chart-line"></i>

                    <span>Reports</span>

                </div>

                <i class="fas fa-chevron-down arrow"></i>

            </a>

            <ul class="submenu <?= menuOpen([
                'reports',
                'daily-report',
                'monthly-report',
                'customer-report',
                'income-report',
                'pending-report',
                'ready-report',
                'delivered-report',
                'invoice-report'
            ]) ?>">

                <li>
                    <a href="index.php?page=reports"
                       class="<?= active('reports') ?>">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="index.php?page=daily-report"
                       class="<?= active('daily-report') ?>">
                        Daily Report
                    </a>
                </li>

                <li>
                    <a href="index.php?page=monthly-report"
                       class="<?= active('monthly-report') ?>">
                        Monthly Report
                    </a>
                </li>

                <li>
                    <a href="index.php?page=customer-report"
                       class="<?= active('customer-report') ?>">
                        Customer Report
                    </a>
                </li>

                <li>
                    <a href="index.php?page=income-report"
                       class="<?= active('income-report') ?>">
                        Income Report
                    </a>
                </li>

                <li>
                    <a href="index.php?page=pending-report"
                       class="<?= active('pending-report') ?>">
                        Pending Orders
                    </a>
                </li>

                <li>
                    <a href="index.php?page=ready-report"
                       class="<?= active('ready-report') ?>">
                        Ready Orders
                    </a>
                </li>

                <li>
                    <a href="index.php?page=delivered-report"
                       class="<?= active('delivered-report') ?>">
                        Delivered Orders
                    </a>
                </li>

                <li>
                    <a href="index.php?page=invoice-report"
                       class="<?= active('invoice-report') ?>">
                        Invoice Report
                    </a>
                </li>

            </ul>

        </li>


        <!-- ==========================
                Backup & Restore
        =========================== -->

        <li class="menu-item">

            <a href="#" class="menu-toggle">

                <div>

                    <i class="fas fa-database"></i>

                    <span>Backup & Restore</span>

                </div>

                <i class="fas fa-chevron-down arrow"></i>

            </a>

            <ul class="submenu <?= menuOpen([
                'backup',
                'restore'
            ]) ?>">

                <li>

                    <a href="index.php?page=backup"
                       class="<?= active('backup') ?>">

                        Backup Database

                    </a>

                </li>

                <li>

                    <a href="index.php?page=restore"
                       class="<?= active('restore') ?>">

                        Restore Database

                    </a>

                </li>

            </ul>

        </li>


       <!-- Settings -->
        <li class="menu-item">

            <a href="#" class="menu-toggle">

                <div>

                    <i class="fas fa-cog"></i>

                    <span>Settings</span>

                </div>

                <i class="fas fa-chevron-down arrow"></i>

            </a>

            <ul class="submenu">

                <li>

                    <a href="index.php?page=settings">

                        <i class="fas fa-store"></i>

                        Shop Information

                    </a>

                </li>

                <li>

                    <a href="index.php?page=measurement-types">

                        <i class="fas fa-ruler-combined"></i>

                        Measurement Fields

                    </a>

                </li>

                <li>

                    <a href="index.php?page=stitching-options">

                        <i class="fas fa-cut"></i>

                        Stitching Options

                    </a>

                </li>

            </ul>

        </li>


        <!-- ==========================
                Logout
        =========================== -->

        <li>

            <a href="index.php?page=logout">

                <i class="fas fa-sign-out-alt"></i>

                <span>Logout</span>

            </a>

        </li>

    </ul>

</aside>