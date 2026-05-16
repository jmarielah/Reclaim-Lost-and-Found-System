<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-expand-md" data-bs-theme="dark" style="background-color: #311432;">
            <div class="container-xxl">
                <a href="home.php" class="navbar-brand">
                    <span class="fw-bold">
                        Reclaim - Lost and Found System
                    </span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" 
                aria-controls="main-nav" aria-expanded="false" aria-label="toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link <?php if($currentPage == 'dashboard.php') echo 'active'; ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="item_gallery.php" class="nav-link <?php if($currentPage == 'item_gallery.php') echo 'active'; ?>">Item Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a href="reports.php" class="nav-link <?php if($currentPage == 'reports.php') echo 'active'; ?>">Reports</a>
                        </li>
                        <li class="nav-item">
                            <a href="records.php" class="nav-link <?php if($currentPage == 'records.php') echo 'active'; ?>">Records</a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>