<!-- all modals of each page are compiled here."-->
<!-------------------------- GENERAL MODALS -------------------------->
<!-- USER CONTACT MODAL -->
<div class="modal fade" id="contact-user-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center pb-4">
                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle text-white shadow-sm" 
                    style="width: 80px; height: 80px; background-color: #311432; font-size: 2rem;">
                    OL
                </div>

                <h5 class="fw-bold mb-1">Orlie Lacerona</h5>
                <p class="text-muted small mb-4">Item Uploader</p>

                <hr class="my-3 mx-4 opacity-50">

                <div class="text-start px-3">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light p-2 rounded me-3">
                            <i class="bi bi-envelope-fill text-secondary"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Email Address</small>
                            <span class="fw-semibold">email@example.com</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-light p-2 rounded me-3">
                            <i class="bi bi-telephone-fill text-secondary"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Phone Number</small>
                            <span class="fw-semibold">+63 912 345 6789</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="bg-light p-2 rounded me-3">
                            <i class="bi bi-building text-secondary"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Department/Office</small>
                            <span class="fw-semibold">College of Computing Education - BSCS</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-------------------------- LOGIN MODALS -------------------------->
<!-- REGISTER MODAL -->
<div class="modal fade" id="register-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h5 class="modal-title">Choose a role.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <div class="row g-3">

                        <!-- ADMIN CARD -->
                        <div class="col-md-6">
                            <a href="register_admin.php" class="text-decoration-none text-dark">
                                <div class="card h-100 shadow-sm border" id="admin-card" style="cursor: pointer;">
                                    <div class="card-body text-center align-items-center p-4">
                                        <div class="mb-3">
                                            <i class="bi bi-shield-lock" style="font-size: 2rem; color: #311432;"></i>
                                        </div>
                                        <h5 class="card-title fw-bold mt-3">Admin</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- USER CARD -->
                        <div class="col-md-6">
                            <a href="register_student.php" class="text-decoration-none text-dark">
                                <div class="card h-100 shadow-sm border" id="user-card" style="cursor: pointer;">
                                    <div class="card-body text-center p-4">
                                        <div class="mb-3">
                                            <i class="bi bi-person" style="font-size: 2rem; color: #311432;"></i>
                                        </div>
                                        <h5 class="card-title fw-bold mt-3">Student</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-------------------------- DASHBOARD MODALS -------------------------->
<!-- VERIFY ITEM MODAL -->
<div class="modal fade" id="verify-item-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Item Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-5 text-center border-end">
                        <img src="img/logo.png" alt="No Image" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                    </div>
                    <div class="col-md-7 ps-4">
                        <h6 class="text-uppercase text-muted small fw-bold">Lost Item</h6>
                        <p class="fs-5 item-name"></p>

                        <h6 class="text-uppercase text-muted small fw-bold">Location(Last Seen)</h6>
                        <p class="fs-5 item-location"></p>

                        <h6 class="text-uppercase text-muted small fw-bold">Date Lost</h6>
                        <p class="fs-5 item-date"></p>

                        <h6 class="text-uppercase text-muted small fw-bold">Description</h6>
                        <p class="fs-6 item-desc"></p>
                        
                        <hr>
                        <p class="small text-secondary">Uploaded by: <span class="item-uploader"></span></p>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-outline-danger"
                    onclick="rejectPost(currentId, currentType)">
                    Reject
                </button>
                <button type="button"
                    class="btn text-white"
                    style="background-color: #311432;"
                    onclick="verifyPost(currentId, currentType)">
                    Verify & Post
                </button>
            </div>

        </div>
    </div>
</div>

