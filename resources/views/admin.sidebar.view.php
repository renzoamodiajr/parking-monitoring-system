<a style="cursor:pointer" onclick="toggleSidebar('show')" class="hamburger-icon"><img src="resources/images/menu-icon.png" alt="" style="position: fixed;background: #fff;width: 39px; top: 0; bottom:0; z-index:2"></a>
<div class="sidebar">
    <a onclick="toggleSidebar('hide')" class="toggleSidebar"><i class="fas fa-times" style="color:#fff;font-size:24px"></i></a>
    
    <div class="d-flex flex-row align-items-center sidebar-user-info">
        <div class="pr-2 prof-avatar">
            <img src="resources/images/avatar.png" alt="">
        </div>
        <div class="prof-name">
            <h4><?php echo $_SESSION['name']; ?></h4>
            <h6>(administrator)</h6>
        </div>
    </div>
    <div class="sidebar-container">
        
        <div class="sidebar-label">
            <p style="color:#fff">Navigation</p>
        </div>
        <ul class="sidebar-list sidebar-list-nav">
            <li class="sidebar-list-item">
                <a href="dashboard.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
            </li>
            <li class="sidebar-list-item-has-child">
                <a class=""><i class="fa fa-stopwatch-20"></i> Parking Meter</a>
                <ul class="nav-toggle" style="display: none;" id="parking-meter-areas">
                
                </ul>
            </li>
            <li class="sidebar-list-item">
                <a href="activity-log.php"><i class="fa fa-list"></i> Activity Log</a>
            </li>
        </ul>

        <div class="sidebar-label">
            <p style="color:#fff">Actions</p>
        </div>
        <ul class="sidebar-list sidebar-list-actions">
            <li class="sidebar-list-item">
                <a href="manage-users.php" disabled><i class="fas fa-users"></i> Manage Users</a>
            </li>
            <li class="sidebar-list-item">
                <a href="manage-parking.php"><i style="font-style: normal;font-weight: bold;padding: 5px 10px;">P</i> Manage Parking</a>
            </li>
        </ul>
    </div>
    

    <footer style="color: #b2bbcc;text-align: center;position: absolute;right: 0;left: 0;bottom: 4px;font-size: 13px;">
        <p style="margin:0">© All rights reserved - 2021</p>
        <p style="margin:0">Powered by: Lorenzo N. Amodia Jr.</p>
    </footer>
</div>

