<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Profile Dropdown Menu -->
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link"><?php echo $this->session->userdata('userName'); ?></a>
        </li>
        <div class="dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user-circle"></i>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo site_url('Login/logout'); ?>">Logout</a>
            </div>
        </div>

    </ul>
</nav>