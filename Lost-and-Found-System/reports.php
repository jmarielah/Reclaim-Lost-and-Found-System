<?php
include 'config/auth_check.php';
include 'config/config.php';
?>

<!DOCTYPE html>
<html>
    <!-- this page displays reports from users who have lost their items.-->
    <?php
    include 'head.php';
    ?>

    <?php
        include 'config/config.php';

        $sql = "SELECT * FROM reports WHERE ver_status = 'approved' ORDER BY created_at DESC";
        $result = $conn->query($sql);
    ?>


    <body>
        <?php
        include 'navbar.php';
        ?>

        <div class="container">
            <div class="row">
                <h1 class="display-6 fw-bold mt-5 mb-0">Reports</h1>
                <medium class="text-secondary">Help someone reunite with their belongings.</medium>
            </div>
        <!-- SEARCH BAR AND ADD ROW-->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex gap-2 flex-grow-1 flex-md-grow-0" style="max-width: 600px;">
                            <!-- SEARCH -->
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" placeholder="Search reports...">
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
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">Sort</h6></li>
                                    <li><a class="dropdown-item" href="#">Newest First</a></li>
                                    <li><a class="dropdown-item" href="#">Oldest First</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- ADD ITEM -->
                        <div>
                            <button class="btn text-white shadow-sm d-flex align-items-center gap-2" style="background-color: #311432;"
                            data-bs-toggle="modal" data-bs-target="#add-report-modal">
                                <span>Add Report</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
                
                <hr class="my-4 text-muted">
                
                <div class="row g-4 ">
                    
                    <!-- REPORT CARD (UPLOADER) -->
                   <?php while ($row = $result->fetch_assoc()) { ?>

<div class="col-md-2">

    <div class="card shadow-sm border h-100"
        data-id="<?= $row['item_id'] ?>"
        style="cursor:pointer;"
        data-bs-toggle="modal"
        data-bs-target="#report-modal1">

        <div class="card-body align-items-center text-center">

            <img src="img/logo.png"
                class="rounded"
                style="width:100%;height:180px;object-fit:cover;">

            <h6 class="fw-bold mt-2 mb-0">
                <?= htmlspecialchars($row['item_name']) ?>
            </h6>

            <small class="text-muted">
                Last Seen: <?= htmlspecialchars($row['location_lost']) ?>
            </small>

        </div>

    </div>

</div>

<?php } ?>
                    <!-- REPORT CARD (NON-UPLOADER) -->
                    <div class="col-md-2" data-bs-toggle="modal" data-bs-target="#report-modal2">
                        <div class="card shadow-sm border h-100" style="cursor:pointer;">
                            <div class="card-body align-items-center text-center">
                                <img src="img/logo.png" alt="" class="rounded" style="width:100%;height:180px;object-fit:cover;">
                                <h6 class="fw-bold mt-2 mb-0">Item Name</h6>
                                <small class="text-muted">Last Seen: Library</small>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <?php
        include 'modals.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
let currentReportId = null;
let currentReport = null;

document.querySelectorAll(".card[data-id]").forEach(card => {
    card.addEventListener("click", function () {
        loadReport(this.dataset.id);
    });
});

function loadReport(id) {

    currentReportId = id;

    fetch("actions/get_item.php?id=" + id + "&type=report")
        .then(res => res.json())
        .then(data => {

            currentReport = data;

            document.querySelector("#report-modal1 .report-name").innerText =
                data.item_name ?? "N/A";

            document.querySelector("#report-modal1 .report-location").innerText =
                data.location_lost ?? "N/A";

            document.querySelector("#report-modal1 .report-date").innerText =
                data.date_lost ?? "N/A";

            document.querySelector("#report-modal1 .report-desc").innerText =
                data.description ?? "No description";

            document.querySelector("#report-modal1 .report-uploader").innerText =
                ((data.f_name ?? "") + " " + (data.l_name ?? "")).trim();

        })
        .catch(err => console.error("Error loading report:", err));
}

// DELETE REPORT
const deleteReportBtn = document.getElementById("deleteReportBtn");

if (deleteReportBtn) {

    deleteReportBtn.addEventListener("click", function () {

        if (!currentReportId) return;

        if (!confirm("Are you sure you want to delete this report?")) {
            return;
        }

        fetch("actions/delete.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body:
                "id=" + currentReportId +
                "&type=report"
        })
        .then(res => res.text())
        .then(response => {

            console.log(response);

            // close modal
            bootstrap.Modal.getInstance(
                document.getElementById("report-modal1")
            ).hide();

            // remove card
            document.querySelector(`[data-id="${currentReportId}"]`)
                ?.closest(".col-md-2")
                ?.remove();

        })
        .catch(err => console.error(err));

    });

}


// OPEN EDIT + DEFAULT VALUES
const editReportBtn = document.getElementById("editReportBtn");

if (editReportBtn) {
    editReportBtn.addEventListener("click", function () {

        if (!currentReport) return;
        document.querySelector("#edit-report-modal input[name='item_name']").value =
            currentReport.item_name ?? "";  

        document.querySelector("#edit-report-modal select[name='category']").value =
            currentReport.category ?? "";

        document.querySelector("#edit-report-modal input[name='date_lost']").value =
            (currentReport.date_lost ?? "").split(" ")[0];

        document.querySelector("#edit-report-modal input[name='location_lost']").value =
            currentReport.location_lost ?? "";

        document.querySelector("#edit-report-modal textarea[name='description']").value =
            currentReport.description ?? "";
    });
}


document.getElementById("editReportForm").addEventListener("submit", function (e) {
    e.preventDefault();

    if (!currentReport) return;

    const formData = new FormData(this);
    formData.append("item_id", currentReport.item_id);
    formData.append("type", "report"); // IMPORTANT FIX

    fetch("actions/update.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(response => {

        console.log(response);

        bootstrap.Modal.getInstance(
            document.getElementById("edit-report-modal")
        ).hide();

        loadReport(currentReport.item_id);
        location.reload(); 
    })
    .catch(err => console.error(err));
});

            window.addEventListener("pageshow", function (event) {
                if (event.persisted) {
                    window.location.reload();
                }
            });

        </script>

    </body>
</html>