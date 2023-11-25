<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/'); ?>img/logo/sekarsari.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text"><?php echo SITE_NAME ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) 
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('assets/admin/'); ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>
        -->
        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo site_url('Admin/dashboard'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!--
                <li class="nav-item">
                    <a href="<?php echo site_url('Hidangan'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>
                            Hidangan
                        </p>
                    </a>
                </li>
                -->
                <li class="nav-item">
                    <a href="<?php echo site_url('Menu'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-bowl-food"></i>
                        <p>
                            Menu
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('Order'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-cart-shopping"></i>
                        <p>
                            Order
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('Payment'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Payment
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?php echo site_url('Gambar'); ?>" class="nav-link">
                        <i class="nav-icon fas fas fa-image"></i>
                        <p>
                            Gambar
                        </p>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>