<!-- VERIFY REPORT MODAL -->
<div class="modal fade" id="verify-report-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Report Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-5 text-center border-end">
                        <img src="img/logo.png" alt="No Image" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                    </div>
                    <div class="col-md-7 ps-4">
                        <h6 class="text-uppercase text-muted small fw-bold">Lost Item</h6>
                        <p class="fs-5 item-name"></p>

                        <h6 class="text-uppercase text-muted small fw-bold">Location(Last Seen)</h6>
                        <p class="fs-5 item-location"></p>

                        <h6 class="text-uppercase text-muted small fw-bold">Date Lost</h6>
                        <p class="fs-5 item-date"></p>

                        <h6 class="text-uppercase text-muted small fw-bold">Description</h6>
                        <p class="fs-6 item-desc"></p>
                        
                        <hr>
                        <p class="small text-secondary">Uploaded by: <span class="item-uploader"></span></p>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button"
                    class="btn btn-outline-danger"
                    onclick="rejectPost(currentId, currentType)">
                    Reject
                </button>
                <button type="button"
                    class="btn text-white"
                    style="background-color: #311432;"
                    onclick="verifyPost(currentId, currentType)">
                    Verify & Post
                </button>
            </div>

        </div>
    </div>
</div>

<!-------------------------- ITEM GALLERY MODALS -------------------------->
<!-- ITEM MODAL (UPLOADER PERSPECTIVE) -->
<div class="modal fade" id="item-modal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Item Details</h5>
                <span class="badge rounded-pill ms-3 px-3 py-2"></span>
                <!-- Other status states (use conditional statements) -->
                <!--<span class="badge bg-dark text-light rounded-pill ms-3 px-3 py-2">Found</span>-->
                <!--<span class="badge bg-danger text-light rounded-pill ms-3 px-3 py-2">Disposed</span>-->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-5 text-center border-end">
                        <img src="img/logo.png" alt="No Image" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                        <div class="mt-4 px-2">
                            <div class="mb-2">
                                <label for="claimerID" class="form-label small fw-bold text-muted text-uppercase d-block text-start">Claimer ID Number</label>
                                <input type="text" class="form-control form-control-sm" id="claimerID" placeholder="Enter ID Number" required>
                            </div>
                            <button type="button" class="btn btn-sm w-100 text-white shadow-sm" style="background-color: #311432;"
                            data-bs-dismiss="modal">
                                <i class="bi bi-check2-circle"></i> Item Claimed
                            </button>
                        </div>
                    </div>

                    <div class="col-md-7 ps-4">
                        <h6 class="text-uppercase text-muted small fw-bold">Found Item</h6>
                        <p class="fs-5 item-name"></p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Location</h6>
                        <p class="fs-5 item-location"></p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Date Found</h6>
                        <p class="fs-5 item-date"></p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Description</h6>
                        <p class="fs-6 item-desc"></p>
                        
                        <hr>
                        <p class="small text-secondary">Uploaded by: <span class="item-uploader"></span></p>
                    </div>
                </div>
            </div>
            
            <!-- NOTE: only add this footer if the user is an ADMIN/UPLOADER -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Edit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Delete</button>
            </div>

        </div>
    </div>
</div>

<!-- ITEM MODAL (NON-UPLOADER PERSPECTIVE) -->
<div class="modal fade" id="item-modal2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Item Details</h5>
                <span class="badge bg-dark text-light rounded-pill ms-3 px-3 py-2">Found</span>
                <!-- Other status states (use conditional statements) -->
                <!--<span class="badge bg-success text-light rounded-pill ms-3 px-3 py-2">Claimed</span>-->
                <!--<span class="badge bg-danger text-light rounded-pill ms-3 px-3 py-2">Disposed</span>-->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-5 text-center border-end">
                        <img src="img/logo.png" alt="No Image" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                        <div class="mt-4 px-2">
                            <button type="button" class="btn btn-sm w-100 text-white shadow-sm" style="background-color: #311432;"
                            data-bs-toggle="modal" data-bs-target="#contact-user-modal" data-bs-dismiss="modal">
                                Contact User
                            </button>
                        </div>
                    </div>

                    <div class="col-md-7 ps-4">
                        <h6 class="text-uppercase text-muted small fw-bold">Found Item</h6>
                        <p class="fs-5">Phone</p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Location</h6>
                        <p class="fs-5">Library</p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Date Found</h6>
                        <p class="fs-5">May 16, 2026</p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Description</h6>
                        <p class="fs-6">Clear casing and found in a bookshelf. Claim if it is yours.</p>
                        
                        <hr>
                        <p class="small text-secondary">Uploaded by: Orlie Lacerona</p>
                    </div>
                </div>
            </div>

            <!-- NOTE: only add this footer if the user is an ADMIN/UPLOADER -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#edit-item-modal" data-bs-dismiss="modal" >Edit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Delete</button>
            </div>

        </div>
    </div>
