<?php
include 'config/auth_check.php';
include 'config/config.php';
?>

<!DOCTYPE html>
<html>
    <?php
    include 'head.php';


    include 'config/config.php';

    $members_sql = "SELECT * FROM users ORDER BY created_at DESC";
$members_result = $conn->query($members_sql);

$claims_sql = "
SELECT 
    claim_history.*,
    items.item_name
FROM claim_history
LEFT JOIN items 
    ON claim_history.item_id = items.item_id
ORDER BY claim_date DESC
";

$claims_result = $conn->query($claims_sql);
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
                                    <input type="text" id="memberSearch" class="form-control border-start-0" placeholder="Search by name or ID...">
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

<?php while ($member = $members_result->fetch_assoc()) { ?>

<tr class="member-row">
    <td><?= htmlspecialchars($member['user_id']) ?></td>

    <td>
        <?= htmlspecialchars($member['f_name'] . ' ' . $member['l_name']) ?>
    </td>

    <td><?= htmlspecialchars($member['department']) ?></td>

    <td>
        <?= date("F d, Y", strtotime($member['created_at'])) ?>
    </td>

    <td class="text-center">
        <button class="btn btn-sm btn-light border view-profile-btn"
            data-user-id="<?= $member['user_id'] ?>"
            type="button">
            View Profile
        </button>
    </td>
</tr>

<?php } ?>

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
                                    <input type="text" id="claimSearch" class="form-control border-start-0" placeholder="Search claims...">
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

<?php while ($claim = $claims_result->fetch_assoc()) { ?>

<tr class="claim-row">
    <td>
        #<?= htmlspecialchars($claim['item_id']) ?>
    </td>

    <td>
        <?= htmlspecialchars($claim['item_name'] ?? 'Unknown Item') ?>
    </td>

    <td>
        <?= htmlspecialchars($claim['claimer_id']) ?>
    </td>

    <td class="text-center">
        <?= date("F d, Y", strtotime($claim['claim_date'])) ?>
    </td>

</tr>

<?php } ?>

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


//
// MEMBER SEARCH
//
document.getElementById("memberSearch")
.addEventListener("input", function () {

    const keyword = this.value.toLowerCase();

    document.querySelectorAll(".member-row").forEach(row => {

        const text = row.innerText.toLowerCase();

        if (text.includes(keyword)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });

});


//
// CLAIM SEARCH
//
document.getElementById("claimSearch")
.addEventListener("input", function () {

    const keyword = this.value.toLowerCase();

    document.querySelectorAll(".claim-row").forEach(row => {

        const text = row.innerText.toLowerCase();

        if (text.includes(keyword)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }

    });

});
            window.addEventListener("pageshow", function (event) {
                if (event.persisted) {
                    window.location.reload();
                }
            });


document.querySelectorAll(".view-profile-btn").forEach(btn => {
    btn.addEventListener("click", function () {

        const userId = this.getAttribute("data-user-id");
        if (!userId) return;

        fetch("actions/get_user.php?id=" + userId)
            .then(res => res.json())
            .then(user => {

                if (!user || Object.keys(user).length === 0) {
                    alert("User not found.");
                    return;
                }

                const fullName = ((user.f_name ?? "") + " " + (user.l_name ?? "")).trim();

                const initials = fullName
                    .split(" ")
                    .filter(Boolean)
                    .map(n => n[0])
                    .join("")
                    .toUpperCase();

                // Fill modal fields
                document.querySelector("#contact-user-modal .uploader-name").innerText = fullName || "Unknown";
                document.querySelector("#contact-user-modal .email-value").innerText = user.email ?? "N/A";
                document.querySelector("#contact-user-modal .phone-value").innerText = user.phone_no ?? "N/A";
                document.querySelector("#contact-user-modal .department-value").innerText = user.department ?? "N/A";

                document.querySelector("#contact-user-modal .rounded-circle").innerText = initials || "U";

                // Open modal
                new bootstrap.Modal(document.getElementById("contact-user-modal")).show();
            })
            .catch(err => {
                console.error(err);
                alert("Failed to load profile.");
            });
    });
});
        </script>

    </body>
</html>