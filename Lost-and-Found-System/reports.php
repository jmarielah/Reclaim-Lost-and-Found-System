<?php
include 'config/auth_check.php';
include 'config/config.php';
?>

<!DOCTYPE html>
<html>
    <?php
    include 'head.php';
    ?>

    <?php
        $sql = "SELECT * FROM reports WHERE status = 'lost' AND ver_status = 'approved' ORDER BY created_at DESC";
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
            
            <div class="row mt-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex gap-2 flex-grow-1 flex-md-grow-0" style="max-width: 600px;">
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Search reports...">
                                <button class="btn text-white" type="button" style="background-color: #311432;">
                                    Search
                                </button>
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-outline-secondary shadow-sm dropdown-toggle h-100" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-funnel"></i> <span id="filterLabel">Filter</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="filterDropdown">
                                    <li><h6 class="dropdown-header">Category</h6></li>
                                    <li><a class="dropdown-item category-filter active" href="#" data-category="all">All Categories</a></li>
                                    <li><a class="dropdown-item category-filter" href="#" data-category="Electronics">Electronics</a></li>
                                    <li><a class="dropdown-item category-filter" href="#" data-category="Documents">Documents</a></li>
                                    <li><a class="dropdown-item category-filter" href="#" data-category="Personal Items">Personal Items</a></li>
                                    <li><a class="dropdown-item category-filter" href="#" data-category="Others">Others</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><h6 class="dropdown-header">Sort</h6></li>
                                    <li><a class="dropdown-item sort-filter active" href="#" data-sort="newest">Newest First</a></li>
                                    <li><a class="dropdown-item sort-filter" href="#" data-sort="oldest">Oldest First</a></li>
                                </ul>
                            </div>
                        </div>

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
                
            <div class="row g-4" id="reportContainer" style="min-height: 300px;">
                    
                <?php while ($row = $result->fetch_assoc()) { 
                    $timestamp = strtotime($row['created_at'] ?? 'now');
                    $categoryClean = trim($row['category'] ?? 'Others');
                ?>

                    <div class="col-md-2 report-card" 
                         data-category="<?= htmlspecialchars($categoryClean) ?>" 
                         data-time="<?= $timestamp ?>">

                        <div class="card shadow-sm border h-100 report-card-box"
                            data-id="<?= $row['item_id'] ?>"
                            data-search="<?= strtolower(htmlspecialchars($row['item_name'] . ' ' . $row['location_lost'])) ?>"
                            style="cursor:pointer;"
                            data-bs-toggle="modal"
                            data-bs-target="#report-modal1">

                            <div class="card-body align-items-center text-center">
                                <img src="img/logo.png" class="rounded" style="width:100%;height:180px;object-fit:cover;">
                                <h6 class="fw-bold mt-2 mb-0"><?= htmlspecialchars($row['item_name']) ?></h6>
                                <small class="text-muted">Last Seen: <?= htmlspecialchars($row['location_lost']) ?></small>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <div class="col-12 text-center py-5" id="noReportsMessage" style="display: none;">
                    <i class="bi bi-inbox text-muted display-4"></i>
                    <p class="text-secondary mt-2 fs-5">No reports match your search or filter criteria.</p>
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

const currentUserId = <?= json_encode($current_user_id ?? null) ?>;
const currentUserRole = <?= json_encode($current_role ?? 'student') ?>;

document.addEventListener("DOMContentLoaded", function () {

    // CARD CLICK (LOAD REPORT)
    document.querySelectorAll(".card[data-id]").forEach(card => {
        card.addEventListener("click", function () {
            loadReport(this.dataset.id);
        });
    });

    // DELETE REPORT
    const deleteReportBtn = document.getElementById("deleteReportBtn");
    if (deleteReportBtn) {
        deleteReportBtn.addEventListener("click", function () {
            if (!currentReportId) return;
            if (!confirm("Are you sure you want to delete this report?")) return;

            fetch("actions/delete.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + currentReportId + "&type=report"
            })
            .then(res => res.text())
            .then(response => {
                console.log(response);
                bootstrap.Modal.getInstance(document.getElementById("report-modal1")).hide();
                document.querySelector(`[data-id="${currentReportId}"]`)?.closest(".col-md-2")?.remove();
            })
            .catch(err => console.error(err));
        });
    }

    // OPEN EDIT + DEFAULT VALUES
    const editReportBtn = document.getElementById("editReportBtn");
    if (editReportBtn) {
        editReportBtn.addEventListener("click", function () {
            if (!currentReport) return;
            
            document.querySelector("#edit-report-modal input[name='item_name']").value = currentReport.item_name ?? "";  
            document.querySelector("#edit-report-modal select[name='category']").value = (currentReport.category ?? "").trim();
            document.querySelector("#edit-report-modal input[name='date_lost']").value = (currentReport.date_lost ?? "").split(" ")[0];
            document.querySelector("#edit-report-modal input[name='location_lost']").value = currentReport.location_lost ?? "";
            document.querySelector("#edit-report-modal textarea[name='description']").value = currentReport.description ?? "";
        });
    }

    // SUBMIT EDIT REPORT FORM
    document.getElementById("editReportForm").addEventListener("submit", function (e) {
        e.preventDefault();
        if (!currentReport) return;

        const formData = new FormData(this);
        formData.append("item_id", currentReport.item_id);
        formData.append("type", "report");

        fetch("actions/update.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(response => {
            console.log(response);
            bootstrap.Modal.getInstance(document.getElementById("edit-report-modal")).hide();
            loadReport(currentReport.item_id);
            location.reload(); 
        })
        .catch(err => console.error(err));
    });

    // ADD REPORT FORM SUBMISSION
    document.getElementById("addReportForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append("type", "report");

        fetch("actions/insert.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(response => {
            console.log(response);
            bootstrap.Modal.getInstance(document.getElementById("add-report-modal")).hide();
            location.reload();
        })
        .catch(err => console.error(err));
    });

    //CLAIM REPORT BUTTON
    document.getElementById("claimItemBtn").addEventListener("click", function () {
        if (!currentReportId) return;

        const formData = new FormData();
        formData.append("item_id", currentReportId);
        formData.append("claimer_id", currentUserId); // Patched with dynamically injected user session variable
        formData.append("type", "report");

        fetch("actions/claim.php", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(response => {
            console.log(response);
            bootstrap.Modal.getInstance(document.getElementById("report-modal1")).hide();
            location.reload();
        })
        .catch(err => console.error(err));
    });

});