</div>

<!-- ADD ITEM MODAL -->
<div class="modal fade" id="add-item-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addItemModalLabel">Post Found Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form>
                <div class="modal-body">

                    <div class="mb-3 text-center">
                        <label for="itemImage" class="form-label d-block text-start fw-semibold">Item Image</label>
                        <div class="border rounded p-3 bg-light d-flex flex-column align-items-center justify-content-center" style="height: 150px; border-style: dashed !important;">
                            <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                            <input type="file" class="form-control form-control-sm mt-2" id="itemImage" name="item_image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Item Name</label>
                        <input type="text" class="form-control" name="item_name" placeholder="Enter item name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="" selected disabled>Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Documents">Documents</option>
                                <option value="Personal Items">Personal Items</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Date Found</label>
                            <input type="date" class="form-control" name="date_found" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Location Found</label>
                        <input type="text" class="form-control" name="location" placeholder="Enter location found" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Description/Notes</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Provide more specific details"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white px-4" style="background-color: #311432;">
                        Post Item
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- EDIT ITEM MODAL -->
<div class="modal fade" id="edit-item-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addItemModalLabel">Edit Found Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form>
                <div class="modal-body">

                    <div class="mb-3 text-center">
                        <label for="itemImage" class="form-label d-block text-start fw-semibold">Item Image</label>
                        <div class="border rounded p-3 bg-light d-flex flex-column align-items-center justify-content-center" style="height: 150px; border-style: dashed !important;">
                            <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                            <input type="file" class="form-control form-control-sm mt-2" id="itemImage" name="item_image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Item Name</label>
                        <input type="text" class="form-control" name="item_name" placeholder="Enter item name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="" selected disabled>Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Documents">Documents</option>
                                <option value="Personal Items">Personal Items</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Date Found</label>
                            <input type="date" class="form-control" name="date_found" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Location Found</label>
                        <input type="text" class="form-control" name="location" placeholder="Enter location found" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Description/Notes</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Provide more specific details"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white px-4" style="background-color: #311432;">
                        Post Item
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-------------------------- REPORTS MODALS -------------------------->
<!-- REPORT MODAL (UPLOADER PERSPECTIVE) -->
<div class="modal fade" id="report-modal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Item Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row">

                    <div class="col-md-5 text-center border-end">
                        <img src="img/logo.png" alt="No Image" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                        <div class="mt-4 px-2">
                            <button type="button" class="btn btn-sm w-100 text-white shadow-sm" style="background-color: #311432;"
                            data-bs-dismiss="modal">
                                <i class="bi bi-check2-circle"></i> Item Found
                            </button>
                        </div>
                    </div>

                    <div class="col-md-7 ps-4">
                        <h6 class="text-uppercase text-muted small fw-bold">Lost Item</h6>
                        <p class="fs-5">Phone</p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Location(Last Seen):</h6>
                        <p class="fs-5">Library</p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Date Lost</h6>
                        <p class="fs-5">May 16, 2026</p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Description</h6>
                        <p class="fs-6">Clear casing, lost it while looking for a book at Circulation A-B.</p>
                        
                        <hr>
                        <p class="small text-secondary">Uploaded by: Orlie Lacerona</p>
                    </div>
                </div>
            </div>
            
            <!-- NOTE: only add this footer if the user is an ADMIN/UPLOADER -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Edit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Delete</button>
            </div>

        </div>
    </div>
