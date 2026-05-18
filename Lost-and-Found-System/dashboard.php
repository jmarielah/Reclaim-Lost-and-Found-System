<!DOCTYPE html>
<html>
    <!-- this page displays statistics (cards and pie chart) for both admin and users, only admins can access the verify section.-->
    <?php
    include 'head.php';
    ?>

    <body>
        <?php
        include 'navbar.php';
        ?>

        <div class="container">
            <div class="row">
                <h1 class="display-6 fw-bold mt-5">Dashboard</h1>
            </div>

            <div class="row g-3 my-3">
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border py-3" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <h1 class="card-title">10</h1>
                            <h6 class="card-subtitle text-secondary">Found Items</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border py-3" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <h1 class="card-title">20</h1>
                            <h6 class="card-subtitle text-secondary">Reports</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border py-3" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <h1 class="card-title">30</h1>
                            <h6 class="card-subtitle text-secondary">Total Returned</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border py-3" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <h1 class="card-title">10</h1>
                            <h6 class="card-subtitle text-secondary">Disposed Items</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PIE CHART -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Item Overview</h5>
                            <div style="height: 350px; display: flex; justify-content: center;">
                                <canvas id="itemPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- VERIFY SECTION -->
            <div class="row g-3 mb-5">
                <!-- VERIFY ITEMS CARD -->
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border d-flex flex-column" style="max-height: 500px;">

                        <div class="p-4 pb-0">
                            <div class="text-center">
                                <h4 class="fw-bold mb-0">Verify Found Items</h4>
                            </div>
                            <hr class="text-muted mt-3 mb-0">
                        </div>

                        <div class="card-body p-4 overflow-y-auto flex-grow-1">

                            <!-- FOUND ITEM CARD -->
                            <div class="row mb-3" data-bs-toggle="modal" data-bs-target="#verify-item-modal">
                                <div class="card shadow-sm border py-2 d-flex flex-row align-items-center" style="cursor:pointer;">
                                    <img src="img/logo.png" alt="No image" class="rounded me-3" style="width:60px;height:60px;">
                                    <div>
                                        <h6 class="mb-0 fw-semibold">Phone</h6>
                                        <small class="text-muted">Found at the Library</small>
                                    </div>
                                </div>
                            </div>
                            <!--Note: use a loop to add more cards based sa db, may scroll na naka implement-->
                        </div>
                    </div>
                </div>

                <!-- VERIFY REPORTS CARD -->
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm border d-flex flex-column" style="max-height: 500px;">

                        <div class="p-4 pb-0">
                            <div class="text-center">
                                <h4 class="fw-bold mb-0">Verify Reports</h4>
                            </div>
                            <hr class="text-muted mt-3 mb-0">
                        </div>

                        <div class="card-body p-4 overflow-y-auto flex-grow-1">

                            <!-- REPORT CARD -->
                            <div class="row mb-3" data-bs-toggle="modal" data-bs-target="#verify-report-modal" aria-hidden="true">
                                <div class="card shadow-sm border py-2 d-flex flex-row align-items-center" style="cursor:pointer;">
                                    <img src="img/logo.png" alt="No image" class="rounded me-3" style="width:60px;height:60px;">
                                    <div>
                                        <h6 class="mb-0 fw-semibold">Phone</h6>
                                        <small class="text-muted">Lost at the Library</small>
                                    </div>
                                </div>
                            </div>
                            <!--Note: use a loop to add more cards based sa db, may scroll na naka implement-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include 'modals.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                const ctx = document.getElementById('itemPieChart').getContext('2d');
                
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Found Items', 'Reports', 'Total Returned', 'Disposed'],
                        datasets: [{
                            data: [10, 20, 30, 10],
                            backgroundColor: [
                                '#311432',
                                '#6c757d',
                                '#198754',
                                '#dc3545'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            </script>

    </body>
</html>