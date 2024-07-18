<header class="header" id="header">
    <div class="header__toggle">
        <i class='bx bx-menu' style="color: black" id="header-toggle"></i>
    </div>

    <!-- Form Logout -->
    <form action="partials/_logout.php" method="POST" id="logoutForm">
        <a href="#" onclick="document.getElementById('logoutForm').submit();">
            <i class='bx bx-log-out nav__icon' style="color: red;"></i>
            <span class="nav__name"></span>
        </a>
    </form>
</header> 


<div class="l-navbar" id="nav-bar" style="background-color: #2A403D;">
    <nav class="nav">
        <div>
            <a href="index.php" class="nav__logo">
                <i class='bx bx-layer nav__logo-icon' style="color: white"></i>
                <span class="nav__logo-name" style="color: white">Elvi Bouquet</span>
            </a>

            <div class="nav__list">
                <a href="index.php" class="nav__link nav-home">
                  <i class='bx bx-grid-alt nav__icon'  style="color: white"></i>
                  <span class="nav__name" style="color: white">Home</span>
                </a>
                <a href="index.php?page=orderManage" class="nav-orderManage nav__link ">
                  <i class='bx bx-bar-chart-alt-2 nav__icon' style="color: white"></i>
                  <span class="nav__name" style="color: white">Orders</span>
                </a>
                <a href="index.php?page=categoryManage" class="nav__link nav-categoryManage">
                  <i class='bx bx-folder nav__icon' style="color: white"></i>
                  <span class="nav__name" style="color: white">Category List</span>
                </a>
                <a href="index.php?page=menuManage" class="nav__link nav-menuManage">
                  <i class='bx bx-message-square-detail nav__icon' style="color: white"></i>
                  <span class="nav__name" style="color: white">Menu</span>
                </a>
                <a href="index.php?page=contactManage" class="nav__link nav-contactManage">
                  <i class="fas fa-hands-helping" style="color: white"></i>
                  <span class="nav__name" style="color: white">contact Info</span>
                </a>
                <a href="index.php?page=userManage" class="nav__link nav-userManage">
                  <i class='bx bx-user nav__icon' style="color: white"></i>
                  <span class="nav__name" style="color: white">Users</span>
                </a>
                <!-- <a href="index.php?page=siteManage" class="nav__link nav-siteManage">
                  <i class="fas fa-cogs" style="color: black"></i>
                  <span class="nav__name" style="color: black">Site Settings</span>
                </a> -->
                
            </div>
        </div>
    </nav>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
    $('.nav-<?php echo $page; ?>').addClass('active');
</script>
