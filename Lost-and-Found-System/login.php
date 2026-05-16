<!DOCTYPE html>
<html>

    <?php
    include 'head.php';
    ?>

    <body>

        <!-- LOGIN PAGE -->
        <div class="bg-image shadow-1-strong">
            <div class="mask d-flex align-items-center h-100">
                <div class="container">

                    <!-- WELCOME MESSAGE -->
                    <div class="row mb-4">
                        <div class="col-12 text-center">
                            <h1 style="color: #311432;" class="fw-bold">Welcome to Reclaim!</h1>
                            <p class="text-muted">Log into your account here.</p>
                        </div>
                    </div>

                    <!-- LOGIN CARD -->
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="card" style="width: 28rem;">
                                <div class="card-body mt-4">
                                    <form>
                                        <div class="mb-3">
                                            <label for="input-email" class="form-label">Email address</label>
                                            <input type="email" class="form-control" id="input-email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="input-password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="input-password">
                                        </div>
                                        <div class="mb-3">
                                            <p>New here? 
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#register-modal" 
                                                class="text-secondary">
                                                Register</a>
                                            </p>
                                        </div>
                                        <button type="submit" 
                                        class="btn w-100 my-3" 
                                        style="background-color: #311432;color: white;">
                                            Sign in
                                        </button>
                                    </form>
                                </div>
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
    </body>

</html>