</div>

<!-- REPORT MODAL (NON-UPLOADER PERSPECTIVE) -->
<div class="modal fade" id="report-modal2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Item Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="row">

                    <div class="col-md-5 text-center border-end">
                        <img src="img/logo.png" alt="No Image" class="img-fluid rounded shadow-sm" style="max-height: 250px;">
                        <div class="mt-4 px-2">
                            <button type="button" class="btn btn-sm w-100 text-white shadow-sm" style="background-color: #311432;"
                            data-bs-toggle="modal" data-bs-target="#contact-user-modal" data-bs-dismiss="modal">
                                Contact User
                            </button>
                        </div>
                    </div>

                    <div class="col-md-7 ps-4">
                        <h6 class="text-uppercase text-muted small fw-bold">Lost Item</h6>
                        <p class="fs-5">Phone</p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Location(Last Seen):</h6>
                        <p class="fs-5">Library</p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Date Lost</h6>
                        <p class="fs-5">May 16, 2026</p>
                        
                        <h6 class="text-uppercase text-muted small fw-bold">Description</h6>
                        <p class="fs-6">Clear casing, lost it while looking for a book at Circulation A-B.</p>
                        
                        <hr>
                        <p class="small text-secondary">Uploaded by: Orlie Lacerona</p>
                    </div>
                </div>
            </div>
            
            <!-- NOTE: only add this footer if the user is an ADMIN/UPLOADER -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#edit-report-modal">Edit</button>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Delete</button>
            </div>

        </div>
    </div>
</div>

<!-- ADD REPORT MODAL -->
<div class="modal fade" id="add-report-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addItemModalLabel">Post a Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form>
                <div class="modal-body">

                    <div class="mb-3 text-center">
                        <label for="itemImage" class="form-label d-block text-start fw-semibold">Item Image (Reference)</label>
                        <div class="border rounded p-3 bg-light d-flex flex-column align-items-center justify-content-center" style="height: 150px; border-style: dashed !important;">
                            <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                            <input type="file" class="form-control form-control-sm mt-2" id="itemImage" name="item_image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Item Name</label>
                        <input type="text" class="form-control" name="item_name" placeholder="Enter item name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="" selected disabled>Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Documents">Documents</option>
                                <option value="Personal Items">Personal Items</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Date Lost</label>
                            <input type="date" class="form-control" name="date_found" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Location(Last Seen)</label>
                        <input type="text" class="form-control" name="location" placeholder="Enter location last seen" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Description/Notes</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Provide more specific details"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white px-4" style="background-color: #311432;">
                        Post Report
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- EDIT REPORT MODAL -->
<div class="modal fade" id="edit-report-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="addItemModalLabel">Edit Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form>
                <div class="modal-body">

                    <div class="mb-3 text-center">
                        <label for="itemImage" class="form-label d-block text-start fw-semibold">Item Image (Reference)</label>
                        <div class="border rounded p-3 bg-light d-flex flex-column align-items-center justify-content-center" style="height: 150px; border-style: dashed !important;">
                            <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                            <input type="file" class="form-control form-control-sm mt-2" id="itemImage" name="item_image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Item Name</label>
                        <input type="text" class="form-control" name="item_name" placeholder="Enter item name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Category</label>
                            <select class="form-select" name="category" required>
                                <option value="" selected disabled>Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Documents">Documents</option>
                                <option value="Personal Items">Personal Items</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Date Lost</label>
                            <input type="date" class="form-control" name="date_found" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Location(Last Seen)</label>
                        <input type="text" class="form-control" name="location" placeholder="Enter location last seen" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Description/Notes</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Provide more specific details"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white px-4" style="background-color: #311432;">
                        Post Report
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>