// LOAD REPORT DYNAMIC WORKFLOW
function loadReport(id) {
    currentReportId = id;

    fetch("actions/get_item.php?id=" + id + "&type=report")
        .then(res => res.json())
        .then(data => {
            currentReport = data;

            document.querySelector("#report-modal1 .report-name").innerText = data.item_name ?? "N/A";
            document.querySelector("#report-modal1 .report-location").innerText = data.location_lost ?? "N/A";
            document.querySelector("#report-modal1 .report-date").innerText = data.date_lost ?? "N/A";
            document.querySelector("#report-modal1 .report-desc").innerText = data.description ?? "No description";
            document.querySelector("#report-modal1 .report-uploader").innerText = ((data.f_name ?? "") + " " + (data.l_name ?? "")).trim();

            const adminUploaderFooter = document.getElementById("admin-uploader-report-footer");
            const claimReportBox = document.getElementById("claim-report-box");
            const contactUserBox = document.getElementById("contact-user-box");

            const isAuthorized = (currentUserRole === 'admin' || currentUserId == data.uploader_id);

            if (isAuthorized) {
                adminUploaderFooter.style.display = "flex";
                claimReportBox.style.display = "block";
                contactUserBox.style.display = "none";
            } else {
                adminUploaderFooter.style.display = "none";
                claimReportBox.style.display = "none";
                contactUserBox.style.display = "block";
            }
        })
        .catch(err => console.error("Error loading report:", err));
}
        </script>

        <script>
            window.addEventListener("pageshow", function (event) {
                if (event.persisted) {
                    window.location.reload();
                }
            });

            let activeCategory = "all";
            let activeSortOrder = "newest";

            const searchInput = document.getElementById("searchInput");
            const reportContainer = document.getElementById("reportContainer");

            function filterAndSortGallery() {
                const keyword = searchInput.value.toLowerCase();
                const cards = Array.from(document.querySelectorAll(".report-card"));
                let visibleCount = 0;

                cards.forEach(card => {
                    const box = card.querySelector(".report-card-box");
                    const searchText = box.getAttribute("data-search") || "";
                    const reportCategory = card.getAttribute("data-category") || "";

                    const matchesSearch = searchText.includes(keyword);
                    const matchesCategory = (activeCategory === "all" || reportCategory === activeCategory);

                    if (matchesSearch && matchesCategory) {
                        card.style.display = "";
                        visibleCount++;
                    } else {
                        card.style.display = "none";
                    }
                });

                const noReportsMessage = document.getElementById("noReportsMessage");
                noReportsMessage.style.display = (visibleCount === 0) ? "block" : "none";

                cards.sort((cardA, cardB) => {
                    const timeA = parseInt(cardA.getAttribute("data-time")) || 0;
                    const timeB = parseInt(cardB.getAttribute("data-time")) || 0;

                    return activeSortOrder === "newest" ? (timeB - timeA) : (timeA - timeB);
                });

                cards.forEach(card => reportContainer.appendChild(card));
            }

            searchInput.addEventListener("input", filterAndSortGallery);

            document.querySelectorAll(".category-filter").forEach(link => {
                link.addEventListener("click", function (e) {
                    e.preventDefault();
                    document.querySelectorAll(".category-filter").forEach(item => item.classList.remove("active"));
                    this.classList.add("active");

                    activeCategory = this.getAttribute("data-category");
                    document.getElementById("filterLabel").innerText = activeCategory === "all" ? "Filter" : activeCategory;
                    filterAndSortGallery();
                });
            });

            document.querySelectorAll(".sort-filter").forEach(link => {
                link.addEventListener("click", function (e) {
                    e.preventDefault();
                    document.querySelectorAll(".sort-filter").forEach(item => item.classList.remove("active"));
                    this.classList.add("active");

                    activeSortOrder = this.getAttribute("data-sort");
                    filterAndSortGallery();
                });
            });
        </script>
    </body>
</html>