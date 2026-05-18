<?php
include 'config/auth_check.php';
include 'config/config.php';


$role = $_SESSION['role'] ?? 'student';

$found = $conn->query("SELECT COUNT(*) AS total FROM items WHERE status='found'")
            ->fetch_assoc()['total'];

$claimed = $conn->query("SELECT COUNT(*) AS total FROM items WHERE status='claimed'")
                ->fetch_assoc()['total'];

$disposed = $conn->query("SELECT COUNT(*) AS total FROM items WHERE status='disposed'")
                ->fetch_assoc()['total'];

$reports = $conn->query("SELECT COUNT(*) AS total FROM reports WHERE ver_status='approved'")
                ->fetch_assoc()['total'];

$found_items = $conn->query("SELECT * FROM items WHERE ver_status='pending' ORDER BY item_id DESC LIMIT 10");

$report_items = $conn->query("SELECT * FROM reports WHERE ver_status='pending' ORDER BY item_id DESC LIMIT 10");
?>

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
                            <h1 class="card-title"><?= $found ?></h1>
                            <h6 class="card-subtitle text-secondary">Found Items</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border py-3" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <h1 class="card-title"><?= $reports ?></h1>
                            <h6 class="card-subtitle text-secondary">Reports</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border py-3" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <h1 class="card-title"><?= $claimed ?></h1>
                            <h6 class="card-subtitle text-secondary">Claimed Items</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm border py-3" style="cursor: pointer;">
                        <div class="card-body text-center">
                            <h1 class="card-title"><?= $disposed ?></h1>
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
                <?php // if ($role === 'admin') { ?>
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
                            <?php while ($row = $found_items->fetch_assoc()) { ?>
                                <div class="row mb-3">
                                    <div class="card shadow-sm border py-2 d-flex flex-row align-items-center"
                                        style="cursor:pointer;"
                                        onclick="loadItem(<?= $row['item_id'] ?>, 'item')"
                                        data-bs-toggle="modal"
                                        data-bs-target="#verify-item-modal">

                                        <img src="img/logo.png" class="rounded me-3" style="width:60px;height:60px;">

                                        <div>
                                            <h6 class="mb-0 fw-semibold">
                                                <?= htmlspecialchars($row['item_name']) ?>
                                            </h6>
                                            <small class="text-muted">
                                                <?= htmlspecialchars($row['location_found']) ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--Note: use a loop to add more cards based sa db, may scroll na naka implement-->
                        </div>
                    </div>
                </div>
                <?php// } ?>

                <!-- VERIFY REPORTS CARD -->
                <?php // if ($role === 'admin') { ?>
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
                            <?php while ($row = $report_items->fetch_assoc()) { ?>
                                <div class="row mb-3">
                                    <div class="card shadow-sm border py-2 d-flex flex-row align-items-center"
                                        style="cursor:pointer;"
                                        onclick="loadItem(<?= $row['item_id'] ?>, 'report')"

                                        data-bs-toggle="modal"
                                        data-bs-target="#verify-report-modal">

                                        <img src="img/logo.png" class="rounded me-3" style="width:60px;height:60px;">

                                        <div>
                                            <h6 class="mb-0 fw-semibold">
                                                <?= htmlspecialchars($row['item_name']) ?>
                                            </h6>
                                            <small class="text-muted">
                                                <?= htmlspecialchars($row['location_lost']) ?>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--Note: use a loop to add more cards based sa db, may scroll na naka implement-->
                        </div>
                    </div>
                </div>
                <?php //} ?>
            </div>
        </div>

        <?php
        include 'modals.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>let currentId = null;
let currentType = null;

function loadItem(id, type) {
    currentId = id;
    currentType = type;

    const modalId = (type === 'item')
        ? "#verify-item-modal"
        : "#verify-report-modal";

    fetch("actions/get_item.php?id=" + id + "&type=" + type)
        .then(res => res.json())
        .then(data => {

            document.querySelector(modalId + " .item-name").innerText = data.item_name;

            document.querySelector(modalId + " .item-location").innerText =
                (type === "item") ? data.location_found : data.location_lost;

            document.querySelector(modalId + " .item-date").innerText =
                (type === "item") ? data.date_found : data.date_lost;

            document.querySelector(modalId + " .item-desc").innerText =
                data.description ?? "No description";

            document.querySelector(modalId + " .item-uploader").innerText =
                (data.f_name ?? "") + " " + (data.l_name ?? "");
        });
}


function verifyPost(id, type) {
    fetch("actions/verify.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: id,
            type: type
        })
    })
    .then(res => res.json())
.then(data => {
    if (data.success) {
        location.reload();
    } else {
        console.log(data);
    }
});
}


function rejectPost(id, type) {
    fetch("actions/verify.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: id,
            type: type,
            action: "reject"
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            console.log(data);
        }
    });
}
</script>


        <script>
            const ctx = document.getElementById('itemPieChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Found Items', 'Reports', 'Claimed Items', 'Disposed'],
                    datasets: [{
                        data: [<?= $found ?>, <?= $reports ?>, <?= $claimed ?>, <?= $disposed ?>],
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