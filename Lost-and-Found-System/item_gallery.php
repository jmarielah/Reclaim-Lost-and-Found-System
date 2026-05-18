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

                    <div class="col-md-2" >

                        <div class="card shadow-sm border h-100" data-id="<?= $row['item_id'] ?>" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#item-modal1">
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

        <script>
let currentItemId = null;
let currentItem = null;

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
                body: "id=" + currentItemId
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

            document.querySelector("#edit-item-modal input[name='location']").value =
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
    formData.append("item_id", currentItem.item_id);

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

            currentItem = data; // IMPORTANT (stores for edit)

            document.querySelector("#item-modal1 .item-name").innerText =
                data.item_name ?? "N/A";

            document.querySelector("#item-modal1 .item-location").innerText =
                data.location_found ?? "N/A";

            document.querySelector("#item-modal1 .item-date").innerText =
                data.date_found ?? "N/A";

            document.querySelector("#item-modal1 .item-desc").innerText =
                data.description ?? "No description";

            document.querySelector("#item-modal1 .item-uploader").innerText =
                ((data.f_name ?? "") + " " + (data.l_name ?? "")).trim();

            const badge = document.querySelector("#item-modal1 .modal-header .badge");

            if (data.status === "claimed") {
                badge.className = "badge bg-success text-light rounded-pill ms-3 px-3 py-2";
                badge.innerText = "Claimed";
            } 
            else if (data.status === "disposed") {
                badge.className = "badge bg-danger text-light rounded-pill ms-3 px-3 py-2";
                badge.innerText = "Disposed";
            } 
            else {
                badge.className = "badge bg-dark text-light rounded-pill ms-3 px-3 py-2";
                badge.innerText = "Found";
            }

        })
        .catch(err => console.error("Error loading item:", err));
}


// CLAIM BUTTON
const claimBtn = document.getElementById("claimBtn");

if (claimBtn) {

    claimBtn.addEventListener("click", function () {

        if (!currentItemId) return;

        const claimerId = document.getElementById("claimerID").value;

        if (!claimerId) {
            alert("Please enter Claimer ID Number");
            return;
        }

        fetch("actions/claim.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body:
                "item_id=" + currentItemId +
                "&claimer_id=" + encodeURIComponent(claimerId)
        })
        .then(res => res.text())
        .then(response => {

            console.log(response);

            alert("Item claimed successfully");

            // close modal
            bootstrap.Modal.getInstance(
                document.getElementById("item-modal1")
            ).hide();

            // optional: reload page to refresh badge
            location.reload();
        })
        .catch(err => console.error(err));
    });

}
        </script>
    </body>
</html>