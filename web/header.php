
<header class="navbar page-header darkHeader bg-dark navbar-expand-lg">
    <ul class="nav flex-row mr-auto">
        <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link sidenav-btn h-lg-down">
                <span class="navbar-toggler-icon"></span>
            </a>
            <a class="nav-link sidenav-btn h-lg-up" href="#page-aside"  data-toggle="dropdown" data-target="#page-aside">
                <span class="navbar-toggler-icon"></span>
            </a>
        </li>

    </ul>
    <ul class="nav flex-row order-lg-2 ml-auto nav-icons">
        <li class="nav-item dropdown user-dropdown align-items-center">
            <a class="nav-link" href="#" id="dropdown-user" role="button" data-toggle="dropdown">
                                <span class="user-states states-online">
                                    <img src="images/avatar6.jpg" width="35" alt="" class=" img-fluid rounded-circle">
                                </span>
                <span class="ml-2 h-lg-down dropdown-toggle">
                                    Hi, <?php echo $_SESSION['u_name'];?>
                                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                <div class="text-center p-3 pt-0 b-b mb-5">
                    <span class="mb-0 d-block font300 text-title fs-1x">Hi! <span class="font700"><?php echo $_SESSION['u_name'];?></span></span>
                    <span class="fs12 mb-0 text-muted">Distributor</span>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php"><i class="icon-Power"></i> logout</a>
            </div>
        </li>

    </ul>

</header>
