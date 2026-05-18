<?php
include 'config/auth_check.php';
include 'config/config.php';
?>

<!DOCTYPE html>
<html>
    <?php
    include 'head.php';
    ?>

    <body>
        <?php
        include 'navbar.php';
        ?>

        <div class="container">
            <div class="row">
                <h1 class="display-6 fw-bold mt-5">Records</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <ul class="nav nav-tabs card-header-tabs" id="recordTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active fw-bold text-dark" id="members-tab" data-bs-toggle="tab" data-bs-target="#members" type="button" role="tab">
                                <i class="bi bi-people-fill me-1"></i> Member Records
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fw-bold text-dark" id="claims-tab" data-bs-toggle="tab" data-bs-target="#claims" type="button" role="tab">
                                <i class="bi bi-clipboard-check-fill me-1"></i> Claim Records
                            </button>
                        </li>
                    </ul>
                </div>
                
                <div class="card-body">
                    <div class="tab-content" id="recordTabsContent">
                        
                        <!-- MEMBER RECORDS TAB -->
                        <div class="tab-pane fade show active" id="members" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                                <h5 class="card-title mb-0 fw-bold">Registered Members</h5>
                                
                                <div class="input-group input-group-sm" style="max-width: 300px;">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-search text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" placeholder="Search by name or ID...">
                                    <button class="btn btn-outline-secondary border-start-0 btn-dark text-light" type="button">Go</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID Number</th>
                                            <th>Full Name</th>
                                            <th>Department</th>
                                            <th>Account Creation Date</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Orlie Lacerona</td>
                                            <td>CCE - BSCS</td>
                                            <td>May 16, 2026</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-light border"
                                                data-bs-toggle="modal" data-bs-target="#contact-user-modal">View profile</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- CLAIM RECORDS TAB -->
                        <div class="tab-pane fade" id="claims" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                                <h5 class="card-title mb-0 fw-bold">Claim History</h5>
                                
                                <div class="input-group input-group-sm" style="max-width: 300px;">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="bi bi-search text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" placeholder="Search claims...">
                                    <button class="btn btn-outline-secondary border-start-0 btn-dark text-light" type="button">Go</button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Item ID</th>
                                            <th>Item Name</th>
                                            <th>Claimer ID</th>
                                            <th class="text-center">Date Claimed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#1234</td>
                                            <td>Phone</td>
                                            <td>1</td>
                                            <td class="text-center">May 16, 2026</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
        include 'modals.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        <script>
            window.addEventListener("pageshow", function (event) {
                if (event.persisted) {
                    window.location.reload();
                }
            });
        </script>

    </body>
</html>