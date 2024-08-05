<?php
if ($adminloggedin) {
    require 'partials/_dbconnect.php';

    if (!function_exists('getOrderCounts')) {
        function getOrderCounts($conn) {
            $orderCounts = ['total' => 0, 'new' => 0];

            $sql_orders = "SELECT COUNT(*) AS total_orders FROM orders WHERE orderStatus >= 1 AND isRead = FALSE";
            if ($stmt = mysqli_prepare($conn, $sql_orders)) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $orderCounts['total']);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
            } else {
                die('Error: ' . mysqli_error($conn));
            }

            $sql_new_orders = "SELECT COUNT(*) AS new_orders FROM orders WHERE orderStatus = 1 AND isRead = FALSE"; // Assuming status 1 is for new orders
            if ($stmt = mysqli_prepare($conn, $sql_new_orders)) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $orderCounts['new']);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);
            } else {
                die('Error: ' . mysqli_error($conn));
            }

            return $orderCounts;
        }
    }

    $orderCounts = getOrderCounts($conn);
?>
<header class="header" id="header">
    <div class="header__toggle">
        <i class='bx bx-menu' style="color: black" id="header-toggle"></i>
    </div>
    <div class="notification">
        <button id="notificationBell" class="btn btn-light">
            <i class="fas fa-bell"></i>
            
        </button>
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
                    <i class='bx bx-grid-alt nav__icon' style="color: white"></i>
                    <span class="nav__name" style="color: white">Dashboard</span>
                </a>
                <a href="index.php?page=orderManage" class="nav-orderManage nav__link">
                    <i class='bx bx-bar-chart-alt-2 nav__icon' style="color: white"></i>
                    <span class="nav__name" style="color: white">Orders
                        <?php if ($orderCounts['new'] > 0) { ?>
                            <span style="color: red; font-weight: bold;">(new)</span>
                        <?php } ?>
                    </span>
                </a>
                <a href="index.php?page=categoryManage" class="nav__link nav-categoryManage">
                    <i class='bx bx-folder nav__icon' style="color: white"></i>
                    <span class="nav__name" style="color: white">Category List</span>
                </a>
                <a href="index.php?page=menuManage" class="nav__link nav-menuManage">
                    <i class='bx bx-message-square-detail nav__icon' style="color: white"></i>
                    <span class="nav__name" style="color: white">Item</span>
                </a>
                <a href="index.php?page=contactManage" class="nav__link nav-contactManage">
                    <i class="fas fa-hands-helping" style="color: white"></i>
                    <span class="nav__name" style="color: white">Message</span>
                </a>
                <a href="index.php?page=userManage" class="nav__link nav-userManage">
                    <i class='bx bx-user nav__icon' style="color: white"></i>
                    <span class="nav__name" style="color: white">Users</span>
                </a>
            </div>
        </div>
    </nav>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        updateNotificationCount();

        $('#notificationBell').click(function(event) {
            event.preventDefault();
            handleNotificationClick();
        });

        // Polling for new notifications every 5 seconds
        setInterval(updateNotificationCount, 5000);
    });

    function updateNotificationCount() {
        $.ajax({
            url: 'get_notification_count.php', // PHP file to get the notification count
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.count) {
                    $('#notificationCount').text(response.count);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function handleNotificationClick() {
        $.ajax({
            url: 'update_notification_count.php', // PHP file to update the notification count
            method: 'POST',
            data: { action: 'reset' },
            success: function(response) {
                $('#notificationCount').text('0');
                // Optional: Redirect to orderNotification.php
                window.location.href = 'index.php?page=orderNotification';
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }
</script>

<?php
}
?>
