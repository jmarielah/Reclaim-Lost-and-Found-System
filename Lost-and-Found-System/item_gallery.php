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
        include 'config/config.php';

        $sql = "SELECT * FROM items WHERE ver_status = 'approved' ORDER BY created_at DESC";
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
        
            <div class="row mt-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex gap-2 flex-grow-1 flex-md-grow-0" style="max-width: 600px;">
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Search items...">
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
                                    <li><h6 class="dropdown-header">Sort By</h6></li>
                                    <li><a class="dropdown-item sort-filter active" href="#" data-sort="newest">Newest First</a></li>
                                    <li><a class="dropdown-item sort-filter" href="#" data-sort="oldest">Oldest First</a></li>
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
                
                <div class="row g-4" id="itemContainer" style="min-height: 300px;">
                    
                    <?php while ($row = $result->fetch_assoc()) { ?>

                    <?php
                        if ($row['status'] == 'claimed') {
                            $badgeClass = 'bg-success';
                        } elseif ($row['status'] == 'disposed') {
                            $badgeClass = 'bg-danger';
                        } else {
                            $badgeClass = 'bg-dark';
                        }
                        $timestamp = strtotime($row['created_at'] ?? 'now');
                        $categoryClean = trim($row['category'] ?? 'Others');
                    ?>

                    <div class="col-md-2 item-card" 
                         data-category="<?= htmlspecialchars($categoryClean) ?>" 
                         data-time="<?= $timestamp ?>">

                        <div class="card shadow-sm border h-100 item-card-box"
                            data-id="<?= $row['item_id'] ?>"
                            data-search="<?= strtolower(htmlspecialchars($row['item_name'] . ' ' . $row['location_found'])) ?>"
                            style="cursor:pointer;"
                            data-bs-toggle="modal"
                            data-bs-target="#item-modal1">
                            <div class="card-body align-items-center text-center">

                                <img src="img/logo.png"
                                    alt=""
                                    class="rounded"
                                    style="width:100%;height:180px;object-fit:cover;">

                                <h6 class="fw-bold mt-2 mb-0">
                                    <?= htmlspecialchars($row['item_name']) ?>
                                </h6>

                                <small class="text-muted">
                                    Found at: <?= htmlspecialchars($row['location_found']) ?>
                                </small>

                                <span class="badge <?= $badgeClass ?> text-light rounded-pill ms-3 px-3 py-2 d-block mt-2">
                                    <?= ucfirst($row['status']) ?>
                                </span>

                            </div>
                        </div>

                    </div>

                <?php } ?>
        </div>
</div>

        <?php
        include 'modals.php';
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
let currentItemId = null;
let currentItem = null;

const currentUserId = <?= json_encode($current_user_id ?? null) ?>;
const currentUserRole = <?= json_encode($current_role ?? 'student') ?>;

document.addEventListener("DOMContentLoaded", function () {

    // CARD CLICK (LOAD ITEM)
    document.querySelectorAll(".card[data-id]").forEach(card => {
        card.addEventListener("click", function () {
            loadItem(this.dataset.id);
        });
    });

    // DELETE BUTTON
    const deleteBtn = document.getElementById("deleteBtn");
    if (deleteBtn) {
        deleteBtn.addEventListener("click", function () {

            if (!currentItemId) return;
            if (!confirm("Are you sure you want to delete this item?")) return;

            fetch("actions/delete.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + currentItemId + "&type=item"
            })
            .then(res => res.text())
            .then(() => {

                bootstrap.Modal.getInstance(
                    document.getElementById("item-modal1")
                ).hide();

                document.querySelector(`[data-id="${currentItemId}"]`)
                    ?.closest(".col-md-2")
                    ?.remove();
            })
            .catch(err => console.error(err));
        });
    }

    // EDIT BUTTON
    const editBtn = document.getElementById("editBtn");
    if (editBtn) {
        editBtn.addEventListener("click", function () {

            if (!currentItem) return;
            

            document.querySelector("#edit-item-modal input[name='item_name']").value =
                currentItem.item_name ?? "";

            document.querySelector("#edit-item-modal input[name='location_found']").value =
                currentItem.location_found ?? "";

            document.querySelector("#edit-item-modal textarea[name='description']").value =
                currentItem.description ?? "";

            document.querySelector("#edit-item-modal input[name='date_found']").value =
                currentItem.date_found ?? "";

            document.querySelector("#edit-item-modal select[name='category']").value =
                (currentItem.category ?? "").trim();
        });
    }


    document.getElementById("editItemForm").addEventListener("submit", function (e) {
    e.preventDefault();

    if (!currentItem) return;

    const formData = new FormData(this);
    formData.append("type", "item");
    formData.append("item_id", currentItem.item_id);
    formData.append("date", document.querySelector("#edit-item-modal input[name='date_found']").value);

    fetch("actions/update.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(response => {

        console.log(response);

        // close modal
        bootstrap.Modal.getInstance(
            document.getElementById("edit-item-modal")
        ).hide();

        // refresh data
        loadItem(currentItem.item_id);
        location.reload();

    })
    .catch(err => console.error(err));
});

});


