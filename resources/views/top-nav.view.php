<nav id="custom-nav">
    <div class="container-fluid">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-end">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display:initial;">
                    <img src="resources/images/avatar.png" alt="" style="width: 27px; border-radius: 50%;"> 
                    <?php echo $_SESSION['name']; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle"></i> Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php"><i class="fas fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>