<!DOCTYPE html>
<html>
    <?php
    include 'head.php';
    ?>


    <?php
        include 'config/config.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $firstname = trim($_POST['firstname']);
            $lastname = trim($_POST['lastname']);
            $phone = trim($_POST['phone']);
            $idnumber = trim($_POST['idnumber']);
            $department = trim($_POST['department']);
            $yearlevel = trim($_POST['yearlevel']);
            $course = trim($_POST['course']);

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $role = "student";

            // USE ID NUMBER FROM FORM (NOT RANDOM)
            $user_id = $idnumber;

            // INSERT INTO USERS
            $sql_users = "INSERT INTO users
            (user_id, email, password, role, f_name, l_name, phone_no, department)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql_users);

            $stmt->bind_param(
                "isssssss",
                $user_id,
                $email,
                $hashed_password,
                $role,
                $firstname,
                $lastname,
                $phone,
                $department
            );

            if ($stmt->execute()) {

                // INSERT INTO STUDENTS
                $sql_students = "INSERT INTO students
                (user_id, course, year_level)
                VALUES (?, ?, ?)";

                $stmt2 = $conn->prepare($sql_students);

                $stmt2->bind_param(
                    "isi",
                    $user_id,
                    $course,
                    $yearlevel
                );

                if ($stmt2->execute()) {

                    echo "<div class='alert alert-success text-center m-3'>
                            Student Registered Successfully!
                        </div>";

                } else {

                    echo "<div class='alert alert-danger text-center m-3'>
                            Failed to register student details.
                        </div>";
                }

            } else {

                echo "<div class='alert alert-danger text-center m-3'>
                        Email or ID number already exists.
                    </div>";
            }
        }
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

                            <form method="POST" action="">

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">First Name</label>
                                        <input type="text" name="firstname" class="form-control" placeholder="Enter first name" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Last Name</label>
                                        <input type="text" name="lastname" class="form-control" placeholder="Enter last name" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter phone number" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">ID Number</label>
                                    <input type="text" name="idnumber" class="form-control" placeholder="Enter ID number" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Department</label>
                                    <input type="text" name="department" class="form-control" placeholder="Enter department" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-semibold">Year Level</label>
                                        <input type="number" name="yearlevel" class="form-control" min="1" max="5" required>
                                    </div>

                                    <div class="col-md-8 mb-4">
                                        <label class="form-label fw-semibold">Course</label>
                                        <select class="form-select" name="course" required>
                                            <option value="" disabled selected>Select your course</option>
                                            <option value="BSCS">BSCS</option>
                                            <option value="BSIT">BSIT</option>
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