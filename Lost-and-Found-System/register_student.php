<!DOCTYPE html>
<html>
    <?php
    include 'head.php';
    ?>

    <body>
        <div class="bg-image shadow-1-strong">
            <div class="mask d-flex align-items-center h-100">
                <div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">

                    <!-- ADMIN REGISTRATION CARD -->
                    <div class="card shadow-sm" style="width: 100%; max-width: 35rem;">
                        <div class="card-body p-4">

                            <div class="d-flex align-items-center justify-content-center mb-4">
                                <img src="img/logo.png" alt="Reclaim" style="width:60px; height:60px; object-fit: cover;" class="rounded-circle me-3">
                                <h3 class="fw-bold mb-0" style="color: #311432;">STUDENT REGISTRATION</h3>
                            </div>

                            <hr class="text-muted mb-4">

                            <form>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email Address</label>
                                    <input type="email" class="form-control" placeholder="Enter email" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Password</label>
                                    <input type="password" class="form-control" placeholder="Enter password" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">First Name</label>
                                        <input type="text" class="form-control" placeholder="Enter first name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Last Name</label>
                                        <input type="text" class="form-control" placeholder="Enter last name" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">ID Number</label>
                                    <input type="text" class="form-control" placeholder="Enter ID number" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Department</label>
                                    <input type="text" class="form-control" placeholder="Enter department" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Year Level</label>
                                        <input type="number" class="form-control" min="1" max="5" placeholder="1" required>
                                    </div>
                                    <div class="col-md-8 mb-4">
                                        <label class="form-label fw-semibold">Course</label>
                                        <select class="form-select" name="course" id="dropdown" required>
                                            <option value="" disabled selected>Select your course</option>
                                            <optgroup label="CCE">
                                                <option value="BSCS">BSCS (Computer Science)</option>
                                                <option value="BSIT">BSIT (Information Technology)</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-lg text-white" style="background-color: #311432;">
                                        Register
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>