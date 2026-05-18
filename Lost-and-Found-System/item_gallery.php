<!DOCTYPE html>
<html>
    <!--
    this page displays items found and uploaded by users in hopes of finding its owner.
    items have 3 status (found, claimed, disposed)
    if an item is claimed, claim details will be recorded and displayed in records
     once claimed, it will remain visible in the item gallery with the status "claimed" for another 30 days before the system removes it
    -->
    <?php
    include 'head.php';
    ?>
    <?php
        include 'config/config.php';

        $sql = "SELECT * FROM items ORDER BY created_at DESC";
        $result = $conn->query($sql);
    ?>

    <body>
        <?php
        include 'navbar.php';
        ?>

        <div class="container">
            <div class="row">
                <h1 class="display-6 fw-bold mt-5 mb-0">Item Gallery</h1>
                <medium class="text-secondary">Try finding your lost item here.</medium>
            </div>
        
            <!-- SEARCH BAR AND ADD ROW -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex gap-2 flex-grow-1 flex-md-grow-0" style="max-width: 600px;">
                            <!-- SEARCH -->
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" placeholder="Search items...">
                                <button class="btn text-white" type="button" style="background-color: #311432;">
                                    Search
                                </button>
                            </div>

                            <!-- FILTER -->
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary shadow-sm dropdown-toggle h-100" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="filterDropdown">
                                    <li><h6 class="dropdown-header">Category</h6></li>
                                    <li><a class="dropdown-item" href="#">Electronics</a></li>
                                    <li><a class="dropdown-item" href="#">Documents</a></li>
                                    <li><h6 class="dropdown-header">Sort</h6></li>
                                    <li><a class="dropdown-item" href="#">Newest First</a></li>
                                    <li><a class="dropdown-item" href="#">Oldest First</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="">
                            <button class="btn text-white shadow-sm d-flex align-items-center gap-2" style="background-color: #311432;"
                            data-bs-toggle="modal" data-bs-target="#add-item-modal">
                                <span>Add Item</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
                
                <hr class="my-4 text-muted">
                
                <div class="row g-4 ">
                    
                    <!-- ITEM CARD (UPLOADER + ADMIN PERSPECTIVE) -->
                    <?php while ($row = $result->fetch_assoc()) { ?>

    <?php
        // status badge
        if ($row['status'] == 'claimed') {
            $badgeClass = 'bg-success';
        } elseif ($row['status'] == 'disposed') {
            $badgeClass = 'bg-danger';
        } else {
            $badgeClass = 'bg-dark';
        }
    ?>

    <div class="col-md-2" data-bs-toggle="modal" data-bs-target="#item-modal1">

        <div class="card shadow-sm border h-100" style="cursor:pointer;">
            <div class="card-body align-items-center text-center">

                <img src="img/logo.png"
                     alt=""
                     class="rounded"
                     style="width:100%;height:180px;object-fit:cover;">

                <h6 class="fw-bold mt-2 mb-0">
                    <?= htmlspecialchars($row['item_name']) ?>
                </h6>

                <small class="text-muted">
                    Location Found: <?= htmlspecialchars($row['location_found']) ?>
                </small>

                <span class="badge <?= $badgeClass ?> text-light rounded-pill ms-3 px-3 py-2">
                    <?= ucfirst($row['status']) ?>
                </span>

            </div>
        </div>

    </div>

<?php } ?>

                    <!-- ITEM CARD (NON-UPLOADER PERSPECTIVE) -->
                    <div class="col-md-2" data-bs-toggle="modal" data-bs-target="#item-modal2">
                        <div class="card shadow-sm border h-100" style="cursor:pointer;">
                            <div class="card-body align-items-center text-center">
                                <img src="img/logo.png" alt="" class="rounded" style="width:100%;height:180px;object-fit:cover;">
                                <h6 class="fw-bold mt-2 mb-0">Item Name</h6>
                                <small class="text-muted">Location Found: Library</small>
                                <span class="badge bg-dark text-light rounded-pill ms-3 px-3 py-2">Found</span>
                                <!-- Other status states (use conditional statements) -->
                                <!--<span class="badge bg-success text-light rounded-pill ms-3 px-3 py-2">Claimed</span>-->
                                <!--<span class="badge bg-danger text-light rounded-pill ms-3 px-3 py-2">Disposed</span>-->
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <?php
        include 'modals.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>