// LOAD ITEM FUNCTION
function loadItem(id) {
    currentItemId = id;

    fetch("actions/get_item.php?id=" + id)
        .then(res => res.json())
        .then(data => {
            currentItem = data;

            document.querySelector("#item-modal1 .item-name").innerText = data.item_name ?? "N/A";
            document.querySelector("#item-modal1 .item-location").innerText = data.location_found ?? "N/A";
            document.querySelector("#item-modal1 .item-date").innerText = data.date_found ?? "N/A";
            document.querySelector("#item-modal1 .item-desc").innerText = data.description ?? "No description";
            document.querySelector("#item-modal1 .item-uploader").innerText = ((data.f_name ?? "") + " " + (data.l_name ?? "")).trim();

            const badge = document.querySelector("#item-modal1 .modal-header .badge");
            if (data.status === "claimed") {
                badge.className = "badge bg-success text-light rounded-pill ms-3 px-3 py-2";
                badge.innerText = "Claimed";
            } else if (data.status === "disposed") {
                badge.className = "badge bg-danger text-light rounded-pill ms-3 px-3 py-2";
                badge.innerText = "Disposed";
            } else {
                badge.className = "badge bg-dark text-light rounded-pill ms-3 px-3 py-2";
                badge.innerText = "Found";
            }

            const adminUploaderFooter = document.getElementById("admin-uploader-footer");
            const claimManagementBox = document.getElementById("claim-management-box");
            const publicActionBox = document.getElementById("public-action-box");

            const isAuthorized = (currentUserRole === 'admin' || currentUserId == data.uploader_id);

            if (isAuthorized) {
                adminUploaderFooter.style.display = "flex";
                claimManagementBox.style.display = "block";
                publicActionBox.style.display = "none";
            } else {
                adminUploaderFooter.style.display = "none";
                claimManagementBox.style.display = "none";
                publicActionBox.style.display = "block";
            }
        })
        .catch(err => console.error("Error loading item properties:", err));
}


// CLAIM BUTTON
document.getElementById("claimBtn").addEventListener("click", function () {

    if (!currentItemId) return;

    const claimerId = document.getElementById("claimerID").value;

    if (!claimerId) {
        alert("Please enter Claimer ID Number");
        return;
    }

    const formData = new FormData();
    formData.append("item_id", currentItemId);
    formData.append("claimer_id", claimerId);
    formData.append("type", "item");

    fetch("actions/claim.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(response => {

        console.log(response);

        bootstrap.Modal.getInstance(
            document.getElementById("item-modal1")
        ).hide();

        location.reload();
    })
    .catch(err => console.error(err));
});



document.getElementById("addItemForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("type", "item");

    fetch("actions/insert.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(response => {

        console.log("ITEM INSERT:", response);

        bootstrap.Modal.getInstance(
            document.getElementById("add-item-modal")
        ).hide();

        location.reload();
    })
    .catch(err => console.error(err));
});
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
            const itemContainer = document.getElementById("itemContainer");

            function filterAndSortGallery() {
                const keyword = searchInput.value.toLowerCase();
                const cards = Array.from(document.querySelectorAll(".item-card"));

                cards.forEach(card => {
                    const box = card.querySelector(".item-card-box");
                    const searchText = box.getAttribute("data-search") || "";
                    const itemCategory = card.getAttribute("data-category") || "";

                    const matchesSearch = searchText.includes(keyword);
                    const matchesCategory = (activeCategory === "all" || itemCategory === activeCategory);

                    if (matchesSearch && matchesCategory) {
                        card.style.display = "";
                    } else {
                        card.style.display = "none";
                    }
                });

                cards.sort((cardA, cardB) => {
                    const timeA = parseInt(cardA.getAttribute("data-time")) || 0;
                    const timeB = parseInt(cardB.getAttribute("data-time")) || 0;

                    return activeSortOrder === "newest" ? (timeB - timeA) : (timeA - timeB);
                });

                cards.forEach(card => itemContainer.appendChild(card));
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